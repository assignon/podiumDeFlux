$(function(){

    window.addEventListener("load", function(){

       $("#userData").hide();
       $(".allBlogContainer").hide();
       //$(".allBlogsMobile").hide();



       var windowWidth = window.innerWidth;
       var allBlogs = document.getElementById("allBlogs");
       //var allBlogsMobile = document.querySelector(".allBlogsMobile");


       /*if(windowWidth < 1000)
       {

         $("#allBlogs").css("opacity","0");
         $("#allBlogs").hide("slow");
        // $(".allBlogsMobile").css("opacity","1");
         //$(".allBlogsMobile").show("slow");

       }else{

         $("#allBlogs").css("opacity","0.9");
         $("#allBlogs").show("slow");
         //$(".allBlogsMobile").css("opacity","0");
        // $(".allBlogsMobile").hide("slow");

      }**/


      $("#displayAllBlogs").click(function(){

         $(".allBlogContainer").css("opacity","0.97");
         $(".allBlogContainer").show("slow");

      })


      $("#closeAllBlog").click(function(){

         $(".allBlogContainer").hide("slow");
         $(".allBlogContainer").css("opacity","0");

      })


       window.addEventListener("resize", function(){

           var windowWidth = window.innerWidth;

          /* if(windowWidth < 1000)
           {

             $("#allBlogs").css("opacity","0");
             $("#allBlogs").hide("slow");
             //$(".allBlogsMobile").css("opacity","1");
             //$(".allBlogsMobile").show("slow");

           }else{

             $("#allBlogs").css("opacity","0.9");
             $("#allBlogs").show("slow");
             //$(".allBlogsMobile").css("opacity","0");
             //$(".allBlogsMobile").hide("slow");

           }*/

       })

    })

})
