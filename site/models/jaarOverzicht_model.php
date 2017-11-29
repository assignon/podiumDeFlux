<?php
require "../vrijwilliger/site/core/model.php";

class jaarOverzicht extends model
{

      private $days_name = ['Zondag','Maandag','Dinsdag','Woensdag','Donderdag','Vrijdag','Zaterdag'];


        public function __construct()
        {

             parent::__construct();

        }


        public function getUser_data($user_id)
       {

           $select = $this->prepare("SELECT*FROM signin WHERE id=?",array($user_id));
           $data_fetch = $select->fetch();
           return $data_fetch;

       }


       public function getAllEvents()
       {


          ?>

             <script type="text/javascript">

                $(function(){

                   window.addEventListener("load",function(){

                     var xhr;

                     if (window.XMLHttpRequest) {
                          // code for IE7+, Firefox, Chrome, Opera, Safari
                           xhr = new XMLHttpRequest();
                         } else {
                          // code for IE6, IE5
                            xhr = new ActiveXObject("Microsoft.XMLHTTP");
                        }


                        var chooseYears = document.querySelector(".chooseYears");
                        var chooseMonths = document.querySelector(".chooseMonths");
                        var eventContainer = document.querySelector(".eventContainer");

                        chooseYears.addEventListener("change", currentYearEvt);
                        chooseMonths.addEventListener("change", currentMonthEvt);


                        function currentYearEvt()
                        {

                              var choosedYear = chooseYears.options[chooseYears.selectedIndex].textContent;

                              xhr.onreadystatechange = function() {
                                if (this.readyState == 4 && this.status == 200) {

                                         eventContainer.innerHTML = xhr.responseText;

                                         $(".evtMore").hide();

                                         $(".readAll").click(function(e){

                                              var readLess = e.target.parentNode;
                                              var readMore = e.target.parentNode.parentNode.childNodes[7];

                                              $(readLess).hide("slow");
                                              $(readMore).css("opacity","1");
                                              $(readMore).show("slow");



                                         })


                                         $(".lessRead").click(function(e){

                                              var readMore = e.target.parentNode;
                                              var readLess = e.target.parentNode.parentNode.childNodes[5];


                                              $(readLess).show("slow");
                                              $(readMore).css("opacity","0");
                                              $(readMore).hide("slow");


                                         })

                                     }

                                };


                               xhr.open('GET','../vrijwilliger/site/models/ajax_requests/allEvents/currentYearEvt.php?choosedYear='+choosedYear,true);
                               xhr.send();

                        }
                        currentYearEvt();



                        function currentMonthEvt()
                        {

                              var choosedMonth = chooseMonths.options[chooseMonths.selectedIndex].textContent;
                              var choosedYear = chooseYears.options[chooseYears.selectedIndex].textContent;


                              xhr.onreadystatechange = function() {

                                  if (this.readyState == 4 && this.status == 200) {

                                         eventContainer.innerHTML = xhr.responseText;

                                         $(".evtMore").hide();

                                         $(".readAll").click(function(e){

                                              var readLess = e.target.parentNode;
                                              var readMore = e.target.parentNode.parentNode.childNodes[7];

                                              $(readLess).hide("slow");
                                              $(readMore).css("opacity","1");
                                              $(readMore).show("slow");



                                         })


                                         $(".lessRead").click(function(e){

                                              var readMore = e.target.parentNode;
                                              var readLess = e.target.parentNode.parentNode.childNodes[5];


                                              $(readLess).show("slow");
                                              $(readMore).css("opacity","0");
                                              $(readMore).hide("slow");


                                         })

                                     }

                                };


                                xhr.open('GET','../vrijwilliger/site/models/ajax_requests/allEvents/currentMonthEvt.php?choosedMonth='+choosedMonth+'&choosedYear='+choosedYear,true);
                                xhr.send();

                        }



                   })

                })

             </script>

          <?php

       }



       public function agendas()
       {

         $month_name = ['Januari','Februari','Maart','April','Mei','Juni','Juli','Augustus','September','Oktober','November','December'];
         //private $days_name = ['Zondag','Maandag','Dinsdag','Woensdag','Donderdag','Vrijdag','Zaterdag'];

          $yearNow = date('Y');
          $monthNow = date('M');
          $dayNow = date('W');
          $date = new DateTime($yearNow.'-01-01');
          $calendar = array();


          while($date->format('Y') <= $yearNow)
          {

             $year = $date->format('Y');
             $month = $month_name[$date->format('n')-1];
             $days = $date->format('j');
             $weeks = str_replace(0,7, $this->days_name[$date->format('w')]);

             $calendar[$year][$month][$days] = $weeks;


             $date->add(new DateInterval('P1D'));



          }

          return $calendar;


       }



