<?php

namespace App\Controllers;

use App\Models\VisitorRequestModel;
use App\Models\VisitorLogModel;
use App\Models\VisitorRequestHeaderModel;

  

class VisitorRequest extends BaseController
{
    protected $visitorModel;
    protected $logModel;
    protected $VisitorRequestHeaderModel;


    public function __construct()
    {
        $this->visitorModel = new VisitorRequestModel();
        $this->logModel     = new VisitorLogModel();
        $this->VisitorRequestHeaderModel     = new VisitorRequestHeaderModel();

    }

    public function index(): string
    {
        return view('dashboard/visitorequest');
    }

    public function groupVisitorRequestForm(): string
    {
        return view('dashboard/group_visitor_request');
    }

    /* ------------------------------------------------------------------
        FILE UPLOAD HELPER (Reusable, Fast)
    ------------------------------------------------------------------ */
    private function uploadFile($file, $path)
    {
        if ($file && $file->isValid()) {
            $name = $file->getRandomName();
            $file->move($path, $name);
            return $name;
        }
        return "";
    }

    /* ------------------------------------------------------------------
        MAIL SEND HELPER
    ------------------------------------------------------------------ */
    private function sendMailAsync($payload)
    {
        service('curlrequest')->post(
            base_url('send-email'),
            ['form_params' => $payload]
        );
    }

    /* ------------------------------------------------------------------
        AUTO QR GENERATION (Single Point Control)
    ------------------------------------------------------------------ */
    private function generateQRcode($vCode)
    {
        $fileName = "visitor_{$vCode}_qr.png";
        $qrUrl = "https://quickchart.io/qr?text=" . urlencode($vCode) . "&size=300";
        $savePath = FCPATH . "public/uploads/qr_codes/{$fileName}";

        if (!is_dir(FCPATH . "public/uploads/qr_codes")) {
            mkdir(FCPATH . "public/uploads/qr_codes", 0777, true);
        }

        file_put_contents($savePath, file_get_contents($qrUrl));
        return $fileName;
    }

    /* ------------------------------------------------------------------
        LOG HELPER
    ------------------------------------------------------------------ */
    private function insertLog($id, $action, $old, $new, $remarks = '--')
    {
        $this->logModel->insert([
            'visitor_request_id' => $id,
            'action_type'        => $action,
            'old_status'         => $old,
            'new_status'         => $new,
            'remarks'            => $remarks,
            'performed_by'       => session()->get('user_id'),
        ]);
    }

