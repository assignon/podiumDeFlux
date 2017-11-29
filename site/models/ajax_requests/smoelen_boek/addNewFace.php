<?php

   require "../pdo_connection.php";

   $pdo = pdo();

   //$groupName = htmlentities(htmlspecialchars($_GET['groupName']));
   $imgName = htmlentities(htmlspecialchars($_GET['imgName']));
//   $existedGroupName = htmlentities(htmlspecialchars($_GET['existedGroupName']));
   $imgDesc = htmlentities(htmlspecialchars($_GET['imgDesc']));
   $imgEmail = htmlentities(htmlspecialchars($_GET['imgEmail']));

   if(isset($_FILES['faceImg']) AND !empty($_FILES['faceImg']))
   {

       $img_file = $_FILES['faceImg'];

       $img_file_name = $img_file['name'];
       $img_tmp = $img_file['tmp_name'];
       $img_new_path = '../../../../public/media/smoelenBoek/'.$img_file_name;

       $valide_extentions = array(".png",".jpeg",".jpg");
       $upload_extention = strrchr($img_file_name,".");

        if(!empty($imgDesc))
        {


             if(in_array($upload_extention, $valide_extentions))
             {

                 if(move_uploaded_file($img_tmp, $img_new_path))
                   {

                       $checkImgName = $pdo->prepare('SELECT image_name FROM face_book WHERE image_name=?');
                       $checkImgName->execute(array($imgName));
                       $countImg_name = $checkImgName->rowCount();


                       if($countImg_name == 0)
                       {

                         $insertFace_book = $pdo->prepare("INSERT INTO face_book(image_name, image_src, image_desc, email) VALUES(?,?,?,?)");
                         $insertFace_book->execute(array($imgName, $img_file_name, $imgDesc, $imgEmail));

                         echo "Smoelen boek met succes toegevoegd...";

                       }else{

                          echo "Deze afbeelding naam bestaat al...";

                       }


                      /*  $checkGroupName = $pdo->prepare('SELECT group_name FROM img_group_name WHERE group_name=?');
                        $checkGroupName->execute(array($groupName));
                        $countGroup_name = $checkGroupName->rowCount();

                        if($countGroup_name == 0)
                        {

                          $insertGroup = $pdo->prepare("INSERT INTO img_group_name(group_name) VALUES(?)");
                          $insertGroup->execute(array($groupName));

                        }*/


                   }else{

                       echo "Afbeelding niet geupload, probeer nogmaals...";

                   }


             }else{

                 echo "Deze instentie is niet geaccepteerd.alleen (jpg, jpeg, en png) zijn geaccepteerd...";

             }


        }else if(empty($imgDesc)){

          if(in_array($upload_extention, $valide_extentions))
          {

              if(move_uploaded_file($img_tmp, $img_new_path))
                {

                  $checkImgName = $pdo->prepare('SELECT image_name FROM face_book WHERE image_name=?');
                  $checkImgName->execute(array($imgName));
                  $countImg_name = $checkImgName->rowCount();


                  if($countImg_name == 0)
                  {

                    $insertFace_book = $pdo->prepare("INSERT INTO face_book(image_name, image_src, image_desc,email) VALUES(?,?,?,?)");
                    $insertFace_book->execute(array($imgName, $img_file_name, "Geen informatie over de huidig afbeelding beschikbaar",$imgEmail));

                    echo "Smoelen boek met succes toegevoegd...";

                  }else{

                     echo "Deze afbeelding naam bestaat al...";

                  }



                }else{

                    echo "Afbeelding niet geupload, probeer nogmaals...";

                }


          }else{

              echo "Deze instentie is niet geaccepteerd.alleen (jpg, jpeg, en png) zijn geaccepteerd...";
          }

        }

 }



 ?>
