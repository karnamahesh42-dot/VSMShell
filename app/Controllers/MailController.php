<?php 
namespace App\Controllers;

use CodeIgniter\Controller;

class MailController extends Controller
{
    public function sendMail()
    {
        try {
        $request_head_id = $this->request->getPost('head_id');
        $headerModel = new \App\Models\VisitorRequestHeaderModel();
        $data = $headerModel->getHeaderWithVisitorsMailData($request_head_id);
        $email   = "karnamahesh42@gmail.com";

         print_r($data);
        $mailCount = count($data);
        $emailService = \Config\Services::email();
        $successCount = 0;
        $failed = [];


           for($i = 0; $i < $mailCount; $i++ ){
                // Prepare Email
                $emailService->clear(true);
                $emailService->setTo($email);
                $emailService->setFrom(env('app.email.fromEmail'), env('app.email.fromName'));
                $emailService->setSubject("Your Visitor QR Code");
                $emailService->setMessage(view("emails/mail_template.php",  ['mailData' => $data[$i]]));
                // $emailService->attach($qrFile);

                // Send
                if ($emailService->send()) {
                    $successCount++;
                } else {
                    $failed[] = [
                        "email"  => $email,
                        "reason" => $emailService->printDebugger()
                    ];
                }
           }   

///////////////////////////////// old Mail //////////////////////////////////////////////////
            // // Get the JSON array
            // $json = $this->request->getPost("mail_data");
            // $visitors = json_decode($json, true);

            // if (!$visitors || !is_array($visitors)) {
            //     return $this->response->setJSON([
            //         "status" => "error",
            //         "message" => "Invalid maildata format"
            //     ]);
            // }

            // $emailService = \Config\Services::email();

            // $successCount = 0;
            // $failed = [];

            // foreach ($visitors as $v) {
                
            //     // $email   = $v['email'];
            //     $email   = "karnamahesh42@gmail.com";
            //     $name    = $v['name'];
            //     $phone   = $v['phone'];
            //     $purpose = $v['purpose'];
            //     $v_code  = $v['v_code'];
            //     $qr_path = $v['qr_path'];

            //     // Full path for attachment
            //     $qrFile = FCPATH . 'public/uploads/qr_codes/' . $qr_path;

            //     if (!file_exists($qrFile)) {
            //         $failed[] = [
            //             "email" => $email,
            //             "reason" => "QR file missing"
            //         ];
            //         continue;
            //     }

            //     // Template data
            //     $data = [
            //         "name"     => $name,
            //         "phone"    => $phone,
            //         "purpose"  => $purpose,
            //         "v_code"   => $v_code,
            //         "qr_url"   => base_url('public/uploads/qr_codes/'.$qr_path)
            //     ];

            //     // Prepare Email
            //     $emailService->clear(true);
            //     $emailService->setTo($email);
            //     $emailService->setFrom(env('app.email.fromEmail'), env('app.email.fromName'));
            //     $emailService->setSubject("Your Visitor QR Code");
            //     $emailService->setMessage(view("emails/visitor_mail_template", $data));
            //     $emailService->attach($qrFile);

            //     // Send
            //     if ($emailService->send()) {
            //         $successCount++;
            //     } else {
            //         $failed[] = [
            //             "email"  => $email,
            //             "reason" => $emailService->printDebugger()
            //         ];
            //     }
            // }

            // return $this->response->setJSON([
            //     "status" => "success",
            //     "message" => "Mail process completed",
            //     "sent" => $successCount,
            //     "failed" => $failed
            // ]);

        } catch (\Exception $e) {

            return $this->response->setJSON([
                "status" => "error",
                "message" => $e->getMessage()
            ]);
        }
    }


}