    public function submit()
    {
        if (!$this->request->isAJAX()) return;

        // Uploads
        $vehicleID = $this->uploadFile($this->request->getFile('vehicle_id_proof'), 'public/uploads/vehicle');
        $visitorID = $this->uploadFile($this->request->getFile('visitor_id_proof'), 'public/uploads/visitor');

        // Auto codes
        $codeGen   = new GenerateCodesController();
        $vCode     = $codeGen->generateVisitorsCode();
        $groupCode = $codeGen->generateGroupVisitorsCode();

        $status = (session()->get('role_id') <= 2) ? "approved" : "pending";

        // Generate QR
        $qrFile = ($status === 'approved') ? $this->generateQRcode($vCode) : "";

        /* =======================================================
        STEP 1 — INSERT INTO visitor_request_header FIRST
        ======================================================= */

        $headerData = [
            'header_code'     => $groupCode,
            'requested_by'    => session()->get('user_id'),
            'requested_date'  => $this->request->getPost('visit_date'),
            'requested_time'  => $this->request->getPost('visit_time'),
            'department'      => session()->get('department_name'),
            'company'      => session()->get('company_name'),
            'total_visitors'  => 1,
            'status'          => $status,
            'remarks'         => '',
            'purpose'         => $this->request->getPost('purpose'),
            'description'         => $this->request->getPost('description'), 
            'email'         => $this->request->getPost('visitor_email'), 
        ];

        $headerId = $this->VisitorRequestHeaderModel->insert($headerData);

        /* =======================================================
        STEP 2 — INSERT INTO visitors (link to header)
        ======================================================= */

        $visitorData = [
            'request_header_id'         => $headerId,   // NEW IMPORTANT LINK
            'v_code'            => $vCode,
            'group_code'        => $groupCode,
            'visitor_name'      => $this->request->getPost('visitor_name'),
            'visitor_email'     => $this->request->getPost('visitor_email'),
            'visitor_phone'     => $this->request->getPost('visitor_phone'),
            'purpose'           => $this->request->getPost('purpose'),
            'proof_id_type'     => $this->request->getPost('proof_id_type'),
            'proof_id_number'   => $this->request->getPost('proof_id_number'),
            'visit_date'        => $this->request->getPost('visit_date'),
            'visit_time'        => $this->request->getPost('visit_time'),
            'description'       => $this->request->getPost('description'),
            'vehicle_no'        => $this->request->getPost('vehicle_no'),
            'vehicle_type'      => $this->request->getPost('vehicle_type'),
            'vehicle_id_proof'  => $vehicleID,
            'visitor_id_proof'  => $visitorID,
            'host_user_id'      => session()->get('user_id'),
            'status'            => $status,
            'qr_code'           => $qrFile,
            'created_by'        => session()->get('user_id'),
        ];

        $visitorId = $this->visitorModel->insert($visitorData);

        // Log entry
        $this->insertLog($visitorId, 'Created', null, $status);

        // Auto email logic
        if ($status === "approved") {
            $mail_data[] = [
                'head_id' => $headerId,
                'name'    => $visitorData['visitor_name'],
                'email'   => $visitorData['visitor_email'],
                'phone'   => $visitorData['visitor_phone'],
                'purpose' => $visitorData['purpose'],
                'vid'     => $visitorId,
                'v_code'  => $vCode,
                'qr_path' => $qrFile,
            ];
            return $this->response->setJSON([
                'status' => 'success',
                'head_id' => $headerId,
                'submit_type' => 'admin'
            ]);
        }

        return $this->response->setJSON([
            'status' => 'success',
            'mail_data' => '',
            'submit_type' => 'user'
        ]);
    }


public function groupSubmit()
{
    if (!$this->request->isAJAX()) return;
    $codeGen = new GenerateCodesController();
    $groupCode = $codeGen->generateGroupVisitorsCode();
    $names  = $this->request->getPost('visitor_name');
    $head_email = $this->request->getPost('email');
    $phones = $this->request->getPost('visitor_phone');
    $visit_time   = $this->request->getPost('visit_time');
    $visit_date   = $this->request->getPost('visit_date');
    $purpose   = $this->request->getPost('purpose');
    $description   = $this->request->getPost('description');
    $autoApprove = (session()->get('role_id') <= 2);
    $vehicleFiles = $this->request->getFileMultiple('vehicle_id_proof');
    $visitorFiles = $this->request->getFileMultiple('visitor_id_proof');
    $mailDataList = []; // Collect mail data

    // 1️ Insert Header Record
    $headerData = [
        'header_code'    => $groupCode,
        'requested_by'   => session()->get('user_id'),
        'requested_date' => $visit_date, // Take from first visitor
        'requested_time' => $visit_time,
        'department'     => session()->get('department_name'),
        'company'        => session()->get('company_name'),
        'total_visitors' => count($names),
        'status'         => $autoApprove ? 'approved' : 'pending',
        'remarks'        => '',
        'purpose'        => $purpose,
        'description'    => $this->request->getPost('description'),
        'email'          => $head_email,
        'updated_by'         => $autoApprove ? session()->get('user_id') : ''
    ];

      $headerId = $this->VisitorRequestHeaderModel->insert($headerData);

    // 2️ Loop through visitors
    foreach ($names as $i => $name)
    {
        $vCode  = $codeGen->generateVisitorsCode();
        $status = $autoApprove ? "approved" : "pending";
        $qrFile = $autoApprove ? $this->generateQRcode($vCode) : "";

        $data = [
            'group_code'        => $groupCode,
            'v_code'            => $vCode,
            'request_header_id' => $headerId, // link to header
            'visitor_name'      => $name,
            'visitor_email'     => $this->request->getPost('visitor_email')[$i],
            'visitor_phone'     => $phones[$i],
            'purpose'           => $purpose,
            'proof_id_type'     => $this->request->getPost('proof_id_type')[$i],
            'proof_id_number'   => $this->request->getPost('proof_id_number')[$i],
            'visit_date'        => $visit_date,
            'visit_time'        => $visit_time,
            'description'       => $description,
            'vehicle_no'        => $this->request->getPost('vehicle_no')[$i],
            'vehicle_type'      => $this->request->getPost('vehicle_type')[$i],
            'vehicle_id_proof'  => $this->uploadFile($vehicleFiles[$i], 'public/uploads/vehicle'),
            'visitor_id_proof'  => $this->uploadFile($visitorFiles[$i], 'public/uploads/visitor'),
            'host_user_id'      => session()->get('user_id'),
            'status'            => $status,
            'qr_code'           => $qrFile,
            'created_by'        => session()->get('user_id'),
        ];

        $vRequestId = $this->visitorModel->insert($data);

        $this->insertLog($vRequestId, 'Created', null, $status);
    // 3 Collect Mail Data
        if ($autoApprove) 
        {
            // $mailDataList[] = [
            //     'head_id' => $headerId,
            //     'name'    => $name,
            //     'email'   => $emails[$i],
            //     'phone'   => $phones[$i],
            //     'purpose' => $data['purpose'],
            //     'vid'     => $vRequestId,
            //     'v_code'  => $vCode,
            //     'qr_path' => $qrFile
            // ];
        }
    }

    return $this->response->setJSON([
        'status'      => 'success',
        'submit_type' => $autoApprove ? 'admin' : 'user',
        'head_id'   => $headerId
    ]);
}


