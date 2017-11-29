<?php

   require "../pdo_connection.php";
   require "../sendEmail.php";

   $pdo = pdo();

   $username = htmlentities(htmlspecialchars($_GET['user_name']));
   $email = filter_var(htmlentities(htmlspecialchars($_GET['email'])), FILTER_VALIDATE_EMAIL);
   $SUpass = sha1($_GET['SUpass']);

   $checkPass = $pdo->prepare("SELECT password FROM signin WHERE password=?");
   $checkPass->execute(array($SUpass));
   $getPass = $checkPass->fetch();


   $randString = "abcdefghijklmnopqrstuvwxyz";
    $randString .= "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
    $temporaryPass = "";

    $length = strlen($randString);
    $nb = 0;

    while($nb < 20)
    {

          $temporaryPass .= $randString[rand(0,$length-1)];
          $nb++;

    }


   if($SUpass == $getPass['password'])
   {

       $checkUsername = $pdo->prepare("SELECT username FROM signin WHERE username=? AND grade=?");
       $checkUsername->execute(array($username, "guest-user"));
       $countUsername = $checkUsername->rowCount();

       if($countUsername == 0)
       {

           $checkEmail = $pdo->prepare("SELECT email FROM signin WHERE email=? AND grade=?");
           $checkEmail->execute(array($email, "guest-user"));
           $countEmail = $checkEmail->rowCount();

           if($countEmail == 0)
           {

               $insertUser = $pdo->prepare("INSERT INTO signin(username, password, email, grade, avatar) VALUES(?,?,?,?,?)");
               $insertUser->execute(array($username, sha1($temporaryPass), $email, "guest-user", "defaultAvatar.svg"));

               send_mail(

                   "Vrijwilliger geworden.",
                   "

                   U bent toegevoegd als vrijwilliger op podium de flux site. Uw tijdelijk inlog gegevens staan onderaan.<br/>
                   uw tijdelijk gebruikersnaam:".' '.$username."<br/>
                   Uw tijdelijk wachtwoord:".' '.$temporaryPass.' '."<br/>Niet vergeten om het wachtwoord te veranderen ales u ingelogd bent.

                   ",
                   "vrijwilliger",
                   "vrijwilligers@gmail.com",
                   $email

               );

               echo "Nieuw gebruiker met succes toegevoegd...";

           }else{

             echo "De email bestaat al...";

           }



       }else{

         echo "Deze gebruikersnaam bestaat al...";

       }


   }else{

     echo "Wachtwoord onjuist...";

   }

 ?>
