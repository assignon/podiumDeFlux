$(function(){


   window.addEventListener("load", function(){

        $(".evtsContent").hide();

         var weeks = document.querySelectorAll(".weeks");
         var evtsContent = document.querySelector(".evtsContent");
         for (var i = 0; i < weeks.length; i++) {

            var weeksArr = weeks[i];
            weeksArr.addEventListener("click",calEvtInfo)

         }


         $("#closeEvtContent").click(closeEvtInfo);


         function calEvtInfo()
         {

             $(".evtsContent").css("opacity","1");
             $(".evtsContent").show("slow");
             $(".eventContainer").css("width","80%");
             $(".eventContainer").css("right","250px");

         }


         function closeEvtInfo()
         {
     
           $(".evtsContent").hide("slow");
           $(".evtsContent").css("opacity","0");
           $(".eventContainer").css("width","100%");
           $(".eventContainer").css("right","0px");

         }

   })

})
