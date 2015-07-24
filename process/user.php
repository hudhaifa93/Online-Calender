<?php
/**
 * Created by PhpStorm.
 * User: Gowtham
 * Date: 7/18/15
 * Time: 11:55 AM
 */

class user extends controller {

    var $user = null;
    var $time;

    function __construct(){
        parent::__construct();
    }

    function validateLogin(){
        $hashPass = md5($_POST['loginPassword']);
        $this->db->query("SELECT memberid ,member.*  FROM member_password_map join member on member.id = member_password_map.memberid  WHERE username='".$_POST['loginUsername']."' and password='".$hashPass."'   ");
        $u = $this->db->fetchObject();
        if(is_object($u)){
            $user['id'] = $u->memberid ;
            $user['name'] = $u->firstname." ".$u->lastname ;
            $user['email'] = $u->email ;
            session::set('user',$user);
        }
        echo json_encode(is_object($u)? array("success" => $u->memberid) : array("failure" => "failure" ));
    }

    function createNewSignUp(){
        $hashPass = md5($_POST['inputpassword']);
        $result = $this->db->query(" insert into member values(null,'". $_POST['inputFirstname']."','".$_POST['inputLastname']."','1','0','0','". $_POST['inputEmail']."','')");

        if(is_object($result)){
            $id = $this->db->last_id();
            $result = $this->db->query(" insert into member_password_map values('".$id."','". $_POST['inputEmail']."','".$hashPass."','1')");
            $result = $this->db->query(" INSERT INTO `note_configuration` (`memberid`, `notetypeid`, `colorcode`) VALUES('".$id."', 1, 'bgm-lightblue'),('".$id."', 2, 'bgm-yellow'),('".$id."', 3, 'bgm-green')");
            $user['id'] = $id ;
            $user['email'] = $_POST['inputEmail'] ;
            $user['name'] = $_POST['inputFirstname']." ".$_POST['inputLastname'] ;
            session::set('user',$user);
        }
        echo json_encode($result? array("success" => $id) : array("failure" => "failure" ));
    }

    function isLogin(){
        if(is_null($this->user))
            return false;
        else
            return true;
    }

    function get($key){
        if(is_null($this->user) || strlen($key) < 1 )
            return null;
        else{
            $user = $this->user;
            if(isset($user[$key]))
                return $user[$key];
            else
                return null;
        }
    }

    function logout(){
        session::remove('user');
    }

    function checkEmail(){
        $this->db->query("select count(*) as id from member where email = '".$_POST['email']."'");
        $r = $this->db->fetchObject();
        echo $r->id ;
    }

} 