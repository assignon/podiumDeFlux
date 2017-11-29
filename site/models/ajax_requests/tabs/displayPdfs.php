<?php
    session_start();
    require "../pdo_connection.php";

    $pdo = pdo();
    $tabName = htmlentities(htmlspecialchars($_GET['tabName']));

    $getCurrentTab_content = $pdo->prepare("SELECT * FROM pdfs WHERE tab=?");
    $getCurrentTab_content->execute(array($tabName));


    while($displayTab_pdf = $getCurrentTab_content->fetch())
    {

        ?>

           <div class="pdf_name">

               <a href="../vrijwilliger/index.php?page=pdfs&id=<?php echo $_SESSION['id'];?>"&pdf_name="<?php echo $displayTab_pdf['pdf_name']; ?>" target="_blank" class="pdfs" >

                  <img src="../vrijwilliger/public/media/pdfs/pdf.svg" alt="">
                  <span><?php echo $displayTab_pdf['pdf_name'];?></span>

                </a>

           </div>


        <?php

    }

 ?>
