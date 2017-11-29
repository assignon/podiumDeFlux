window.addEventListener("load", function(){

    $(function(){


      if(navigator.userAgent == "Mozilla/5.0 (Windows NT 10.0; WOW64; rv:54.0) Gecko/20100101 Firefox/54.0")
      {



      }

      var tabContent = document.getElementById("tabContent");

    //  CKEDITOR.replace( 'tabContent' );


      $("#updateTabs").hide();
      $(".tabsFormContainer").hide();
    //  $("#tabContent").ckeditor();
      $('.updateTextArea').hide();
      $('.pdfsUpdate').hide();
      $("#tabContent").ckeditor();
      $('.pdfsContainer').hide();
      $('.tabblads').hide();
      //$('.tabblads').css('opacity','0');

      $("#moreMenu").css('color',"#F59C00");

        /* CKEDITOR.editorConfig = function( config )
         {

           config.height = 70%
           config.width = 90%

         }*/


         $("#add").click(addCallTabForm);
         $("#update").click(updateCallTabForm);
         $("#delete").click(deleteCallTabForm);
         $("#closeTabsForm").click(closeTabsForm);


         var tabsFormContainer = document.querySelector(".tabsFormContainer");

         function addCallTabForm()
         {

             tabsFormContainer.style.opacity = "1";
             $(tabsFormContainer).show("slow");

             $(".tabsFront .error").html("Maak een nieuw tabblad aan en voeg een content toe...");
             $("#newTab").show();
             $("#addTabs").show();//submit butt
             //$(".updateTextArea").css("display","none");
             $(".addTextArea").show();
             $('.updateTextArea').hide();
             $('#pdf_name').show();
             $('#newTab').show();
             $('#pdf').show();
             $('#labelPdf').show();
            // $("#updateContent").hide();
             $("#allTabs").hide();//select input
             $("#deleteTabs").hide();
             $("#updateTabs").hide();//submit butt
             $('.pdfsUpdate').hide();
             $("#tabPass").hide();

         }



         function updateCallTabForm()
         {

           tabsFormContainer.style.opacity = "1";
           $(tabsFormContainer).show("slow");

           $(".tabsFront .error").html("Pas de geselecteerde tabblad aan...");

           $("#addTabs").hide();//submit butt
           //$(".updateTextArea").css("display","block");
           $("#allTabs").show();//select input
           $(".addTextArea").hide();
           $('.updateTextArea').show();
           $('#pdf_name').hide();
           $("#pdf_nameUpdate").show();
           $(".pdfsName").css('width','49%');
           $('#newTab').show();
           $('#pdf').show();
           $('#labelPdf').show();
          // $("#updateContent").show();
          $("#deleteTabs").hide();
           $("#updateTabs").show();//submit butt
           $('.pdfsUpdate').show();
           $("#tabPass").hide();

         }



         function deleteCallTabForm()
         {

           tabsFormContainer.style.opacity = "1";
           $(tabsFormContainer).show("slow");

           $(".tabsFront .error").html("Verwijdert de geselecteerde tabblad...");

           $("#addTabs").hide();//submit butt
           //$(".updateTextArea").css("display","block");
           $("#allTabs").show();//select input
           $(".addTextArea").hide();
           $('.updateTextArea').hide();
           $('#pdf_name').hide();
           $('#newTab').hide();
           $('#pdf').hide();
           $(".pdfsName").css('width','100%');
           $('#labelPdf').hide();
          // $("#updateContent").show();
          $("#deleteTabs").show();
          $("#pdf_nameUpdate").hide();
           $("#updateTabs").hide();//submit butt
           $('.pdfsUpdate').show();
           $("#tabPass").show();

         }



          //var tabContent = document.getElementById("tabContent");
          var newTab = document.getElementById("newTab");


         function closeTabsForm()
         {

           tabsFormContainer.style.opacity = "0";
           $(tabsFormContainer).hide("slow");
           tabContent.value = "";
           newTab.value = "";

         }


         $("#pdfMobile").click(function(){

            $(".pdfsContainer").show('slow');

         })


    })

})
