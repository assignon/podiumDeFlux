<?php

   session_start();
   $_SESSION = array();
   session_destroy();
   header("Location:../vrijwilliger/index.php?page=login");

 ?>
