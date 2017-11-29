<!DOCTYPE html>
<html>
    <head>
      <?php require "../vrijwilliger/site/views/templates/head.php"; ?>
      <link rel="stylesheet" href="../vrijwilliger/public/css/tabblad.css"/>
    <!--  <link rel="stylesheet" href="../reachoutNL/public/css/font.css"/>-->
    <script src="../vrijwilliger/site/libs/ckeditor/ckeditor.js"></script>
    <!--<script src="//cdn.ckeditor.com/4.7.3/full/ckeditor.js"></script>-->
    <script src="../vrijwilliger/site/libs/ckeditor/adapters/jquery.js"></script>
      <script src="../vrijwilliger/public/js/tabblad.js"></script>
      <title>Vrijwilligers</title>
    </head>
    <body>

        <header>

            <?php //require "../vrijwilliger/site/views/templates/users_data.php"; ?>
            <?php require "../vrijwilliger/site/views/templates/userSettings.php";?>

            <div class="tabContainer">

                  <form class="tabsFormContainer" action="" method="" enctype="multipart/form-data">

                     <div class="tabsBack">

                     </div>

                     <div class="tabsFront">

                       <img src="../vrijwilliger/public/media/menuIcon/svg/004-x-button.svg" alt="" id="closeTabsForm">

                       <p class="error"></p>

                       <input type="text" name="" placeholder="Tabblad naam" id="newTab">
                       <input type="text" name="" placeholder="PDF naam" id="pdf_name">
                       <div class="pdfsUpdate">

                           <input type="text" name="" id="pdf_nameUpdate" placeholder="PDF naam">
                           <select class="pdfsName" name="">

                              <option>Selecteer een pdf</option>
                              <?php

                                 $tabblad->displayAllPdfs();

                               ?>

                           </select>

                       </div>
                       <label for="pdf" id="labelPdf">Upload een pdf</label>
                       <input type="file" name="pdf" placeholder="Upload een PDF document" id="pdf">

                       <select id="allTabs" name="">

                           <option>Selecteer de tabblad die aangepast moet worden</option>
                           <?php

                               $tabblad->displayAllTabs();

                            ?>

                       </select>


                      <!--  <textarea name="" rows="8" cols="80" id="updateContent" placeholder=""></textarea>-->

                       <div class="addTextArea">

                           <textarea name="" rows="8" cols="80" id="tabContent" placeholder=""></textarea>

                       </div>

                       <div class="updateTextArea">

                       </div>
                       <input type="password" name="" id="tabPass" placeholder="Wachtwoord">

                       <input type="submit" name="" value="Toevoegen" id="addTabs">
                       <input type="submit" name="" value="Aanpassen" id="updateTabs">
                       <input type="submit" name="" value="Verwijderen" id="deleteTabs">

                      </div>


                  </form>

                  <?php require "../vrijwilliger/site/views/templates/menu.php"; ?>

                  <?php require "../vrijwilliger/site/views/templates/logo.php"; ?>

                  <div class="tabblads">

                    <select name="">

                        <option>Selecteer een andere tabblad</option>
                        <?php

                            $tabblad->displayAllTabs();

                         ?>

                    </select>

                    <button id="pdfMobile">PDF'S</button>

                  </div>

                  <div id="core">

                     <div class="tabCore">

                     </div>


                     <div class="pdfsContainer">

                         <img src="../vrijwilliger/public/media/menuIcon/svg/004-x-button.svg" alt="" id="closePdfContainer">

                     </div>

                  </div>

            </div>

        </header>

        <?php //require "../vrijwilliger/site/views/templates/footer.php"; ?>

   </body>

</html>
