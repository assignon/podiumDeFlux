<!DOCTYPE html>
<html>
    <head>
      <?php require "../vrijwilliger/site/views/templates/head.php"; ?>
      <link rel="stylesheet" href="../vrijwilliger/public/css/vrijwilligers.css"/>
      <script src="../vrijwilliger/public/js/vrijwilligers.js"></script>
      <title>Vrijwilligers</title>
    </head>
    <body>

        <header>

            <?php require "../vrijwilliger/site/views/templates/userSettings.php";?>
            <div id="container">

              <?php //require "../vrijwilliger/site/views/templates/users_data.php";?>

              <!--<div class="vrijwilligersBack">

                <div class="vrijwilligersBackImg">

                </div>

              </div>-->

              <div id="core">

                <div class="forms">


                    <form class="addNewEvt" action="" method="">

                      <img src="../vrijwilliger/public/media/menuIcon/svg/004-x-button.svg" alt="" id="closeAdd">
                      <p class="error">Voeg een nieuw evenement toe...</p>

                      <div class="dates">

                        <input type="text" name=""  placeholder="Datum" class"addEvtInput" id="evtDate" disabled>
                        <input type="text" name=""  placeholder="Datum" class"addEvtInput" id="evtDateAdmin" disabled>

                      </div>

                      <input type="text" name=""  placeholder="Evenement naam*" class"addEvtInput" id="newEvtName">

                      <div class="times">

                        <input type="text" name="" placeholder="Begin tijd*" class"addEvtInput" id="newEvtBtime">
                        <input type="text" name="" placeholder="Eind tijd*" class"addEvtInput" id="newEvtEtime">

                      </div>

                      <textarea name="" rows="8" cols="80" class"addEvtInput" placeholder="Evenement beschrijving..." id="newEvtDesc"></textarea>
                      <div class="colors">

                        <select name="" class="addEvtInput" id="newEvtColor">

                            <option>Kies een kleur</option>
                            <option value="green">Groen</option>
                            <option value="red">Rood</option>
                            <option value="yellow">Geel</option>
                            <option value="violet">Paars</option>
                            <option value="blue">Blauw</option>
                            <option value="aqua">Aqua</option>
                            <option value="orange">Oranje</option>
                            <option value="azure">Azuur</option>
                            <option value="whitesmoke">Wite rool</option>
                            <option value="crimson">karmozijn</option>
                            <option value="magenta">Magenta</option>
                            <option value="pinl">Roze</option>

                        </select>

                      </div>
                      <input type="submit" name="" value="Toevoegen" id="addEvt">

                    </form>


                    <form class="updateCurrentEvt" action="" method="">

                        <img src="../vrijwilliger/public/media/menuIcon/svg/004-x-button.svg" alt="" id="closeUpd">
                        <p class="error">Pas aan...</p>

                        <input type="text" name=""  placeholder="Datum" class"updateEvtForm" id="updtEVt" disabled>

                        <input type="text" name=""  placeholder="Evenement naam" class"updateEvtForm" id="updtEvtName">
                        <input type="text" name=""  placeholder="" class"updateEvtForm" id="updtEvtCloneName" disabled style="opacity: 0; margin-bottom:-39px; z-index: 0;">
                        <div class="times" style="z-index: 2;">

                          <input type="text" name="" placeholder="Begin tijd" class"updateEvtForm" id="updtEvtBtime">
                          <input type="text" name="" placeholder="Eind tijd" class"updateEvtForm" id="updtEvtEtime">

                        </div>

                        <textarea name="" rows="8" cols="80" class"updateEvtForm" placeholder="Evenement beschrijving..." id="updtDesc"></textarea>
                        <div class="colors">

                             <select name="" class="addEvtInput" id="updtColor">

                                 <option>Kies een kleur</option>
                                 <option value="green">Groen</option>
                                 <option value="red">Rood</option>
                                 <option value="yellow">Geel</option>
                                 <option value="violet">Paars</option>
                                 <option value="blue">Blauw</option>
                                 <option value="aqua">Aqua</option>
                                 <option value="orange">Oranje</option>
                                 <option value="azure">Azuur</option>
                                 <option value="whitesmoke">Wite rool</option>
                                 <option value="crimson">karmozijn</option>
                                 <option value="magenta">Magenta</option>
                                 <option value="pinl">Roze</option>

                             </select>


                        </div>
                        <input type="submit" name="" value="Aanpassen" id="updateEvt">

                    </form>


                    <form class="deleteCurrentEvt" action="" method="">

                       <img src="../vrijwilliger/public/media/menuIcon/svg/004-x-button.svg" alt="" id="closeDel">
                       <p class="error">Voer je wachtwoord in om te verwijderen...</p>
                       <input type="password" name="" placeholder="Wachtwoord" id='sUserPass'>
                       <input type="submit" name="" value="Delete" id="deleteEvt">

                    </form>

                </div>


                <!--<div id="mobileAgenda">

                  <img src="../vrijwilliger/public/media/menuIcon/svg/004-x-button.svg" alt="" id="closeMobileAgenda">

                  <div id="mobileAgendaContentContainer">

                    <div id="mobileMonthControles">

                       <div class="arrowContainer">

                         <img src="../vrijwilliger/public/media/menuIcon/svg/001-angle-arrow-down.svg" alt="" id="mobileArrowBottom">

                       </div>
                       <h3><?php //echo date('Y');?></h3>
                       <div class="arrowContainer">

                          <img src="../vrijwilliger/public/media/menuIcon/svg/002-up-arrow.svg" alt="" id="mobileArrowTop">

                       </div>

                    </div>

                    <div id="mobileAgendaContent">

                    </div>


                  </div>


                  <div id="mobileAgendaInfo">



                  </div>

                </div>-->


                <?php require "../vrijwilliger/site/views/templates/menu.php"; ?>
                <?php require "../vrijwilliger/site/views/templates/logo.php"; ?>


                <div id="contentContainer">


                        <div id="content">

                           <img src="../vrijwilliger/public/media/flux_2017-2326.jpg" alt="" id="bckImg">

                            <div class="welcomText">

                                <h1>Hoi, welkom op de vrijwilligerspagina!</h1>

                                <p>

                                  Hier vind je alle informatie die je graag wil
                                  weten overzichtelijk op een rij. Als je nog vragen hebt
                                  kan je altijd even bellen of gewoon langskomen natuurlijk.

                                </p>

                                <p>Groetjes!</p>

                                <h2>Kantoor: 075-615 4832</h2>
                                <h2>Vrijwilligerscoördinator, Stephanie: 06- 25 108 305</h2>

                            </div>

                        </div>

                        <div class="calendarContainer">

                              <div id="agenda">

                                    <div id="agendaInfo">



                                    </div>


                                    <div id="agendaContentContainer">

                                      <div id="monthControles">

                                         <div class="arrowContainer">


                                           <img src="../vrijwilliger/public/media/menuIcon/svg/002-left-arrow.svg" alt="" id="arrowLeft">
                                           <!--<p id="prevMonth">Mei</p>-->

                                         </div>
                                         <h3><?php echo date('Y');?></h3>
                                         <div class="arrowContainer">

                                            <img src="../vrijwilliger/public/media/menuIcon/svg/001-right-arrow.svg" alt="" id="arrowRight">
                                            <!--<p id="nextMonth">Juli</p>-->

                                         </div>

                                      </div>


                                      <div id="agendaContent">

                                      </div>


                                    </div>

                              </div>

                        </div>


                </div>

              </div>

            </div>

        </header>


          <?php //require "../vrijwilliger/site/views/templates/footer.php"; ?>


    </body>

</html>
