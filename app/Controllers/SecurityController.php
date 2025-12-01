<?php
namespace App\Controllers;

class SecurityController extends BaseController
{

    
    public function index()
    {
      return view('dashboard/security_authorization');
    }


     public function View_authorized_visitor_list()
    {
      return view('dashboard/authorized_visitor_list');
    }



     public function authorized_visitors_list_data()
    {
        $db = \Config\Database::connect();

        $builder = $db->table('visitors vr');
        $builder->select("
            vr.id,
            vr.v_code,
            vr.visitor_name,
            vr.visitor_email,
            vr.visitor_phone,
            vr.purpose,
            vr.visit_time,
            vr.visit_date,
            vr.description,
            vr.vehicle_no,
            vr.vehicle_type,
            vr.proof_id_type,
            vr.proof_id_number,
            vr.securityCheckStatus,
            vr.spendTime,
            log.check_in_time,
            log.check_out_time,
            log.verified_by
        ");

        $builder->join('security_gate_logs log', 'log.visitor_request_id = vr.id', 'left');

        // Only approved visitors
        $builder->where('vr.status', 'approved');

        // Optional: show latest first
        $builder->orderBy('vr.id', 'DESC');

        $result = $builder->get()->getResultArray();

        return $this->response->setJSON($result);

    }


    public function verifyVisitor()
    {
        $vcode = $this->request->getPost('v_code');

        $model = new \App\Models\VisitorRequestModel();
        $visitor = $model->where('v_code', $vcode)->first();

        if (!$visitor) {
            return $this->response->setJSON(['status' => 'error']);
        }

        if ($visitor['status'] !== 'approved') {
            return $this->response->setJSON(['status' => 'not_approved']);
        }

        return $this->response->setJSON([
            'status' => 'success',
            'visitor' => $visitor
        ]);

    }

    
public function checkIn() 
{
    date_default_timezone_set('Asia/Kolkata');

    $log = new \App\Models\SecurityGateLogModel();
    $visitorModel = new \App\Models\VisitorRequestModel();

    $visitorId = $this->request->getPost('visitor_request_id');

    // Check if already checked-in
    $existing = $log->where('visitor_request_id', $visitorId)->first();

    if ($existing && $existing['check_in_time']) {
        return $this->response->setJSON(['status' => 'exists']);
    }

    // Insert log entry
    $log->insert([
        'visitor_request_id' => $visitorId,
        'v_code'             => $this->request->getPost('v_code'),
        'check_in_time'      => date('Y-m-d H:i:s'),
        'verified_by'        => session()->get('user_id'),
    ]);

    $visitorModel->update($visitorId, [
        'securityCheckStatus' => 1
    ]);

    return $this->response->setJSON(['status' => 'success']);
}




    public function checkOut()
    {
            date_default_timezone_set('Asia/Kolkata');

            $logModel = new \App\Models\SecurityGateLogModel();
            $visitorModel = new \App\Models\VisitorRequestModel();

            $visitorId = $this->request->getPost('visitor_request_id');

            // Fetch visitor
            $visitor = $visitorModel->find($visitorId);

            if (!$visitor || $visitor['securityCheckStatus'] != 1) {
                return $this->response->setJSON(['status' => 'no_entry']);
            }

            // Fetch security log entry
            $log = $logModel->where('visitor_request_id', $visitorId)->first();

            if (!$log || !$log['check_in_time'] ) {
                return $this->response->setJSON(['status' => 'no_entry']);
            }

            // Calculate spend time
            $entryTime = strtotime($log['check_in_time']);
            $exitTime  = time();

            $spentSeconds = $exitTime - $entryTime;
            $spendTime = gmdate("H:i:s", $spentSeconds); // HH:MM:SS format

            // Update log checkout time
            $logModel->update($log['id'], [
                'check_out_time' => date('Y-m-d H:i:s')
            ]);

            // Update visitor table
            $visitorModel->update($visitorId, [
                'securityCheckStatus' => 2,        // Completed visit
                'spendTime'          => $spendTime
            ]);

            return $this->response->setJSON([
                'status' => 'success',
                'spendTime' => $spendTime
            ]);
    }

}
