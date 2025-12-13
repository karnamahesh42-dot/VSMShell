<?php
namespace App\Controllers;
use App\Models\DepartmentModel;

class SecurityController extends BaseController
{

    
    public function index()
    {
      return view('dashboard/security_authorization');
    }


     public function View_authorized_visitor_list()
    {
          $deptModel = new DepartmentModel();
    $data['departments'] = $deptModel->findAll();
      return view('dashboard/authorized_visitor_list',$data);
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
        vr.validity,
        vr.proof_id_type,
        vr.proof_id_number,
        vr.securityCheckStatus,
        vr.spendTime,
        log.check_in_time,
        log.check_out_time,
        log.verified_by,
        hr.header_code,
        hr.department AS department_name,
        hr.company,
        hr.requested_by,
        hr.requested_date,
        hr.requested_time,
        u.name AS created_by_name
    ");

    $builder->join('security_gate_logs log', 'log.visitor_request_id = vr.id', 'left');
    $builder->join('visitor_request_header hr', 'hr.id = vr.request_header_id', 'left');
    $builder->join('users u', 'u.id = vr.created_by', 'left');

    // Only approved
    $builder->where('vr.status', 'approved');

    // --- FILTERS ---
    $company = $this->request->getGet('company');
    $department = $this->request->getGet('department');
    $security = $this->request->getGet('securityCheckStatus');
    $requestcode = $this->request->getGet('requestcode');
    $v_code = $this->request->getGet('v_code');
    


    if (!empty($company)) {
        $builder->where('hr.company', $company);
    }

    if (!empty($department)) {
        $builder->where('hr.department', $department);
    }

    if ($security !== "" && $security !== null) {
        $builder->where('vr.securityCheckStatus', $security);
    }
    
    if ($requestcode !== "" && $requestcode !== null) {
        $builder->where('hr.header_code', $requestcode);
    }

    if ($v_code !== "" && $v_code !== null) {
        $builder->where('vr.v_code', $v_code);
    }

    $builder->orderBy('vr.id', 'DESC');

    return $this->response->setJSON($builder->get()->getResultArray());
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

    
// public function checkIn() 
// {
//     date_default_timezone_set('Asia/Kolkata');

//     $log = new \App\Models\SecurityGateLogModel();
//     $visitorModel = new \App\Models\VisitorRequestModel();

//     $visitorId = $this->request->getPost('visitor_request_id');
//     $v_code = $this->request->getPost('v_code');

//     // Check if already checked-in
//     $existing = $log->where('visitor_request_id', $visitorId)->first();

//     if ($existing && $existing['check_in_time']) {
//         return $this->response->setJSON(['status' => 'exists', 'check_point' => 0]);
//     }


//     // Insert log entry
//     $log->insert([
//         'visitor_request_id' => $visitorId,
//         'v_code'             => $v_code,
//         'check_in_time'      => date('Y-m-d H:i:s'),
//         'verified_by'        => session()->get('user_id'),
//     ]);

//     $visitorModel->update($visitorId, [
//         'securityCheckStatus' => 1
//     ]);

//     return $this->response->setJSON(['status' => 'success', 'check_point' => 1]);
// }

public function checkIn() 
{
    date_default_timezone_set('Asia/Kolkata');

    $log = new \App\Models\SecurityGateLogModel();
    $visitorModel = new \App\Models\VisitorRequestModel();

    $visitorId = $this->request->getPost('visitor_request_id');
    $v_code    = $this->request->getPost('v_code');

    // 🔹 Fetch visitor details
    $visitor = $visitorModel->find($visitorId);

    if (!$visitor) {
        return $this->response->setJSON([
            'status' => 'error',
            'message' => 'Visitor not found'
        ]);
    }

    // 🔹 VALIDITY CHECK
    if ($visitor['validity'] != 1) {
        return $this->response->setJSON([
            'status' => 'invalid',
            'message' => 'Visitor pass expired / not valid'
        ]);
    }

    // 🔹 Check if already checked-in
    $existing = $log
        ->where('visitor_request_id', $visitorId)
        ->where('check_in_time IS NOT NULL', null, false)
        ->first();

    if ($existing) {
        return $this->response->setJSON([
            'status' => 'exists',
            'check_point' => 0
        ]);
    }

    // 🔹 Insert gate log
    $log->insert([
        'visitor_request_id' => $visitorId,
        'v_code'             => $v_code,
        'check_in_time'      => date('Y-m-d H:i:s'),
        'verified_by'        => session()->get('user_id'),
    ]);

    // 🔹 Update visitor status
    $visitorModel->update($visitorId, [
        'securityCheckStatus' => 1
    ]);

    return $this->response->setJSON([
        'status' => 'success',
        'check_point' => 1
    ]);
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

            if ($visitor['meeting_status'] != 1) {
                return $this->response->setJSON([
                  'status'  => 'meeting_not_completed'
                ]);
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
