<?php

    require "../pdo_connection.php";

    $pdo = pdo();

    $username = htmlentities(htmlspecialchars($_GET['username']));
    $user_name = htmlentities(htmlspecialchars($_GET['user_name']));
    $email = filter_var(htmlentities(htmlspecialchars($_GET['email'])), FILTER_VALIDATE_EMAIL);
    $SUpass = sha1($_GET['SUpass']);

    $checkPass = $pdo->prepare("SELECT password FROM signin WHERE password=?");
    $checkPass->execute(array($SUpass));
    $getPass = $checkPass->fetch();

    if($SUpass == $getPass['password'])
    {

      if(!empty($user_name))
      {

          $checkUsername = $pdo->prepare("SELECT username FROM signin WHERE username=? AND grade=?");
          $checkUsername->execute(array($username, "guest-user"));
          $countUsername = $checkUsername->rowCount();

          if($countUsername == 1)
          {

            $update_username = $pdo->prepare("UPDATE signin SET username=? WHERE username=? AND grade=?");
            $update_username->execute(array($user_name, $username, "guest-user"));

            echo "Gebruikersnaam met succes aangepast...";

          }else if($countUsername > 1){

             echo "Deze gebruikersnaam bestaat al...";

          }

      }else if(!empty($email))
      {

          $checkEmail = $pdo->prepare("SELECT email FROM signin WHERE username=? AND grade=?");
          $checkEmail->execute(array($username, "guest-user"));
          $countEmail = $checkEmail->rowCount();

          if($countEmail == 1)
          {

            $update_email = $pdo->prepare("UPDATE signin SET email=? WHERE username=? AND grade=?");
            $update_email->execute(array($email, $username, "guest-user"));

            echo "Email met succes aangepast...";

          }else if($countUsername > 1){

             echo "Deze email bestaat al...";

          }

      }


    }else{

        echo "Wachtwoord onjuist";

    }

 ?>
