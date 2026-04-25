<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require __DIR__.'/../config.php'; // fichier hors htdocs, inaccessible depuis internet
require __DIR__.'/mailer/PHPMailer.php';

$mail = new PHPMailer(true);
$mail->isSMTP();
$mail->Host = 'smtp.ionos.fr';
$mail->SMTPAuth = true;
$mail->Username = SMTP_USER;
$mail->Password = SMTP_PASSWORD;
$mail->SMTPSecure = 'tls';
$mail->Port = 587;

// Champs du formulaire
$name    = isset($_POST['name']) ? trim($_POST['name']) : '';
$email   = isset($_POST['email']) ? trim($_POST['email']) : '';
$phone   = isset($_POST['phone']) ? trim($_POST['phone']) : '';
$message = isset($_POST['message']) ? trim($_POST['message']) : '';

// Validation : rejeter les soumissions vides (bots)
if(empty($name) || empty($email) || empty($message) || !filter_var($email, FILTER_VALIDATE_EMAIL)){
  header('Location: contact.html?error=1');
  exit;
}

$mail->From = 'contact@agro-palme.fr';
$mail->FromName = 'AGRO PALME';
$mail->addAddress('contact@agro-palme.fr');

$mail->Subject = '[Site] Nouvelle demande – AGRO PALME';

$mail->Body =
"Nouvelle demande depuis le site AGRO PALME\n"
."----------------------------------------\n"
."Nom       : $name\n"
."Email     : $email\n"
."Téléphone : $phone\n\n"
."Message :\n$message\n\n"
."----------------------------------------\n"
."Date : ".date('d/m/Y H:i')."\n";

if($mail->send()){
  header('Location: contact.html?sent=1');
}else{
  header('Location: contact.html?error=1');
}
exit;
?>