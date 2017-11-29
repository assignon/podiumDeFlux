<?php

require "../vrijwilliger/site/core/model.php";

class blog extends model
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


     public function blog()
     {

         $this->addBlog();
        // $this->updateBlog();
        // $this->deleteBlog();

     }


     public function addBlog()
     {

        ?>

           <script type="text/javascript">

              $(function(){

                 window.addEventListener("load", function(){

                     var editBack = document.querySelector(".editBack")
                     var editForm = document.querySelector(".editForm");
                     var addBlog = document.getElementById("addBlog");
                     var addExtraOptions = document.getElementById("addExtraOptions");
                     var error = document.querySelector(".error");
                     var blogVal = document.querySelectorAll(".blogInput");
                     var optionsVal = document.querySelectorAll(".options");
                     var addImg = document.getElementById("newImage");
                     var xhr;

                     addBlog.addEventListener("click", addNewBlog);
                     //blogVal[2].addEventListener("keydown", addNewLine);
                     //addExtraOptions.addEventListener("click", addOptions);



                     if (window.XMLHttpRequest) {
                          // code for IE7+, Firefox, Chrome, Opera, Safari
                           xhr = new XMLHttpRequest();
                         } else {
                          // code for IE6, IE5
                            xhr = new ActiveXObject("Microsoft.XMLHTTP");
                        }


                        function hideBlogForm()
                        {

                            $(".editModus").animate({

                              bottom: 700,

                            },{

                               duration: 700,
                               easing: "easeInOutBack"

                            })

                            $(".editModus").hide("slow");

                        }




                     function addNewBlog(e)
                     {

                        e.preventDefault();
                        var blogsContent = document.getElementById("blogsContent");
                        var editFormError = document.querySelector(".editForm .error");

                        var blogTitle = blogVal[0].value;
                        //var subHeading = blogVal[1].value;
                        var blogContent = blogVal[2];
                        var articleVal = blogsContent.value;
                        var article = $("#blogsContent").val();

                        var featureImg = document.getElementById("featuredImg").files[0];
                        var featureImgVal = document.getElementById("featuredImg");

                        var formData = new FormData();
                        formData.append('featuredImg', featureImg);


                        xhr.onreadystatechange = function() {
                          if (this.readyState == 4 && this.status == 200) {

                               editFormError.innerHTML = xhr.responseText;


                              // $(blogContent).val() = "";

                               if(editFormError.textContent == "Artikel met succes toegevoegd...")
                               {

                                   blogVal[0].value = "";
                                   //blogVal[1].value = "";
                                   blogsContent.value ="";
                                   featureImgVal.value = "";


                                    hideBlogForm();
                                    displayBlog();

                               }

                             }

                          };


                         if(blogTitle != "")
                         {

                           xhr.open('POST','../vrijwilliger/site/models/ajax_requests/blog/addBlog.php?blogTitle='+blogTitle+'&article='+article,true);
                           xhr.send(formData);


                         }else{

                            editFormError.innerHTML = "Geef een titel en een inhoud...";
                            //alert(error.innerHTML = "Geef een titel en een inhoud...");
                         }

                     }



                    /* function addNewLine(e)
                     {


                        if(e.keyCode == 13)
                        {

                          blogVal[2].value += "<?php echo '<br/>';?>";

                        }

                     }*/



                /*     function addOptions(e)
                     {

                        e.preventDefault();
                        var blogContent = blogVal[2].value;
                        var subHeading = optionsVal[0].value;
                        var linkName = optionsVal[1].value;
                        var linkAddres = optionsVal[2].value;

                        if(subHeading != "")
                        {

                           blogVal[2].value += "<?php echo '<h3>';?>" + subHeading + "<?php echo '</h3><br/>';?>";

                        }


                        if(linkName != "")
                        {

                           //blogVal[2].value += "<?php //echo '<a href="'+ linkAddres +'">'?>" + linkName + "<?php //echo '</a><br/>';?>";
                           var createLink = document.createElement("a");
                           createLink.href = linkAddres;
                           blogVal[2].appendChild(createLink);

                        }

                         addImage();

                        optionsVal[0].value = "";
                        optionsVal[1].value = "";
                        optionsVal[2].value = "";

                     }*/



                  /*   function addImage()
                     {

                       var newImg = document.getElementById("newImage").files[0];
                       var imgVal = document.getElementById("newImage");
                       var formData = new FormData();
                       formData.append('newImage', newImg);


                       xhr.onreadystatechange = function() {
                         if (this.readyState == 4 && this.status == 200) {

                              blogVal[2].value += xhr.responseText;

                            }

                         };


                          if(imgVal.value != "")
                          {

                            xhr.open('POST','../vrijwilliger/site/models/ajax_requests/blog/addImage.php',true);
                            xhr.send(formData);

                          }


                     }*/



                     function displayBlog()
                     {

                         var blogContainer = document.getElementById("core");
                         var showupdateIcons = document.getElementById("update");
                         var showdeleteIcons = document.getElementById("delete");
                         var closeSidebar = document.getElementById("closeSidebar");
                         var blogTitle = blogVal[0].value;

                         xhr.onreadystatechange = function() {
                           if (this.readyState == 4 && this.status == 200) {

                                core.innerHTML = xhr.responseText;
                                $(".updateBlog").hide();
                                $(".deleteBlog").hide();

                                showupdateIcons.addEventListener("click", showUpdateIcons);
                                showdeleteIcons.addEventListener("click", showDeleteIcons);

                                closeSidebar.addEventListener("click", function() {

                                  $(".updateBlog").hide("slow");
                                  $(".deleteBlog").hide("slow");


                                })

                                $('.paginationButt').click(pagination);


                                var deleteCurrentBlog = document.querySelectorAll(".deleteBlog");
                                for (var i = 0; i < deleteCurrentBlog.length; i++) {

                                    var deleteCurrentBlogArr = deleteCurrentBlog[i];
                                    deleteCurrentBlogArr.addEventListener("click",deleteBlog);

                                }


                              }

                           };



                          xhr.open('GET','../vrijwilliger/site/models/ajax_requests/blog/displayBlog.php',true);
                          xhr.send();


                     }
                     displayBlog();



                     function pagination(e)// geroepen in displayBlog()
                     {

                         var blogContainer = document.getElementById("core");
                         var showupdateIcons = document.getElementById("update");
                         var showdeleteIcons = document.getElementById("delete");
                         var closeSidebar = document.getElementById("closeSidebar");
                         paginationVal = e.target.textContent;

                         xhr.onreadystatechange = function()
                         {

                             if (this.readyState == 4 && this.status == 200)
                             {

                                core.innerHTML = xhr.responseText;

                                $(".updateBlog").hide();
                                $(".deleteBlog").hide();

                                showupdateIcons.addEventListener("click", showUpdateIcons);
                                showdeleteIcons.addEventListener("click", showDeleteIcons);

                                closeSidebar.addEventListener("click", function() {

                                  $(".updateBlog").hide("slow");
                                  $(".deleteBlog").hide("slow");


                                })

                                $('.paginationButt').click(pagination);


                                var deleteCurrentBlog = document.querySelectorAll(".deleteBlog");
                                for (var i = 0; i < deleteCurrentBlog.length; i++) {

                                    var deleteCurrentBlogArr = deleteCurrentBlog[i];
                                    deleteCurrentBlogArr.addEventListener("click",deleteBlog);

                                }

                             }

                        };

                        xhr.open('GET','../vrijwilliger/site/models/ajax_requests/blog/displayBlog.php?paginationVal='+paginationVal,true);
                        xhr.send();

                     }



                     function showUpdateIcons()
                     {

                         var updateBlog = document.querySelectorAll('.updateBlog');
                         for (var i = 0; i < updateBlog.length; i++) {

                             var updateBlogArr = updateBlog[i];
                             $(updateBlogArr).show("slow");

                             updateBlogArr.addEventListener("click", getArticleValue);
                            // $("#core").css("marginTop": "20px");

                         }


                         var deleteBlog = document.querySelectorAll('.deleteBlog');
                         for (var i = 0; i < deleteBlog.length; i++) {

                             var deleteBlogArr = deleteBlog[i];
                             $(deleteBlogArr).hide("slow");
                            // $("#core").css("marginTop": "20px");

                         }

                     }



                     function showDeleteIcons()
                     {

                         var updateBlog = document.querySelectorAll('.updateBlog');
                         for (var i = 0; i < updateBlog.length; i++) {

                             var updateBlogArr = updateBlog[i];
                             $(updateBlogArr).hide("slow");

                         }


                         var deleteBlog = document.querySelectorAll('.deleteBlog');
                         for (var i = 0; i < deleteBlog.length; i++) {

                             var deleteBlogArr = deleteBlog[i];
                             $(deleteBlogArr).show("slow");

                         }

                     }



                     function showUpdateForm()
                     {

                         $("#UpdateBlogs").show("slow");
                         $("#addBlog").hide("slow");
                         //$("#blogsContent").hide();


                         $("#update_blog_name").show("slow");
                         $("#addBlogName").hide("slow");
                         $(".editModus").show("slow");

                         $(".editModus").animate({

                           bottom: 0,

                         },{

                            duration: 700,
                            easing: "easeOutBack"

                         })

                     }



                     function getArticleValue(e)// aangeroepen vanaf showUpdateIcons()
                     {

                          var error = document.querySelector(".editForm .error");

                          $(error).html("Pas het huidige artikrl aan...");

                          showUpdateForm();

                          var currentTitel = e.target.parentNode.parentNode.childNodes[3].childNodes[3].textContent;
                          var textAreas = document.getElementById("textAreas");


                          var blogInputsVal = document.querySelectorAll(".blogInput");
                          var update_blog_name = document.getElementById("update_blog_name");


                          update_blog_name.value = currentTitel;
                          blogInputsVal[0].value = currentTitel;



                          xhr.onreadystatechange = function() {
                            if (this.readyState == 4 && this.status == 200) {


                                  textAreas.innerHTML = xhr.responseText;
                                  //var textArea2 = textAreas.childNodes[1];
                                  $(".ckeditor").ckeditor();

                                  textAreas.style.zIndex = "3";
                                  $(".addTexArea").css("zIndex","2");

                               }

                            };

                           xhr.open('GET','../vrijwilliger/site/models/ajax_requests/blog/getArtcleContent.php?currentTitel='+currentTitel,true);
                           xhr.send();


                     }



                     var UpdateBlogs = document.getElementById("UpdateBlogs");
                       UpdateBlogs.addEventListener("click", updateCurrentBlog);


                     function updateCurrentBlog(e)
                     {

                          var blogInputsVal = document.querySelectorAll(".blogInput");
                          var update_blog_name= document.getElementById("update_blog_name");

                          var error = document.querySelector(".editForm .error");

                          var featureImg = document.getElementById("featuredImg").files[0];

                          var formData = new FormData();
                          formData.append('featuredImg', featureImg);


                              e.preventDefault();
                              var blogTitelUpdated = update_blog_name.value;
                              var blogTitel = blogInputsVal[0].value;
                              var blog_content = blogInputsVal[2];
                              var blogContent = $('.ckeditor').val();

                              xhr.onreadystatechange = function() {
                                if (this.readyState == 4 && this.status == 200) {

                                       error.innerHTML = xhr.responseText;

                                       displayBlog(blogTitel);

                                       if(error.textContent == "Artikel met succes aangepast...")
                                       {

                                           blogInputsVal[0].value = "";
                                           //$(blog_content).val() = "";
                                           hideBlogForm();

                                       }

                                   }

                                };

                               xhr.open('POST','../vrijwilliger/site/models/ajax_requests/blog/updateBlog.php?blogTitelUpdated='+blogTitelUpdated+'&blogTitel='+blogTitel+'&blogContent='+blogContent,true);
                               xhr.send(formData);

                     }



                  /*   var addBlog = document.querySelector("#add");
                     addBlog.addEventListener("click", function(){

                         var textAreas = document.getElementById("textAreas");
                         textAreas.innerHTML = "<?php //echo '<textarea name="" rows="8" cols="80" class="blogInput" id="blogsContent" placeholder="schrijf de inhoud van het artikel hier"></textarea>';?>";

                    })*/




                     function callDeleteForm()
                     {

                         $(".deleteCurrentBlog").animate({

                           bottom: 0,

                         },{

                            duration: 700,
                            easing: "easeOutBack"

                         })

                     }


                     function hideFormDelt()
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



                     function deleteBlog(e)
                     {

                       callDeleteForm()

                        var currentBlog_name = e.target.parentNode.parentNode.childNodes[3].childNodes[3].textContent;
                        var currentBlog_parent = e.target.parentNode.parentNode;
                        var deleteCurrentBlogError = document.querySelector(".deleteCurrentBlog .error");

                        var deltCurentBlog = document.getElementById("deleteCurentBlog");
                        deltCurentBlog.addEventListener("click", function(e){


                            e.preventDefault();

                             var error = document.querySelector(".error");
                             var sUserPass = document.getElementById("sUserPass");
                             var sUserPassVal = sUserPass.value;

                             xhr.onreadystatechange = function() {
                               if (this.readyState == 4 && this.status == 200) {

                                      deleteCurrentBlogError.innerHTML = xhr.responseText;

                                    if(deleteCurrentBlogError.textContent == "Artikel met succes verwijderd...")
                                      {

                                        hideFormDelt();

                                        $(currentBlog_parent).toggle("explode");

                                      }

                                  }

                               };

                              if(sUserPassVal != "")
                              {

                                xhr.open('GET','../vrijwilliger/site/models/ajax_requests/blog/deleteBlog.php?currentBlog_name='+currentBlog_name+'&sUserPassVal='+sUserPassVal,true);
                                xhr.send();

                              }else{

                                deleteCurrentBlogError.innerHTML = "Voer een wachtwoord in...";

                              }

                        })


                     }


                 })

              })

           </script>

        <?php

     }


 }

 ?>
