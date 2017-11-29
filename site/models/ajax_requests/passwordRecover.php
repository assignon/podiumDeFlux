<?php

    require "pdo_connection.php";
    require "sendEmail.php";

    $pdo = pdo();

    $userMailVal = filter_var(htmlentities(htmlspecialchars($_GET['userMailVal'])), FILTER_VALIDATE_EMAIL);

    $randString = "abcdefghijklmnopqrstuvwxyz";
     $randString .= "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
     $temporaryPassword = "";

     $length = strlen($randString);
     $nb = 0;

     while($nb < 20)
     {

           $temporaryPassword .= $randString[rand(0,$length-1)];
           $nb++;

     }


     $checkEmail = $pdo->prepare("SELECT email FROM signin WHERE email=?");
     $checkEmail->execute(array($userMailVal));
     $countEmail = $checkEmail->rowCount();

     if($countEmail == 1)
     {

         $updatePassword = $pdo->prepare("UPDATE signin SET password=? WHERE email=?");
         $updatePassword->execute(array(sha1($temporaryPassword), $userMailVal));

         send_mail(

             "Gebruikersnaam hersteld.",
             "

             Uw wachtwoordis met succes gewijzigd. Uw tijdelijk gebruikersnaam staat onderaan.<br/>
             uw tijdelijk wachtwoord:".' '.$temporaryPassword."<br/>

             ",
             "vrijwilliger",
             "vrijwilligers@gmail.com",
             $userMailVal

         );

         echo "Het wachtwoord is met succes gewijzigd. Een email is naar u mail box gestuurd met een nieuw tijdelijke wachtwoord(Kijk in uw span als u niet in uw mail box hebt gekregen)...";

     }else{

         echo "Email onjuist...";

     }

 ?>
