<?php

   require "../pdo_connection.php";

   $pdo = pdo();

   $limit = 20;

   if(isset($_GET['paginationVal']))
   {

      $paginationVal = htmlentities(htmlspecialchars($_GET['paginationVal']));
    //  $postedGroupName = htmlentities(htmlspecialchars($_GET['postedGroupName']));

      $groupsImg = $pdo->query("SELECT count(id) as groupsImgId FROM face_book");
    //  $groupsImg->execute(array($postedGroupName));
      $getgroupsImg = $groupsImg->fetch();

      $groupsImgId = $getgroupsImg['groupsImgId'];

      $begin = ($paginationVal * $limit)-$limit;
      $end;

      if($paginationVal == 1)
      {

         $end = $limit;

      }else{

         $end = ($paginationVal * $limit)-$limit;

      }

      $byPage = $groupsImgId / $limit;


      $selectImg = $pdo->query("SELECT * FROM face_book ORDER BY id ASC LIMIT ".$begin.','.$end);
    //  $selectImg->execute(array($postedGroupName));

      ?>

         <div class="imgGallerij">

             <?php

             while($displayImg = $selectImg->fetch())
             {

                 ?>

                   <div class="imgActionsContainer">

                     <div class="face_book_actions">

                       <img  src="../vrijwilliger/public/media/menuIcon/svg/004-bar-chart-reload.svg" alt="" class="faceImgUpdate">
                       <img  src="../vrijwilliger/public/media/menuIcon/svg/003-rubbish.svg" alt="" class="faceImfDel">

                     </div>

                      <div class="imgsCont">

                          <img src="../vrijwilliger/public/media/smoelenBoek/<?php echo $displayImg['image_src'];?>" alt="" class="faceImgs">
                          <h3><?php echo $displayImg['image_name'];?></h3>

                      </div>

                   </div>

                 <?php

             }

              ?>

         </div>

      <?php

      if($groupsImgId >= $limit)
      {

      ?>

         <div class="pagination">

            <?php

                for ($i=1; $i < $byPage+1; $i++)
                {

                    ?>

                       <button class="paginationImgButt"><?php echo $i; ?></button>

                    <?php

                }

             ?>

         </div>

      <?php
    }


   }else{

      // $postedGroupName = htmlentities(htmlspecialchars($_GET['postedGroupName']));

       $groupsImg = $pdo->query("SELECT count(id) as groupsImgId FROM face_book");
      // $groupsImg->execute(array($postedGroupName));
       $getgroupsImg = $groupsImg->fetch();

       $groupsImgId = $getgroupsImg['groupsImgId'];


       $byPage = $groupsImgId / $limit;

       $selectImg = $pdo->query("SELECT * FROM face_book ORDER BY image_name ASC LIMIT ".$limit);
      // $selectImg = $pdo->prepare("SELECT * FROM face_book WHERE group_name=? ORDER BY image_name ASC");
      // $selectImg->execute(array($postedGroupName));

       ?>

          <div class="imgGallerij">

              <?php

              while($displayImg = $selectImg->fetch())
              {

                  ?>

                    <div class="imgActionsContainer">

                      <div class="face_book_actions">

                        <img  src="../vrijwilliger/public/media/menuIcon/svg/004-bar-chart-reload.svg" alt="" class="faceImgUpdate">
                        <img  src="../vrijwilliger/public/media/menuIcon/svg/003-rubbish.svg" alt="" class="faceImfDel">

                      </div>

                       <div class="imgsCont">

                           <img src="../vrijwilliger/public/media/smoelenBoek/<?php echo $displayImg['image_src'];?>" alt="" class="faceImgs">
                           <h3><?php echo $displayImg['image_name'];?></h3>

                       </div>

                    </div>

                  <?php

              }

               ?>

          </div>

       <?php

       if($groupsImgId >= $limit)
       {

       ?>

          <div class="pagination">

             <?php

                 for ($i=1; $i < $byPage+1; $i++)
                 {

                     ?>

                        <button class="paginationImgButt"><?php echo $i; ?></button>

                     <?php

                 }

              ?>

          </div>

       <?php
     }

   }



?>
