<?php
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require '../vendor/autoload.php';
require './util.php';


function start(){

    $lista= getLista();
   
    $registrosEnviados=[];
    $registrosNaoEnviados=[];
    $registrosSemEmail=[];
    foreach($lista as $pessoa):
       $nomeArquivo=getNomeArquivo($pessoa);
        if($nomeArquivo && $pessoa->email):
            $registrosEnviados[]=$pessoa->email;
            enviarEmail($pessoa->email,$nomeArquivo);
        else:
            $registrosNaoEnviados[]=json_encode($pessoa);  
        endif;

        if(!$pessoa->email){
            $registrosSemEmail[]=json_encode($pessoa);
        }
    endforeach; 
    gravarLog(['registrosEnviados'=>$registrosEnviados, 'registrosNaoEnviados'=>$registrosNaoEnviados, 'registrosSemEmail'=>$registrosSemEmail]);
   
 }


function enviarEmail($emailDestino,$anexo){
    require 'config.php'; //importar a variavel config
    $mail = new PHPMailer(true);
    try {
        //Server settings
        $mail->SMTPDebug = 0;                                       // Enable verbose debug output
        $mail->isSMTP();                                            // Set mailer to use SMTP
        $mail->Host       = $config['host'];  // Specify main and backup SMTP servers
        $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
        $mail->Username   = $config['username'];                     // SMTP username
        $mail->Password   = $config['password'];                               // SMTP password
        $mail->SMTPSecure = '';                                  // Enable TLS encryption, `ssl` also accepted
        $mail->Port       = $config['port'];                                    // TCP port to connect to
        $mail->CharSet = 'UTF-8';
        $mail->SMTPOptions = array(
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            )
        );
    
    
        //Rementente
        $mail->setFrom($config['fromMail'], $config['fromName']);


        //destinatário
        $mail->addAddress($emailDestino);     // Add a recipient
       
    
        // Attachments
        $mail->addAttachment($anexo);         // Add attachments
        //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
    
        // Content
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = $config['subject'];
        $mail->Body    = $config['body'];
        $mail->AltBody = $config['altBody'];
    
        $mail->send();
        echo 'Email Enviado';
    } catch (Exception $e) {
        echo "Email não enviado. Mailer Error: {$mail->ErrorInfo}";
    }

} //fim envia email;


start();




















