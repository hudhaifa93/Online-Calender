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
        $result = $this->db->query("   SELECT * FROM  `note`  ");
        //$r = $result->fetchAll();
        echo "<pre>";
        while ($row = $this->db->fetchObject($result) ){

            print_r($row);
        }
        echo "</pre>";
    }

} 