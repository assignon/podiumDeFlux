<?php

require "../vrijwilliger/site/core/model.php";

class userManager extends model
{


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


     public function getAllUsers()
     {

        $selectUsers = $this->prepare("SELECT * FROM signin WHERE grade=?", array("guest-user"));
        $usersCount = $selectUsers->rowCount();

        if($usersCount > 0)
        {

              while($displayUsers = $selectUsers->fetch())
              {

                  ?>
                      <div class="globalUsers">

                          <div class="usersActions">

                              <img src="../vrijwilliger/public/media/menuIcon/svg/004-bar-chart-reload.svg" alt="" class="updateUserData">
                              <img src="../vrijwilliger/public/media/menuIcon/svg/003-rubbish.svg" alt="" class="deleteUserData">


                            </div>
                            <div class="allUsers">

                               <img src="../vrijwilliger/public/media/users_avatar/<?php echo $displayUsers['avatar'];?>" alt="">
                               <div class="users_name">

                                 <p class="userNames"><?php echo ucfirst($displayUsers['username']);?></p>

                               </div>

                            </div>

                      </div>

                      <script type="text/javascript">

                         window.addEventListener("load", function(){

                              var usersContainer = document.getElementById("usersContainer");
                              var globalUsers = document.querySelectorAll(".globalUsers");

                              for (var i = 0; i < globalUsers.length; i++) {

                                  var globalUsersArr = globalUsers[i];
                                  usersContainer.appendChild(globalUsersArr);

                              }


                         })

                      </script>

                  <?php

              }

        }else if($usersCount == 0)
        {

               ?>

               <script type="text/javascript">

                  window.addEventListener("load", function(){

                       var usersContainer = document.getElementById("usersContainer");
                       var h2 = document.createElement("h2");
                       h2.className = "noUsers";
                       h2.textContent = "Geen vrijwilligers toegevoegd of aangemeld...";

                       usersContainer.appendChild(h2);


                  })

               </script>

               <?php

        }



        ?>

             <script type="text/javascript">

                /*  window.addEventListener("load", function(){

                      $(function(){

                            var deleteUserData = document.querySelectorAll(".deleteUserData");
                            for (var i = 0; i < deleteUserData.length; i++) {

                                  var deleteUserDataArr = deleteUserData[i];

                                  deleteUserDataArr.addEventListener("click", deleteCurrentUser);


                                  function deleteCurrentUser(e)
                                  {

                                      var currentUsername = e.target.className;
                                      alert(currentUsername);

                                  }

                            }


                      })

                  })*/

             </script>

        <?php


     }



     public function getUsersData()
     {

        ?>

           <script type="text/javascript">

               $(function(){

                  var xhr;

                  if (window.XMLHttpRequest) {
                       // code for IE7+, Firefox, Chrome, Opera, Safari
                        xhr = new XMLHttpRequest();
                      } else {
                       // code for IE6, IE5
                         xhr = new ActiveXObject("Microsoft.XMLHTTP");
                     }



                   var allUsers = document.querySelectorAll(".allUsers");

                   for (var i = 0; i < allUsers.length; i++) {

                       var allUsersArr = allUsers[i];
                       allUsersArr.addEventListener("click", usersData);


                   }


                   var users_name = document.querySelectorAll(".users_name");

                   for (var i = 0; i < users_name.length; i++) {

                       var users_nameArr = users_name[i];
                       users_nameArr.addEventListener("click", usersData);


                   }



                   var closeUsersData = document.createElement("img");
                   closeUsersData.src = "../vrijwilliger/public/media/menuIcon/svg/004-x-button.svg";
                   closeUsersData.className = "closeUsersData";

                   var usersData = document.getElementById("usersData");


                   function usersData(e)
                   {


                         closeUsersData.addEventListener("click", closeUsersDataCont);

                         //alert(e.target.className);
                         //alert(e.target.parentNode.className);

                         if(e.target.className == "userNames")
                         {

                             var currentUserName = e.target.textContent;

                         }else if(e.target.className == "users_name")
                         {

                            var currentUserName = e.target.parentNode.childNodes[3].childNodes[1].textContent;

                         }



                         xhr.onreadystatechange = function() {
                           if (this.readyState == 4 && this.status == 200) {

                                usersData.innerHTML = xhr.responseText;
                                usersData.style.width = "400px";
                                usersData.style.border = "1px solid #030303";
                                usersData.style.borderRadius = "3px";

                                $("#usersContainer").css("width","75%");
                                $("#usersContainer").css("margin-right","270px");


                              /*  var windowWidht = window.innerWidth;

                                if(windowWidht < 800)
                                {

                                    $("#usersContainer").css("width","60%");
                                    usersData.style.width = "40%";

                                }else if(windowWidht > 0 && windowWidht < 500){

                                  $("#usersContainer").css("width","50%");
                                  usersData.style.width = "50%";
                                  $("#usersContainer").css("margin-right","230px");

                                }
                                else{

                                   $("#usersContainer").css("width","75%");
                                   usersData.style.width = "25%";

                                }*/


                                /*window.addEventListener("resize", function(){

                                    var windowWidht = window.innerWidth;

                                    if(windowWidht < 800)
                                    {

                                        $("#usersContainer").css("width","60%");
                                        usersData.style.width = "40%";

                                    }else if(windowWidht > 0 && windowWidht < 500){

                                      $("#usersContainer").css("width","50%");
                                      usersData.style.width = "50%";
                                      $("#usersContainer").css("margin-right","230px");

                                    }
                                    else{

                                       $("#usersContainer").css("width","75%");
                                       usersData.style.width = "25%";

                                    }

                                })*/

                                usersData.appendChild(closeUsersData);

                              }

                           };


                            xhr.open('GET','../vrijwilliger/site/models/ajax_requests/userManager/usersData.php?currentUserName='+currentUserName,true);
                            xhr.send();

                    }




                   function closeUsersDataCont()//call from usersData
                   {

                        usersData.innerHTML = "";

                        usersData.style.width = "0%";
                        usersData.style.border = "0px solid #030303";
                        usersData.style.borderRadius = "0px";

                        $("#usersContainer").css("width","100%");
                        $("#usersContainer").css("margin-right","0px");

                   }

               })

           </script>

        <?php

     }



