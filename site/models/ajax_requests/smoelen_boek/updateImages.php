<?php

    require "../pdo_connection.php";

    $pdo = pdo();

    //$groupName = htmlentities(htmlspecialchars($_GET['groupName']));
    $imgName = htmlentities(htmlspecialchars($_GET['imgName']));
    $imageName = htmlentities(htmlspecialchars($_GET['imageName']));
    $imgDesc = htmlentities(htmlspecialchars($_GET['imgDesc']));
    $imgNameUpdate = htmlentities(htmlspecialchars($_GET['imgNameUpdate']));
    $updateEmail = htmlentities(htmlspecialchars($_GET['updateEmail']));
  //  $selectGroupVal = htmlentities(htmlspecialchars($_GET['selectGroupVal']));


  /*  $selectGroupName = $pdo->prepare("SELECT group_name FROM face_book WHERE image_name=?");
    $selectGroupName->execute(array($imgName));
    $getGroupName = $selectGroupName->fetch();*/


    $checkImgName = $pdo->prepare('SELECT image_name FROM face_book WHERE image_name=?');
    $checkImgName->execute(array($imgNameUpdate));
    $countImg_name = $checkImgName->rowCount();


    if(isset($_FILES['faceImg']))
    {

          $img_file = $_FILES['faceImg'];

          $img_file_name = $img_file['name'];
          $img_tmp = $img_file['tmp_name'];
          $img_new_path = '../../../../public/media/smoelenBoek/'.$img_file_name;

          $valide_extentions = array(".png",".jpeg",".jpg");
          $upload_extention = strrchr($img_file_name,".");

          if(!empty($img_file))
          {

                  if(in_array($upload_extention, $valide_extentions))
                  {

                          if(move_uploaded_file($img_tmp, $img_new_path))
                            {



                                  $update = $pdo->prepare("UPDATE face_book SET image_src=? WHERE image_name=?");
                                  $update->execute(array($img_file_name, $imgName));

                                //  $updateGroup = $pdo->prepare("UPDATE img_group_name SET group_name=? WHERE group_name=?");
                                //  $updateGroup->execute(array($groupName, $getGroupName['group_name']));

                                  echo 'Huidige afbeelding met succes aangepast...';



                            }else{

                                echo "Afbeelding niet geupload, probeer nogmaals...";

                            }


                    }else{

                        echo "Deze instentie is niet geaccepteerd.alleen (jpg, jpeg, en png) zijn geaccepteerd...";

                    }



          }


          /*else if(!empty($groupName) AND $selectGroupVal != "Of selecteer een bestaande groepsnaam" OR !empty($imageName) OR !empty($imgDesc) OR !empty($img_file))
          {

              echo "Geef een groupsnaam door de afbeelding groepsnaam veld in te vullen of door een bestaande groepsnaam te kiezen, u kunt beide niet tegelijk tijd gebruiken...";

          }*/

    }

    if(!empty($imageName))
    {

      $update = $pdo->prepare("UPDATE face_book SET image_name=? WHERE image_name=?");
      $update->execute(array($imageName, $imgName));
      echo 'Huidige afbeelding met succes aangepast...';

    }


    if(!empty($imgDesc))
    {

      $update = $pdo->prepare("UPDATE face_book SET image_desc=? WHERE image_name=?");
      $update->execute(array($imgDesc, $imgName));
      echo 'Huidige afbeelding met succes aangepast...';

    }


    if(!empty($updateEmail))
    {

      $update = $pdo->prepare("UPDATE face_book SET email=? WHERE image_name=?");
      $update->execute(array($updateEmail, $imgName));
      echo 'Huidige afbeelding met succes aangepast...';

    }


  /*  if(empty($updateEmail))
    {

      $update = $pdo->prepare("UPDATE face_book SET image_name=?, image_desc=? WHERE image_name=?");
      $update->execute(array($imageName, $imgDesc, $imgName));
      echo 'Huidige afbeelding met succes aangepast...';

    }*/





 ?>
