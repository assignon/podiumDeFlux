<!DOCTYPE html>
<html>
    <head>
      <?php require "../vrijwilliger/site/views/templates/head.php"; ?>
      <link rel="stylesheet" href="../vrijwilliger/public/css/jaarOverzicht.css"/>
    <!--  <link rel="stylesheet" href="../reachoutNL/public/css/font.css"/>-->
    <script src="../vrijwilliger/public/js/jaarOverzicht.js"></script>
    <script src="../vrijwilliger/public/js/ckeditor/ckeditor.js"></script>
    <script src="../vrijwilliger/public/js/ckeditor/adapters/jquery.js"></script>
      <title>Vrijwilligers</title>
    </head>
    <body>

        <header>

           <?php require "../vrijwilliger/site/views/templates/userSettings.php";?>

           <div id="core">

             <?php require "../vrijwilliger/site/views/templates/menu.php"; ?>
             <?php require "../vrijwilliger/site/views/templates/logo.php"; ?>

             <div class="overzichtContainer">

                  <h1>Het jaar overzicht</h1>
                  <hr/>

                  <?php

                      $month_name = ['Januari','Februari','Maart','April','Mei','Juni','Juli','Augustus','September','Oktober','November','December'];
                      $current_Month = substr(date("m"), 1,1);

                   ?>

                   <h1 id="curentYear"><?php echo $yearNow = date('Y');?></h1>

                  <div class="yearMonth">

                      <!--<select class="chooseYears" name="">

                        <option value="<?php echo $yearNow = date('Y');?>"><?php echo $yearNow = date('Y');?></option>

                      </select>-->


                      <!--<select class="chooseMonths" name="">

                        <option>Huidig mand:<?php //echo ' '.$month_name[$current_Month-1];?></option>

                         <?php

                            //$monthLen = count($month_name);

                          //  for ($i=0; $i < $monthLen; $i++)
                            {

                               ?>

                                  <option value="<?php //echo $monthLen[$i];?>"><?php echo $month_name[$i];?></option>

                               <?php

                            }

                          ?>

                      </select>-->



                  </div>

                  <hr/>

                  <div class="evtsContainer">

                        <div class="eventContainer">

                        </div>

                        <div class="evtsContent">

                            <img src="../vrijwilliger/public/media/menuIcon/svg/004-x-button.svg" alt="" id="closeEvtContent">

                            <div class="evtContentReceiver">

                            </div>

                        </div>

                  </div>

             </div>

           </div>

        </header>

    </body>

</html>
