<?php

  class model{

    private $pdo;

        public function __construct()
         {


         }

        protected function PDO()
        {

          if($this->pdo === null)
            {

              $this->pdo = new PDO("mysql:host=localhost;dbname=podiumdeflux",'root','');//localhost
            //$this->pdo = new PDO("mysql:host=localhost;dbname=deb33439n4_vrijwilligers",'deb33439n4_vrijwilligers','podiumwilligers');//podium.nl
              $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

          }

           return $this->pdo;

        }


       protected function prepare($statement,$data)
       {

          $prepare = $this->PDO()->prepare($statement);
          $prepare->execute($data);
          return $prepare;


       }



       protected function query($statement)
       {

          $query = $this->PDO()->query($statement);
          $query->fetch();
          return $query;


       }



       public function error($error)
       {

           ?>

               <script type="text/javascript">

                  window.addEventListener("load", function(){

                     var error = document.querySelector(".error");
                     error.innerHTML = "<?php echo $error;?>";
                     error.style.color = "red";

                  })

               </script>

           <?php

       }



       public function succes($succes)
       {

           ?>

               <script type="text/javascript">

                  window.addEventListener("load", function(){

                     var error = document.querySelector(".error");
                     error.innerHTML = "<?php echo $succes;?>";
                     error.style.color = "#00D636";

                  })

               </script>

           <?php

       }



       public function post_value($name)
       {

          if(isset($_POST[$name]))
          {

             $inputname = $_POST[$name];
             return $inputname;

          }


       }



       public function hide_sidebar()
       {

          ?>

             <script type="text/javascript">

                window.addEventListener("load", function(){

                    $(function(){

                      $("#sideBar").hide(0);
                      $("#closeSidebar").hide(0);
                      $("#sideBa").css('display','none');
                      $("#closeSidebar").css('display','none');

                    })

                })

             </script>

          <?php

       }



       public function show_sidebar()
       {

         ?>

            <script type="text/javascript">

               window.addEventListener("load", function(){

                 var  editModeIcon = document.querySelector("#editModeIcon");

                  editModeIcon.addEventListener("click", function(){

                     $(function(){

                       $("#sideBar").css("opacity","1");
                       $("#sideBar").css("display","flex");
                       $("#sideBar").show("slow");
                       $("#closeSidebar").css("opacity","1");
                       $("#closeSidebar").css("display","block");
                       $("#closeSidebar").show("slow");
                       $("#editModeIcon").hide("slow")

                      // $("#core").css('width','92%');
                      // $("#core").css('marginLeft','110px');

                     })

                 })


               })

            </script>

         <?php

       }



       public function show_sidebar_controller()
       {

         ?>

            <script type="text/javascript">

               window.addEventListener("load", function(){

                 $(function(){

                   $(".sidebarController").css("display","flex");
                   $(".sidebarController").css("opacity","1");
                    $(".sidebarController").show("slow");

                 })

               })

            </script>

         <?php

       }



       public function hide_sidebar_controller()//veberg de edit mode knop en de delete en update knop van de smoelen foto
       {

         ?>

            <script type="text/javascript">

               window.addEventListener("load", function(){

                 $(function(){

                   $(".sidebarController").css("display","none");
                   $(".sidebarController").css("opacity","0");
                    $(".sidebarController").hide();

                    $("#updateImg").hide();
                    $("#deleteImg").hide();

                 })

               })

            </script>

         <?php

       }



       public function close_sidebar()
       {

         ?>

            <script type="text/javascript">

               window.addEventListener("load", function(){

                 var closeSidebar = document.getElementById("closeSidebar");
                 var controle = document.querySelectorAll(".controle");
                 var closeAdd = document.getElementById("closeAdd");

                 closeSidebar.addEventListener("click", function(){

                     $(function(){

                       $("#sideBar").hide("slow");
                       $("#sideBar").css("opacity","0");
                       $("#sideBar").css("display","none");
                       $("#closeSidebar").css("opacity","0");
                       $("#closeSidebar").css("display","none");
                       $("#closeSidebar").hide("slow");
                       $("#editModeIcon").show("slow");

                       for (var i = 0; i < controle.length; i++) {

                           var controleArr = controle[i];
                           controleArr.style.display = "none";

                       }

                     })

                 })


                 closeAdd.addEventListener("click", function(){

                     for (var i = 0; i < controle.length; i++) {

                         var controleArr = controle[i];
                         controleArr.style.display = "none";


                     }

                     var agendaInfo = document.getElementById("agendaInfo");

                     $(agendaInfo).animate({

                       right: 70,

                     },{

                       duration: 500,
                       easing: "easeInOutBack",

                     })

                 })



               })

            </script>

         <?php

       }



       public function enableUniverselPass()
       {

          ?>

          <script type="text/javascript">

                window.addEventListener("load", function(){

                   $(function(){

                      $(".universelForm").css("opacity","1");
                      $(".universelForm").show("slow");

                   })

                })

          </script>

          <?php

       }



       public function user_settings()
       {

         $userId = $_GET['id'];
         if(isset($_GET['artikel']))
         {

            $artikel = $_GET['artikel'];

         }

           ?>

               <script type="text/javascript">

                  window.addEventListener("load", function(){

                     $(function(){


                          var usersDataUpdate = document.querySelectorAll(".usersDataUpdate");
                          var updatePersonalData = document.getElementById("updatePersonalData");
                          var userCurrentPass = document.getElementById("userCurrentPass");
                          var error = document.querySelector(".error");
                          var xhr;


                          if (window.XMLHttpRequest) {
                               // code for IE7+, Firefox, Chrome, Opera, Safari
                                xhr = new XMLHttpRequest();
                              } else {
                               // code for IE6, IE5
                                 xhr = new ActiveXObject("Microsoft.XMLHTTP");
                             }


                            updatePersonalData.addEventListener("click", updateUserData);

                            function updateUserData(e)
                            {

                                e.preventDefault();

                                var profileFoto = document.getElementById("profilFoto").files[0];
                                var profilImg = document.getElementById("profilFoto");
                                var formData = new FormData();
                                formData.append('profilFoto', profileFoto);

                                var email = usersDataUpdate[0].value;
                                var newPass = usersDataUpdate[1].value;
                                var currentPass = userCurrentPass.value;
                                var userId = "<?php echo $userId;?>"


                                xhr.onreadystatechange = function() {
                                    if (this.readyState == 4 && this.status == 200) {

                                           error.innerHTML = xhr.responseText;

                                           if(error.innerHTML == "Profiel foto bijgewerkt..." || error.innerHTML == "Email met succes aangepast..." || error.innerHTML == "Wachtwoord met succes aangepast..." || error.innerHTML == "Profiel foto bijgewerkt...Email met succes aangepast...Wachtwoord met succes aangepast...")
                                           {

                                             usersDataUpdate[0].value = "";
                                             usersDataUpdate[1].value = "";
                                             userCurrentPass.value = "";

                                             displayUserAvatar();

                                            // error.innerHTML = "Pas je persoonlijk gegevens aan";

                                           }

                                       }

                                  };


                                  if(email != ""|| newPass != "" || currentPass != "" || profilImg.value != "" )
                                  {

                                    xhr.open('POST','../vrijwilliger/site/models/ajax_requests/userSettings/updateUserData.php?email='+email+'&newPass='+newPass+'&currentPass='+currentPass+'&userId='+userId,true);
                                    xhr.send(formData);

                                  }else{

                                     error.innerHTML = "Alle velden zij leeg";

                                  }

                            }


                            function displayUserAvatar()// aangeroepen vanaf updateUserData()
                            {

                                   var profile = document.getElementById("profile");
                                   var usersAvatar = document.getElementById("usersAvatar");
                                   var userId = "<?php echo $userId;?>";


                                   xhr.onreadystatechange = function() {
                                       if (this.readyState == 4 && this.status == 200) {

                                              profile.src = xhr.responseText;
                                              usersAvatar.src = xhr.responseText;
                                              displayUserData();

                                          }

                                     };


                                   xhr.open('GET','../vrijwilliger/site/models/ajax_requests/userSettings/displayUserAvatar.php?userId='+userId);
                                   xhr.send();



                            }
                            displayUserAvatar();




                            function displayUserData()// aangeroepen vanaf updateUserData()
                            {

                                   var personalData = document.getElementById("personalData");
                                   var userId = "<?php echo $userId;?>";


                                   xhr.onreadystatechange = function() {
                                       if (this.readyState == 4 && this.status == 200) {

                                              personalData.innerHTML = xhr.responseText;

                                          }

                                     };


                                   xhr.open('GET','../vrijwilliger/site/models/ajax_requests/userSettings/displayUserData.php?userId='+userId);
                                   xhr.send();



                            }
                          //  displayUserData();

                     })

                  })

               </script>

           <?php

       }



       public function avatar()
       {

            $userId = $_GET['id'];

            ?>

              <script type="text/javascript">

                 $(function(){

                   window.addEventListener("load", function(){

                     function displayUserAvatar()// aangeroepen vanaf updateUserData()
                     {

                            var profile = document.getElementById("profile");
                          //var usersAvatar = document.getElementById("usersAvatar");
                            var userId = "<?php echo $userId;?>";

                            var xhr;


                            if (window.XMLHttpRequest) {
                                 // code for IE7+, Firefox, Chrome, Opera, Safari
                                  xhr = new XMLHttpRequest();
                                } else {
                                 // code for IE6, IE5
                                   xhr = new ActiveXObject("Microsoft.XMLHTTP");
                               }


                            xhr.onreadystatechange = function() {
                                if (this.readyState == 4 && this.status == 200) {

                                       profile.src = xhr.responseText;
                                      // usersAvatar.src = xhr.responseText;

                                   }

                              };


                            xhr.open('GET','../vrijwilliger/site/models/ajax_requests/userSettings/displayUserAvatar.php?userId='+userId);
                            xhr.send();



                     }
                     displayUserAvatar();

                   })

                 })

              </script>

            <?php

       }


       public function universelPass()
       {

         $userId = $_GET['id'];

           ?>

               <script type="text/javascript">

                  window.addEventListener("load", function(){

                      var error = document.querySelector(".universelForm .error");
                      var universalPass = document.getElementById("universalPass");
                      var sUserCurentPass = document.getElementById("sUserCurentPass");
                      var SuPass = document.getElementById("SuPass");
                      var xhr;


                      if (window.XMLHttpRequest) {
                           // code for IE7+, Firefox, Chrome, Opera, Safari
                            xhr = new XMLHttpRequest();
                          } else {
                           // code for IE6, IE5
                             xhr = new ActiveXObject("Microsoft.XMLHTTP");
                         }

                         sUserCurentPass.addEventListener("click", changeUniversalPass);

                         function changeUniversalPass(e)
                         {

                             e.preventDefault();

                             var newUniversalPass = universalPass.value;
                             var superUserPass = SuPass.value;
                             var userId = "<?php echo $userId;?>";


                             xhr.onreadystatechange = function() {
                                 if (this.readyState == 4 && this.status == 200) {

                                        error.innerHTML = xhr.responseText;

                                        if(error.innerHTML == "Wachtwoord met succes aangepast")
                                        {

                                          universalPass.value = "";
                                          SuPass.value = "";


                                        }

                                    }

                               };


                               if(newUniversalPass != "" && superUserPass != "")
                               {

                                 xhr.open('GET','../vrijwilliger/site/models/ajax_requests/userSettings/changeUniversalPass.php?newUniversalPass='+newUniversalPass+'&superUserPass='+superUserPass+'&userId='+userId,true);
                                 xhr.send();

                               }else{

                                  error.innerHTML = "Velden zijn leeg";

                               }

                         }

                  })

               </script>

           <?php

       }


       public function showImgsAction()//function die de update en de delete knop laat zien
       {

            ?>

                <script type="text/javascript">

                   window.addEventListener("load", function(){

                     $(function(){

                       $("#updateImg").show("slow");
                       $("#deleteImg").show("slow");

                     })

                   })

                </script>

            <?php

       }



       public function hideImgsAction()//function die de update en de delete knop laat zien
       {

            ?>

                <script type="text/javascript">

                   window.addEventListener("load", function(){

                     $(function(){

                       $("#updateImg").hide();
                       $("#deleteImg").hide();

                     })

                   })

                </script>

            <?php

       }



       public function tabs()
       {

           ?>

                <script type="text/javascript">

                   window.addEventListener("load", function(){

                      $(function(){

                        var xhr;

                        if (window.XMLHttpRequest) {
                             // code for IE7+, Firefox, Chrome, Opera, Safari
                              xhr = new XMLHttpRequest();
                            } else {
                             // code for IE6, IE5
                               xhr = new ActiveXObject("Microsoft.XMLHTTP");
                           }

                          function getAllTab()// geroepen vanaf addTab()
                          {

                                var tabsLink = document.querySelector(".tabsLink");
                                var tabsReceiver = document.getElementById("tabsReceiver");

                                xhr.onreadystatechange = function() {
                                    if(this.readyState == 4 && this.status == 200) {

                                            tabsLink.innerHTML = xhr.responseText;
                                            tabsReceiver.innerHTML = xhr.responseText;

                                       }

                                  };



                                   xhr.open('GET','../vrijwilliger/site/models/ajax_requests/tabs/getAllTab.php',true);
                                   xhr.send();

                          }
                          //getAllTab();

                      })

                   })

                </script>

           <?php

       }



  }

 ?>
