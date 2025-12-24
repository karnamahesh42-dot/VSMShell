<?php
namespace App\Controllers;
use App\Models\DepartmentModel;
use App\Models\VisitorRequestModel;

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



/// ..........Visitor Photo Upload  Start.............. ///

      public function uploadPhoto()
{
    $file   = $this->request->getFile('photo');
    $v_code = $this->request->getPost('v_code');

    if (!$file || !$file->isValid()) {
        return $this->response->setJSON([
            'status' => 'error',
            'message' => 'Invalid image'
        ]);
    }

    // 🔐 Check security status
    $visitorModel = new \App\Models\VisitorRequestModel();
    $visitor = $visitorModel->where('v_code', $v_code)->first();

    if (!$visitor || $visitor['securityCheckStatus'] == 0) {
        return $this->response->setJSON([
            'status' => 'error',
            'message' => 'Photo upload not allowed at this stage'
        ]);
    }

    // Validate image type
    $allowedTypes = ['image/png', 'image/jpg', 'image/jpeg'];
    if (!in_array($file->getMimeType(), $allowedTypes)) {
        return $this->response->setJSON([
            'status' => 'error',
            'message' => 'Only JPG/PNG allowed'
        ]);
    }

    // Create upload directory
    $uploadPath = FCPATH . 'public/uploads/visitor_photos/';
    if (!is_dir($uploadPath)) {
        mkdir($uploadPath, 0777, true);
    }

    // Generate file name
    $newName = 'v_pic_' . $v_code . '_' . time() . '.jpg';
    $fullPath = $uploadPath . $newName;

    // Compress & resize image
    $image = \Config\Services::image()
        ->withFile($file)
        ->resize(800, 800, true, 'auto') // max 800px
        ->save($fullPath, 75); // 🔥 75% quality (compression)

    // Save file path in DB
    $visitorModel->where('v_code', $v_code)
                 ->set(['v_phopto_path' => $newName])
                 ->update();

    return $this->response->setJSON([
        'status' => 'success',
        'path'   => base_url('public/uploads/visitor_photos/' . $newName)
    ]);
}

/// ..........Visitor Photo Upload  Start.............. ///


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


    private function deleteGatePassFiles(string $v_code): void
    {
        // 🔹 Gate Pass PDF
        $pdfPath = FCPATH . 'public/uploads/gate_pass_pdf/GatePass_' . $v_code . '.pdf';

        if (is_file($pdfPath)) {
            unlink($pdfPath);
        }

        // 🔹 QR Code Image
        $qrPath = FCPATH . 'public/uploads/qr_codes/visitor_' . $v_code . '_qr.png';

        if (is_file($qrPath)) {
            unlink($qrPath);
        }
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
                'status' => 'checkin_success',
                'v_code' =>  $v_code
            ]);
        }
        

        /////////////////////// Check out  //////////////////
        
        if ($visitor['meeting_status'] == 1 && $visitor['securityCheckStatus'] == 1) {

            if ($activeLog) {


                $entryTime = strtotime($activeLog['check_in_time']);
                $exitTime  = time();
                $diffSeconds = $exitTime - $entryTime;
                $hours   = floor($diffSeconds / 3600);
                $minutes = floor(($diffSeconds % 3600) / 60);
                $seconds = $diffSeconds % 60;

                $spendTime = sprintf('%02d:%02d:%02d', $hours, $minutes, $seconds);


                // 🔹 Update log table
                $logModel->update($activeLog['id'], [
                    'check_out_time' => date('Y-m-d H:i:s'),
                    'updated_at'     => date('Y-m-d H:i:s'),
                    'updated_by'     => session()->get('user_id')
                ]);

                // 🔹 Update visitor table
                $visitorModel->update($visitorId, [
                    'securityCheckStatus' => 2,
                    'spendTime'           => $spendTime
                ]);

               
                 // Dalete Gate Passfiles Code Image
                $this->deleteGatePassFiles($v_code);

                return $this->response->setJSON([
                    'status'     => 'checkout_success',
                    'spendTime'  => $spendTime,
                    'v_code'     => $v_code
                ]);
            }
        }

        /////////////////////// Checking Meeting Status //////////////////

         if($visitor['meeting_status'] == 0 && $visitor['securityCheckStatus'] == 1){
               
              
            // return $this->response->setJSON([
                //     'status' => 'meeting_not_completed'
                // ]);

                            // 🔹 Fetch host details
                $requestHeaderModel = new \App\Models\VisitorRequestHeaderModel();
                
                $requestId = $visitor['request_header_id'];
                $host = $requestHeaderModel
                    ->select('u.company_name, u.name,u.email')
                    ->join('users u', 'u.id = visitor_request_header.referred_by', 'left')
                    ->where('visitor_request_header.id', $requestId)
                    ->first();

                return $this->response->setJSON([
                    'status'            => 'meeting_not_completed',
                    'name'         => $host['name'] ?? '--',
                    'company_name'  => $host['company_name'] ?? '--',
                    'email'        => $host['email'] ?? '--'
                ]);
         }

       
        return $this->response->setJSON([
            'status' => 'already_used',
            'v_code' =>  $v_code
        ]);
       
    }


}
