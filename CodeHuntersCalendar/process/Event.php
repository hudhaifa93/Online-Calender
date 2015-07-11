<?php

class Event extends Controller {

    function __construct(){
        parent::__construct();
    }

    function insertBasicEvent(){
        $id = $this->db->query(" insert into note values(null,'". $_POST['subject']."','".$_POST['description']."','".$_POST['timeslotid']."','".$_POST['status']."','".$_POST['startdate']."','". $_POST['enddate']."','".$_POST['createddate']."','".$_POST['createdby']."','".$_POST['notetype']."','".$_POST['location']."') ");
        echo json_encode($id? array("success" => $this->db->last_id()) : array("failure" => "failure" ));
    }

    function getMonthlyEvents($start="",$end=""){
        $start = "2015-06-28";
        $end = "2015-07-25";
        $results = $this->db->query(" select * from note where `startdate` BETWEEN '$start' AND '$end'  order by startdate ");

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
        echo json_encode( $data );
    }



} 