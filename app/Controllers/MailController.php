<?php 
namespace App\Controllers;

use CodeIgniter\Controller;

class MailController extends Controller
{

public function sendMail()
{
        $name    = $this->request->getPost('name');
        // $email   = 'karnamahesh42@gmail.com';
        $email   =  $this->request->getPost('email');
        $phone   = $this->request->getPost('phone');
        $purpose = $this->request->getPost('purpose');
        $vid     = $this->request->getPost('vid');
        $v_code     = $this->request->getPost('v_code');

        // QR file path
        $qrFileName = "visitor_{$vid}_qr.png";
        $qrFullPath = FCPATH . "public/uploads/qr_codes/" . $qrFileName;
        // Convert image to Base64
        $qrData = base64_encode(file_get_contents($qrFullPath));
        $qrBase64 = 'data:image/png;base64,' . $qrData; 


        if (!file_exists($qrFullPath)) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'QR file not found',
                'path' => $qrFullPath
            ]);
        }

        // Email service
        $emailService = \Config\Services::email();

        $fromEmail = env('app.email.fromEmail');
        $fromName  = env('app.email.fromName');

        $emailService->setFrom($fromEmail, $fromName);
        $emailService->setTo($email);
        $emailService->setSubject("Your Visitor QR Code");

        // 📌 Embed QR using CID
        $qrCid = $emailService->setAttachmentCID($qrFullPath);

        // Load template
        $message = view('emails/visitor_template', [
            'name'    => $name,
            'phone'   => $phone,
            'purpose' => $purpose,
            'vid'     => $vid,
            'qrBase64' => $qrBase64,
            'v_code'  => $v_code
        ]);

        $emailService->setMessage($message);
        $emailService->attach($qrFullPath);  // example: QR code attachment


        if ($emailService->send()) {
            return $this->response->setJSON(['status' => 'success']);
        }

        return $this->response->setJSON([
            'status' => 'error',
            'debug' => $emailService->printDebugger(['headers', 'subject'])
        ]);
    }

}





