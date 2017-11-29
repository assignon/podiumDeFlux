<?php

   require "../pdo_connection.php";

   $pdo = pdo();
   $evtDate = htmlentities(htmlspecialchars($_GET['evtDate']));

   $selectEvents = $pdo->prepare("SELECT DATE_FORMAT(evt_date, '%d/%m/%Y') AS evtdate, evt_name, begin_time, end_time, evt_description, evt_color FROM events WHERE evt_date=?");
   $selectEvents->execute(array($evtDate));

   $eventsCount = $selectEvents->rowCount();

   if($eventsCount > 0)
   {
     ?>

        <img src="../vrijwilliger/public/media/menuIcon/svg/004-x-button.svg" alt="" id="closeCalInfo">

     <?php
     while($displayEvt = $selectEvents->fetch())
     {

        ?>

           <div class="evtContainer <?php echo $displayEvt['evt_color'];?>" style="background-color: #030303">

              <div class="evtHead">

                  <h3 class="<?php echo ucfirst($displayEvt['evt_color']);?>"><?php echo ucfirst($displayEvt['evt_name']);?></h3>
                  <img  src="../vrijwilliger/public/media/menuIcon/svg/001-angle-arrow-down.svg" alt="" class="evtMore">
                  <img  src="../vrijwilliger/public/media/menuIcon/svg/002-up-arrow.svg" alt="" class="evtLess">
                  <img  src="../vrijwilliger/public/media/menuIcon/svg/004-bar-chart-reload.svg" alt="" class="evtUpdate">
                  <img  src="../vrijwilliger/public/media/menuIcon/svg/003-rubbish.svg" alt="" class="evtDel">

              </div>

               <p class="evtBody"><?php echo $displayEvt['evt_description'];?></p>


              <div class="evtFoot">

                <p>Datum:<?php echo ' '.$displayEvt['evtdate'];?></p>
                <p>Begin-tijd:<?php echo ' '.$displayEvt['begin_time'];?></p>
                <p>Eind-tijd:<?php echo ' '.$displayEvt['end_time'];?></p>

              </div>

           </div>

        <?php

     }

   }else{

     ?>
        <img src="../vrijwilliger/public/media/images/close.svg" alt="" id="closeCalInfo" style="margin-top: 200px; position: relative; bottom: 180px;">
        <h3 class="noEvts">Geen evenement gepland...</h3>

     <?php

   }



 ?>
