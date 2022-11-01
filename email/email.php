<?php
// include ('PHPMailer/class.phpmailer.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer-master/src/Exception.php';
require 'PHPMailer-master/src/PHPMailer.php';
require 'PHPMailer-master/src/SMTP.php';


//Instantiation and passing `true` enables exceptions

$nome = $_POST["nome"];
$email = $_POST["email"];
$telefone = $_POST["telefone"];
$tratamento = $_POST["tratamento"];
$duvida = $_POST["duvida"];

// //Server settings
$mail = new PHPMailer(true);
// $mail->SMTPDebug = 3;
$mail->setLanguage('br');
$mail->CharSet = 'UTF-8';
$mail->isSMTP();                                            //Send using SMTP
$mail->Host = 'smtp.hostinger.com';                       //Set the SMTP server to send through
$mail->SMTPAuth = true;                                   //Enable SMTP authentication
$mail->Username = 'formulario-site@maraodontologia.com.br';             //SMTP username
$mail->Password = '&E3K7@8d6Wvr';                           //SMTP password
$mail->SMTPSecure = 'ssl';                                  //Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
$mail->Port = 465;
// $mail->SMTPOptions = array('ssl' => array('verify_peer' => false, 'verify_peer_name' => false, 'allow_self_signed' => true)); //Específico para Hostgator

//Recipients
$mail->From = 'formulario-site@maraodontologia.com.br';
$mail->FromName = 'contato';
$mail->addAddress('contato@maraodontologia.com.br', 'Formulário do site');     //Add a recipient
$mail->addReplyTo($email);

$Body = " 
Nome: {$nome} <br>
Email: {$email} <br>
Telefone: {$telefone} <br>  
Tratamento: {$tratamento} <br>
Dúvida: {$duvida}
";

//Content
$mail->isHTML(true);                                  //Set email format to HTML
$mail->Subject = 'Contato';
$mail->Body = $Body;


if (!$mail->send()) {

  echo 'A mensagem não pode ser enviada';

  echo 'Mensagem de erro: ' . $mail->ErrorInfo;
} else {

  echo "
  <script type='text/javascript'>
    alert('Mensagem enviada com sucesso.')
    javascript:window.location='" . $_SERVER['HTTP_REFERER'] . "'
  </script>";
}