       public function getMonthIndex($months)
       {

             $index = 0;
             if($months == "Januari")
             {

                $index = 1;

             }else if($months == "Februari")
             {

                $index = 2;

             }else if($months == "Maart")
             {

                $index = 3;

             }else if($months == "April")
             {

                $index = 4;

             }else if($months == "Mei")
             {

                $index = 5;

             }else if($months == "Juni")
             {

                $index = 6;

             }else if($months == "Juli")
             {

                $index = 7;

             }else if($months == "Augustus")
             {

                $index = 8;

             }
             else if($months == "September")
             {

                $index = 9;

             }else if($months == "Oktober")
             {

                $index = 10;

             }else if($months == "November")
             {

                $index = 11;

             }else if($months == "December")
             {

                $index = 12;

             }


             return $index;

       }


       public function display_agendas()
       {

           //$test = 2400;

           $calendar = $this->agendas();

           $day = date('j');
           $date = new DateTime();
           //$date->sub(new DateInterval('P1D'));
           $monthNow = $date->format('n')-1;

           $currentDay = $date->format('j');
           $currentYear = date('Y');
         //  $currentDay = $date->sub(new DateInterval('P1D'));

           ?>

               <div class="day_name">

                 <?php

                  ?>

               </div>

           <?php

           foreach (current($calendar) as $months => $days) {

             $monthIndex = $this->getMonthIndex($months);

             ?>

               <div class="month">

                   <h3 class="monthName"><?php echo $months;?></h3>

                   <div class="daysOfWeek">

                        <li>Maa</li>
                        <li>Din</li>
                        <li>Woe</li>
                        <li>Don</li>
                        <li>Vri</li>
                        <li>Zat</li>
                        <li>Zon</li>


                   </div>

                   <div class="days">

                     <?php

                        foreach ($days as $day => $week) {

                            if($days < 10 AND $monthIndex < 10)
                            {

                               $evtDate =  $currentYear.'-'.'0'.$monthIndex.'-'.'0'.$day;

                            }else if($days < 10 AND $monthIndex >= 10){

                              $evtDate =  $currentYear.'-'.$monthIndex.'-'.'0'.$day;

                            }else if($days >= 10 AND $monthIndex < 10){

                              $evtDate =  $currentYear.'-'.'0'.$monthIndex.'-'.$day;

                            }else if($days >= 10 AND $monthIndex >= 10){

                              $evtDate =  $currentYear.'-'.$monthIndex.'-'.$day;

                            }


                            $getEvtColor = $this->prepare("SELECT * FROM events WHERE evt_date=?", array($evtDate));
                            $evtColor = $getEvtColor->fetch();
                            $displayEvtColor = $evtColor['evt_color'];

                            ?>

                                <div class="weeks" style="background-color:<?php echo $displayEvtColor;?>; border: 1px solid #030303;">

                                   <h4 class="<?php echo substr($week, 0,3);?>"><?php echo $day; ?></h4>

                                   <!--<h5><?php echo substr($week, 0,3);?></h5>-->

                                </div>

                            <?php

                        }

                      ?>

                   </div>

               </div>


               <script type="text/javascript">

                  window.addEventListener("load", function(){

                       var eventContainer = document.querySelector(".eventContainer");
                       var month = document.querySelectorAll(".month");
                       var weeks = document.querySelectorAll(".weeks");


                       var monthNow = "<?php echo $monthNow;?>";

                       var windowWidht = window.innerWidth;


                     for (var i = 0; i < month.length; i++) {

                           var monthArr = month[i];

                            eventContainer.appendChild(monthArr);


                       }



                       function calendar_order()
                       {

                            var days = document.querySelectorAll(".days");
                            var weeks = document.querySelectorAll(".weeks");

                            for (var i = 0; i < days.length; i++) {

                                var daysArr = days[i];
                                firstDay = daysArr.childNodes[1].childNodes[1].className;
                                //lastDay = daysArr.lastChild;
                                weeksArr = daysArr.childNodes[1];



                                    if(firstDay == "Din")
                                    {

                                       weeksArr.style.left = "47px";
                                       weeksArr.style.marginRight = "47px";

                                    }else if(firstDay == "Woe")
                                    {

                                        weeksArr.style.left = "94px";
                                        weeksArr.style.marginRight = "94px"

                                    }else if(firstDay == "Don")
                                    {

                                        weeksArr.style.left = "141px";
                                        weeksArr.style.marginRight = "141px"

                                    }else if(firstDay == "Vri")
                                    {

                                       weeksArr.style.left = "188px";
                                       weeksArr.style.marginRight = "188px"

                                    }else if(firstDay == "Zat")
                                    {

                                       weeksArr.style.left = "235px";
                                       weeksArr.style.marginRight = "235px"

                                    }else if(firstDay == "Zon")
                                    {

                                       weeksArr.style.left = "282px";
                                       weeksArr.style.marginRight = "270px"

                                    }


                            }


                       }
                       calendar_order();




   /*********************************date of now********************************************************/


                      /* for (var i = 0; i < weeks.length; i++) {

                           var weeksArr = weeks[i];
                           var days = weeksArr.childNodes[1];

                           if(days.textContent == "<?php echo $currentDay;?>")
                           {

                             days.parentNode.style.backgroundColor = "#F59C00";
                             days.parentNode.style.border = "1px solid #F59C00";
                             days.style.color = "white";

                           }

                       }*/

                  })

               </script>

             <?php


           }

       }


