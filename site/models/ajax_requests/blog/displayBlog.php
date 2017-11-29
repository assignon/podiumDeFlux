<?php
session_start();
   require "../pdo_connection.php";

   $pdo = pdo();
   //$blogTitle = htmlentities(htmlspecialchars($_GET['blogTitle']));
       $limit = 20;

       if (isset($_GET['paginationVal']))
       {

             $paginationVal = htmlentities(htmlspecialchars($_GET['paginationVal']));

           $blogs = $pdo->query("SELECT count(id) as blogsId FROM blog");
           $getBlogs = $blogs->fetch();

           $blogsId = $getBlogs['blogsId'];

           $begin = ($paginationVal * $limit)-$limit;
           $end = ($paginationVal * $limit);

           $byPage = $blogsId / $limit;

           $selectBlog = $pdo->query('SELECT id, blog_name, blog_image, blog_content, DATE_FORMAT(date_added, "%d/%m/%Y") AS date_added FROM blog ORDER BY id DESC LIMIT '.$begin.','.$end);

           ?>

               <div class="blogsContainer">

                  <?php

                      while($displayBlog = $selectBlog->fetch())
                      {

                         ?>

                           <div class="newBlogs">

                             <div class="blogActions">

                               <img src="../vrijwilliger/public/media/menuIcon/svg/004-bar-chart-reload.svg" alt="" class="updateBlog">
                               <img src="../vrijwilliger/public/media/menuIcon/svg/003-rubbish.svg" alt="" class="deleteBlog">

                             </div>

                             <a href="../vrijwilliger/index.php?page=nieuws&id=<?php echo $_SESSION['id']?>&artikel=<?php echo $displayBlog['id'];?>" class="blogs">

                                <img src="../vrijwilliger/public/media/blog_images/<?php echo $displayBlog['blog_image'];?>" alt="">
                                <h3><?php echo $displayBlog['blog_name'];?></h3>
                                <p><?php echo $displayBlog['date_added'];?></p>

                             </a>

                           </div>


                         <?php

                      }

                   ?>

               </div>

           <?php

           if($blogsId >= $limit)
           {

           ?>

              <div class="pagination">

                 <?php

                     for ($i=1; $i < $byPage+1; $i++)
                     {

                         ?>

                            <button class="paginationButt"><?php echo $i; ?></button>

                         <?php

                     }

                  ?>

              </div>

           <?php
          }

  }else{


        $blogs = $pdo->query("SELECT count(id) as blogsId FROM blog");
        $getBlogs = $blogs->fetch();

        $blogsId = $getBlogs['blogsId'];


        $byPage = $blogsId / $limit;

        $selectBlog = $pdo->query('SELECT id,blog_name, blog_image, blog_content, DATE_FORMAT(date_added, "%d/%m/%Y") AS date_added FROM blog ORDER BY id DESC LIMIT '.$limit);

        ?>

            <div class="blogsContainer">

               <?php

                   while($displayBlog = $selectBlog->fetch())
                   {

                      ?>

                        <div class="newBlogs">

                          <div class="blogActions">

                            <img src="../vrijwilliger/public/media/menuIcon/svg/004-bar-chart-reload.svg" alt="" class="updateBlog">
                            <img src="../vrijwilliger/public/media/menuIcon/svg/003-rubbish.svg" alt="" class="deleteBlog">

                          </div>

                          <a href="../vrijwilliger/index.php?page=nieuws&id=<?php echo $_SESSION['id']?>&artikel=<?php echo $displayBlog['id'];?>" class="blogs">

                             <img src="../vrijwilliger/public/media/blog_images/<?php echo $displayBlog['blog_image'];?>" alt="">
                             <h3><?php echo $displayBlog['blog_name'];?></h3>
                             <p><?php echo $displayBlog['date_added'];?></p>

                          </a>

                        </div>


                      <?php

                   }

                ?>

            </div>

        <?php

        if($blogsId >= $limit)
        {

        ?>

           <div class="pagination">

              <?php

                  for ($i=1; $i < $byPage+1; $i++)
                  {

                      ?>

                         <button class="paginationButt"><?php echo $i; ?></button>

                      <?php

                  }

               ?>

           </div>

        <?php
       }

  }


 ?>
