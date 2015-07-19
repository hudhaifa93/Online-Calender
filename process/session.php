<?php
/**
 * Created by PhpStorm.
 * User: Gowtham
 * Date: 7/18/15
 * Time: 11:56 AM
 */

class session {

    static function start(){
        if(!isset($_SESSION)){
            session_start();
            $_SESSION['time'] = time();
        }
        if(isset($_SESSION['time']) && ( ($_SESSION['time'] + 86400) < time() ) ){
            session_destroy();
        }
    }

    static function set($key=null,$value=null){
        self::start();
        if(!is_null($value) && !is_null($key) ){
            $_SESSION[$key] = $value;
        }
    }

    static function remove($key){
        self::start();
        if(isset($_SESSION[$key]))
            return session_unset($_SESSION[$key]) ;
        else
            return false;
    }

    static function get($key){
        self::start();
        if(isset($_SESSION[$key]))
            return $_SESSION[$key] ;
        else
            return false;
    }

    static function destroy(){
        self::remove('user');
        session_destroy();
    }

} 