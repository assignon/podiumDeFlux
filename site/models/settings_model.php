<?php

require "../vrijwilliger/site/core/model.php";

class settings extends model
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


}

 ?>
