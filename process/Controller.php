<?php
/**
 * Created by PhpStorm.
 * User: Gowtham
 * Date: 7/11/15
 * Time: 12:21 PM
 */

class Controller {

    var $db = null;

    function __construct(){
        $this->db = new Database();
    }

    function post($name=""){
        if(isset($_POST[$name])){
            if(empty($_POST[$name])) return false;
            else return $_POST[$name] ;
        }
        return false;
    }

} 