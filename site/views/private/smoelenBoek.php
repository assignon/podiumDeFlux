<!DOCTYPE html>
<html>
    <head>
      <?php require "../vrijwilliger/site/views/templates/head.php"; ?>
      <link rel="stylesheet" href="../vrijwilliger/public/css/smoelenBoek.css"/>
    <!--  <link rel="stylesheet" href="../reachoutNL/public/css/font.css"/>-->
      <script src="../vrijwilliger/public/js/smoelenBoek.js"></script>
      <title>Vrijwilligers</title>
    </head>
    <body>

        <header>

          <?php //require "../vrijwilliger/site/views/templates/users_data.php"; ?>


          <div id="nieuwsContainer">

            <?php require "../vrijwilliger/site/views/templates/userSettings.php";?>

            <form class="faceForm" action="" method="" enctype="multipart/form-data">

               <div class="inputs">

                 <p class="error">Voeg afbeeldingen aan de smoelen boek toe...</p>

                 <!--<input type="text" name="" placeholder="Afbeelding groep naam*" class="faceInputs" id="group_name">
                 <input type="text" name="" placeholder="Nieuw afbeelding groep naam" class="faceGroupUpdate">-->
                 <input type="text" name="" placeholder="Afbeelding naam*" class="faceInputs">
                 <input type="text" name="" placeholder="Afbeelding naam" class="faceInputsUpdate">

                 <input type="email" name="" placeholder="Email*" class="email">
                 <input type="email" name="" placeholder="EmailUpdate" class="emailUpdate">
                 <!--<select class="faceInputs" name="" id="selectGroup">

                    <option>Of selecteer een bestaande groepsnaam</option>
                    <?php //$smoelenBoek->getAllGroupName();?>

                 </select>-->
                 <input type="file" name="faceImg" id="faceImg">

               </div>

               <div class="areaSubs">

                 <textarea name="name" rows="8" cols="80" placeholder="Beschrijving over de afbeelding" class="faceInputs"></textarea>

                 <input type="submit" name="" value="Toevoegen" id="addFace_book">
                 <input type="submit" name="" value="Aanpassen" id="updateFace_book">
                 <input type="submit" name="" value="Afbeelging aanpassen" id="updateImg_book">

               </div>

               <img src="../vrijwilliger/public/media/menuIcon/svg/004-x-button.svg" alt="" id="closeFaceBookForm">

            </form>


            <form class="faceDeleteForm" action="" method="">
                <img src="../vrijwilliger/public/media/menuIcon/svg/004-x-button.svg" alt="" id="closeDeleteForm">
                <p class="error">Huidige smoelen groep verwijderen(Letop:als u een groep verwijdert, worden alle afbeeldingen die in staan ook mee verwijderd)</p>
                <input type="password" name="" placeholder="Wachtwoord" id="sUserPass">
                <input type="submit" name="" value="Verwijderen" id="imgDeleteForm">

            </form>

            <?php require "../vrijwilliger/site/views/templates/menu.php"; ?>

            <?php require "../vrijwilliger/site/views/templates/logo.php"; ?>

            <div id="core">

               <!--<div id="groupContainer">

               </div>-->


               <div id="groupImgContainer">

                   <!--<div class="backColor">

                   </div>-->

                   <div class="groupcontents">

                     <!--<div class="groupImgHeaders">

                       <div class="deleteUpdate">

                         <img  src="../vrijwilliger/public/media/menuIcon/svg/004-bar-chart-reload.svg" alt="" id="updateImg">
                         <img  src="../vrijwilliger/public/media/menuIcon/svg/003-rubbish.svg" alt="" id="deleteImg">


                       </div>

                       <select class="groupsSelect" id="allGroup" name="">

                            <option>Alle greopen</option>

                       </select>

                       <img src="../vrijwilliger/public/media/menuIcon/svg/004-x-button.svg" alt="" id="closeGroupImg">

                     </div>-->

                     <div id="innerGroupCont">

                        <!--<div id="allGroups">

                          <h3>Alle greopen</h3>

                        </div>-->

                        <div id="groupImg">

                        </div>

                     </div>

                   </div>

               </div>


               <div id="imgContainer">

                   <div class="imgBackColor">

                   </div>


                   <div id="imgsReceiverCont">



                   </div>

               </div>

            </div>

          </div>

        </header>


          <?php// require "../vrijwilliger/site/views/templates/footer.php"; ?>

    </body>

</html>
