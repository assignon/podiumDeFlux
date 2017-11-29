<?php

   require "../pdo_connection.php";

   $pdo = pdo();
   $imageName = htmlentities(htmlspecialchars($_GET['imageName']));

   $selectCurrentImg = $pdo->prepare("SELECT * FROM face_book WHERE image_name=?");
   $selectCurrentImg->execute(array($imageName));

   ?>

     <img src="../vrijwilliger/public/media/menuIcon/svg/004-x-button.svg" alt="" id="closeImgs">

   <?php

   while($displayImg = $selectCurrentImg->fetch())
   {

      ?>

         <div class="currentImgCont">

            <img src="../vrijwilliger/public/media/smoelenBoek/<?php echo $displayImg['image_src'];?>" alt="">
            <div class="imgNameDesc">

              <h2><?php echo $displayImg['image_name'];?><span>(<?php echo $displayImg['email'];?>)</span></h2>
              <p><?php echo $displayImg['image_desc'];?></p>

            </div>

         </div>

      <?php

   }

 ?>
