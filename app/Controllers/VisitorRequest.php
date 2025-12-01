<?php

namespace App\Controllers;

class VisitorRequest extends BaseController
{
    public function index(): string
    {
        return view('dashboard/visitorequest');
    }

       public function groupVisitorRequestForm(): string
    {
        return view('dashboard/group_visitor_request');
    }

    public function submit()
    {
        if ($this->request->isAJAX()) {

            // ----------- FILE UPLOADS ----------
            $vehicleIDFile  = $this->request->getFile('vehicle_id_proof');
            $visitorIDFile  = $this->request->getFile('visitor_id_proof');

            $vehicleIDName = "";
            $visitorIDName = "";

            // Upload Vehicle ID Proof
            if ($vehicleIDFile && $vehicleIDFile->isValid()) {
                $vehicleIDName = $vehicleIDFile->getRandomName();
                $vehicleIDFile->move('public/uploads/vehicle', $vehicleIDName);
            }

            // Upload Visitor ID Proof
            if ($visitorIDFile && $visitorIDFile->isValid()) {
                $visitorIDName = $visitorIDFile->getRandomName();
                $visitorIDFile->move('public/uploads/visitor', $visitorIDName);
            }

            // Generate new V code
            $codeGen = new GenerateCodesController();
            $vCode = $codeGen->generateVisitorsCode();
            $groupCode = $codeGen->generateGroupVisitorsCode();

            // ---------- NORMAL FIELDS -----------
            $data = [
                'v_code'            => $vCode,
                'group_code'        => $groupCode,
                'visitor_name'      => $this->request->getPost('visitor_name'),
                'visitor_email'     => $this->request->getPost('visitor_email'),
                'visitor_phone'     => $this->request->getPost('visitor_phone'),
                'purpose'           => $this->request->getPost('purpose'),
                'proof_id_type'     => $this->request->getPost('proof_id_type'),
                'proof_id_number'   => $this->request->getPost('proof_id_number'),
                'visit_date'        => $this->request->getPost('visit_date'),
                'description'       => $this->request->getPost('description'),
                // New Fields
                'vehicle_no'        => $this->request->getPost('vehicle_no'),
                'vehicle_type'      => $this->request->getPost('vehicle_type'),
                'vehicle_id_proof'  => $vehicleIDName,
                'visitor_id_proof'  => $visitorIDName,
                'visit_time' => $this->request->getPost('visit_time'),
                // System fields
                'host_user_id'      => session()->get('user_id'),
                'status'            => 'pending',
                'created_by'        => session()->get('user_id'),
            ];
            // ---------- INSERT MAIN REQUEST ----------
            $visitorModel = new \App\Models\VisitorRequestModel();
            $vRequestId = $visitorModel->insert($data);

            // ---------- LOG ENTRY ----------
            $logModel = new \App\Models\VisitorLogModel();
            $logModel->insert([
                'visitor_request_id' => $vRequestId,
                'action_type'        => 'Created',
                'old_status'         => null,
                'new_status'         => 'pending',
                'remarks'            => '--',
                'performed_by'       => session()->get('user_id'),
            ]);

            return $this->response->setJSON(['status' => 'success']);
        }
    }



