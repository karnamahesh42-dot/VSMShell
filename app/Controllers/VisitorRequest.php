<?php

namespace App\Controllers;

class VisitorRequest extends BaseController
{
    public function index(): string
    {
        return view('dashboard/visitorequest');
    }

     public function submit()
    {
        if ($this->request->isAJAX()) {

            $data = [
            'visitor_name'    => $this->request->getPost('visitor_name'),
            'visitor_email'   => $this->request->getPost('visitor_email'),
            'visitor_phone'   => $this->request->getPost('visitor_phone'),
            'purpose'         => $this->request->getPost('purpose'),
            'proof_id_type'   => $this->request->getPost('proof_id_type'),
            'proof_id_number' => $this->request->getPost('proof_id_number'),
            'host_user_id'    => session()->get('user_id'),
            'status'          => 'Pending',
            'created_by'      => session()->get('user_id'),
            'visit_date'      => $this->request->getPost('visit_date'),
            'description' => $this->request->getPost('description')
            ];

            $visitorModel = new \App\Models\VisitorRequestModel();
            $vRequestId = $visitorModel->insert($data);

            $logModel = new \App\Models\VisitorLogModel();

            $logModel->insert([
                'visitor_request_id' => $vRequestId,
                'action_type'        => 'Created',
                'old_status'         => null,
                'new_status'         => 'Pending',
                'remarks'            => '--',
                'performed_by'       => session()->get('user_id'),
            ]);



            // if($_SESSION['role_id']== '1'){
            //    $qrPath = $this->approvalProcess($qrText, $fileName);
            // }

            return $this->response->setJSON(['status' => 'success']);
        } 
    }

    
    public function approvalProcess()
    {
            $id = $this->request->getPost('id');
            $status = $this->request->getPost('status');
    
            $visitorModel = new \App\Models\VisitorRequestModel();
            $logModel     = new \App\Models\VisitorLogModel();

            $vRequestdataById = $visitorModel->find($id);
            $oldStatus = $vRequestdataById['status'];
        
            // Update Status
            $update = $visitorModel->update($id, [
                'status' => $status
            ]);

            // Insert log
            $logModel->insert([
                'visitor_request_id' => $id,
                'action_type'        => $status === 'approved' ? 'approved' : 'rejected',
                'old_status'         => $oldStatus,
                'new_status'         => $status,
                'remarks'            => '',
                'performed_by'       => session()->get('user_id'),
            ]);      
        

            if($status === 'approved'){
                // Generate QR Code
                // $qrText = "Visitor ID: $id \nName: ".$v['visitor_name']."\nPhone: ".$v['visitor_phone'];
                $qrText = "Visitor ID : $id";
                $fileName = "visitor_".$id."_qr.png";
                $qrPath = $this->generateQR($qrText, $fileName);

                // Save QR path to database
                $visitorModel->update($id, [
                "qr_code" => $fileName
                ]);
            }
                

            if ($update) {
                return $this->response->setJSON(["status" => "success"]);
            } else {
                return $this->response->setJSON(["status" => "error"]);
            }

    }

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
