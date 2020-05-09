<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'classes/PHPMailer/Exception.php';
require 'classes/PHPMailer/PHPMailer.php';
require 'classes/PHPMailer/SMTP.php';

function EnviarEmail($NameTo, $emailto, $emailtitle, $emailbody){
    try {
        $mail = new PHPMailer();
        //Server settings
        //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
        $mail->isSMTP();                                            // Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
        $mail->Username   = 'studentshometcc@gmail.com';                     // SMTP username
        $mail->Password   = 'etelaurogomes123';                               // SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
        $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
    
        //Recipients
        $mail->setFrom('nao-responda@studentshome.tk', "Student's Home");
        $mail->addAddress($emailto, $NameTo);     // Add a recipient
        $mail->addReplyTo('nao-responda@studentshome.tk', "Student's Home");
    
        // Content
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = $emailtitle;
        $mail->Body    = $emailbody;
        //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
    
        $mail->send();
        return 'Email enviado com sucesso!';
    } catch (Exception $e) {
        return "Email não pode ser enviado: {$mail->ErrorInfo}";
    }
}
