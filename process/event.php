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

        $results = $this->db->query("  select * from `note` where
          (  `startdate` BETWEEN '".$this->post('start')."' AND '".$this->post('end')."'
          OR  ( DATE_FORMAT(`startdate`, '%m-%d') between DATE_FORMAT('".$this->post('start')."', '%m-%d') and DATE_FORMAT('".$this->post('end')."', '%m-%d') and `notetype` = 3 )
           )  AND `status` = 1 ORDER BY DATE_FORMAT(`startdate`, '%m-%d')  ");

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
        if(isset($start))
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

    function editBasicEvent(){

        $id = $this->db->query("UPDATE note SET subject='". $_POST['subject']."',description='".$_POST['description']."' WHERE id='".$_POST['id']."'");
        if(is_object($id)){
            echo json_encode($id? array("success" => $_POST['id']) : array("failure" => "failure" ));
        }
        else{
            echo json_encode($id? array("success" => "failure") : array("failure" => "failure" ));
        }

    }

    function deleteBasicEvent(){

        $id = $this->db->query("UPDATE note SET status='0' WHERE id='".$_POST['id']."'");
        if(is_object($id)){
            echo json_encode($id? array("success" => "Deleted") : array("failure" => "failure" ));
        }
        else{
            echo json_encode($id? array("success" => "failure") : array("failure" => "failure" ));
        }

    }

    function getCurrentEvent(){
        if($date = $this->post('date'))
        $result = $this->db->query("  select * from `note` where  DATE_FORMAT(startdate, '%m-%d')   = DATE_FORMAT('$date', '%m-%d')  ");
        echo json_encode($result);
    }

} 