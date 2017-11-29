<?php

     require "../vrijwilliger/site/core/model.php";

     class vrijwilligers extends model
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


          public function agenda()
          {

            $month_name = ['Januari','Februari','Maart','April','Mei','Juni','Juli','Augustus','September','Oktober','November','December'];
            //private $days_name = ['Zondag','Maandag','Dinsdag','Woensdag','Donderdag','Vrijdag','Zaterdag'];
             $setYear = '2018';
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


             ?>

                 <script type="text/javascript">

                  /*  $(function(){

                        window.addEventListener("load", function(){

                          var nexteYear = document.getElementById("nextYear");
                          var previousYear = document.getElementById("prevYear");


                          nexteYear.addEventListener("click", nexteYear);
                          previousYear.addEventListener("click", previousYear);


                          function nexteYear()
                          {

                            "<?php
                                 $currentDate  = new DateTime($yearNow);
                                 $currentDate->add(new DateInterval('P1Y'));
                                 $displayDate = $currentDate->format('Y');
                              ?>"

                          }


                        })

                    })*/

                 </script>

             <?php


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


          public function display_agenda()
          {

              //$test = 2400;

              $calendar = $this->agenda();

              $day = date('j');
              $date = new DateTime();
              //$date->sub(new DateInterval('P1D'));
              $monthNow = $date->format('n')-1;

              $currentDay = $date->format('j');
              $currentYear = date('Y');
              $currentDate  = new DateTime($currentYear);

            //  $currentDay = $date->sub(new DateInterval('P1D'));

              ?>

                  <div class="day_name">

                    <?php

                    /*    foreach ($this->days_name as $day_name) {

                           ?>

                              <h3><?php echo $day_name;?></h3>

                           <?php

                        }*/

                     ?>

                  </div>

              <?php

               $month_name = ['','Januari','Februari','Maart','April','Mei','Juni','Juli','Augustus','September','Oktober','November','December'];
              foreach (current($calendar) as $months => $days) {

                $monthIndex = $this->getMonthIndex($months);

                ?>

                  <div class="month">

                      <h3 class="monthName"><?php echo $months;?></h3>


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


                                  // echo $displatEvtColor['evt_color'].'=>'.$displatEvtColor['evt_date'].'</br>';


                                   ?>

                                       <div class="weeks" id="<?php echo $evtDate;?>" style="background-color:<?php echo $displayEvtColor;?>; border: 1px solid <?php echo $displayEvtColor;?>;">


                                          <h4><?php echo $day; ?></h4>

                                           <div class="controle">

                                             <img src="../vrijwilliger/public/media/menuIcon/svg/003-rubbish.svg" alt="" class="delete_cal">
                                             <img src="../vrijwilliger/public/media/menuIcon/svg/004-bar-chart-reload.svg" alt="" class="update_cal">
                                             <img src="../vrijwilliger/public/media/menuIcon/svg/001-add-button.svg" alt="" class="add_cal">

                                           </div>

                                          <h5><?php echo substr($week, 0,3);?></h5>

                                       </div>

                                   <?php

                             }

                           ?>

                        </div>


                  </div>


                  <script type="text/javascript">

                     window.addEventListener("load", function(){

                          var agendaContent = document.getElementById("agendaContent");
                          //var mobileAgendaContent = document.getElementById("mobileAgendaContent");
                          var month = document.querySelectorAll(".month");
                          var weeks = document.querySelectorAll(".weeks");

                          var arrowLeft = document.getElementById("arrowLeft");
                          var arrowRight = document.getElementById("arrowRight");


                          var monthNow = "<?php echo $monthNow;?>";

                          var windowWidht = window.innerWidth;


                        for (var i = 0; i < month.length; i++) {

                              var monthArr = month[i];

                               agendaContent.appendChild(monthArr);


                          }

                          var increase = "<?php echo $monthNow;?>";
                          var constantVal = 520;
                          var increment = increase*constantVal;

                          agendaContent.style.right = increment+"px";

                          arrowLeft.addEventListener("click", previousMonth);
                          arrowRight.addEventListener("click", nextMonth);



                          function calendar_order()
                          {

                               var days = document.querySelectorAll(".days");
                               var weeks = document.querySelectorAll(".weeks");

                               for (var i = 0; i < days.length; i++) {

                                   var daysArr = days[i];
                                   firstDay = daysArr.childNodes[1].childNodes[5].textContent;
                                   lastDay = daysArr.lastChild;
                                   weeksArr = daysArr.childNodes[1];



                                       if(firstDay == "Din")
                                       {

                                          weeksArr.style.left = "69px";
                                          weeksArr.style.marginRight = "75px";

                                       }else if(firstDay == "Woe")
                                       {

                                           weeksArr.style.left = "136px";
                                           weeksArr.style.marginRight = "142px"

                                       }else if(firstDay == "Don")
                                       {

                                           weeksArr.style.left = "205px";
                                           weeksArr.style.marginRight = "210px"

                                       }else if(firstDay == "Vri")
                                       {

                                          weeksArr.style.left = "275px";
                                          weeksArr.style.marginRight = "280px"

                                       }else if(firstDay == "Zat")
                                       {

                                          weeksArr.style.left = "345px";
                                          weeksArr.style.marginRight = "350px"

                                       }else if(firstDay == "Zon")
                                       {

                                          weeksArr.style.left = "415px";
                                          weeksArr.style.marginRight = "450px"

                                       }




                                      /* if(firstDay == "Zat" && )
                                       {

                                          weeksArr.style.left = "345px";
                                          weeksArr.style.marginRight = "350px"

                                       }else if(firstDay == "Zon")
                                       {

                                          weeksArr.style.left = "415px";
                                          weeksArr.style.marginRight = "450px"

                                       }*/


                               }


                          }
                          calendar_order();


                          function nextMonth()
                          {

                                agendaContent.style.transition = "right 1.0s linear 0s";
                                agendaContent.style.right = increase*constantVal+"px";



                                 if(increase < 11){

                                  increase++;
                                //  $(arrowTop).show();

                              }else

                                     increase = 0;

                              // console.log("top:"+increase+' '+increment);

                          }




                          function previousMonth()
                          {

                            if(increase >0)
                            {

                              increase--;
                            //  $(arrowBottom).show();


                          }else if(increase <= 0){

                              increase = 11;
                            //  $(arrowBottom).hide();

                          }

                            agendaContent.style.transition = "right 1.0s linear 0s";
                            agendaContent.style.right = increase*constantVal+"px";

                          }


      /*********************************date of now********************************************************/


                          for (var i = 0; i < weeks.length; i++) {

                              var weeksArr = weeks[i];
                              var days = weeksArr.childNodes[1];

                              if(days.textContent == "<?php echo $currentDay;?>")
                              {

                                days.parentNode.style.backgroundColor = "#F59C00";
                                days.parentNode.style.border = "1px solid #F59C00";
                                days.style.color = "white";

                              }



                          }


                          function weeksID()
                          {

                                var month_name = ['','Januari','Februari','Maart','April','Mei','Juni','Juli','Augustus','September','Oktober','November','December'];
                                var month = "<?php echo $months;?>";
                                var days = "<?php echo $day;?>";


                                //var monthCont = weeksArr.parentNode.parentNode.className;

                                var evtDate;

                                if(days < 10 && month_name.indexOf(month) < 10)
                                {

                                   evtDate = '<?php echo $currentYear;?>'+'-'+'0'+month_name.indexOf(month)+'-'+'0'+days;

                                }else if(days < 10 && month_name.indexOf(month) >= 10){

                                  evtDate = '<?php echo $currentYear;?>'+'-'+month_name.indexOf(month)+'-'+'0'+days;

                                }else if(days >= 10 && month_name.indexOf(month) < 10){

                                  evtDate = '<?php echo $currentYear;?>'+'-'+'0'+month_name.indexOf(month)+'-'+days;

                                }else if(days >= 10 && month_name.indexOf(month) >= 10){

                                  evtDate = '<?php echo $currentYear;?>'+'-'+month_name.indexOf(month)+'-'+days;

                                }

                                return evtDate;

                          }


                          var nextYear = document.getElementById("nextYear");
                          var prevYear = document.getElementById("prevYear");



                     })

                  </script>

                <?php


              }

          }


          public function showCalAction()
          {

            ?>

              <script type="text/javascript">

              $(function(){

                 window.addEventListener("load", function(){

                     var menu = document.querySelectorAll(".menu");

                    /* for (var i = 0; i < menu.length; i++) {

                         var menuArr = menu[i];
                         menuArr.addEventListener("click", showCalAction);

                     }*/

                     menu[0].addEventListener("click", showCalAction);


                     function showCalAction(e){

                        menuID = e.target.parentNode.id;

                        var actionsClassName = document.querySelectorAll('.'+menuID+'_cal');

                        var controle = document.querySelectorAll(".controle");

                        for (var i = 0; i < controle.length; i++) {

                            var controleArr = controle[i];
                            controleArr.style.display = "flex";

                        }




                        for (var i = 0; i < actionsClassName.length; i++) {

                            var actionsClassNameArr = actionsClassName[i];

                          //  var deletecal = actionsClassNameArr.parentNode.childNodes[1];
                          //  var updatecal = actionsClassNameArr.parentNode.childNodes[3];
                            var addcal = actionsClassNameArr.parentNode.childNodes[5];

                          //  calActionZindex(menuID, deletecal, updatecal, addcal);

                            addcal.style.opacity = "1";
                            addcal.style.zIndex = "2";
                            $(addcal).show();

                            /*actionsClassNameArr.style.opacity = "1";
                            actionsClassNameArr.style.zIndex = "2";
                            $(actionsClassNameArr).show();*/

                        }



                     }




                     function calActionZindex(menuID, deletecal, updatecal, addcal)
                     {


                              if(menuID == "add")
                              {

                                $(deletecal).hide();
                                $(updatecal).hide();


                              }else if(menuID == "update")
                              {

                                $(deletecal).hide();
                                $(addcal).hide();

                              }else if(menuID == "delete"){

                                $(addcal).hide();
                                $(updatecal).hide();

                              }


                     }



                 })

              })

              </script>

            <?php

          }


          public function getCurrentDate()
          {

               $date = date('Y');

              ?>

                 <script type="text/javascript">

                   window.addEventListener("load", function()
                  {

                      var addCalendar = document.querySelectorAll(".add_cal");
                      var addEvtInput = document.querySelector("#evtDate");
                      var evtDateAdmin = document.querySelector("#evtDateAdmin");
                      var month_name = ['','Januari','Februari','Maart','April','Mei','Juni','Juli','Augustus','September','Oktober','November','December'];

                      for (var i = 0; i < addCalendar.length; i++) {

                         var addCalendarArr = addCalendar[i];

                         addCalendarArr.addEventListener("click", function(e){

                            var month = e.target.parentNode.parentNode.parentNode.parentNode.childNodes[1].textContent;
                            var day = e.target.parentNode.parentNode.childNodes[1].textContent;
                            //alert(month_name.indexOf(month));
                            if(day < 10 && month_name.indexOf(month) < 10)
                            {

                              evtDateAdmin.value = '0'+day+'-'+'0'+month_name.indexOf(month)+'-'+'<?php echo $date;?>';
                              addEvtInput.value = '<?php echo $date;?>'+'-'+'0'+month_name.indexOf(month)+'-'+'0'+day;

                            }else if(day < 10 && month_name.indexOf(month) >= 10){

                              evtDateAdmin.value = '0'+day+'-'+month_name.indexOf(month)+'-'+'<?php echo $date;?>';
                              addEvtInput.value = '<?php echo $date;?>'+'-'+month_name.indexOf(month)+'-'+'0'+day;

                            }else if(day >= 10 && month_name.indexOf(month) < 10){

                              evtDateAdmin.value = day+'-'+'0'+month_name.indexOf(month)+'-'+'<?php echo $date;?>';
                              addEvtInput.value = '<?php echo $date;?>'+'-'+'0'+month_name.indexOf(month)+'-'+day;

                            }else if(day >= 10 && month_name.indexOf(month) >= 10){

                              evtDateAdmin.value = day+'-'+month_name.indexOf(month)+'-'+'<?php echo $date;?>';
                              addEvtInput.value = '<?php echo $date;?>'+'-'+month_name.indexOf(month)+'-'+day;

                            }



                         })

                      }




                  })

                 </script>

              <?php

          }




          public function addEvent()
          {

              $date = date('Y');

              ?>

                  <script type="text/javascript">

                    $(function(){

                      window.addEventListener("load",function()
                      {


                         var addEvt = document.querySelector("#addEvt");

                         var error = document.querySelector(".addNewEvt .error");
                         var xhr;


                         if (window.XMLHttpRequest) {
                              // code for IE7+, Firefox, Chrome, Opera, Safari
                               xhr = new XMLHttpRequest();
                             } else {
                              // code for IE6, IE5
                                xhr = new ActiveXObject("Microsoft.XMLHTTP");
                            }



                            function closeAddEvtForm()
                            {

                                //var controle = document.querySelectorAll(".controle");
                                var addNewEvt = document.querySelector(".addNewEvt");

                                  $(addNewEvt).animate({

                                     top: 0,

                                  },{

                                    duration: 700,
                                    easing: "easeInOutBack",

                                  })


                            }


                         addEvt.addEventListener("click", addEvent);


                         function addEvent(e)
                         {

                                e.preventDefault();

                                var addEvtDate = document.getElementById("evtDate");
                                var addEvtName = document.querySelector("#newEvtName");
                                var addEvtBtime = document.querySelector("#newEvtBtime");
                                var addEvtEtime = document.querySelector("#newEvtEtime");
                                var addEvtColor = document.querySelector("#newEvtColor");
                                var addEvtDesc = document.getElementById("newEvtDesc");

                                 var evtDate = addEvtDate.value;
                                 var evtName = addEvtName.value;
                                 var evtBtime = addEvtBtime.value;
                                 var evtEtime = addEvtEtime.value;
                                 var evtInfo = addEvtDesc.value;
                                 var evtColor = addEvtColor.value;
                                 //var evtColor = addEvtColor.options[addEvtColor.selectedIndex.value];
                                 //alert(evtDate);


                                 xhr.onreadystatechange = function() {
                                   if (this.readyState == 4 && this.status == 200) {

                                        error.innerHTML = xhr.responseText;

                                        addEvtName.value = "";
                                        addEvtBtime.value = "";
                                        addEvtEtime.value = "";
                                        addEvtDesc.value = "";
                                        addEvtColor.value = "";


                                        if(error.innerHTML == "De evenement is met succes toegevoegd.")
                                        {

                                           closeAddEvtForm();
                                           displayEvent();

                                        }



                                      }

                                   };


                                  xhr.open('GET','../vrijwilliger/site/models/ajax_requests/calendar/addEvent.php?evtDate='+evtDate+'&evtName='+evtName+'&evtBtime='+evtBtime+'&evtEtime='+evtEtime+'&evtInfo='+evtInfo+'&evtColor='+evtColor,true);
                                  xhr.send();

                           }


                           var weeks = document.querySelectorAll(".weeks");
                           for (var i = 0; i < weeks.length; i++) {

                              var weeksArr = weeks[i];
                              weeksArr.addEventListener("click",displayChoosedEvt);

                           }

                           var evtDate;


                           function displayChoosedEvt(e)
                           {

                               var month_name = ['','Januari','Februari','Maart','April','Mei','Juni','Juli','Augustus','September','Oktober','November','December'];
                               var month = e.target.parentNode.parentNode.childNodes[1].textContent;
                               var day;

                               if(e.target.className == "weeks")
                               {

                                   day = e.target.childNodes[1].textContent;

                               }else{

                                   day = e.target.parentNode.parentNode.childNodes[1].textContent;

                               }

                               if(day < 10 && month_name.indexOf(month) < 10)
                               {

                                  evtDate =  "<?php echo $date;?>"+'-'+'0'+month_name.indexOf(month)+'-'+'0'+day;

                               }else if(day < 10 && month_name.indexOf(month) >= 10){

                                 evtDate =  "<?php echo $date;?>"+'-'+month_name.indexOf(month)+'-'+'0'+day;

                               }else if(day >= 10 && month_name.indexOf(month) < 10){

                                 evtDate =  "<?php echo $date;?>"+'-'+'0'+month_name.indexOf(month)+'-'+day;

                               }else if(day >= 10 && month_name.indexOf(month) >= 10){

                                 evtDate =  "<?php echo $date;?>"+'-'+month_name.indexOf(month)+'-'+day;

                               }

                               //var day = e.target.childNodes[1].textContent;
                               //alert(e.target.parentNode.parentNode.childNodes[1].textContent);
                               //evtDate = "<?php echo $date;?>"+'-'+month_name.indexOf(month)+'-'+day;
                               //evtDate = "<?php //echo $date;?>"+'-'+month_name.indexOf(month)+'-'+day;

                               displayEvent()

                           }



                           function displayEvent()
                           {

                             var agendaInfo = document.getElementById("agendaInfo");

                          /*  var month_name = ['','January','February','Maart','April','Mei','Juni','Juli','Augustus','Sptember','October','Novenber','December'];
                            var month = e.target.parentNode.parentNode.childNodes[1].textContent;
                            var day = e.target.childNodes[1].textContent;
                            var evtDate = "<?php //echo $date;?>"+'-'+month_name.indexOf(month)+'-'+day;*/

                             xhr.onreadystatechange = function() {
                               if (this.readyState == 4 && this.status == 200) {

                                    agendaInfo.innerHTML = xhr.responseText;
                                    //mobileAgendaInfo.innerHTML = xhr.responseText;

                                    var closeCalInfo = document.querySelector("#agendaInfo #closeCalInfo");

                                    closeCalInfo.addEventListener("click", hideCalInfo);

                                    hidAllevtActions();
                                    showMore();
                                    showLess();
                                    showEvtActions();
                                    hideEvtActions();
                                    evtUpdate();
                                    evtDelete();
                                    getCurrentEvtInfo();


                                    var evtContainer = document.querySelectorAll(".evtContainer");
                                    var weeks = document.querySelectorAll(".weeks");



                               };

                             }


                              xhr.open('GET','../vrijwilliger/site/models/ajax_requests/calendar/displayEvent.php?evtDate='+evtDate,true);
                              xhr.send();



                           }


                           function eventColor()
                           {

                               var weeks = document.querySelectorAll(".weeks")

                                //  var month_name = ['','January','February','Maart','April','Mei','Juni','Juli','Augustus','Sptember','October','Novenber','December'];
                                //  var month = weeksArr.parentNode.parentNode.childNodes[1].textContent;
                                //  var days = weeksArr.childNodes[1].textContent;


                                  //var monthCont = weeksArr.parentNode.parentNode.className;

                                /*  var evtDate;

                                  /*if(days < 10 && month_name.indexOf(month) < 10)
                                  {

                                     evtDate = '<?php echo $date;?>'+'-'+'0'+month_name.indexOf(month)+'-'+'0'+days;

                                  }else if(days < 10 && month_name.indexOf(month) >= 10){

                                    evtDate = '<?php echo $date;?>'+'-'+month_name.indexOf(month)+'-'+'0'+days;

                                  }else if(days >= 10 && month_name.indexOf(month) < 10){

                                    evtDate = '<?php echo $date;?>'+'-'+'0'+month_name.indexOf(month)+'-'+days;

                                  }else if(days >= 10 && month_name.indexOf(month) >= 10){

                                    evtDate = '<?php echo $date;?>'+'-'+month_name.indexOf(month)+'-'+days;

                                  }*/

                                  //var evtDate = "<?php// echo $date;?>"+'-'+month+'-'+day_name.indexOf(day);


                                  xhr.onreadystatechange = function() {
                                    if (this.readyState == 4 && this.status == 200) {


                                          currentEvtColor = xhr.responseText;

                                       }

                                    };


                                   xhr.open('GET','../vrijwilliger/site/models/ajax_requests/calendar/eventsColor.php?evtDate='+evtDate,true);
                                   xhr.send();



                           }
                          //  eventColor();



                           function hideCalInfo()
                           {

                               $(agendaInfo).animate({

                                 right: 70,

                               },{

                                 duration: 500,
                                 easing: "easeInOutBack",

                               })

                               $(agendaInfo).css("opacity","0");

                           }


                          /* function hideMobileCalInfo()
                           {

                               $(mobileAgendaInfo).animate({

                                   opacity: 0,
                                   zIndex: 0,

                               },{

                                   duration: 500,
                                   easing: "easeInOutBack",

                               })

                           }*/



                           function hidAllevtActions()
                           {

                              $(function(){

                                $(".evtLess").hide();
                                $(".evtUpdate").hide();
                                $(".evtDel").hide();
                                $(".evtBody").hide();

                              })

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


                           function showEvtActions()
                           {

                                var update = document.querySelector("#update");
                                update.addEventListener("click", function(){

                                    $(function(){

                                      $(".evtDel").hide("slow");
                                      $(".evtUpdate").show("slow");

                                    })

                                })

                           }



                           function hideEvtActions()
                           {

                                var deleteEvt = document.getElementById("delete");
                                deleteEvt.addEventListener("click", function(){

                                     $(function(){

                                       $(".evtDel").show("slow");
                                      $(".evtUpdate").hide("slow");

                                     })

                                })

                           }


                           function evtUpdate()
                           {

                               var evtUpdate = document.querySelectorAll(".evtUpdate");
                               for (var i = 0; i < evtUpdate.length; i++) {

                                   var evtUpdateArr = evtUpdate[i];
                                   evtUpdateArr.addEventListener("click", function(e){

                                       callUpdateForm();
                                       updateEvents();

                                   })

                               }

                           }


                           function evtDelete()
                           {

                               var evtDelete = document.querySelectorAll(".evtDel");
                               for (var i = 0; i < evtDelete.length; i++) {

                                   var evtDeleteArr = evtDelete[i];
                                   evtDeleteArr.addEventListener("click", function(){

                                       callDeleteForm();
                                       //deleteEvents();

                                   })

                               }

                           }


                          function callUpdateForm()
                          {

                             var updateEvtForm = document.querySelector(".updateCurrentEvt");
                             $(function(){

                                 $(updateEvtForm).animate({

                                    top: 620,

                                 },{

                                   duration: 700,
                                   easing: "easeOutBack",

                                 })

                             })

                          }


                          var closeUpd = document.getElementById("closeUpd");
                          closeUpd.addEventListener("click", closeUpdateForm);

                          function closeUpdateForm()
                          {

                              var updateEvtForm = document.querySelector(".updateCurrentEvt");

                              $(function(){

                                  $(updateEvtForm ).animate({

                                     top: 0,

                                  },{

                                    duration: 700,
                                    easing: "easeInOutBack",

                                  })

                              })

                          }




                          function callDeleteForm()
                          {

                             var deleteEvtForm = document.querySelector(".deleteCurrentEvt");
                             $(function(){

                                 $(deleteEvtForm).animate({

                                    top: 520,

                                 },{

                                   duration: 700,
                                   easing: "easeOutBack",

                                 })

                             })

                          }


                          var closeDel = document.getElementById("closeDel");
                          closeDel.addEventListener("click", closeDeleteForm);

                          function closeDeleteForm()
                          {

                              var deleteEvtForm = document.querySelector(".deleteCurrentEvt");

                              $(function(){

                                  $(deleteEvtForm ).animate({

                                     top: 0,

                                  },{

                                    duration: 700,
                                    easing: "easeInOutBack",

                                  })

                              })

                          }


                           var delDate;
                           var delEvtName;

                           function getCurrentEvtInfo()
                           {

                              var evtUpdate = document.querySelectorAll(".evtUpdate");
                              var evtDel = document.querySelectorAll(".evtDel");

                                var updtEVtDate = document.getElementById("updtEVt");
                                var updtEvtName = document.getElementById("updtEvtName");
                                var updtEvtCloneName = document.getElementById("updtEvtCloneName");
                                var updtEvtBtime = document.getElementById("updtEvtBtime");
                                var updtEvtEtime = document.getElementById("updtEvtEtime");
                                var updtDesc = document.getElementById("updtDesc");
                                var updtColor = document.getElementById("updtColor");



                                for (var i = 0; i < evtUpdate.length; i++) {

                                     var evtUpdateArr = evtUpdate[i];

                                     evtUpdateArr.addEventListener("click", function(e){


                                        var date =  e.target.parentNode.parentNode.childNodes[5].childNodes[1].textContent.substring(7);
                                        var evtName = e.target.parentNode.childNodes[1].textContent;
                                        var evtColor = e.target.parentNode.childNodes[1].className;
                                        var evtDesc = e.target.parentNode.parentNode.childNodes[3].textContent;
                                        var bTime = e.target.parentNode.parentNode.childNodes[5].childNodes[3].textContent.substring(12);
                                        var eTime = e.target.parentNode.parentNode.childNodes[5].childNodes[5].textContent.substring(11);

                                        updtEVtDate.value = date;
                                        updtEvtName.value = evtName;
                                        updtEvtCloneName.value = evtName;
                                        updtEvtBtime.value = bTime;
                                        updtEvtEtime.value = eTime;
                                        updtDesc.value = evtDesc;
                                        //updtColor.value = evtColor;



                                   })

                               }


                               for (var i = 0; i < evtDel.length; i++) {

                                    var evtDelArr = evtDel[i];

                                    evtDelArr.addEventListener("click", function(e){

                                       delDate =  e.target.parentNode.parentNode.childNodes[5].childNodes[1].textContent.substring(7);
                                       delEvtName = e.target.parentNode;


                                  })

                              }

                           }


                           var updateEvt = document.getElementById("updateEvt");

                           updateEvt.addEventListener("click", updateEvents);


                           function updateEvents(e)
                           {

                               e.preventDefault();
                               var updtEVtDate = document.getElementById("updtEVt");
                               var updtEvtName = document.getElementById("updtEvtName");
                               var updtEvtCloneName = document.getElementById("updtEvtCloneName");
                               var updtEvtBtime = document.getElementById("updtEvtBtime");
                               var updtEvtEtime = document.getElementById("updtEvtEtime");
                               var updtDesc = document.getElementById("updtDesc");
                               var updtColor = document.getElementById("updtColor");

                                 var date = updtEVtDate.value;
                                 var evtName = updtEvtName.value;
                                 var evtCloneName = updtEvtCloneName.value;
                                 var bTime = updtEvtBtime.value;
                                 var eTime = updtEvtEtime.value;
                                 var evtDesc = updtDesc.value;
                                 var colorVal = updtColor.value

                                 //alert(evtName);

                                 var  error = document.querySelector(".updateCurrentEvt .error");


                                 xhr.onreadystatechange = function() {
                                   if (this.readyState == 4 && this.status == 200) {

                                        error.innerHTML = xhr.responseText;

                                        if(error.textContent == "Evenement met succes aangepast...")
                                        {

                                          closeUpdateForm();
                                          displayEvent();

                                        }


                                      }

                                   };


                                  xhr.open('GET','../vrijwilliger/site/models/ajax_requests/calendar/updateEvent.php?dateVal='+date+'&nameVal='+evtName+'&evtCloneName='+evtCloneName+'&timeBval='+bTime+'&timeEval='+eTime+'&descVal='+evtDesc+'&colorVal='+colorVal,true);
                                  xhr.send();



                           }


                           var deleteEvt = document.getElementById("deleteEvt");

                           deleteEvt.addEventListener("click", deleteEvents);

                           function deleteEvents(e)
                           {

                               e.preventDefault();
                               var  error = document.querySelector(".deleteCurrentEvt .error");
                                var sUserPass = document.getElementById("sUserPass");
                                var sUserPassVal = sUserPass.value;
                                var delEvtNameVal = delEvtName.childNodes[1].textContent;
                                var delEvtParent = delEvtName.parentNode;

                               xhr.onreadystatechange = function() {
                                 if (this.readyState == 4 && this.status == 200) {

                                      error.innerHTML = xhr.responseText;

                                        if(error.textContent == "Evenement met succes verwijderd...")
                                        {

                                            closeDeleteForm();
                                            displayEvent();
                                            sUserPass.value = "";
                                            $(delEvtParent).toggle( "explode" );

                                        }


                                    }

                                 };


                                if(sUserPassVal != "")
                                {

                                  xhr.open('GET','../vrijwilliger/site/models/ajax_requests/calendar/deleteEvent.php?dateVal='+delDate+'&evtName='+delEvtNameVal+'&sUserPassVal='+sUserPassVal,true);
                                  xhr.send();

                                }else{

                                  error.innerHTML = "Voer een wachtwoord in...!";

                                }


                           }

                      })

                    })

                  </script>

              <?php

          }

     }

 ?>
