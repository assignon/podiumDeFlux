<?php
session_start();
   if(isset($_GET['name']))
   {

       $username = htmlentities(htmlspecialchars($_GET['name']));

   }

 ?>

 <!DOCTYPE html>
 <html>
     <head>
       <title>Vrijwilligers</title>
     </head>
     <body>

         <header>
           <a href="../vrijwilliger/vrijwilligers.php?page=login" class="logoCont">

             <img src="../vrijwilliger/public/media/vrijwilligerLogo.png" id="logo" alt="">

                <!--<p id="willigers">vrijwilligers</p>-->

           </a>

            <div id="completeData">


                <form class="" action="" method="post">

                  <p class="info">Completeer je gegeven en login...</p>

                  <input type="text" name="username" placeholder="Gebruikersnaam" value="<?php echo $username;?>">
                  <input type="email" name="email" placeholder="Email">
                  <input type="password" name="password" placeholder="Wachtwoord">
                  <input type="password" name="confirm_password" placeholder="Wachtwoord bevestiging">
                  <input type="submit" name="signin" value="Login">

                </form>

            </div>

         </header>

         <style media="screen" type="text/css">

         html, body
         {

             padding: 0px;
             margin: 0px;
             background-image: url(../vrijwilliger/public/media/images/logowebsite.png);
             background-repeat: no-repeat;

         }


         .logoCont
         {

            width: auto;
            height: auto;
            margin: 50px;


         }


         .logoCont img
         {

             width: 250px;
             height: 90px;
             margin-top: 50px;

         }

             #completeData
             {

                 width: 100%;
                 height: 100vh;

             }


          /*   .backColor
             {

                width: 100%;
                height: 100%;
                /*background-color: #030303;
                opacity: 0.9;
                position: absolute;

             }*/


             #completeData form
             {

              width: 100%;
              height: 100%;
              display: flex;
              flex-direction: column;
              justify-content: center;
              align-items: center;
              margin-top: -200px;

             }


             #completeData form p
             {

                  width: auto;
                  height: auto;
                  color: 030303;
                  font-size: 20px;
                  margin-top: -50px;
                  margin-bottom: 50px;

             }


             #completeData form input
             {

                 width: 60%;
                 height: 38px;
                 border: 1px solid #F59C00;
                 border-radius: 3px;
                 background-color: white;
                 color: #030303;
                 font-size: 18px;
                 margin-bottom: 10px;
                 padding-left: 10px;

             }


             #completeData form input[type="submit"]
             {

                 width: 60.8%;
                 padding-left: 0px;
                 text-align: center;
                 color: white;
                 background-color: #F59C00;
                 cursor: pointer;

             }


             #completeData form input[type="submit"]:hover
             {

                background-color: #96650E;

             }


             @media screen and (max-width: 800px)
             {

                #completeData form input
                {

                   width: 90%;

                }


                #completeData form input[type="submit"]
                {

                   width: 90.8%;

                }

             }



         </style>

         <footer>

         </footer>

     </body>

</html>


<?php

    require "../vrijwilliger/site/models/ajax_requests/pdo_connection.php";

    $pdo = pdo();

     if(isset($_POST['signin']))
     {

         $user_name = htmlentities(htmlspecialchars($_POST['username']));
         $email = htmlentities(htmlspecialchars($_POST['email']));
         $password = $_POST['password'];
         $confirm_pass = $_POST['confirm_password'];

         if(!empty($user_name) AND !empty($email) AND !empty($password) AND !empty($confirm_pass))
         {

             if($password == $confirm_pass)
             {

               $checkDataCount = $pdo->prepare("SELECT * FROM signin WHERE email=? AND password=?");
               $checkDataCount->execute(array($email, sha1($password)));
               $countData = $checkDataCount->rowCount();

               if($countData == 0)
               {

                   $insertData = $pdo->prepare("INSERT INTO signin(username,password, email, grade, avatar ) VALUES(?,?,?,?,?)");
                   $insertData->execute(array($user_name, sha1($password), $email, "guest-user", "defaultAvatar.svg"));


                   $select = $pdo->prepare("SELECT*FROM signin WHERE username=? AND password=?");
                   $select->execute(array($user_name, sha1($password)));
                   $data_row = $select->rowCount();

                 if($data_row == 1)
                 {

                     $data = $select->fetch();

                      $_SESSION['id'] = $data['id'];
                      $_SESSION['username'] = $data['username'];
                      $_SESSION['password'] = $data['password'];

                      header("Location: ../vrijwilliger/vrijwilligers.php?page=vrijwilligers&id=".$_SESSION['id']);

                 }else{

                   ?>

                       <script type="text/javascript">

                            window.addEventListener("load", function(){

                              var info = document.querySelector(".info");
                              info.innerHTML = "Gebruikersnaam of Wachtwoord onjuist...";
                              info.style.color = "#F91535";

                            })

                       </script>

                   <?php

                 }

               }else{

                 ?>

                     <script type="text/javascript">

                          window.addEventListener("load", function(){

                            var info = document.querySelector(".info");
                            info.innerHTML = "Deze email bestaat al...";
                            info.style.color = "#F91535";

                          })

                     </script>

                 <?php

               }

             }else{

               ?>

                   <script type="text/javascript">

                        window.addEventListener("load", function(){

                          var info = document.querySelector(".info");
                          info.innerHTML = "De twee wachtwoorden passen niet bij elkaar...";
                          info.style.color = "#F91535";

                        })

                   </script>

               <?php

             }

         }else{

           ?>

               <script type="text/javascript">

                    window.addEventListener("load", function(){

                      var info = document.querySelector(".info");
                      info.innerHTML = "Vul alles in...";
                      info.style.color = "#F91535";

                    })

               </script>

           <?php

         }

     }

 ?>
