<?php

    require "../pdo_connection.php";

    $pdo = pdo();

    $limit = 2;

    if(isset($_GET['paginationVal']))
    {

        $paginationVal = htmlentities(htmlspecialchars($_GET['paginationVal']));

        $groups = $pdo->query("SELECT count(id) as groupsId FROM img_group_name");
        $getgroups = $groups->fetch();

        $groupsId = $getgroups['groupsId'];

        $begin = ($paginationVal * $limit)-$limit;
        $end = ($paginationVal * $limit);

        $byPage = $groupsId / $limit;


        $selectGroup = $pdo->query("SELECT * FROM img_group_name ORDER BY id DESC LIMIT ".$begin.','.$end);

        ?>

           <div class="groupsContainer">


                <?php

                while($displayGroups = $selectGroup->fetch())
                {

                  ?>

                  <div class="groupsActionsContainer">

                    <div class="update_delete">

                      <img  src="../vrijwilliger/public/media/menuIcon/svg/004-bar-chart-reload.svg" alt="" class="groupUpdate">
                      <img  src="../vrijwilliger/public/media/menuIcon/svg/003-rubbish.svg" alt="" class="groupDel">

                    </div>

                      <div class="groups">


                            <div class="imgCont">

                              <!--<img src="../vrijwilliger/public/media/smoelenBoek/groupIcons/001-groupicon.svg" alt="">-->
                              <?php

                                 $groupImg = $pdo->prepare("SELECT image_src FROM face_book WHERE group_name=? LIMIT 3");
                                 $groupImg->execute(array($displayGroups['group_name']));

                                 while($display = $groupImg->fetch())
                                 {

                                    ?>

                                       <img src="../vrijwilliger/public/media/smoelenBoek/<?php echo $display['image_src'];?>" alt="">

                                    <?php

                                 }

                               ?>

                            </div>
                            <h2 class="groupesNames"><?php echo $displayGroups['group_name'];?></h2>

                      </div>

                  </div>

                  <?php

                }

                 ?>

           </div>

        <?php


        if($groupsId >= $limit)
        {

        ?>

           <div class="pagination">

              <?php

                  for ($i=1; $i < $byPage+1; $i++)
                  {

                      ?>

                         <button class="paginationButt"><?php echo $i; ?></button>

                      <?php

                  }

               ?>

           </div>

        <?php
       }

    }else{


          $groups = $pdo->query("SELECT count(id) as groupsId FROM img_group_name");
          $getgroups = $groups->fetch();

          $groupsId = $getgroups['groupsId'];


          $byPage = $groupsId / $limit;


          $selectGroup = $pdo->query("SELECT * FROM img_group_name ORDER BY id DESC LIMIT ".$limit);

          ?>

             <div class="groupsContainer">


                  <?php

                  while($displayGroups = $selectGroup->fetch())
                  {

                    ?>

                    <div class="groupsActionsContainer">

                      <div class="update_delete">

                        <img  src="../vrijwilliger/public/media/menuIcon/svg/004-bar-chart-reload.svg" alt="" class="groupUpdate">
                        <img  src="../vrijwilliger/public/media/menuIcon/svg/003-rubbish.svg" alt="" class="groupDel">

                      </div>

                        <div class="groups">


                              <div class="imgCont">

                                <!--<img src="../vrijwilliger/public/media/smoelenBoek/groupIcons/001-groupicon.svg" alt="">-->
                                <?php

                                   $groupImg = $pdo->prepare("SELECT image_src FROM face_book WHERE group_name=? LIMIT 3");
                                   $groupImg->execute(array($displayGroups['group_name']));

                                   while($display = $groupImg->fetch())
                                   {

                                      ?>

                                         <img src="../vrijwilliger/public/media/smoelenBoek/<?php echo $display['image_src'];?>" alt="">

                                      <?php

                                   }

                                 ?>

                              </div>
                              <h2 class="groupesNames"><?php echo $displayGroups['group_name'];?></h2>

                        </div>

                    </div>

                    <?php

                  }

                   ?>

             </div>

          <?php


          if($groupsId >= $limit)
          {

          ?>

             <div class="pagination">

                <?php

                    for ($i=1; $i < $byPage+1; $i++)
                    {

                        ?>

                           <button class="paginationButt"><?php echo $i; ?></button>

                        <?php

                    }

                 ?>

             </div>

          <?php
         }

    }



 ?>
