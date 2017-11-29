<?php

   class vrijwilligersRoute
   {

     private $pageName;

      public function __construct()
      {

          $this->route();

      }


      public function route()
      {

          require "../vrijwilliger/site/controllers/routing.php";
          $Routing = new routing();

          if(isset($_GET['page']) AND $_GET['page'] != "")
          {

              $this->pageName = $_GET['page'];

              if($this->pageName == "login")
              {

                $Routing->login();

              }else if($this->pageName == "vrijwilligers")
              {

                $Routing->vrijwilligers();

              }else if($this->pageName == "blog")
              {

                $Routing->blog();

              }else if($this->pageName == "nieuws")
              {

                 $Routing->nieuws();

              }else if($this->pageName == "smoelenboek")
              {

                 $Routing->smoelenBoek();

              }else if($this->pageName == "uitloggen")
              {

                 $Routing->loguit();

              }else if($this->pageName == "volledigeData")
              {

                 $Routing->volledigeData();

              }else if($this->pageName == "userManager")
              {

                 $Routing->userManager();

              }else if($this->pageName == "tabblad")
              {

                 $Routing->tabblad();

              }else if($this->pageName == "jaarOverzicht")
              {

                 $Routing->jaarOverzicht();

              }else if($this->pageName == "pdfs")
              {

                 $Routing->pdf();

              }else if($this->pageName == 'instellingen')
              {

                 $Routing->instellingen();

              }


         }else if($this->pageName == ""){

            $Routing->login();

         }else{

           echo "URL bestaat niet";

         }

      }

   }

 ?>