    ///////////////////// Group Visitor Form Save /////////////////////////////

public function groupSubmit()
{
    if ($this->request->isAJAX()) {

        $codeGen = new GenerateCodesController();

        // Get all rows as arrays
        $visitorNames     = $this->request->getPost('visitor_name');
        $visitorEmails    = $this->request->getPost('visitor_email');
        $visitorPhones    = $this->request->getPost('visitor_phone');
        $proofTypes       = $this->request->getPost('proof_id_type');
        $proofNumbers     = $this->request->getPost('proof_id_number');
        $purposes         = $this->request->getPost('purpose');
        $visitDates       = $this->request->getPost('visit_date');
        $visitTimes       = $this->request->getPost('visit_time');
        $descriptions     = $this->request->getPost('description');
        $vehicleNos       = $this->request->getPost('vehicle_no');
        $vehicleTypes     = $this->request->getPost('vehicle_type');

        // FILE ARRAYS
        $vehicleFiles = $this->request->getFileMultiple('vehicle_id_proof');
        $visitorFiles = $this->request->getFileMultiple('visitor_id_proof');

        $visitorModel = new \App\Models\VisitorRequestModel();
        $logModel     = new \App\Models\VisitorLogModel();

        $totalRows = count($visitorNames);
        $groupCode  = $codeGen->generateGroupVisitorsCode();  // same for all OR each row? (tell me)
        for ($i = 0; $i < $totalRows; $i++) {

            // --- SAVE VEHICLE PROOF ---
            $vehicleProofName = "";
            if (!empty($vehicleFiles[$i]) && $vehicleFiles[$i]->isValid()) {
                $vehicleProofName = $vehicleFiles[$i]->getRandomName();
                $vehicleFiles[$i]->move('public/uploads/vehicle', $vehicleProofName);
            }

            // --- SAVE VISITOR PROOF ---
            $visitorProofName = "";
            if (!empty($visitorFiles[$i]) && $visitorFiles[$i]->isValid()) {
                $visitorProofName = $visitorFiles[$i]->getRandomName();
                $visitorFiles[$i]->move('public/uploads/visitor', $visitorProofName);
            }

            // --- AUTO GENERATE CODES ---
            $vCode      = $codeGen->generateVisitorsCode();
            // --- PREPARE DATA ---
            $data = [
                'v_code'            => $vCode,
                'group_code'        => $groupCode,
                'visitor_name'      => $visitorNames[$i],
                'visitor_email'     => $visitorEmails[$i],
                'visitor_phone'     => $visitorPhones[$i],
                'purpose'           => $purposes[$i],
                'proof_id_type'     => $proofTypes[$i],
                'proof_id_number'   => $proofNumbers[$i],
                'visit_date'        => $visitDates[$i],
                'visit_time'        => $visitTimes[$i],
                'description'       => $descriptions[$i],
                'vehicle_no'        => $vehicleNos[$i],
                'vehicle_type'      => $vehicleTypes[$i],
                'vehicle_id_proof'  => $vehicleProofName,
                'visitor_id_proof'  => $visitorProofName,
                'host_user_id'      => session()->get('user_id'),
                'status'            => 'pending',
                'created_by'        => session()->get('user_id'),
            ];

            // --- INSERT MAIN VISITOR REQUEST ---
            $vRequestId = $visitorModel->insert($data);

            // --- INSERT LOG ---
            $logModel->insert([
                'visitor_request_id' => $vRequestId,
                'action_type'        => 'Created',
                'old_status'         => null,
                'new_status'         => 'pending',
                'remarks'            => '--',
                'performed_by'       => session()->get('user_id'),
            ]);
        }

        return $this->response->setJSON(['status' => 'success']);
    }
}



public function approvalProcess()
{
        $id     = $this->request->getPost('id');
        $status = $this->request->getPost('status');
        $v_code = $this->request->getPost('v_code');

        $visitorModel = new \App\Models\VisitorRequestModel();
        $logModel     = new \App\Models\VisitorLogModel();

        $visitor = $visitorModel->find($id);
        $oldStatus = $visitor['status'];

        // Update visitor status
        $update = $visitorModel->update($id, ['status' => $status]);

        // Insert log
        $logModel->insert([
            'visitor_request_id' => $id,
            'action_type'        => ($status === 'approved') ? 'approved' : 'rejected',
            'old_status'         => $oldStatus,
            'new_status'         => $status,
            'remarks'            => '',
            'performed_by'       => session()->get('user_id'),
        ]);

        // ✔ Generate QR ONLY on approval
        if ($status === 'approved') {

            $qrText   = "Visitor ID : $v_code";
            $fileName = "visitor_" . $id . "_qr.png";
            $qrPath   = $this->generateQR($qrText, $fileName);

            $visitorModel->update($id, ["qr_code" => $fileName]);

            // ------------------------------------------
            //  ✔ SEND EMAIL AFTER QR IS GENERATED
            // ------------------------------------------

            // Prepare POST data
            $postData = [
                'name'    => $visitor['visitor_name'],
                'email'   => $visitor['visitor_email'],
                'phone'   => $visitor['visitor_phone'],
                'purpose' => $visitor['purpose'],
                'vid'     => $id,
                'v_code'  => $v_code
            ];

            // Call mail controller internally
            $mailResponse = service('curlrequest')->post(
                base_url('send-email'),
                ['form_params' => $postData]
            );

            // Log or check mail status (optional)
            $mailStatus = json_decode($mailResponse->getBody(), true);
        }

        return $this->response->setJSON(["status" => "success","mailResponse" => $mailStatus]);
}


//     public function approvalProcess()
//     {
//             $id = $this->request->getPost('id');
//             $status = $this->request->getPost('status');
//             $v_code = $this->request->getPost('v_code');
//             $visitorModel = new \App\Models\VisitorRequestModel();
//             $logModel     = new \App\Models\VisitorLogModel();
//             $vRequestdataById = $visitorModel->find($id);
//             $oldStatus = $vRequestdataById['status'];
        
//             // Update Status
//             $update = $visitorModel->update($id, [
//                 'status' => $status
//             ]);

//             // Insert log
//             $logModel->insert([
//                 'visitor_request_id' => $id,
//                 'action_type'        => $status === 'approved' ? 'approved' : 'rejected',
//                 'old_status'         => $oldStatus,
//                 'new_status'         => $status,
//                 'remarks'            => '',
//                 'performed_by'       => session()->get('user_id'),
//             ]);      
        

//             if($status === 'approved'){
//                 // Generate QR Code
//                 // $qrText = "Visitor ID: $id \nName: ".$v['visitor_name']."\nPhone: ".$v['visitor_phone'];
//                 $qrText = "Visitor ID : $v_code";
//                 $fileName = "visitor_".$id."_qr.png";
//                 $qrPath = $this->generateQR($qrText, $fileName);
//                 // Save QR path to database
//                 $visitorModel->update($id, [
//                 "qr_code" => $fileName
//                 ]);
//             }
                
// $name    = $this->request->getPost('name');
// // $email   = 'karnamahesh42@gmail.com';
// $email   =  $this->request->getPost('email');
// $phone   = $this->request->getPost('phone');
// $purpose = $this->request->getPost('purpose');
// $vid     = $this->request->getPost('vid');
// $v_code     = $this->request->getPost('v_code');



//             if ($update) {
//                 return $this->response->setJSON(["status" => "success"]);
//             } else {
//                 return $this->response->setJSON(["status" => "error"]);
//             }

//     }

    public function visitorDataListView()
    {
             return view('dashboard/visitorrequestlist');
    } 

    public function visitorData()
    {
            // if ($this->request->isAJAX()) {

                $visitorModel = new \App\Models\VisitorRequestModel();
                $data = $visitorModel->orderBy('id', 'DESC')->findAll();
                return $this->response->setJSON($data); 
            
            // }
    }
            
    // Save QR Code Image in path Folder
    public function generateQR($text, $fileName)
    {
            $qrUrl = "https://quickchart.io/qr?text=" . urlencode($text) . "&size=300";
            $imageData = file_get_contents($qrUrl);
            $savePath = FCPATH . "public/uploads/qr_codes/" . $fileName;

            if (!is_dir(FCPATH . "public/uploads/qr_codes")) {
                mkdir(FCPATH . "public/uploads/qr_codes", 0777, true);
            }

            file_put_contents($savePath, $imageData);

            return $savePath;
    }

    // Get Visitor Request  Data By Id
    public function getVisitorRequastDataById($id)
    {
                $model = new \App\Models\VisitorRequestModel();
                $data = $model->find($id);
                return $this->response->setJSON($data);
    }

}
