<?php

    require "../pdo_connection.php";

    $pdo = pdo();

    $imgName = htmlentities(htmlspecialchars($_GET['imgName']));

    $selectImgDesc = $pdo->prepare("SELECT image_desc FROM face_book WHERE image_name=?");
    $selectImgDesc->execute(array($imgName));
    $getImgDesc = $selectImgDesc->fetch();

    echo $getImgDesc['image_desc'];


 ?>
