<?php
/**
 * Created by PhpStorm.
 * User: gowtham
 * Date: 6/14/15
 * Time: 11:38 AM
 */

class Home extends CI_Controller {

    function __construct(){
        parent::__construct();
        $this->load->model('main','main');
    }
    function index(){

        $this->load->view('index');

    }
    function AddMeeting(){

        $this->load->view('AddMeeting');

    }

    function month(){
        $this->load->view('month');
    }



} 