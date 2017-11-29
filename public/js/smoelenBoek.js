$(function(){

   window.addEventListener("load", function(){

     $("#userData").hide();
     $(".faceForm").hide();
     $(".faceDeleteForm").hide();

     var primairyMenu = document.querySelectorAll(".primairyMenu");

     primairyMenu[1].style.color = "#F59C00";


      var add = document.getElementById("add");
    /*  add.addEventListener("click", function(){*/

         var faceInputs = document.querySelectorAll(".faceInputs");
         var selectGroup = document.getElementById('selectGroup');



    /*    faceInputs[0].addEventListener("blur",function(){

           var imgGroup = faceInputs[0].value;

             if(imgGroup != "")
             {

                  $(selectGroup).hide();

             }else{

                $(selectGroup).show();

             }

         })*/


/*         selectGroup.addEventListener("blur",function(){

           var selectGroupVal = selectGroup.value;
           var groupName = faceInputs[0];

             if(selectGroupVal != "Of selecteer een bestaande groep naam")
             {

                  $(groupName).hide();

             }else{

                $(groupName).show();

             }

         })

    /*  })*/

       //$('.faceGroupUpdate').hide();
       $('.faceInputsUpdate').hide();
       $('.emailUpdate').hide();
       $('#updateFace_book').hide();
       $("#updateImg_book").hide();

      // $("#groupImgContainer").hide();
       $("#imgContainer").hide();


       $("#closeFaceBookForm").click(function(){

         var faceInputs = document.querySelectorAll(".faceInputs");
         var faceImg = document.querySelector("#faceImg")
        // var selectGroup = document.getElementById('selectGroup');
         var textArea = document.querySelector(".areaSubs textArea");
         var email = document.querySelector("email");
        // var faceGroupUpdate = document.querySelector(".faceGroupUpdate");

         faceInputs[0].value = "";
         //faceInputs[1].value = "";
         textArea.value = "";
        // selectGroup.value = "Selecteer een bestaande groep naam";
         faceImg.value = "";

         //email.value = "";
      //   faceGroupUpdate.value = "";



           $(".faceForm").hide("slow");
           $(".faceForm").css("opacity","0");

       })


       $("#closeDeleteForm").click(function(){


           $(".faceDeleteForm").hide("slow");
           $(".faceDeleteForm").css("opacity","0");

       })


       var closeGroupImg = document.getElementById("closeGroupImg");
       closeGroupImg.addEventListener("click", function(){

            $("#groupImgContainer").hide("slow");

       })


        var windowWidth = window.innerWidth;

        if(windowWidth < 400)
        {

         $(".deleteUpdate").hide();

        }else{

           $(".deleteUpdate").show();

        }


        window.addEventListener("resize", function(){

          var windowWidth = window.innerWidth;

          if(windowWidth < 400)
          {

           $(".deleteUpdate").hide();

          }else{

             $(".deleteUpdate").show();

          }

        })


   })

})
