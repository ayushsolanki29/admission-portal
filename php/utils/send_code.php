<?php

// use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';



function send_activation_link($email, $subject, $verification_code, $username, $date)
{
    $SMTP_HOST = "mail.steam-games.in";
    $SMTP_USER = "admin@steam-games.in";
    $SMTP_PASS = ";89s6#7tvnCXGB";

    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host       = $SMTP_HOST;
        $mail->SMTPAuth   = true;
        $mail->Username   = $SMTP_USER;
        $mail->Password   = $SMTP_PASS;
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port       = 465;
        // $mail->SMTPDebug  = SMTP::DEBUG_OFF; // Disable debug mode for production

        // Recipients
        $mail->setFrom($SMTP_USER, 'Dream Creations');
        $mail->addAddress($email);

        // Email Template
        $templatePath = __DIR__ . "/../../assets/email/send-otp.html";
        if (!file_exists($templatePath)) {
            throw new Exception("Email template not found.");
        }

        $templateContent = file_get_contents($templatePath);
        $templateContent = str_replace(["{username}", "{date}", "{verification_code}"], [$username, $date, $verification_code], $templateContent);

        // Email content
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body    = $templateContent;

        if ($mail->send()) {
            return ['success' => true, 'message' => 'Email sent successfully.'];
        } else {
            throw new Exception("Email could not be sent.");
        }
    } catch (Exception $e) {
        error_log("Mailer Error: " . $mail->ErrorInfo);
        return ['success' => false, 'message' => "Mail Error: {$mail->ErrorInfo}"];
    }
}
