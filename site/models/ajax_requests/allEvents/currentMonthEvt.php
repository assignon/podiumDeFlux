<?php

    require "../pdo_connection.php";

    $pdo = pdo();

    $choosedYear = htmlentities(htmlspecialchars($_GET['choosedYear']));
    $choosedMonth = htmlentities(htmlspecialchars($_GET['choosedMonth']));

    $getEvents = $pdo->prepare("SELECT DATE_FORMAT(evt_date, '%d/%m/%Y') AS evtdate, evt_name, begin_time, end_time, evt_description, evt_color FROM events WHERE year=? AND month=?");
    $getEvents->execute(array($choosedYear, $choosedMonth));

    $evtsCount = $getEvents->rowCount();

    ?>

       <h3>Evenementen in de maand van <?php echo ' '.strtoupper($choosedMonth).' '.$choosedYear;?></h3>
       <hr/>

    <?php

    if($evtsCount > 0)
    {

        while($displayEvts = $getEvents->fetch())
        {

           ?>

              <div class="currentDateMonthContainer">


                 <div class="currentDateMonth">

                    <h4><?php echo $displayEvts['evtdate'];?></h4>
                    <h3><?php echo $displayEvts['evt_name'];?></h3>
                    <p class="evtLess">

                      <?php

                        echo substr($displayEvts['evt_description'], 0, 70)."..."."<span class='readAll'>Lees verder</span>";

                       ?>

                    </p>
                    <p class="evtMore">

                      <?php

                        echo $displayEvts['evt_description']."<span class='lessRead'>Lees minder</span>";

                       ?>

                    </p>
                    <h4><?php echo $displayEvts['begin_time'];?></h4>
                    <h4><?php echo $displayEvts['end_time'];?></h4>

                 </div>

              </div>

              <hr/>

           <?php

        }

    }else{

       ?>

          <h2>Er is(zijn) geen evenement(en) in de maand van<?php echo ' '.strtoupper($choosedMonth).' '.$choosedYear;?></h2>

       <?php

    }



 ?>
