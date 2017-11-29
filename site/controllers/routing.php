<?php

   require "../vrijwilliger/site/core/controller.php";

   class routing extends controller
   {

       public function __construct()
       {

           parent::__construct();

       }


       public function login()
       {

          $this->render("public","login");

       }


       public function vrijwilligers()
       {

          $this->render("private/sessions","vrijwilligers_session");

       }


       public function blog()
       {

          $this->render("private/sessions","blog_session");

       }


       public function nieuws()
       {

          $this->render("private/sessions","nieuws_session");

       }


       public function smoelenBoek()
       {

          $this->render("private/sessions","smoelenBoek_session");

       }


       public function loguit()
       {

          $this->render("public","loguit");

       }


       public function volledigeData()
       {

          $this->render("private","volledigeData");

       }


       public function userManager()
       {

           $this->render("private/sessions","userManager_session");

       }


       public function tabblad()
       {

           $this->render("private/sessions","tabblad_session");

       }


       public function jaarOverzicht()
       {

           $this->render("private/sessions","jaarOverzicht_session");

       }


       public function instellingen()
       {

           $this->render("private/sessions","userData_session");

       }


       public function pdf()
       {

           require "../vrijwilliger/site/models/ajax_requests/tabs/displayTab.php";

       }


   }

 ?>
