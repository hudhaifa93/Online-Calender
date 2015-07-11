<?php

class Event extends Controller {

    function __construct(){
        parent::__construct();
    }

    function insertBasicEvent(){
        $id = $this->db->query(" insert into note values(null,'". $_POST['subject']."','".$_POST['description']."','".$_POST['timeslotid']."','".$_POST['status']."','".$_POST['startdate']."','". $_POST['enddate']."','".$_POST['createddate']."','".$_POST['createdby']."','".$_POST['notetype']."','".$_POST['location']."') ");
        echo json_encode($id? array("success" => $this->db->last_id()) : array("failure" => "failure" ));
    }

    function getMonthlyEvents(){

        $results = $this->db->query(" select * from note where `startdate` BETWEEN '".$this->post('start')."' AND '".$this->post('end')."'  order by startdate ");

        while( $row = $results->fetchObject() ){
            if(@$start != $row->startdate){
                if(isset($d)){
                    $data[] = array( 'date'=> $start ,'events' => $d );
                    unset($d);
                }
                $start = $row->startdate ;
            }
            $d[] = objectToArray($row) ;
        }
        $data[] = array( 'date'=> $start ,'events' => $d );
        echo json_encode( isset($data) ? $data : array() );
    }

    function validateLogin(){
        $hashPass = md5($_POST['loginPassword']);
       // echo "SELECT memberid FROM member_password_map WHERE username='".$_POST['loginUsername']."' and password='".$hashPass."'  ";
        $id = $this->db->query("SELECT memberid FROM member_password_map WHERE username='".$_POST['loginUsername']."' and password='".$hashPass."'  ");
        echo json_encode($id? array("success" => $this->db->fetchObject()->memberid) : array("failure" => "failure" ));
    }

    function createNewSignUp(){
        $hashPass = md5($_POST['inputpassword']);
        $result = $this->db->query(" insert into member values(null,'". $_POST['inputFirstname']."','".$_POST['inputLastname']."','1','0','0','". $_POST['inputEmail']."','')");

        if(is_object($result)){
            $id = $this->db->last_id();
            $result = $this->db->query(" insert into member_password_map values('".$id."','". $_POST['inputEmail']."','".$hashPass."','1')");
        }
        echo json_encode($result? array("success" => $id) : array("failure" => "failure" ));
    }


} 