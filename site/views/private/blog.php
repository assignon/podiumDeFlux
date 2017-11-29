<!DOCTYPE html>
<html>
    <head>
      <?php require "../vrijwilliger/site/views/templates/head.php"; ?>
      <link rel="stylesheet" href="../vrijwilliger/public/css/blog.css"/>
    <!--  <link rel="stylesheet" href="../reachoutNL/public/css/font.css"/>-->
    <script src="../vrijwilliger/public/js/blog.js"></script>
    <!--<script src="../vrijwilliger/public/js/ckeditor/ckeditor.js"></script>
    <script src="../vrijwilliger/public/js/ckeditor/adapters/jquery.js"></script>-->
    <script src="../vrijwilliger/site/libs/ckeditor/ckeditor.js"></script>
    <script src="../vrijwilliger/site/libs/ckeditor/adapters/jquery.js"></script>
      <title>Vrijwilligers</title>
    </head>
    <body>

        <header>

            <div class="blog_container">

              <?php require "../vrijwilliger/site/views/templates/userSettings.php";?>

              <?php //require "../vrijwilliger/site/views/templates/users_data.php";?>

              <div class="editModus">


                <div class="editBack">

                </div>

                <form class="editForm" action="" method="" enctype="multipart/form-data">

                  <img src="../vrijwilliger/public/media/menuIcon/svg/004-x-button.svg" alt="" id="closeEditForm">

                  <p class="error">Vul de velden om een nieuw artikel toe te voegen...</p>

                  <div class="formGlobalContainer">

                    <div class="inputsOptions">

                      <div id="inputs">


                        <div class="inputsContainer">

                          <label for="">Titel</label>
                          <input type="text" name="" class="blogInput" id="addBlogName">
                          <input type="text" name="" id="update_blog_name">

                        </div>

                        <div class="inputsContainer">

                          <label for="">Uitgelicht afbeelding</label>
                          <input type="file" name="featuredImg" id="featuredImg">

                        </div>

                        <!--<label for="">Tussen kopje(niet verplicht)</label>
                        <input type="text" name="" class="blogInput">-->



                      </div>


                      <!--<div id="meerOptions">-->

                        <!--<button id="newLine">Nieuw lijne</button>-->

                        <!--<label for="">Voeg een andere tussen kopje toe</label>-->
                        <!--<p>Extra functionnaliteiten.</p>-->
                        <!--<input type="text" name="" class="options" placeholder="Voeg een andere tussen kopje toe">-->

                        <!--<label for="">Voeg een link toe</label>-->
                        <!--<input type="text" name="" class="options" placeholder="Voer de naam van de link in">
                        <input type="text" name="link_addres" class="options" placeholder="Voer de addres van de link in">

                        <label for="">Voeg afbeelding toe</label>
                        <input type="file" name="newImage" id="newImage">

                        <button id="addExtraOptions">Toevoegen</button>-->

                    <!--  </div>-->

                    </div>

                    <!--<label for="">Artikel</label>-->
                    <div class="areas">

                      <div class="addTexArea">

                        <textarea name="" rows="8" cols="80" class="blogInput" id="blogsContent" placeholder="schrijf de inhoud van het artikel hier"></textarea>

                      </div>

                      <div id="textAreas">



                      </div>

                    </div>

                    <input type="submit" name="" value="Voeg het artikel toe" id="addBlog">
                    <input type="submit" name="" value="pas het artikel aan" id="UpdateBlogs">

                  </div>



                </form>

              </div>

              <form class="deleteCurrentBlog" action="" method="">

                 <img src="../vrijwilliger/public/media/menuIcon/svg/004-x-button.svg" alt="" id="closeDeleteForm">
                 <p class="error">Voer je wachtwoord in om te verwijderen...</p>
                 <input type="password" name="" placeholder="Wachtwoord" id='sUserPass'>
                 <input type="submit" name="" value="Delete" id="deleteCurentBlog">

              </form>

              <?php require "../vrijwilliger/site/views/templates/menu.php"; ?>
              <?php require "../vrijwilliger/site/views/templates/logo.php"; ?>

              <div id="core">



              </div>

            </div>

        </header>


            <?php //require "../vrijwilliger/site/views/templates/footer.php"; ?>

    </body>


</html>
