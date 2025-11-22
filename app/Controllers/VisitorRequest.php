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
                ];

                $visitorModel = new \App\Models\VisitorRequestModel();
                $visitorModel->insert($data);

                return $this->response->setJSON(['status' => 'success']);
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
}
