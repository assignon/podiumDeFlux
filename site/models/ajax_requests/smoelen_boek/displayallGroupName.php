<?php

   require "../pdo_connection.php";

   $pdo = pdo();

   $selectGroups = $pdo->query("SELECT * FROM img_group_name");
   ?>

    <h3 class="goupsAll">Alle greopen</h3>

   <?php
   while($displayGroups = $selectGroups->fetch())
   {

      ?>

        <option value="<?php echo $displayGroups['group_name'];?>"><?php echo $displayGroups['group_name'];?></option>

      <?php

   }

?>
