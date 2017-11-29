<?php

require "../vrijwilliger/site/core/model.php";

class nieuws extends model
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


     public function display_nieuws()
     {

         if(isset($_GET['artikel']) AND $_GET['artikel'] != "")
         {

             $nieuws_id = intval($_GET['artikel']);

             $selectNieuws = $this->prepare("SELECT * FROM blog WHERE id=?", array($nieuws_id));
             $displayNieuws = $selectNieuws->fetch();
             ?>

                <div class="currentNieuws">

                   <h1><?php echo $displayNieuws['blog_name'];?></h1>
                   <p class="ncurrentNieuwsContent">

                      <?php echo $displayNieuws['blog_content'];?>

                   </p>

                </div>

                <script type="text/javascript">

                   window.addEventListener("load", function(){

                      var nieuwsContent = document.getElementById("nieuwsContent");
                      var currentNieuws = document.querySelector(".currentNieuws")

                      nieuwsContent.appendChild(currentNieuws);

                   })

                </script>

             <?php

         }

     }



     public function allArticles()
     {

         $selectBlogs = $this->PDO()->query('SELECT * FROM blog ORDER BY id DESC');

         while($displayBlogs = $selectBlogs->fetch())
         {

              ?>

                  <a href="../vrijwilliger/index.php?page=nieuws&id=<?php echo $_SESSION['id']?>&artikel=<?php echo $displayBlogs['id'];?>" class="blogsLink">

                     <img src="../vrijwilliger/public/media/blog_images/<?php echo $displayBlogs['blog_image'];?>" alt="">
                     <h3><?php echo $displayBlogs['blog_name'];?></h3>

                  </a>


                  <script type="text/javascript">

                    window.addEventListener("load", function(){

                        var allBlogs = document.getElementById("allBlogs");
                        var blogsLink = document.querySelectorAll(".blogsLink");
                        //var allBlogsMobile = document.querySelector(".allBlogsMobile");

                        var windowWidth = window.innerWidth;


                        for (var i = 0; i < blogsLink.length; i++) {

                            var blogsLinkArr = blogsLink[i];

                            allBlogs.appendChild(blogsLinkArr);


                          /*  if(windowWidth < 1000)
                            {

                               allBlogsMobile.appendChild(blogsLinkArr);

                            }else{

                               allBlogs.appendChild(blogsLinkArr);

                            }*/


                        }

                    })

                  </script>

              <?php

          }

     }



     public function comments()
     {

       $article_id = intval($_GET['artikel']);
        $user_id = intval($_GET['id']);

       ?>

          <script type="text/javascript">

             $(function(){

                window.addEventListener("load", function(){

                     var reactionText =document.getElementById("reactionText");
                     var postReaction = document.getElementById("postReaction");
                     var xhr;

                     if (window.XMLHttpRequest) {
                          // code for IE7+, Firefox, Chrome, Opera, Safari
                           xhr = new XMLHttpRequest();
                      } else {
                          // code for IE6, IE5
                            xhr = new ActiveXObject("Microsoft.XMLHTTP");
                      }

                      postReaction.addEventListener("click", addComments);

                      function  addComments(e)
                      {

                         e.preventDefault();

                         var writeComment = document.getElementById("writeComment");
                         var reactionTextVal = reactionText.value;
                         var article_id = "<?php echo $article_id;?>";
                         var user_id = "<?php echo $user_id;?>";

                         xhr.onreadystatechange = function() {
                           if (this.readyState == 4 && this.status == 200) {

                                  writeComment.innerHTML = xhr.responseText;

                                  if(writeComment.textContent == "Reactie toegevoegd...")
                                  {

                                      reactionText.value = ""
                                      displayComment();
                                  }

                              }

                           };


                          if(reactionTextVal != "")
                          {

                            xhr.open('GET','../vrijwilliger/site/models/ajax_requests/nieuws/addComment.php?reactionTextVal='+reactionTextVal+'&article_id='+article_id+'&user_id='+user_id,true);
                            xhr.send();

                          }else{

                             writeComment.innerHTML = "De reactie veld is leeg...";

                          }


                      }



                      function displayComment()
                      {

                          var article_id = "<?php echo $article_id;?>";
                          var user_id = "<?php echo $user_id;?>";
                          var allcomments = document.getElementById("allcomments");

                          xhr.onreadystatechange = function() {
                            if (this.readyState == 4 && this.status == 200) {

                                   allcomments.innerHTML = xhr.responseText;
                                   commentCount();
                                   $(".totalContent").hide();
                                   $(".showLess").hide();

                                   $(".showLess").click(showLessContent);
                                   $(".showMore").click(showMoreContent);


                               }

                            };


                            xhr.open('GET','../vrijwilliger/site/models/ajax_requests/nieuws/displayComment.php?article_id='+article_id+'&user_id='+user_id,true);
                            xhr.send();

                      }
                      displayComment();



                      function commentCount()
                      {

                        var article_id = "<?php echo $article_id;?>";
                        var comments = document.getElementById("comments");

                        xhr.onreadystatechange = function() {
                          if (this.readyState == 4 && this.status == 200) {

                                 comments.innerHTML = xhr.responseText;

                             }

                          };


                          xhr.open('GET','../vrijwilliger/site/models/ajax_requests/nieuws/commentsCount.php?article_id='+article_id,true);
                          xhr.send();

                      }


                      function showMoreContent(e)
                      {

                         var totalContent = e.target.parentNode.childNodes[5];
                         var partContent = e.target.parentNode.childNodes[3];
                         var show_less = e.target.parentNode.childNodes[9];
                         var show_more = e.target.parentNode.childNodes[7];

                         $(totalContent).show("slow");
                         $(partContent).hide("slow");
                         $(show_less).show("slow");
                         $(show_more).hide("slow");

                      }


                      function showLessContent(e)
                      {

                        var totalContent = e.target.parentNode.childNodes[5];
                        var partContent = e.target.parentNode.childNodes[3];
                        var show_less = e.target.parentNode.childNodes[9];
                        var show_more = e.target.parentNode.childNodes[7];

                        $(totalContent).hide("slow");
                        $(partContent).show("slow");
                        $(show_less).hide("slow");
                        $(show_more).show("slow");

                      }

                })

             })

          </script>

       <?php

     }


}

 ?>
