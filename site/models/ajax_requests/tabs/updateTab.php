<?php

   require "../pdo_connection.php";

   $pdo = pdo();
   $tabName = htmlentities(htmlspecialchars($_GET['tabName']));
   $tabnameUpdate = htmlentities(htmlspecialchars($_GET['tabnameUpdate']));
   $pdf_name = htmlentities(htmlspecialchars($_GET['pdf_name']));
   $currentPdf = htmlentities(htmlspecialchars($_GET['currentPdf']));
   $tab_Content = $_GET['tab_Content'];


   if($tabName != 'Selecteer een tabblad die u wil aanpassen')
   {

         $currentTab_content = $pdo->prepare('SELECT tab_content FROM tabs WHERE tab_name=?');
         $currentTab_content->execute(array($tabName));
         $currentTab_content = $currentTab_content->fetch();

         if($currentTab_content['tab_content'] != $tab_Content)
         {

           $updateTab = $pdo->prepare("UPDATE tabs SET tab_Content=? WHERE tab_name=?");
           $updateTab->execute(array($tab_Content, $tabName));

           echo "tabblad met succes aangepast...";

         }else{



         }



         if(!empty($tabnameUpdate))
         {

           $updateTabName = $pdo->prepare("UPDATE tabs SET tab_name=? WHERE tab_name=?");
           $updateTabName->execute(array($tabnameUpdate, $tabName));

           /*************************pdfs tab name*******************************************/

           $updateTab_Name = $pdo->prepare("UPDATE pdfs SET  tab=? WHERE tab=?");
           $updateTab_Name->execute(array($tabnameUpdate, $tabName));

           echo "tab naam met succes aangepast...";

         }



         if(!empty($pdf_name) AND $currentPdf != "Selecteer een pdf")
         {

           $updatePdfName = $pdo->prepare("UPDATE pdfs SET pdf_name=? WHERE pdf_name=? AND tab=?");
           $updatePdfName->execute(array($pdf_name, $currentPdf, $tabName));

           echo "PDF naam met succes aangepast...";

         }


          if(!empty($_FILES['pdf']) AND isset($_FILES['pdf']) AND !empty($pdf_name) AND $currentPdf == "Selecteer een pdf")
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

                        if(empty($tabnameUpdate))
                        {

                          $addPdf = $pdo->prepare("INSERT INTO pdfs(pdf_name, pdf_file, tab) VALUES(?,?,?)");
                          $addPdf->execute(array($pdf_name, $pdf_file_name, $tabName));

                          echo "Nieuw pdf met succes Toegevoegd...";

                        }else{

                          $addPdf = $pdo->prepare("INSERT INTO pdfs(pdf_name, pdf_file, tab) VALUES(?,?,?)");
                          $addPdf->execute(array($pdf_name, $pdf_file_name, $tabnameUpdate));

                          echo "Nieuw pdf met succes Toegevoegd...";

                        }

                    }else{

                       echo "pdf niet geupload...";

                    }


                }else{

                   echo "Alleen PDF bestaanden zij toegestaan en geef een naam aan de pdf...";

                }

          }else{



          }


   }else{

      echo "Selecteer de tabblad die aangepast moet worden";

   }

    /*    if(!empty($tabnameUpdate) AND !empty($pdf_name) AND  !empty($pdfFile) AND isset($_FILES['pdf']) AND !empty($tab_Content))
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

                            $updateTab = $pdo->prepare("UPDATE tabs SET tab_name=?, pdf_name=?, pdf_file=?, tab_Content=? WHERE tab_name=?");
                            $updateTab->execute(array($tabnameUpdate, $pdf_name, $pdf_file_name, $tab_Content, $tabName));

                            echo "tabblad met succes aangepast...";

                        }else{

                           echo "pdf niet geupload...";

                        }


                    }else{

                       echo "Alleen PDF bestaanden zij toegestaan...";

                    }



            }else if(empty($tabnameUpdate) AND !empty($pdf_name) AND  !empty($pdfFile) AND isset($_FILES['pdf']) AND !empty($tab_Content))
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

                          $updateTab = $pdo->prepare("UPDATE tabs SET pdf_name=?, pdf_file=?, tab_Content=? WHERE tab_name=?");
                          $updateTab->execute(array( $pdf_name, $pdf_file_name, $tab_Content, $tabName));

                          echo "tabblad met succes aangepast...";

                      }else{

                         echo "pdf niet geupload...";

                      }


                  }else{

                     echo "Alleen PDF bestaanden zij toegestaan...";

                  }

            }else if(!empty($tabnameUpdate) AND empty($pdf_name) AND  !empty($pdfFile) AND isset($_FILES['pdf']) AND !empty($tab_Content))
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

                            $updateTab = $pdo->prepare("UPDATE tabs SET tab_name=?, pdf_file=?, tab_Content=? WHERE tab_name=?");
                            $updateTab->execute(array($tabnameUpdate, $pdf_file_name, $tab_Content, $tabName));

                            echo "tabblad met succes aangepast...";

                        }else{

                           echo "pdf niet geupload...";

                        }


                    }else{

                       echo "Alleen PDF bestaanden zij toegestaan...";

                    }

            }else if(!empty($tabnameUpdate) AND !empty($pdf_name) AND  empty($pdfFile) AND !empty($tab_Content))
            {

              $updateTab = $pdo->prepare("UPDATE tabs SET tab_name=?, pdf_name=?, tab_Content=? WHERE tab_name=?");
              $updateTab->execute(array($tabnameUpdate, $pdf_name, $tab_Content, $tabName));

              echo "tabblad met succes aangepast...";

            }else if(empty($tabnameUpdate) AND empty($pdf_name) AND  empty($pdfFile) AND !empty($tab_Content))
            {

              $updateTab = $pdo->prepare("UPDATE tabs SET  tab_Content=? WHERE tab_name=?");
              $updateTab->execute(array($tab_Content, $tabName));

              echo "tabblad met succes aangepast...";

            }else{

                echo "nenenenen";

            }*/



 ?>