     public function updateUsersData()
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


                        var update = document.getElementById("update");
                        update.addEventListener("click", displayUpdateIcons);


                        function displayUpdateIcons()
                        {

                            var updateUserData = document.querySelectorAll(".updateUserData");
                            for (var i = 0; i < updateUserData.length; i++) {

                                var updateUserDataArr = updateUserData[i];
                                $(updateUserDataArr).css("opacity","1");
                                $(updateUserDataArr).show("slow");
                                //$(updateUserDataArr).css("opacity","1");

                                updateUserDataArr.addEventListener("click", callUpdateForm);

                            }


                            var deleteUserData = document.querySelectorAll(".deleteUserData");
                            for (var i = 0; i < deleteUserData.length; i++) {

                                var deleteUserDataArr = deleteUserData[i];
                                $(deleteUserDataArr).hide("slow");
                                //$(deleteUserDataArr).css("opacity","1");

                            }

                        }



                        function callUpdateForm(e)//call from displayUpdateIcons()
                        {

                             var username = e.target.parentNode.parentNode.childNodes[3].childNodes[3].childNodes[1].textContent;
                             var usersDataVal = document.querySelectorAll(".usersDataVal");

                             var usersDataVal = document.querySelectorAll(".usersDataVal");
                             usersDataVal[0].value = username;


                              $(".addUpdateForm").animate({

                                   top: 700,

                              },{

                                   duration: 700,
                                   easing: "easeOutBack",

                              })

                              $("#addUser").hide();
                              $("#updateUser").show();

                              $(".addFormInputs .error").html("Pas de gegevens van " +username+ " aan...");

                              usersDataVal[2].placeholder = "Administrator wachtwoord";

                              updateCurrentUser(username);

                        }



                        var deleteIcon = document.getElementById("delete");
                        deleteIcon.addEventListener("click", displayDeleteIcons);



                        function displayDeleteIcons()
                        {

                            var updateUserData = document.querySelectorAll(".updateUserData");
                            for (var i = 0; i < updateUserData.length; i++) {

                                var updateUserDataArr = updateUserData[i];
                                $(updateUserDataArr).hide("slow");
                                //$(updateUserDataArr).css("opacity","1");

                            }


                            var deleteUserData = document.querySelectorAll(".deleteUserData");
                            for (var i = 0; i < deleteUserData.length; i++) {

                                var deleteUserDataArr = deleteUserData[i];
                                $(deleteUserDataArr).css("opacity","1");
                                $(deleteUserDataArr).show("slow");

                                deleteUserDataArr.addEventListener("click", callDeleteForm);

                            }

                        }



                        function callDeleteForm()//call from displayDeleteIcons()
                        {

                            $(".deleteForm").animate({

                                 top: 400,

                            },{

                                 duration: 700,
                                 easing: "easeOutBack",

                            })

                        }


                       var closeSidebar = document.getElementById("closeSidebar");
                       closeSidebar.addEventListener("click", closeUpdateDeleteIcons)


                       function closeUpdateDeleteIcons()
                       {

                           var updateUserData = document.querySelectorAll(".updateUserData");
                           for (var i = 0; i < updateUserData.length; i++) {

                               var updateUserDataArr = updateUserData[i];
                               $(updateUserDataArr).hide("slow");
                               $(updateUserDataArr).css("opacity","0");

                           }


                           var deleteUserData = document.querySelectorAll(".deleteUserData");
                           for (var i = 0; i < deleteUserData.length; i++) {

                               var deleteUserDataArr = deleteUserData[i];
                               $(deleteUserDataArr).hide("slow");
                               $(deleteUserDataArr).css("opacity","0");

                           }

                       }



