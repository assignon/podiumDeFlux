<?php
    session_start();
    require "../pdo_connection.php";

    $pdo = pdo();
    $tabName = htmlentities(htmlspecialchars($_GET['tabName']));

    $getCurrentTab_content = $pdo->prepare("SELECT tab_content, tab_name FROM tabs WHERE tab_name=?");
    $getCurrentTab_content->execute(array($tabName));


    while($displayTab_content = $getCurrentTab_content->fetch())
    {

        ?>
            
            <div class="tab_contents"><?php echo $displayTab_content['tab_content'];?></div>

        <?php

    }

 ?>
