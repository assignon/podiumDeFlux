<?php

   require "../vrijwilliger/site/core/model.php";

   class login extends model
   {

      public function __construct()
      {

         parent::__construct();

      }


      public function signin()
      {

          if(isset($_POST['vrijw_signin']))
          {

              $admin_name = htmlentities(htmlspecialchars($_POST['username']));
              $pass = sha1($_POST['password']);

              if(!empty($admin_name) AND !empty($pass))
              {

                   $select = $this->prepare("SELECT*FROM signin WHERE username=? AND password=?", array($admin_name, $pass));
                   $adminname_row = $select->rowCount();

                 if($adminname_row == 1)
                 {

                     $data = $select->fetch();

                      $_SESSION['id'] = $data['id'];
                      $_SESSION['username'] = $data['username'];
                      $_SESSION['password'] = $data['password'];

                      header("Location: ../vrijwilliger/index.php?page=vrijwilligers&id=".$_SESSION['id']);//ma-cloud probleem

                 }else{

                    ?>

                        <script type="text/javascript">

                             window.addEventListener("load", function(){

                               var error = document.querySelector("#error");
                               error.innerHTML = "Gebruikersnaam of Wachtwoord onjuist";
                               error.style.color = "#F91535";

                             })

                        </script>

                    <?php

                 }

              }else{

                ?>

                    <script type="text/javascript">

                         window.addEventListener("load", function(){

                           var error = document.querySelector("#error");
                           error.innerHTML = "Alles invullen";
                           error.style.color = "#F91535";

                         })

                    </script>

                <?php

              }

          }

      }



      public function not_register_sigin()
      {

          if(isset($_POST['vrijw_signup']))
          {

                $admin_name = htmlentities(htmlspecialchars($_POST['username']));
                $pass = sha1($_POST['password']);

                if(!empty($admin_name) AND !empty($pass))
                {


                        $selectUniversalPass = $this->PDO()->query("SELECT universal_pass FROM universal_password");
                        $getUniversalPass = $selectUniversalPass->fetch();

                        if($pass == $getUniversalPass['universal_pass'])
                        {

                            $checkUsername = $this->prepare("SELECT username FROM signin WHERE username=?", array($admin_name));
                            $countUsername = $checkUsername->rowCount();

                            if($countUsername == 0)
                            {

                                header("Location: ../vrijwilliger/index.php?page=volledigeData&name=".$admin_name);

                             }else{

                                 ?>

                                     <script type="text/javascript">

                                          window.addEventListener("load", function(){

                                            var error = document.querySelector("#error");
                                            error.innerHTML = "Deze gebruikersnaam bestaat al...";
                                            error.style.color = "#F91535";

                                          })

                                     </script>

                                 <?php

                             }

                        }


                }else{

                  ?>

                      <script type="text/javascript">

                           window.addEventListener("load", function(){

                             var error = document.querySelector("#error");
                             error.innerHTML = "Alles invullen";
                             error.style.color = "#F91535";

                           })

                      </script>

                  <?php

                }

          }

      }



      public function dataRecorvery()
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

                           var error = document.getElementById("explain");
                           var userEmail = document.getElementById("userEmail");
                           var recoverSubmits = document.querySelectorAll(".recoverSubmits");

                           recoverSubmits[0].addEventListener("click", recoverUserName);
                           recoverSubmits[1].addEventListener("click", recoverPass);


                           function recoverUserName(e)
                           {

                                  e.preventDefault();
                                  var userMailVal = userEmail.value;


                                  xhr.onreadystatechange = function() {
                                    if (this.readyState == 4 && this.status == 200) {

                                         error.innerHTML = xhr.responseText;

                                           if(error.textContent == "De Gebruikersnaam is met succes gewijzigd. Een email is naar u mail box gestuurd met een nieuw tijdelijke gebruikersnaam...")
                                           {

                                               userEmail.value = "";

                                           }

                                       }

                                    };


                                   if(userMailVal != "")
                                   {

                                       xhr.open('GET','../vrijwilliger/site/models/ajax_requests/usernameRecover.php?userMailVal='+userMailVal,true);
                                       xhr.send();


                                   }else{

                                      error.innerHTML = "Voer uw email in...";

                                   }

                           }




                           function recoverPass(e)
                           {

                                  e.preventDefault();
                                  var userMailVal = userEmail.value;


                                  xhr.onreadystatechange = function() {
                                    if (this.readyState == 4 && this.status == 200) {

                                         error.innerHTML = xhr.responseText;

                                           if(error.textContent == "Het wachtwoord is met succes gewijzigd. Een email is naar u mail box gestuurd met een nieuw tijdelijke wachtwoord...")
                                           {

                                               userEmail.value = "";

                                           }

                                       }

                                    };


                                   if(userMailVal != "")
                                   {

                                       xhr.open('GET','../vrijwilliger/site/models/ajax_requests/passwordRecover.php?userMailVal='+userMailVal,true);
                                       xhr.send();


                                   }else{

                                      error.innerHTML = "Voer uw email in...";

                                   }

                           }


                    })

                 })

             </script>

         <?php

      }

   }

?>
