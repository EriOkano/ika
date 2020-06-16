<?php
    defined('BASEPATH') OR exit('No direct script access allowed'); 
    use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;
    function phpmailer_send($recipient, $from_name, $from_addr, $subject, $message, $file) {
        require_once 'phpmailer/src/Exception.php';
		require_once 'phpmailer/src/PHPMailer.php';
        require_once 'phpmailer/src/SMTP.php';
        $smtp_host = 'smtp.gmail.com';
        $smtp_port = '587';
        $smtp_user = 'sample000licenses@gmail.com';
        $smtp_password = 'gjbizazebwvgipyr';
        $mail = new PHPMailer(); 
        $mail->CharSet = "UTF-8";
        // $mail->Encoding = "8bit";
		$mail->Encoding = "base64";

        $mail->IsSMTP();
        $mail->IsHTML(true);
        $mail->SMTPDebug = 0;
        // $mail->Host = $smtp_host . ":" . $smtp_port;
        $mail->Host = $smtp_host;
        $mail->Port = $smtp_port;
        $mail->SMTPAuth = TRUE;
        $mail->Username = $smtp_user;
        $mail->Password = $smtp_password;
        $mail->FromName = $from_name;
        $mail->From = $from_addr;
        $mail->Subject = mb_encode_mimeheader($subject);
        //$mail->Body = strip_tags($message);
        $mail->Body = $message;
        $mail->SMTPSecure = 'tls';
        //$mail->SMTPSecure = 'ssl';

        if(is_array($recipient)){
            foreach ($recipient as $to){
            // $mail->clearAddresses();
            //$mail->AddAddress($to);
            $mail->AddBcc($to);
            }
        }else{
            $mail->AddAddress($recipient);
        }

        if($file != NULL){
            $file = "attachment/".$file;
            chmod("attachment/".$file, 777);
            $mail->AddAttachment($file);
            $result = $mail->Send();
            // var_dump($result);
            if ($result){
                chmod("attachment/".$file, 0755);
                return TRUE;
            }else{
                var_dump($mail->ErrorInfo);
                return $mail->ErrorInfo;
                //return FALSE;
            };
        }else{
            $result = $mail->Send();
            // var_dump($result);
            if ($result){
                return TRUE;
            }else{
                var_dump($mail->ErrorInfo);
                return $mail->ErrorInfo;
                //return FALSE;
            };
        }
        
        
    }