<!DOCTYPE html>
<html>
    <head>
      <?php require "../vrijwilliger/site/views/templates/head.php"; ?>
      <link rel="stylesheet" href="../vrijwilliger/public/css/userManager.css"/>
    <!--  <link rel="stylesheet" href="../reachoutNL/public/css/font.css"/>-->
    <script src="../vrijwilliger/public/js/userManager.js"></script>
    <script src="../vrijwilliger/public/js/ckeditor/ckeditor.js"></script>
    <script src="../vrijwilliger/public/js/ckeditor/adapters/jquery.js"></script>
      <title>Vrijwilligers</title>
    </head>
    <body>

        <header>

           <div class="usersForms">

              <form class="addUpdateForm" action="" method="">

                  <div class="addBackColor">

                  </div>

                  <div class="addFormInputs">

                      <img src="../vrijwilliger/public/media/menuIcon/svg/004-x-button.svg" alt="" id="closeUsersDataForm">

                      <p class="error"></p>

                      <input type="text" name="" placeholder="Gebruikersname" class="usersDataVal" id="usersname">
                      <input type="email" name="" placeholder="Email" class="usersDataVal">
                      <input type="password" name="" placeholder="Wachtwoord" class="usersDataVal">
                      <input type="submit" name="" value="Toevoegen" id="addUser">
                      <input type="submit" name="" value="Aanpassen" id="updateUser">

                  </div>

              </form>


              <form class="deleteForm" action="" method="">

                  <div class="deleteBackColor">

                  </div>

                  <div class="deleteFormInputs">

                      <img src="../vrijwilliger/public/media/menuIcon/svg/004-x-button.svg" alt="" id="closeUsersDeleteForm">

                      <p class="error">Huidig gebruiker verwijderen</p>

                      <input type="password" name="" placeholder="Wachtwoord" id="SUpass">
                      <input type="submit" name="" value="Verwijderen" id="deleteUser">

                  </div>

              </form>

           </div>

            <div class="userManager_container">

              <?php require "../vrijwilliger/site/views/templates/userSettings.php";?>

              <?php //require "../vrijwilliger/site/views/templates/users_data.php";?>

              <?php require "../vrijwilliger/site/views/templates/menu.php"; ?>
              <?php require "../vrijwilliger/site/views/templates/logo.php"; ?>

              <div id="core">

                   <div id="usersContainer">

                   </div>

                   <div id="usersData">

                   </div>

              </div>

            </div>

        </header>


       <?php// require "../vrijwilliger/site/views/templates/footer.php"; ?>

  </body>
