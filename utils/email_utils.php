<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require CLASSES_PATH . 'PHPMailer/src/Exception.php';
require CLASSES_PATH . 'PHPMailer/src/PHPMailer.php';
require CLASSES_PATH . 'PHPMailer/src/SMTP.php';

define("CODE_LENGTH", 6);
define("DEBUG", false);

function generateCode(){
	$random = [];
	for($i = 0; $i < CODE_LENGTH; $i++)
		$random[$i] = rand(0, 9);

	return implode('', $random);
}

function hideEmail($email){
	$encodedEmail = explode("@", $email);

	$emailFirstHalf = $encodedEmail[0];
	$emailSecondHalf = $encodedEmail[1];

	$count = strlen($emailFirstHalf);

	if ($count > 3)
		$count = 3;

	$encodedEmail = "";
	for($i = 0; $i < $count; $i++)
		$encodedEmail .= $emailFirstHalf[$i];

	for ($i = 0; $i < strlen($emailFirstHalf) - $count; $i++)
		$encodedEmail .= "*";

	$encodedEmail .= "@" . $emailSecondHalf;

	return $encodedEmail;
}

function sendRecoveryEmail($to, $name, $code){
	$altBody = "Olá, $name! Seu código de segurança é: " . $code;

	$body = file_get_contents(EMAIL_TEMPLATES_PATH . '/recovery.html');
	$body = str_replace("{{NOME}}", $name, $body);
	$body = str_replace("{{CODIGO}}", $code, $body);

	send($to, $name, 'Recuperação de Senha', $body, $altBody);
}

function send($to, $name, $subject, $body, $altBody){
	try {
		$mail = new PHPMailer(true);
    //Server settings
		$mail->CharSet = "UTF-8";
		if(DEBUG)
	    	$mail->SMTPDebug = SMTP::DEBUG_SERVER; //Enable verbose debug output
	    $mail->isSMTP(); //Send using SMTP
	    $mail->Host = 'smtp.gmail.com'; //Set the SMTP server to send through
	    $mail->SMTPAuth = true; //Enable SMTP authentication
	    $mail->Username = 'naoresponda.casalinda@gmail.com'; //SMTP username
	    $mail->Password = 'qwnyquqhtmwtxncb'; //SMTP password
	    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; //Enable implicit TLS encryption
	    $mail->Port = 465; //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

	    //Recipients
	    $mail->setFrom('naoresponda.casalinda@gmail.com', 'Casa Linda');
	    $mail->addAddress($to, $name); //Add a recipient
	    
	    $mail->AddEmbeddedImage("res/img/logo.png", "logo", "logo.png");

	    //Content
	    $mail->isHTML(true); //Set email format to HTML
	    $mail->Subject = $subject;
	    $mail->Body = $body;
	    $mail->AltBody = $altBody;

	    $mail->send();
	    //echo 'Message has been sent';
	} catch (Exception $e) {
		if (DEBUG)
			echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
	}
}
?>