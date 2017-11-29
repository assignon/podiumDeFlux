window.addEventListener("load", function(){

      $(function(){


          $("#userData").hide();

           $("#updateUser").hide();
           $(".updateUserData").hide();
           $(".deleteUserData").hide();


             var addUsers = document.getElementById("add");
             addUsers.addEventListener("click", callAddUserForm);


             function callAddUserForm()
             {


                   $(".addUpdateForm").animate({

                        top: 700,

                   },{

                        duration: 700,
                        easing: "easeOutBack",

                   })

                   $("#addUser").show();
                   $("#updateUser").hide();


                   $(".addFormInputs .error").html("Voeg nieuw vrijwilligers toe...");

             }


             var closeUsersDataForm = document.getElementById("closeUsersDataForm");
             closeUsersDataForm.addEventListener("click", closeAddUserForm);
             var usersDataVal = document.querySelectorAll(".usersDataVal");


             function closeAddUserForm()
             {


                 $(".addUpdateForm").animate({

                      top: 0,

                 },{

                      duration: 700,
                      easing: "easeInOutBack",

                 })

                 $(".addFormInputs .error").html("");

                 usersDataVal[0].value = "";
                 usersDataVal[1].value = "";
                 usersDataVal[2].value = "";

             }



             var deleteUsers = document.getElementById("delete");
          //   deleteUsers.addEventListener("click", callUserDeleteForm);

             function callUserDeleteForm()
             {

                 $(".deleteForm").animate({

                      top: 400,

                 },{

                      duration: 700,
                      easing: "easeOutBack",

                 })



             }


             var closeUsersDeleteForm = document.getElementById("closeUsersDeleteForm");
             closeUsersDeleteForm.addEventListener("click", closeUserDeleteForm);

             function closeUserDeleteForm()
             {

                 $(".deleteForm").animate({

                      top: 0,

                 },{

                      duration: 700,
                      easing: "easeInOutBack",

                 })



             }


      })



})
