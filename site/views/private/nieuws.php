<!DOCTYPE html>
<html>
    <head>
      <?php require "../vrijwilliger/site/views/templates/head.php"; ?>
      <link rel="stylesheet" href="../vrijwilliger/public/css/nieuws.css"/>
    <!--  <link rel="stylesheet" href="../reachoutNL/public/css/font.css"/>-->
      <script src="../vrijwilliger/public/js/nieuws.js"></script>
      <title>Vrijwilligers</title>
    </head>
    <body>

        <header>

          <div id="nieuwsContainer">

            <?php require "../vrijwilliger/site/views/templates/userSettings.php";?>

              <?php require "../vrijwilliger/site/views/templates/menu.php"; ?>

                <?php require "../vrijwilliger/site/views/templates/logo.php"; ?>

                <div class="allBlogContainer">

                  <img src="../vrijwilliger/public/media/menuIcon/svg/004-x-button.svg" alt="" id="closeAllBlog">

                  <div id="allBlogs">

                  </div>

                </div>

              <div id="core">

                  <div class="contentsBlogs">

                     <button id="displayAllBlogs"><img src="../vrijwilliger/public/media/blog_images/allBlogs.svg" alt="">ALL BLOGS WEERGEVEN</button>

                      <div id="nieuwsContent">

                      </div>

                  </div>


                  <div id="reactions">

                    <p id="writeComment">Schrijf een reactie...</p>
                    <hr/>

                     <form id="reactionForm" action="" method="">

                        <textarea name="" rows="8" cols="80" id="reactionText" placeholder="Schrijf je reactie hierin..."></textarea>
                        <input type="submit" name="" value="Reactie plaatsen" id="postReaction">

                     </form>

                     <p id="comments">Reacties</p>
                     <hr class="separator2"/>

                     <div id="allcomments">

                     </div>

                  </div>

              </div>

          </div>

        </header>


           <?php //require "../vrijwilliger/site/views/templates/footer.php"; ?>

    </body>

</html>
