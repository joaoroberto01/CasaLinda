<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require CLASSES_PATH . 'PHPMailer/src/Exception.php';
require CLASSES_PATH . 'PHPMailer/src/PHPMailer.php';
require CLASSES_PATH . 'PHPMailer/src/SMTP.php';

try {
	$mail = new PHPMailer(true);
    //Server settings
	$mail->CharSet = "UTF-8";
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'naoresponda.casalinda@gmail.com';                     //SMTP username
    $mail->Password   = 'qwnyquqhtmwtxncb';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('naoresponda.casalinda@gmail.com', 'Casa Linda');
    $mail->addAddress('joaoroberto.gc.01@gmail.com', 'João');     //Add a recipient
    
    $mail->AddEmbeddedImage("logo.png", "logo", "logo.png");

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Recuperação de Senha';
    $nome = "Lívia";
    $codigo = "0 2 1 2 9 7";
    $mail->Body = file_get_contents(VIEWS_PATH . 'email/email_template.html');
    $mail->Body = str_replace("{{NOME}}", $nome, $mail->Body);
    $mail->Body = str_replace("{{CODIGO}}", $codigo, $mail->Body);
    $mail->AltBody = "Olá $nome, Seu código de segurança é: $codigo";

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
	echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
?>