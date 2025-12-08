<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Visitor Pass | Ramoji Film City</title>
</head>

<body style="margin:0; padding:0; background:#eef2f7; font-family: Arial, sans-serif;">

<?php 
$data = $mailData; 
?>

<table width="100%" cellpadding="0" cellspacing="0" style="padding:25px;">
<tr>
<td align="center">

    <!-- Card -->
    <table width="600" cellpadding="0" cellspacing="0"
           style="background:#ffffff; border-radius:12px;
           border:2px solid #0056a6; overflow:hidden;">

        <!-- Header -->
        <tr>
            <td style="background:#003c74; padding:18px 20px; text-align:center;">
                <img src="https://www.nicepng.com/png/detail/37-376583_ramoji-film-city-hyderabad-logo.png"
                     style="width:150px; margin-bottom:5px;">
                <h2 style="margin:0; font-size:18px; color:white;">Visitor Pass</h2>
                <p style="margin:4px 0 0; font-size:13px; color:#d9e6f7;">
                    Your visit is confirmed
                </p>
            </td>
        </tr>

        <!-- Body -->
        <tr>
            <td style="padding:20px;">

                <p style="font-size:15px; color:#222; margin:0;">
                    Hello <strong><?= esc($data['visitor_name']) ?></strong>,
                </p>

                <p style="font-size:13px; color:#555; line-height:1.6; margin:10px 0 0;">
                    Below are your visitor details. Please present this QR at the security gate.
                </p>

                <!-- Details -->
                <table width="100%" cellpadding="8" cellspacing="0"
                       style="background:#f5f7fb; border:1px solid #d7ddea;
                              border-radius:8px; margin-top:15px; font-size:14px;">

                    <tr>
                        <td style="color:#001f3f; font-weight:bold; width:32%; text-align:right;">V-Code:</td>
                        <td style="color:#333;"><?= esc($data['v_code']) ?></td>
                    </tr>

                    <tr>
                        <td style="color:#001f3f; font-weight:bold; text-align:right;">Name:</td>
                        <td style="color:#333;"><?= esc($data['visitor_name']) ?></td>
                    </tr>

                    <tr>
                        <td style="color:#001f3f; font-weight:bold; text-align:right;">Phone:</td>
                        <td style="color:#333;"><?= esc($data['visitor_phone']) ?></td>
                    </tr>

                    <tr>
                        <td style="color:#001f3f; font-weight:bold; text-align:right;"> Purpose:</td>
                        <td style="color:#333;"><?= esc($data['purpose']) ?></td>
                    </tr>

                    <tr>
                        <td style="color:#001f3f; font-weight:bold; text-align:right;">Visit Date:</td>
                        <td style="color:#333;"><?= esc($data['visit_date']) ?> <?= esc($data['visit_time']) ?></td>
                    </tr>

                    <tr>
                        <td style="color:#001f3f; font-weight:bold; text-align:right;">Vehicle:</td>
                        <td style="color:#333;"><?= esc($data['vehicle_no']) ?> (<?= esc($data['vehicle_type']) ?>)</td>
                    </tr>

                    <tr>
                        <td style="color:#001f3f; font-weight:bold; text-align:right;">Department:</td>
                        <td style="color:#333;"><?= esc($data['department_name']) ?></td>
                    </tr>

                    <tr>
                        <td style="color:#001f3f; font-weight:bold; text-align:right;">Company:</td>
                        <td style="color:#333;"><?= esc($data['company']) ?></td>
                    </tr>

                    <tr>
                        <td style="color:#001f3f; font-weight:bold; text-align:right;">Created By:</td>
                        <td style="color:#333;">
                            <?= esc($data['created_by_name']) ?>  
                            (<?= esc($data['created_by_email']) ?>)
                        </td>
                    </tr>

                </table>

                <!-- QR -->
                <div style="text-align:center; margin-top:22px;">
                    <h3 style="margin:0; color:#003c74; font-size:16px;">Entry QR Code</h3>
                    <p style="font-size:12px; color:#777; margin:5px 0 10px;">
                        Show this at the entrance
                    </p>

                    <img src="https://quickchart.io/qr?text=<?= $data['v_code'] ?>&size=200"
                         style="width:150px; height:150px; border:2px solid #0056a6;
                         border-radius:8px; padding:6px; background:white;">
                </div>

            </td>
        </tr>

        <!-- Footer -->
        <tr>
            <td style="background:#e53935; padding:12px; text-align:center;
                       color:white; font-size:12px;">
                © 2025 Ramoji Film City • Visitor Management System
            </td>
        </tr>

    </table>

</td>
</tr>
</table>

</body>
</html>
