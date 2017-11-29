<?php
session_start();
    require "../pdo_connection.php";

    $pdo = pdo();

    $selectTabs = $pdo->query("SELECT tab_name FROM tabs");

    while($postTabs = $selectTabs->fetch())
    {

       ?>

          <a href="../vrijwilliger/index.php?page=tabblad&tab=<?php echo $postTabs['tab_name'];?>&id=<?php echo $_SESSION['id'];?>"><p><?php echo $postTabs['tab_name'];?></p></a>

       <?php

    }

 ?>
