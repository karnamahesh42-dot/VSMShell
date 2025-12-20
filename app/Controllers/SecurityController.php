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
     $user_id  = session()->get('user_id');
     $role_id  = session()->get('role_id');

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
        vr.meeting_status,
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
        u.name AS created_by_name,
        usr.name AS referred_by_name,
        usr2.name AS check_in_by,
        usr3.name AS check_out_by

    ");

    $builder->join('security_gate_logs log', 'log.visitor_request_id = vr.id', 'left');
    $builder->join('visitor_request_header hr', 'hr.id = vr.request_header_id', 'left');
    $builder->join('users u', 'u.id = vr.created_by', 'left');
    $builder->join('users usr', 'usr.id = hr.referred_by', 'left');
    $builder->join('users usr2', 'usr2.id = log.verified_by', 'left');
    $builder->join('users usr3', 'usr3.id = log.updated_by', 'left');
    // Only approved
    $builder->where('vr.status', 'approved');

    // --- FILTERS ---
    $company = $this->request->getGet('company');
    $department = $this->request->getGet('department');
    $security = $this->request->getGet('securityCheckStatus');
    $requestcode = $this->request->getGet('requestcode');
    $v_code = $this->request->getGet('v_code');
    

    if($role_id == '4'){        /// Securuty Condition 
           
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

    }else if($role_id == '3'){                /// User Condition 
            $builder->where('vr.created_by', $user_id);

    }else if($role_id  == '2'){                 /// Admin Condition 
 
            $builder->where('hr.referred_by', $user_id);
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

   
    public function securityAction()
    {
        date_default_timezone_set('Asia/Kolkata');

        $logModel     = new \App\Models\SecurityGateLogModel();
        $visitorModel = new \App\Models\VisitorRequestModel();
        $v_code = $this->request->getPost('v_code');

        // 🔹 Validate V-Code
        $visitor = $visitorModel->where('v_code', $v_code)->first();

        if (!$visitor) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Invalid V-Code'
            ]);
        }
        $visitorId = $visitor['id'];

        // 🔹 Check active log (decides action)
        $activeLog = $logModel
            ->where('visitor_request_id', $visitorId)
            ->where('check_out_time IS NULL', null, false)
            ->first();



        if ($visitor['validity'] != 1) {
            return $this->response->setJSON([
                'status' => 'invalid',
                'message' => 'Visitor pass expired / not valid'
            ]);
        }

        /* =====================================================
        CHECK-IN (if no log exists)
        ===================================================== */
        
        if($visitor['meeting_status'] == 0 && $visitor['securityCheckStatus'] == 0){

            $logModel->insert([
                'visitor_request_id' => $visitorId,
                'v_code'             => $v_code,
                'check_in_time'      => date('Y-m-d H:i:s'),
                'verified_by'        => session()->get('user_id')
            ]);

            $visitorModel->update($visitorId, [
                'securityCheckStatus' => 1
            ]);

            return $this->response->setJSON([
                'status' => 'checkin_success'
            ]);

        }
        
        
        /* =====================================================
        CHECK-OUT (if log exists)
        ===================================================== */
        if($visitor['meeting_status'] == 1 && $visitor['securityCheckStatus'] == 1){

                if ($activeLog) {

                    $entryTime = strtotime($activeLog['check_in_time']);
                    $exitTime  = time();
                    $spendTime = gmdate("H:i:s", $exitTime - $entryTime);

                    $logModel->update($activeLog['id'], [
                        'check_out_time' => date('Y-m-d H:i:s'),
                        'updated_at'      => date('Y-m-d H:i:s'),
                        'updated_by'        => session()->get('user_id')
                    ]);

                    $visitorModel->update($visitorId, [
                        'securityCheckStatus' => 2,
                        'spendTime'           => $spendTime
                    ]);

                    return $this->response->setJSON([
                        'status' => 'checkout_success',
                        'spendTime' => $spendTime
                    ]);
                }
        }

         if($visitor['meeting_status'] == 0 && $visitor['securityCheckStatus'] == 1){
                return $this->response->setJSON([
                    'status' => 'meeting_not_completed'
                ]);
         }

       
        return $this->response->setJSON([
            'status' => 'already_used'
        ]);
       
    }


}
