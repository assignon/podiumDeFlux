<?php

   require "../pdo_connection.php";

   $pdo = pdo();

   $currentUserName = htmlentities(htmlspecialchars($_GET['currentUserName']));

   $getUsersData = $pdo->prepare("SELECT * FROM signin WHERE username=?");
   $getUsersData->execute(array($currentUserName));

   while($displayUserData = $getUsersData->fetch())
   {

        ?>


            <div class="nameEmail">

              <p>Naam:<?php echo '  '.$displayUserData['username'];?></p>
              <p>Email:<?php echo '  '.$displayUserData['email'];?></p>

            </div>
            <img src="../vrijwilliger/public/media/users_avatar/<?php echo $displayUserData['avatar'];?>" alt="">

        <?php

   }

 ?>