    /* ==================================================================
       APPROVAL PROCESS
    ================================================================== */

    public function approvalProcess()
    {

            $head_id  = $this->request->getPost('head_id');
            $status   = $this->request->getPost('status');
            $remark   = $this->request->getPost('comment');

            // ------------------------------
            // 1. GET ALL VISITORS BY HEAD ID
            // ------------------------------
            $visitors = $this->visitorModel
                            ->where('request_header_id', $head_id)
                            ->findAll();

            if (empty($visitors)) {
                return $this->response->setJSON([
                    "status"  => "error",
                    "message" => "No visitors found for this head_id"
                ]);
            }

            // // ------------------------------
            // // 2. UPDATE EACH VISITOR + ADD LOG
            // // ------------------------------
                $mail_data = [];   // create empty array

                foreach ($visitors as $v) {

                    // Generate QR
                    $qrFile = $this->generateQRcode($v['v_code']);

                    // Update visitor status
                    $this->visitorModel->update($v['id'], [
                        'status'  => $status,
                        'qr_code' => $qrFile
                    ]);

                    // Insert log
                    $this->insertLog(
                        $v['id'],        // visitor_id
                        $status,         // new status
                        $v['status'],    // old status
                        $status,         // updated status
                        $remark          // comment
                    );

                    // ADD THIS: push visitor mail data to array
                    // $mail_data[] = [
                    //     'head_id' => $head_id,
                    //     'name'    => $v['visitor_name'],
                    //     'email'   => $v['visitor_email'],
                    //     'phone'   => $v['visitor_phone'],
                    //     'purpose' => $v['purpose'],
                    //     'vid'     => $v['id'],
                    //     'v_code'  => $v['v_code'],
                    //     'qr_path' => $qrFile
                    // ];
                }

            // -----------------------------------
            // 3. UPDATE HEAD TABLE STATUS
            // -----------------------------------
            $this->VisitorRequestHeaderModel->update($head_id, [
                'status' => $status,
                'remark' => $remark,
            ]);

            
            // -----------------------------------
            // 4. SEND RESPONSE
            // -----------------------------------

            return $this->response->setJSON([
                "status"  => "success",
                "message" => "Head status & all visitors updated successfully!",
                'head_id' => $head_id
            ]);

    }

