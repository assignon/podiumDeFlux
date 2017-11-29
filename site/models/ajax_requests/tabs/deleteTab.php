<?php

require "../pdo_connection.php";

$pdo = pdo();
$pass = $_GET['tabPassVal'];

if($pass == "")
{

      $getPass = $pdo->prepare("SELECT password FROM signin WHERE password=? AND grade=?");
      $getPass->execute(array($pass, 'super-user'));
      $passExist = $getPass->fetch();

      if($passExist['password'] == $pass)
      {

          if(isset($_GET['allTabs']) AND $_GET['allTabs'] != "Selecteer de tabblad die aangepast moet worden")
          {

             $allTabs = htmlentities(htmlspecialchars($_GET['allTabs']));

             $deleteTab = $pdo->prepare("DELETE FROM tabs WHERE tab_name=?");
             $deleteTab->execute(array($allTabs));

             $deletepdfTab = $pdo->prepare("DELETE FROM pdfs WHERE tab=?");
             $deletepdfTab->execute(array($allTabs));

             echo "tabblad en de bijhorende pdf(s) met succes verwijderd...";

          }else if(isset($_GET['pdfsName']) AND $_GET['pdfsName'] != "Selecteer een pdf")
          {

             $pdfsName = htmlentities(htmlspecialchars($_GET['pdfsName']));

             $deletepdfTab = $pdo->prepare("DELETE FROM pdfs WHERE pdf_name=?");
             $deletepdfTab->execute(array($pdfsName));

             echo "pdf met succes verwijderd...";

          }else if(isset($_GET['allTabs']) AND $_GET['allTabs'] != "Selecteer de tabblad die aangepast moet worden" AND isset($_GET['pdfsName']) AND $_GET['pdfsName'] != "Selecteer een pdf")
          {

            $allTabs = htmlentities(htmlspecialchars($_GET['allTabs']));

            $deleteTab = $pdo->prepare("DELETE FROM tabs WHERE tab_name=?");
            $deleteTab->execute(array($allTabs));

            $deletepdfTab = $pdo->prepare("DELETE FROM pdfs WHERE tab=?");
            $deletepdfTab->execute(array($allTabs));

            $pdfsName = htmlentities(htmlspecialchars($_GET['pdfsName']));

            $deletepdfTab = $pdo->prepare("DELETE FROM pdfs WHERE pdf_name=?");
            $deletepdfTab->execute(array($pdfsName));

            echo "tabblad en de bijhorende pdf(s) met succes verwijderd...";

          }

      }else{

          echo "Het wachtwoord is onjuist...";

      }


}else{

   echo "Geef het wachtwoord aan";

}

?>
