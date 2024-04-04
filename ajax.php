<?php
include 'function.php';


if (isset($_POST['email'])) {
    $mail = htmlspecialchars_decode(strip_tags($_POST['email']));
    $Gonder = new SifreSifirla();
    $mail = $Gonder->MailGonder("Metin Yeşil", "$mail");
    echo $mail;
}

if (isset($_POST['otp'])) {
    $otpcode = htmlspecialchars_decode(strip_tags($_POST['otp']));

        if($otpcode == $_SESSION['otp']){
            echo 'success';
        }
        else{
            echo 'error';
        }
}
?>
