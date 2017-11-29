<?php

  $img_file = $_FILES['newImage'];

  $img_name = $img_file['name'];
  $img_tmp = $img_file['tmp_name'];
  $img_new_path = '../../../../public/media/blog_images/'.$img_name;

  $valide_extentions = array(".png",".jpeg",".jpg");
  $upload_extention = strrchr($img_name,".");

   if(in_array($upload_extention, $valide_extentions))
   {

     if(move_uploaded_file($img_tmp, $img_new_path))
     {

         echo "<img src='".$img_new_path."'></br>";

     }else{

       echo "Afbeelding niet geupload, probeer nogmaals...";

     }


   }else{

     echo "Deze instentie is niet geaccepteerd.alleen (jpg, jpeg, en png) zijn geaccepteerd...";

   }

 ?>
