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

    function insertBasicEvent(){
       // print_r($_POST);
        $id = $this->db->query(" insert into note values(null,'". $_POST['subject']."','".$_POST['description']."','".$_POST['timeslotid']."','".$_POST['status']."','".$_POST['startdate']."','". $_POST['enddate']."','".$_POST['createddate']."','".$_POST['createdby']."','".$_POST['notetype']."','".$_POST['location']."') ");
        echo json_encode($id? array("success" => $this->db->last_id()) : array("failure" => "failure" ));

    }

    function getEvent(){
        $result = $this->db->query(" insert into note values(null,'','','','','','','','','','') ");
      if($result){
          echo $this->db->last_id();
          echo "success";
      }else
          echo "failure";

    }

} 