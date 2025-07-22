<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once __DIR__ . '/vendor/autoload.php';

function send_verification_code($email, $name, $code, $subject = 'Mã xác minh ROSA', $bodyTitle = 'Mã xác minh của bạn là') {
    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'rosavietson150@gmail.com';
        $mail->Password   = 'wgum gell uyxp pnno';  // App password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;

        // Thiết lập charset UTF-8 cho email
        $mail->CharSet = 'UTF-8';
        $mail->Encoding = 'base64';
        
        $mail->setFrom('rosavietson150@gmail.com', 'rosacomputer');
        $mail->addAddress($email, $name);
        $mail->isHTML(false);

        // Đảm bảo subject cũng được mã hóa đúng
        $mail->Subject = '=?UTF-8?B?'.base64_encode($subject).'?=';
        
        $mail->Body = "Xin chào $name,\n\n"
                    . "$bodyTitle: $code\n"
                    . "Mã có hiệu lực trong vòng 1 phút.\n\n"
                    . "ROSA Computer.";

        $mail->send();
        return true;

    } catch (Exception $e) {
        return $mail->ErrorInfo;
    }
}
?>
