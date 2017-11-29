<?php

    require "pdo_connection.php";
    require "sendEmail.php";

    $pdo = pdo();

    $userMailVal = filter_var(htmlentities(htmlspecialchars($_GET['userMailVal'])), FILTER_VALIDATE_EMAIL);

    $randString = "abcdefghijklmnopqrstuvwxyz";
     $randString .= "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
     $temporaryUsername = "";

     $length = strlen($randString);
     $nb = 0;

     while($nb < 20)
     {

           $temporaryUsername .= $randString[rand(0,$length-1)];
           $nb++;

     }


     $checkEmail = $pdo->prepare("SELECT username, email FROM signin WHERE email=?");
     $checkEmail->execute(array($userMailVal));

     $getUsername = $checkEmail->fetch();
     $username = $getUsername['username'];
     $countEmail = $checkEmail->rowCount();

     if($countEmail == 1)
     {

        // $updateUsername = $pdo->prepare("UPDATE signin SET username=? WHERE email=?");
        // $updateUsername->execute(array($getUsername, $userMailVal));

         send_mail(

             "Gebruikersnaam hersteld.",
             "

             Uw gebruikersnaam is met succes gevonden. Uw kunt uw gebruikersnaam weer gebruiken.<br/>
             uw gebruikersnaam:".' '.$username."<br/>

             ",
             "vrijwilliger",
             "vrijwilligers@gmail.com",
             $userMailVal

         );

         echo "De Gebruikersnaam is naar uw email gestuurd (Kijk in uw span als u niet in uw mail box hebt gekregen)...";

     }else{

         echo "Email onjuist...";

     }

 ?>
