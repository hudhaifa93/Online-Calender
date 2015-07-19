<?php
/**
 * Created by PhpStorm.
 * User: Gowtham
 * Date: 7/18/15
 * Time: 3:45 PM
 */

include 'process/session.php';

if(session::get('user')){
    include 'Calendar.php';
    exit(0);
}else{
    include 'login.html';
    exit(0);
}