    /* ==================================================================
       VISITOR LIST
    ================================================================== */
    public function visitorDataListView()
    {
        return view('dashboard/visitorrequestlist');
    }

    public function visitorData()
    {
        $role = session()->get('role_id');
        $uid  = session()->get('user_id');

        $query = $this->visitorModel->orderBy('id', 'DESC');
          $query = $this->VisitorRequestHeaderModel->orderBy('id', 'DESC');
        

        if ($role == 3) {
            $query->where('requested_by', $uid);
        }

        return $this->response->setJSON($query->findAll());
    }

       /* ==================================================================
       VISITOR LIST By GV-Code
    ================================================================== */
    // public function getVisitorRequastDataById($head_id)
    // {
    //     return $this->response->setJSON(
    //         $this->visitorModel->find($id)
    //     );
    // }


    public function getVisitorRequastDataById($id)
    {
        $headerModel = new \App\Models\VisitorRequestHeaderModel();

        $data = $headerModel->getHeaderWithVisitors($id);

        return $this->response->setJSON([
            'status' => 'success',
            'data'   => $data
        ]);
    }


        // downloadCsvTemplate
        public function downloadCsvTemplate()
        {
            $filename = "Visitor_Template.csv";

            // CSV Header Row
            $header = [
                "S.No",
                "Visitor Name",
                "Email",
                "Phone",
                "ID Type",
                "ID Number",
                "Vehicle No",
                "Vehicle Type",
                "Vehicle ID Proof",
                "Visitor ID Proof",
                "Action"
            ];

            // Dropdown options (CSV cannot have dropdowns, so we provide allowed values)
            $allowedIdTypes = "Options: Aadhaar Card| PAN Card| Voter ID | Passport | Driving License";
            $allowedVehicleTypes = "Options: Bike | Car | Van | Bus | Auto | Truck";

            // Sample Rows
            $sampleRows = [
                [
                    1, "Prakash", "john@example.com", "9876543210", 
                    "Aadhaar Card", "123456789012", "TN10AB1234", "Car", "Yes", "Yes", ""
                ],
                [
                    2, "Sharath", "mary@example.com", "9876501234",
                    "PAN Card", "ABCDE1234F", "TN09XY9876", "Bike", "No", "Yes", ""
                ]
            ];

            // Output CSV
            header("Content-Type: text/csv");
            header("Content-Disposition: attachment; filename={$filename}");

            $output = fopen("php://output", "w");

            // Write header
            fputcsv($output, $header);

            // Write allowed options row (row 2)
            fputcsv($output, [
                "",
                "",
                "",
                "",
                $allowedIdTypes,
                "",
                "",
                $allowedVehicleTypes,
                "",
                "",
                ""
            ]);

            // Write sample rows
            foreach ($sampleRows as $row) {
                fputcsv($output, $row);
            }

            fclose($output);
            exit;
        }

        

         // Upload CSV Template
        public function uploadCsv()
        {
            $file = $this->request->getFile('excel_file');

            if (!$file->isValid()) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Invalid File']);
            }

            $path = $file->getTempName();
            $csv = array_map('str_getcsv', file($path));

            $finalData = [];

            foreach ($csv as $index => $row) {

            if ($index == 0) continue; // Skip header
            if (empty($row[1])) continue; // Skip empty rows

            $finalData[] = [
                'sno'            => $row[0],
                'visitor_name'   => $row[1],
                'email'          => $row[2],
                'phone'          => $row[3],
                'id_type'        => $row[4],
                'id_number'      => $row[5],
                'vehicle_no'     => $row[6],
                'vehicle_type'   => $row[7],
                'vehicle_id'     => $row[8],
                'visitor_id'     => $row[9],
            ];
            }

            return $this->response->setJSON([
            'status' => 'success',
            'data'   => $finalData
            ]);
        }


}
