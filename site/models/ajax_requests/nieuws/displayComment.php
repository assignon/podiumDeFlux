<?php

   require "../pdo_connection.php";

   $pdo = pdo();
   $article_id = intval($_GET['article_id']);
   $user_id = intval($_GET['user_id']);

   $select_comments = $pdo->prepare("SELECT * FROM blog_comments WHERE blog_id=? ORDER BY id DESC");
   $select_comments->execute(array($article_id));


   while($display_comments = $select_comments->fetch())
   {

     $dateNow = new DateTime();
     $datePost = new DateTime($display_comments['comment_date']);
     $dateAfterPost = $dateNow->diff($datePost)->format('%d');

      ?>

        <div class="commentsContainer">

             <img src="../vrijwilliger/public/media/users_avatar/<?php echo $display_comments['avatar'];?>" alt="" class="userAvatar">

               <div class="commentContent">

                 <div class="date_name">

                   <h3><?php echo $display_comments['username'];?></h3>
                   <p class="datePos" style="color:#030303; font-size:15;"><?php echo $dateAfterPost.' '.'dag(en) geleden';?></p>

                 </div>

                 <p class="partContent"><?php echo substr($display_comments['comments'], 0,100);?>...</p>
                 <p class="totalContent"><?php echo $display_comments['comments'];?></p>
                 <img src="../vrijwilliger/public/media/menuIcon/svg/002-commentMore.svg" alt="" class="showMore">
                 <img src="../vrijwilliger/public/media/menuIcon/svg/001-commentless.svg" alt="" class="showLess">

               </div>

        </div>
        <hr class="commentsSeparator"/>

        <script type="text/javascript">

           window.addEventListener("load", function(){

                var allcomments = document.getElementById("allcomments");
                var commentsContainer = document.querySelectorAll(".commentsContainer");

                for (var i = 0; i < commentsContainer.length; i++) {

                    var commentsContainerArr = commentsContainer[i];

                    allcomments.appendChild(commentsContainerArr);

                }


           })

        </script>

      <?php

   }

 ?>
