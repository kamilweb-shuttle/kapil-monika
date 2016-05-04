<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Mailer {

    public function sending_mail($mail_conf = array()) {
        require_once('php_mailer/autoload.php');
        $mail = new PHPMailer();
        if (is_array($mail_conf) && !empty($mail_conf)) {

//echo $mail_conf['body_part'];die;
            $mail->isSMTP();


            $mail->Debugoutput = 'html';

            $mail->Host = 'smtp.gmail.com';


            $mail->Port = 587;

            $mail->SMTPSecure = 'tls';

            $mail->SMTPAuth = true;

            $mail->Username = "kamil@web-shuttle.com";

            $mail->Password = "kamil@123";

            $mail->setFrom($mail_conf['from_email'], $mail_conf['from_name']);

            $mail->addReplyTo('kamil@web-shuttle.com', 'First Last');

            $mail->addAddress($mail_conf['to_email'], $mail_conf['from_name']);

            $mail->Subject = $mail_conf['subject'];

            $mail->Body    = $mail_conf['body_part'];
            $mail->IsHTML(true); 
            $mail->AltBody = @$mail_conf['alternative_msg'];

            if (!$mail->send()) {
                echo "Mailer Error: " . $mail->ErrorInfo;
            } else {
                echo "Message sent!";
            }
        }
    }

}

?>
