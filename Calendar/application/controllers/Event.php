<?php
/**
 * Created by PhpStorm.
 * User: gowtham
 * Date: 6/14/15
 * Time: 11:38 AM
 */

class Event extends CI_Controller {

    function __construct(){
        parent::__construct();
        $this->load->model('event_m','event');
    }
    function index(){

    }

    function login(){
        $this->load->view('login');
    }

    //main page modal
    function insertSimpleNote(){
        $id = $this->event->insertSimpleNote();
        echo json_encode($id? array("success" => $id) : array( "failure" => "failure" ) );
    }

    //note with advance options
    function addNote(){
        $this->load->view('addNote');
    }


    function addMember(){
        echo json_encode($this->event->insertMember()? array("success" => "success") : array( "failure" => "failure" ) );
    }

    function insertMeeting(){
        echo json_encode($this->event->insert()? array("success" => "success") : array( "failure" => "failure" ) );
    }

    function viewMeeting(){
        $this->load->view('ViewMeeting');
    }
    function getMeeting(){
        echo json_encode( $this->event->getMeetingById() );
    }

    function getAllMeeting(){
        echo json_encode( $this->event->getAllMeeting());
    }


    function validateLogin(){
        echo json_encode( $this->event->getLoginStatus('nf','123') );
    }
} 