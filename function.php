<?php
/*
Metin Yeşil | PHP Developer

Github: https://github.com/metinyesil
Twitter: https://twitter.com/metlexx

*/

session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

class SifreSifirla {

    private $mailer;

    public function __construct() {
        $this->mailer = new PHPMailer(true);
    }

    public function MailGonder($nickname, $mail) {

         $nickname = htmlspecialchars_decode(strip_tags($nickname));
         $mail = htmlspecialchars_decode(strip_tags($mail));
         $code = rand(100000,999999);
         $_SESSION['otp'] = $code;
         $otp = $_SESSION['otp'];
         try {
             $this->mailer->CharSet = 'UTF-8';
             $this->mailer->SMTPDebug = 0;
             $this->mailer->isSMTP(); 
             $this->mailer->Host = 'smtp.gmail.com';
             $this->mailer->SMTPAuth = true;
             $this->mailer->Username = 'mailadresi@gmail.com';
             $this->mailer->Password = 'Şifre';
             $this->mailer->SMTPSecure = 'tls';
             $this->mailer->Port = 587;
             $this->mailer->SMTPOptions = array(
                 'ssl' => array(
                 'verify_peer' => false,
                 'verify_peer_name' => false,
                 'allow_self_signed' => true
                 )
             );

             $this->mailer->setFrom('isim@alanadiniz.com', 'İletişim Formu');
             $this->mailer->addAddress("$mail");

             $this->mailer->isHTML(true);
             $this->mailer->Subject = 'Siteismi - Şifre Sıfırlama';
             $this->mailer->Body = "<h3>Merhaba $nickname</h3><br> Az önce bir şifre sıfırlama talebi gönderdiniz. <br>Şifre sıfırlama talebiniz için güvenlik kodunuz: <b>$code</b>" ;

             $this->mailer->send();
             return "success";
         } catch (Exception $e) {
             return "error";
         }
    }
}
?>
