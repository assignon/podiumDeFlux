$(function(){

   window.addEventListener("load", function(){

     var logo = document.getElementById("logo");
     var windowWidht = window.innerWidth;

     logo.src = "../vrijwilliger/public/media/images/logo.png";

     if(windowWidht < 500)
     {

        logo.src = "";

     }else{

          logo.src = "../vrijwilliger/public/media/images/logo.png";

     }


     window.addEventListener('resize', function(){
       var windowWidht = window.innerWidth;

       if(windowWidht < 500)
       {

          logo.src = "";

       }else{

          logo.src = "../vrijwilliger/public/media/images/logo.png";

       }

     })

     function navigator_name()
     {
          //  console.log(navigator.userAgent);
            if(navigator.userAgent == "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.79 Safari/537.36 Edge/14.14393")
            {


            }else if(navigator.userAgent == "Mozilla/5.0 (Windows NT 10.0; WOW64; rv:54.0) Gecko/20100101 Firefox/54.0")
            {

              //$(".allMenus").css("top","3px");
              $(".forms .addNewEvt").css("marginBottom","-360px");

            }


      }
      navigator_name();

    /*  $(".addNewEvt").hide();
      $(".updateCurrentEvt").hide();
      $(".deleteCurrentEvt").hide();*/
      //$("#userData").hide();


        var agendaInfo = document.getElementById("agendaInfo");
        //var mobileAgendaInfo = document.getElementById("mobileAgendaInfo");
      //  var closeCalInfo = document.getElementById("closeCalInfo");

        var weeks = document.querySelectorAll(".weeks");

        for (var i = 0; i < weeks.length; i++) {

            var weeksArr = weeks[i];
            weeksArr.addEventListener("click", showCalInfo);
            //weeksArr.addEventListener("click", showMobileCalInfo);

        }


      //  closeCalInfo.addEventListener("click", hideCalInfo);



        function showCalInfo()
        {

           $(agendaInfo).css("opacity","1");

           $(agendaInfo).animate({

             right: 520,

           },{

             duration: 500,
             easing: "easeInBack",

           })

        }


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


      /*  function showMobileCalInfo()
        {

            $(mobileAgendaInfo).animate({

                opacity: 1,
                zIndex: 7,

            },{

                duration: 500,
                easing: "easeOutBack",

            })

        }*/


        //var mobileCalenda = document.getElementById("mobileCalenda");
        //var mobileAgenda = document.getElementById("mobileAgenda");
      //  var closeMobileAgenda = document.getElementById("closeMobileAgenda");

      //  $(mobileAgenda).hide();

      //  mobileCalenda.addEventListener("click",callMobileCalenda);



      /*  function callMobileCalenda()
        {

            $(mobileAgenda).css("opacity","1");
            $(mobileAgenda).show("slow");

            $(mobileAgenda).animate({

              bottom: 100,

            },{

              duration: 700,
              easing: "easeInBack",

            })


            $(".mobileMenu").hide("slow");

        }*/


    /*    function closeMobileCalenda()
        {

          $(".mobileMenu").show("slow");
        //  $(".mobileMenu").css()

            $(mobileAgenda).animate({

              bottom: 700,

            },{

              duration: 700,
              easing: "easeInBack",

            })

            $(mobileAgenda).hide("slow");
            $(mobileAgenda).css("opacity","0");

        }*/



        var calCtrlImg = document.querySelectorAll(".controle img");
        for (var i = 0; i < calCtrlImg.length; i++) {

            var calCtrlImgArr = calCtrlImg[i];
            $(calCtrlImgArr).hide();

        }


        var add_cal = document.querySelectorAll(".add_cal");
        var addNewEvt = document.querySelector(".addNewEvt");
        var closeAdd = document.getElementById("closeAdd");

        for (var i = 0; i < add_cal.length; i++) {

            var add_calArr = add_cal[i];
            add_calArr.addEventListener("click", callAddEvtForm);

        }

        closeAdd.addEventListener("click", closeAddEvtForm);


        function callAddEvtForm()
        {

            $(addNewEvt).animate({

               top: 720,

            },{

              duration: 700,
              easing: "easeOutBack",

            })

        }


        function closeAddEvtForm()
        {

          var controle = document.querySelectorAll(".controle");

            $(addNewEvt).animate({

               top: 0,

            },{

              duration: 700,
              easing: "easeInOutBack",

            })

            hideCalInfo();

            /*for (var i = 0; i < controle.length; i++) {

                var controleArr = controle[i];
                controleArr.style.display = "none";

            }*/

        }


        var month = document.querySelectorAll(".month");
        var arrowTop = document.getElementById("arrowTop");
        var agendaContent = document.getElementById("agendaContent");
        var arrowBottom = document.getElementById("arrowBottom");
        var increase = 400;


        function getAgendaColor()
        {
          alert();

           var evtContainer = document.querySelectorAll(".evtContainer");

           for (var i = 0; i < evtContainer.length; i++) {

               var evtContainerArr = evtContainer[i];

               evtContainerArr.addEventListener("click", function(){

                  alert();

               })

           }

        }




   })

})
