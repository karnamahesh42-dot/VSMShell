<?php 
namespace App\Controllers;

use CodeIgniter\Controller;
use Dompdf\Dompdf;
use Dompdf\Options;

class MailController extends Controller
{
    

        public function sendMail()
        {
            try {
                $resendVId = $this->request->getPost();
                $request_head_id = $this->request->getPost('head_id');
                $headerModel = new \App\Models\VisitorRequestHeaderModel();
                $mailType = "";

                if(isset($resendVId['re_send']) && $resendVId['re_send'] != ''){
                    $data = $headerModel->getHeaderWithVisitorsMailDataByVCode($resendVId);
                    $mailType = 'Resend';
                } else {
                    $data = $headerModel->getHeaderWithVisitorsMailData($request_head_id);
                    $mailType = 'Approval Send';

                    // print_r($data);
                }

                $emailService = \Config\Services::email();
                $successCount = 0;
                $failed = [];

                foreach($data as $row){

                    $email = $row['visitor_email'];
                    // print_r($row);
                    // 1️⃣ Generate PDF from HTML
                    $html = view('emails/gate_pass_layout', ['mailData' => $row]);

                    $options = new Options();
                    $options->set('isRemoteEnabled', true); // enable external images
                    $options->set('defaultFont', 'DejaVu Sans');

                    $dompdf = new Dompdf($options);
                    $dompdf->loadHtml($html);
                    $dompdf->setPaper([0, 0, 400, 550]); // custom card size
                    $dompdf->render();
                    
                    // Save PDF to file
                    $pdfDir = FCPATH . 'public/uploads/gate_pass_pdf/';
                    if(!is_dir($pdfDir)) mkdir($pdfDir, 0777, true);

                    $pdfFile = $pdfDir . 'GatePass_' . $row['v_code'] . '.pdf';
                    // Check if file exists, then delete
                    if (file_exists($pdfFile)) {
                    unlink($pdfFile);
                    }
                    // Save new PDF
                    file_put_contents($pdfFile, $dompdf->output());

                    // 2️⃣ Prepare Email
                    $emailService->clear(true);
                    $emailService->setTo($email);
                    $emailService->setFrom(env('app.email.fromEmail'), env('app.email.fromName'));
                    $emailService->setSubject("Your Visitor Gate Pass");
                    $emailService->setMessage("Dear Visitor,<br><br>Please find your Gate Pass attached.<br><br>Regards,<br>Security Team");
                    $emailService->attach($pdfFile);

                    // 3️⃣ Send Email
                    if($emailService->send()){
                        $successCount++;
                    } else {
                        $failed[] = [
                            "email" => $email,
                            "reason" => $emailService->printDebugger()
                        ];
                    }
                }

                return $this->response->setJSON([
                    "status" => "success",
                    "sendType" => $mailType,
                    "message" => "Mail process completed",
                    "sent" => $successCount,
                    "failed" => $failed
                ]);

            } catch (\Exception $e){
                return $this->response->setJSON([
                    "status" => "error",
                    "message" => $e->getMessage()
                ]);
            }
        }

}
