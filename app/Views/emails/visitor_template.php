<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Visitor Pass</title>
</head>
<body style="margin:0; padding:0; background:#f4f4f4; font-family: Arial, sans-serif;">

    <table width="100%" border="0" cellpadding="0" cellspacing="0" style="background:#f4f4f4; padding:20px;">
        <tr>
            <td align="center">

                <!-- CARD -->
                <table width="600" cellpadding="0" cellspacing="0" style="background:white; border-radius:10px; overflow:hidden; box-shadow:0px 3px 10px rgba(0,0,0,0.1);">
                    
                    <!-- HEADER -->
                    <tr>
                        <td style="background:#4A90E2; padding:20px; text-align:center; color:white;">
                            <h2 style="margin:0; color:white; font-size:24px;">Visitor Pass Confirmation</h2>
                            <p style="margin:0; font-size:14px;">Thank you for registering your visit</p>
                        </td>
                    </tr>

                    <!-- BODY -->
                    <tr>
                        <td style="padding:20px;">

                            <h3 style="margin-top:0; color:#333;">Hello <?= $name ?>,</h3>
                            <p style="font-size:15px; color:#555;">
                                Your visit has been successfully registered.  
                                Please find the details below:
                            </p>

                            <!-- DETAILS BOX -->
                            <table width="100%" cellpadding="10" cellspacing="0" style="background:#f9f9f9; border:1px solid #eee; border-radius:8px; margin-top:10px;">
                                <tr>
                                    <td width="40%" style="color:#333; font-weight:bold;">Visitor Name</td>
                                    <td style="color:#555;"><?= $name ?></td>
                                </tr>
                                <tr>
                                    <td style="color:#333; font-weight:bold;">Phone</td>
                                    <td style="color:#555;"><?= $phone ?></td>
                                </tr>
                                <tr>
                                    <td style="color:#333; font-weight:bold;">Purpose</td>
                                    <td style="color:#555;"><?= $purpose ?></td>
                                </tr>
                                <tr>
                                    <td style="color:#333; font-weight:bold;">V-Code</td>
                                    <td style="color:#555;"><?= $v_code ?></td>
                                </tr>
                                
                            </table>

                            <!-- QR SECTION -->
                            <div style="text-align:center; margin-top:20px;">
                                <h3 style="color:#333;">Your QR Code</h3>
                                <p style="font-size:14px; color:#777;">Please show this QR at the security gate </p>
                              
                               <img src="<?= $qrBase64 ?>" alt="QR Code"  style="width:160px; height:160px; border:1px solid #ddd;">
                               <h4 style="color:#333;"><?= $v_code ?></h4>
                            </div>

                        </td>
                    </tr>

                    <!-- FOOTER -->
                    <tr>
                        <td style="background:#4A90E2; text-align:center; padding:15px; color:white; font-size:13px;">
                            Visitor Management System © <?= date("Y") ?>  
                        </td>
                    </tr>

                </table>

            </td>
        </tr>
    </table>

</body>
</html>