       public function getEvtInfo()
       {

         $date = date('Y');

           ?>

               <script type="text/javascript">

                  $(function(){

                        window.addEventListener("load", function(){

                              var weeks = document.querySelectorAll(".weeks");
                              for (var i = 0; i < weeks.length; i++) {

                                 var weeksArr = weeks[i];
                                 weeksArr.addEventListener("click",displayChoosedEvt);

                              }

                              var evtDate;


                              function displayChoosedEvt(e)
                              {

                                  month_name = ['','Januari','Februari','Maart','April','Mei','Juni','Juli','Augustus','September','Oktober','November','December'];
                                  var month;
                                  var day;

                                  if(e.target.className == "weeks")
                                  {

                                      day = e.target.childNodes[1].textContent;
                                      month = e.target.parentNode.parentNode.childNodes[1].textContent;

                                  }else{

                                      day = e.target.textContent;
                                      month = e.target.parentNode.parentNode.parentNode.childNodes[1].textContent;

                                  }

                                  evtDate = "<?php echo $date;?>"+'-'+month_name.indexOf(month)+'-'+day;

                                  displayEvent()

                              }


                              function showMore()
                              {

                                 var evtMore = document.querySelectorAll(".evtMore");
                                 for (var i = 0; i < evtMore.length; i++) {

                                     var evtMoreArr = evtMore[i];

                                     evtMoreArr.addEventListener("click", function(e){

                                       var currentMore = e.target;
                                       var currentLess = e.target.parentNode.childNodes[5];
                                       var evtDesc = e.target.parentNode.parentNode.childNodes[3];

                                       $(currentLess).show("slow");
                                       $(currentMore).hide("slow");
                                       $(evtDesc).show("slow");

                                     })


                                 }

                              }


                              function showLess()
                              {

                                var evtLess = document.querySelectorAll(".evtLess");
                                for (var i = 0; i < evtLess.length; i++) {

                                    var evtLessArr = evtLess[i];

                                    evtLessArr.addEventListener("click", function(e){

                                      var currentLess = e.target;
                                      var currentMore = e.target.parentNode.childNodes[3];
                                      var evtDesc = e.target.parentNode.parentNode.childNodes[3];

                                      $(currentLess).hide("slow");
                                      $(currentMore).show("slow");
                                      $(evtDesc).hide("slow");

                                    })


                                }

                              }


                              var xhr;

                              if (window.XMLHttpRequest) {
                                   // code for IE7+, Firefox, Chrome, Opera, Safari
                                    xhr = new XMLHttpRequest();
                                  } else {
                                   // code for IE6, IE5
                                     xhr = new ActiveXObject("Microsoft.XMLHTTP");
                                 }


                              function displayEvent()
                              {

                                var evtContentReceiver = document.querySelector(".evtContentReceiver");


                                xhr.onreadystatechange = function() {
                                  if (this.readyState == 4 && this.status == 200) {

                                       evtContentReceiver.innerHTML = xhr.responseText;

                                       var closeCalInfo = document.querySelector("#agendaInfo #closeCalInfo");


                                      // closeCalInfo.addEventListener("click", hideCalInfo);
                                       $(".evtLess").hide();
                                       $(".evtBody").hide();
                                       showMore();
                                       showLess();
                                       //getCurrentEvtInfo();


                                       var evtContainer = document.querySelectorAll(".evtContainer");
                                       var weeks = document.querySelectorAll(".weeks");



                                  };

                                }


                                 xhr.open('GET','../vrijwilliger/site/models/ajax_requests/allEvents/displayEvents.php?evtDate='+evtDate,true);
                                 xhr.send();



                              }


                              function evtColor()
                              {

                                 var weeks = document.querySelectorAll(".weeks");
                                 var month_name = ['','January','February','Maart','April','Mei','Juni','Juli','Augustus','Sptember','October','Novenber','December'];
                                 var chooseYears = document.querySelector(".chooseYears");
                                 var year;

                                 chooseYears.addEventListener("change", function(){

                                     year = chooseYears.value;

                                 })

                                 year = chooseYears.value;


                                 for (var i = 0; i < weeks.length; i++) {

                                     var weeksArr = weeks[i];
                                     var months = weeksArr.parentNode.parentNode.childNodes[1].textContent;
                                     months_number = month_name.indexOf(months);
                                     var days = weeksArr.childNodes[1].textContent;

                                     var dates = year+'-'+months_number+'-'+days;

                                     xhr.onreadystatechange = function() {
                                         if (this.readyState == 4 && this.status == 200) {

                                              weeksArr.style.backgroundColor = xhr.responseText;

                                         };

                                     }


                                      xhr.open('GET','../vrijwilliger/site/models/ajax_requests/allEvents/evtColor.php?dates='+dates,true);
                                      xhr.send();

                                 }



                              }
                            //  evtColor();

                        })

                  })

               </script>

           <?php

       }




}


?>
