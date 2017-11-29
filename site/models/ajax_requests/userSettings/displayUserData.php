<?php

   require "../pdo_connection.php";

   $pdo = pdo();
   $userId = intval($_GET['userId']);

   $selectData = $pdo->prepare("SELECT * FROM signin WHERE id=?");
   $selectData->execute(array($userId));


   while($displayData = $selectData->fetch())
   {

       ?>

          <p class="userDatas"><?php echo $displayData['username'];?></p>
          <p class="userDatas"><?php echo $displayData['email'];?></p>

       <?php

   }


 ?>
