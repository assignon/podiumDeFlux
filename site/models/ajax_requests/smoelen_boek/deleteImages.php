<?php

    require "../pdo_connection.php";

    $pdo = pdo();

    $imgName = htmlentities(htmlspecialchars($_GET['imgName']));
    $SUpass = sha1($_GET['SUpassVal']);

    $checkPass  =$pdo->prepare("SELECT password FROM signin WHERE password=?");
    $checkPass->execute(array($SUpass));
    $getSUpass = $checkPass->fetch();


    if($SUpass == $getSUpass['password'])
    {

        $deleteCurrentFaceImg = $pdo->prepare("DELETE FROM face_book WHERE image_name=?");
        $deleteCurrentFaceImg->execute(array($imgName));

        echo "Huidige afbeelding met succes verwijderd...";

    }else{

        echo "Wachtwoord onjuist...";

    }

 ?>
