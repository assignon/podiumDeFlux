<?php

   require "../pdo_connection.php";

   $pdo = pdo();


   $newTabVal = htmlentities(htmlspecialchars($_GET['newTabVal']));
   $tabContentVal = $_GET['tabContentVal'];
   $pdf_name = htmlentities(htmlspecialchars($_GET['pdfname']));

   //$tabName = htmlentities(htmlentities($_GET['tabName']));

   $checkTab_name = $pdo->prepare("SELECT tab_name FROM tabs WHERE tab_name=?");
   $checkTab_name->execute(array($newTabVal));
   $tabName_count = $checkTab_name->rowCount();


   $checkPdfTab_name = $pdo->prepare("SELECT tab FROM pdfs WHERE tab=?");
   $checkPdfTab_name->execute(array($newTabVal));
   $pdfTabName_count = $checkPdfTab_name->rowCount();

   if(!empty($newTabVal) AND !empty($pdf_name) AND isset($_FILES['pdf']))
   {

       $pdfFile = $_FILES['pdf'];

       $pdf_file_name = $pdfFile['name'];
       $pdf_tmp = $pdfFile['tmp_name'];
       $pdf_new_path = '../../../../public/media/pdfs/'.$pdf_file_name;

       $valide_extentions = array(".pdf");
       $upload_extention = strrchr($pdf_file_name,".");


            if(in_array($upload_extention, $valide_extentions))
            {

                if(move_uploaded_file($pdf_tmp, $pdf_new_path))
                  {

                      if($tabName_count == 0 AND $pdfTabName_count == 0)
                      {

                         $insert_newTab = $pdo->prepare("INSERT INTO tabs(tab_name, tab_content) VALUES(?,?)");
                         $insert_newTab->execute(array($newTabVal, $tabContentVal));

                         $insert_newTab = $pdo->prepare("INSERT INTO pdfs(pdf_name, pdf_file, tab) VALUES(?,?,?)");
                         $insert_newTab->execute(array($pdf_name, $pdf_file_name, $newTabVal));

                         echo "Tabblad met succes toegevoegd...";

                      }else{

                        echo "Deze tabblad bestaat al...";

                      }

                  }else{

                     echo "pdf niet geupload...";

                  }
            }else{

               echo "Alleen PDF bestaanden zij toegestaan...";

            }


   }else if(!empty($newTabVal) AND empty($pdf_name) AND empty($_FILES['pdf']))
   {

         if($tabName_count == 0)
         {

            $insert_newTab = $pdo->prepare("INSERT INTO tabs(tab_name, tab_content) VALUES(?,?)");
            $insert_newTab->execute(array($newTabVal, $tabContentVal));

            echo "Tabblad met succes toegevoegd...";

         }else{

           echo "Deze tabblad bestaat al...";

         }

   }else{

      echo "Tekst veld leeg...";

   }

 ?>
