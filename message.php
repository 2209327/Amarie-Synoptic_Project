<?php

if(isset($_POST['button-send'])){
    
    $name = $_POST['name'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    if(empty($name) || empty($email) || empty($subject) || empty($message)){
        header('location: contact.php?error');
    }else{
        $to = "amariephillips11@gmail.com";

        if(mail($to,$subject,$message,$email)){
            header('location: contact.php?success');
        }
    }
}else{
    header('location: contact.php');
}


?>