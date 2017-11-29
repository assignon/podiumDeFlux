$(function(){

  window.addEventListener("load", function(){

      var dataRecovery = document.getElementById("dataRecovery");
      var closeRecoverForm = document.getElementById("closeRecoverForm");
      var recoveryDataScreen = document.getElementById("recoveryDataScreen");
      var userEmail = document.getElementById("userEmail");

        $("#recoveryDataScreen").hide();

      dataRecovery.addEventListener("click", function(){

        $("#recoveryDataScreen").show();

        $(recoveryDataScreen).animate({

             top: -50,

          },{

            duration: 500,
            easing: "easeOutBack",

          })

      })


      closeRecoverForm.addEventListener("click", function(){

      //  $("#heads").css("marginTop", "-50px");

        $("#recoveryDataScreen").hide("slow");

          $(recoveryDataScreen).animate({

             top: 200,

          },{

            duration: 500,
            easing: "easeInOutBack",

          })

         userEmail.value = "";

      })

  })

})
