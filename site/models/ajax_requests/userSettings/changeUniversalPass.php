<?php

    require "../pdo_connection.php";

    $pdo = pdo();

    $newUniversalPass = htmlentities(htmlentities($_GET['newUniversalPass']));
    $superUserPass = sha1($_GET['superUserPass']);
    $userId = intval($_GET['userId']);


    $checkPass = $pdo->prepare("SELECT * FROM signin WHERE id=? AND password=?");
    $checkPass->execute(array($userId, $superUserPass));
    $getData = $checkPass->fetch();

    if($superUserPass == $getData['password'] AND $getData['grade'] == "super-user")
    {

         if(strlen($newUniversalPass) > 7)
         {

             if($newUniversalPass != $getData['username'])
             {

               $update = $pdo->prepare("UPDATE universal_password SET universal_pass=?");
               $update->execute(array(sha1($newUniversalPass)));

               echo "Wachtwoord met succes aangepast";

             }else{

                echo "Het new Wachtwoord moet niet gelijk aan de gebruiksnaam zijn...";

             }

         }else{

           echo "Wachtwoord te kort(minmaal 7 letters)...";

         }

    }else{

      echo "Wachtwoord onjuist...";

    }

?>
