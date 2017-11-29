$(function(){

   window.addEventListener("load", function(){

     $("#userData").hide();
     $(".editModus").hide();

     var primairyMenu = document.querySelectorAll(".primairyMenu");

     primairyMenu[0].style.color = "#F59C00";


     if(navigator.userAgent == "Mozilla/5.0 (Windows NT 10.0; WOW64; rv:54.0) Gecko/20100101 Firefox/54.0")
     {


         $(".deleteCurrentBlog").css("marginBottom","-218px");

     }


     CKEDITOR.editorConfig = function( config ) {
     	// Define changes to default configuration here. For example:
     	 config.language = 'nl';
        config.height = 580;
        config.width = 98+'%';
     	// config.uiColor = '#AADC6E';
     };

     var blogVal = document.querySelectorAll(".blogInput");
     var blogsContent = blogVal[2];
     $("#blogsContent").ckeditor();

     var editBack = document.querySelector(".editBack")
     var editForm = document.querySelector(".editForm");
     var addBlog = document.querySelector("#add");
     var closeEditForm = document.getElementById("closeEditForm");
     var blogInputsVal = document.querySelectorAll(".blogInput");
     var blogsContent = document.getElementById("blogsContent");
     var textAreas = document.getElementById("textAreas");

     addBlog.addEventListener("click", showBlogForm);
     closeEditForm.addEventListener("click", hideBlogForm);

     $("#UpdateBlogs").hide();
     $("#update_blog_name").hide();


     function showBlogForm()
     {

       var error = document.querySelector(".editForm .error");

       $(error).html("Vul de velden om een nieuw artikel toe te voegen...");

      // textAreas.innerHTML = '<textarea name="" rows="8" cols="80" class="blogInput" id="blogsContent" placeholder="schrijf de inhoud van het artikel hier"></textarea>';
       $(".editModus").show();

       $("#UpdateBlogs").hide("slow");
       $("#addBlog").show("slow");

       $("#update_blog_name").hide("slow");
       $("#addBlogName").show("slow");

       $(".addTexArea").css("zIndex","3");
       $("#textAreas").css("zIndex","2");


        $(".editModus").animate({

          bottom: 0,

        },{

           duration: 700,
           easing: "easeOutBack"

        })


     }



     function hideBlogForm()
     {

        blogsContent.value = "";
        blogInputsVal[0].value = "";
        $(".error").html("Vul de velden om een nieuw artikel toe te voegen...");

         $(".editModus").animate({

           bottom: 700,

         },{

            duration: 700,
            easing: "easeInOutBack"

         })
         $(".editModus").hide("slow");

     }


     var closeFormDelt = document.getElementById("closeDeleteForm");
     closeFormDelt.addEventListener("click", closeDeltForm);


     function closeDeltForm()
     {

         $(".deleteCurrentBlog").animate({

           bottom: 250,

         },{

            duration: 700,
            easing: "easeOutBack"

         })

         var sUserPass = document.getElementById("sUserPass");
         sUserPass.value = "";

     }

   })

})
