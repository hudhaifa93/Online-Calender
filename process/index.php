<?php
/**
 * Created by PhpStorm.
 * User: Gowtham
 * Date: 7/11/15
 * Time: 8:53 AM
 */
 error_reporting(0);
 
 // url pattern domain.com/process/index.php?route="Class name"&method="Class Method name "
 // from submit using post method
 // example http://localhost/calendar/process/?route=Event&method=getEvent



if ( ! function_exists('objectToArray'))
{
    function objectToArray($d) {
        if (is_object($d)) {
            // Gets the properties of the given object
            // with get_object_vars function
            $d = get_object_vars($d);
        }

        if (is_array($d)) {
            /*
            * Return array converted to object
            * Using __FUNCTION__ (Magic constant)
            * for recursive call
            */
            return array_map(__FUNCTION__, $d);
        }
        else {
            // Return array
            return $d;
        }
    }
}


function __autoload($class_name) {
    include $class_name . '.php';
}

// get from GET method and save into $gat Object
$get = new stdClass();
foreach($_GET as $k => $v)
    $get->$k = $v ;

// get from POST method and save into $post Object
$post = new stdClass();
foreach($_POST as $k => $v)
    $post->$k = $v ;

if(file_exists("./{$get->route}.php")){
    require_once "./{$get->route}.php";

    $obj = new $get->route();

    if(is_callable(array($obj,$get->method))){
        call_user_func(array($obj,$get->method));
    }else{
        echo json_encode( array('error'=>"Method not found"));
    }

}else{
    echo json_encode( array('error'=>"Class not found"));
}

