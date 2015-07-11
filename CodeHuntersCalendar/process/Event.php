<?php
/**
 * Created by PhpStorm.
 * User: Gowtham
 * Date: 7/11/15
 * Time: 9:07 AM
 */

class Event extends Controller {

    function __construct(){
        parent::__construct();
    }

    function getEvent(){
        $result = $this->db->query(" insert into note values(null,'','','','','','','','','','') ");
      if($result){

          echo "success";
      }else
          echo "failure";

    }

} 