                       function updateCurrentUser(username)//call from callUpdateForm()
                       {

                             var error = document.querySelector(".error");

                             var updateUser = document.getElementById("updateUser");
                             var usersDataVal = document.querySelectorAll(".usersDataVal");

                             updateUser.addEventListener("click", function(e){

                                  e.preventDefault();

                                  var user_name = usersDataVal[0].value;
                                  var email = usersDataVal[1].value;
                                  var SUpass = usersDataVal[2].value;


                                  xhr.onreadystatechange = function() {
                                    if (this.readyState == 4 && this.status == 200) {

                                         error.innerHTML = xhr.responseText;
                                         location.reload();

                                       }

                                    };


                                   if(SUpass != "")
                                   {

                                     xhr.open('GET','../vrijwilliger/site/models/ajax_requests/userManager/updateUsersData.php?user_name='+user_name+'&username='+username+'&email='+email+'&SUpass='+SUpass,true);
                                     xhr.send();

                                   }else{

                                      error.innerHTML = "Voer het wachtwoord in...";

                                   }

                             })



                       }



                })

            })

           </script>

        <?php

     }



     public function deleteUsersData()
     {

         ?>

              <script type="text/javascript">

                  window.addEventListener("load",function(){

                     $(function(){

                            var xhr;


                            if (window.XMLHttpRequest) {
                                 // code for IE7+, Firefox, Chrome, Opera, Safari
                                  xhr = new XMLHttpRequest();
                                } else {
                                 // code for IE6, IE5
                                   xhr = new ActiveXObject("Microsoft.XMLHTTP");
                               }



                            var deleteUserData = document.querySelectorAll(".deleteUserData");
                            for (var i = 0; i < deleteUserData.length; i++) {

                                 var deleteUserDataArr = deleteUserData[i];

                                 deleteUserDataArr.addEventListener("click", deleteCurrentUser);

                              }


                                function deleteCurrentUser(e)
                                {

                                    var currentUsername = e.target.parentNode.parentNode.childNodes[3].childNodes[3].childNodes[1].textContent;
                                    var currentUserParent = e.target.parentNode.parentNode;
                                    var SUpass = document.getElementById("SUpass");
                                    var deleteUser = document.getElementById("deleteUser");
                                    var error = document.querySelector(".deleteFormInputs .error");

                                    deleteUser.addEventListener("click",function(e){

                                          e.preventDefault();
                                          var SUpassVal = SUpass.value;


                                          xhr.onreadystatechange = function() {
                                              if (this.readyState == 4 && this.status == 200) {

                                                       error.innerHTML = xhr.responseText;

                                                       if(error.textContent == "Gebruiker met succes verwijderd")
                                                       {

                                                           $(currentUserParent).toggle("explode");
                                                           SUpass.value = "";

                                                       }

                                                 }

                                            };


                                           if(SUpassVal != "")
                                           {

                                             xhr.open('GET','../vrijwilliger/site/models/ajax_requests/userManager/deleteUser.php?currentUsername='+currentUsername+'&SUpassVal='+SUpassVal,true);
                                             xhr.send();

                                           }else{

                                              error.innerHTML = "Voer het wachtwoord in...";

                                           }


                                    })

                                }


                       })

                  })

              </script>

         <?php

     }


     public function addUsers()
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


                          var usersDataVal = document.querySelectorAll(".usersDataVal");
                          var addUser = document.getElementById("addUser");
                          var error = document.querySelector(".addFormInputs .error");


                          addUser.addEventListener("click", function(e){

                               e.preventDefault();


                               var user_name = usersDataVal[0].value;
                               var email = usersDataVal[1].value;
                               var SUpass = usersDataVal[2].value;


                               xhr.onreadystatechange = function() {
                                   if (this.readyState == 4 && this.status == 200) {

                                          error.innerHTML = xhr.responseText;
                                        //  location.reload();

                                            if(error.textContent == "Nieuw gebruiker met succes toegevoegd...")
                                            {

                                              usersDataVal[0].value = "";
                                              usersDataVal[1].value = "";
                                              usersDataVal[2].value = "";

                                              //"<?php// $this->getAllUsers();?>"

                                            }

                                      }

                                 };


                                if(user_name != "" && email != "" && SUpass != "")
                                {

                                  xhr.open('GET','../vrijwilliger/site/models/ajax_requests/userManager/addUser.php?user_name='+user_name+'&email='+email+'&SUpass='+SUpass,true);
                                  xhr.send();

                                }else{

                                   error.innerHTML = "Vul alle velden...";

                                }

                          })


                    })

                 })

             </script>

          <?php

     }

}

 ?>
