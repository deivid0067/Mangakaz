<?php
header('Location: contato.php');
//Variáveis
date_default_timezone_set('America/Sao_Paulo');
$nome = $_POST['nome'];
$email = $_POST['email'];
$mensagem = $_POST['mensagem'];
$assunto = $_POST['assunto'];
$data_envio = date('d/m/Y');
$envio = $_POST['Enviar'];
$hora_envio = date('H:i:s');
// Campo E-mail
$arquivo = "
<style type='text/css'>


body {
margin:0px;
font-family:Verdane;
font-size:12px;
color: #666666;
}
a{
color: #666666;
text-decoration: none;
}
a:hover {
color: #FF0000;
text-decoration: none;
}
</style>
  <html>
      <table width='510' border='1' cellpadding='1' cellspacing='1' bgcolor='#CCCCCC'>
          <tr>
            <td>
            
<tr>
                
               <td width='500'>Assunto:$assunto</td>
              </tr>
              <tr>
                <td width='320'>Nome:<b>$nome</b></td>
              </tr>
              <tr>
                <td width='320'>E-mail:<b>$email</b></td>
   </tr>

              <tr>
                <td width='320'>Mensagem:$mensagem</td>
              </tr>
          </td>
        </tr>
        <tr>
          <td>Este e-mail foi enviado em <b>$data_envio</b> às <b>$hora_envio</b></td>
        </tr>
      </table>
  </html>
";

//enviar



use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';


if  (isset($envio)) {
    $mail = new PHPMailer(true);

    try {
        
       
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'Mangakaz.offc@gmail.com';                     //SMTP username
        $mail->Password   = 'cmukncfsgsutlyau';                               //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
    
        //Recipients
        $mail->setFrom($email, $nome);
        $mail->addAddress('Mangakaz.offc@gmail.com', 'Mangakaz');     //Add a recipient
        $mail->addReplyTo($email, 'Information');

    
        
        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'Mensagem via Site Mangakaz';
        $mail->Body    = $arquivo;
       
        $mail->send();
        echo 'Message has been sent';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
  } else {
    echo "ERRo ao enviar email, accesso n foi via formulario";
  }