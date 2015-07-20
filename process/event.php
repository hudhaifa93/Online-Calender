<?php

class Event extends Controller {

    function __construct(){
        parent::__construct();
    }

    function insertBasicEvent(){
        $id = $this->db->query(" insert into note values(null,'". $_POST['subject']."','".$_POST['description']."','".$_POST['timeslotid']."','".$_POST['status']."','".$_POST['startdate']."','". $_POST['enddate']."',0,0,'".$_POST['createddate']."','".$_POST['createdby']."','".$_POST['notetype']."','".$_POST['location']."','') ");
        echo json_encode($id? array("success" => $this->db->last_id()) : array("failure" => "failure" ));
    }

    function insertAdvanceEvent(){
      $locationid = $_POST['locationid'];
        if($locationid!="0"){//location is present
            $result = $this->db->query(" insert into address values(null,'". $_POST['street']."','".$_POST['city']."','". $_POST['state']."','". $_POST['country']."')");
            if(is_object($result)){
                $id = $this->db->last_id();

                $start = $_POST['startDate'];
                $end = $_POST['endDate'];
                if($end==""){
                    $end=$start;
                }

                 $result = $this->db->query(" insert into note values(null,'". $_POST['subject']."','".$_POST['description']."','".$_POST['timeslotid']."','".$_POST['status']."','".$start."','".$end."','".$_POST['starttime']."','".$_POST['endtime']."','".$_POST['createddate']."','".$_POST['createdby']."','".$_POST['notetype']."','".$id."','". $_POST['repeat']."') ");

                if(is_object($result))
                {
                    $id = $this->db->last_id();
                }
                else{
                    $this->db->query("DELETE FROM address WHERE id='$id'");
                }
            }
        }
        else{//location Not Present
            $start = $_POST['startDate'];
            $end = $_POST['endDate'];
            if($end==""){
                $end=$start;
            }

            $result = $this->db->query(" insert into note values(null,'". $_POST['subject']."','".$_POST['description']."','".$_POST['timeslotid']."','".$_POST['status']."','".$start."','".$end."','".$_POST['starttime']."','".$_POST['endtime']."','".$_POST['createddate']."','".$_POST['createdby']."','".$_POST['notetype']."','0','". $_POST['repeat']."') ");

            if(is_object($result))
            {
                $id = $this->db->last_id();

            }
        }
        echo json_encode($result? array("success" => $id) : array("failure" => "failure" ));

    }

    function updateAdvanceEvent(){

        $locationid = $_POST['locationid'];
        $locationflag  = $_POST['locationflag'];
        if($locationid=="0" && $locationflag=="N"){

            $result = $this->db->query(" insert into address values(null,'". $_POST['street']."','".$_POST['city']."','". $_POST['state']."','". $_POST['country']."')");
            if(is_object($result)){
                $id = $this->db->last_id();
                $result = $this->db->query("UPDATE note SET `repeat`='". $_POST['repeat']."',subject='". $_POST['subject']."',description='".$_POST['description']."',timeslotid='".$_POST['timeslotid']."',status='".$_POST['status']."',startdate='".$_POST['startDate']."',enddate='".$_POST['endDate']."',starttime='".$_POST['starttime']."',endtime='".$_POST['endtime']."',location='".$id."' WHERE id='".$_POST['noteid']."'");
            }
        }
        elseif ($locationid=="0" && $locationflag=="U"){

            $result = $this->db->query("UPDATE note SET `repeat`='". $_POST['repeat']."',subject='". $_POST['subject']."',description='".$_POST['description']."',timeslotid='".$_POST['timeslotid']."',status='".$_POST['status']."',startdate='".$_POST['startDate']."',enddate='".$_POST['endDate']."',starttime='".$_POST['starttime']."',endtime='".$_POST['endtime']."' WHERE id='".$_POST['noteid']."'");
            if(is_object($result)){
                $id = $_POST['noteid'];
            }
        }
        elseif($locationflag=="N"){
            $result = $this->db->query("UPDATE address SET street='". $_POST['street']."',city='".$_POST['city']."',state='".$_POST['state']."',country='".$_POST['country']."' WHERE id='$locationid'");
            if(is_object($result)){
                $result = $this->db->query("UPDATE note SET `repeat`='". $_POST['repeat']."',subject='". $_POST['subject']."',description='".$_POST['description']."',timeslotid='".$_POST['timeslotid']."',status='".$_POST['status']."',startdate='".$_POST['startDate']."',enddate='".$_POST['endDate']."',starttime='".$_POST['starttime']."',endtime='".$_POST['endtime']."' WHERE id='".$_POST['noteid']."'");
                if(is_object($result)){
                    $id = $_POST['noteid'];
                }
            }
        }
        elseif($locationflag=="U"){
            $result = $this->db->query("DELETE FROM address WHERE id='$locationid'");
            if(is_object($result)){
                $result = $this->db->query("UPDATE note SET `repeat`='". $_POST['repeat']."',subject='". $_POST['subject']."',description='".$_POST['description']."',timeslotid='".$_POST['timeslotid']."',status='".$_POST['status']."',startdate='".$_POST['startDate']."',enddate='".$_POST['endDate']."',starttime='".$_POST['starttime']."',endtime='".$_POST['endtime']."',location='0' WHERE id='".$_POST['noteid']."'");
                if(is_object($result)){
                    $id = $_POST['noteid'];
                }
            }
        }

        echo json_encode($result? array("success" => $id) : array("failure" => "failure" ));
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
        if($date = $this->post('date')){
            $result = $this->db->query(" select note.* ,concat(member.firstname , ' ' , member.lastname) as name  from `note` join member  on member.id = note.createdby WHERE  DATE_FORMAT(startdate, '%m-%d')   = DATE_FORMAT('$date', '%m-%d')  ");
            while($r = $result->fetchObject()){
                $d[] =  $r;
            }
        }
        $share = $this->shareEvent();
        if(is_array($d)){
            if(is_array($share))
                $d =array_merge($d,$share);
            echo json_encode($d);
        }else if(is_array($share))
            echo json_encode($share);
        else echo json_encode(array());
    }

    function getAdvanceEventData(){
        $id = $this->db->query("SELECT n.*,a.id as locationid,a.street,a.city,a.state,a.country FROM note n,address a WHERE n.id='".$_POST['id']."' and n.location = a.id");
        if(is_object($id))
        {
            while($r = $id->fetchObject()){
                $d[] =  $r;
            }
            echo json_encode($id? array("success" => json_encode($d?$d : array())) : array("failure" => "failure" ));
        }
        else{
            echo json_encode($id? array("success" => "No Data") : array("failure" => "failure" ));
        }
    }

    function getAllNotesByStartDateAndEndDate(){
        $results = $this->db->query("

        (
        SELECT * FROM `note` WHERE
        (
        (
        DATE_FORMAT(`startdate`,'%y,%m,%d') BETWEEN DATE_FORMAT('".$this->post('start')."','%y,%m,%d') AND DATE_FORMAT('".$this->post('end')."','%y,%m,%d')
        OR
        DATE_FORMAT(`enddate`,'%y,%m,%d') BETWEEN DATE_FORMAT('".$this->post('start')."','%y,%m,%d') AND DATE_FORMAT('".$this->post('end')."','%y,%m,%d')
        OR
        DATE_FORMAT('".$this->post('start')."','%y,%m,%d') BETWEEN DATE_FORMAT(`startdate`,'%y,%m,%d') AND DATE_FORMAT(`enddate`,'%y,%m,%d')
        OR
        DATE_FORMAT('".$this->post('end')."','%y,%m,%d') BETWEEN DATE_FORMAT(`startdate`,'%y,%m,%d') AND DATE_FORMAT(`enddate`,'%y,%m,%d')
        )
        OR
        (
        `notetype` In (3) AND DATE_FORMAT(`startdate`,'%m-%d') between DATE_FORMAT('".$this->post('start')."','%m-%d') AND  DATE_FORMAT('".$this->post('end')."','%m-%d')
        )
        )
        AND `status` = 1 AND  `repeat` = '' AND `createdby` IN( ".$this->post('MemberId').") ORDER BY `starttime` , `endtime`-`starttime`
        )

        union

        (
        SELECT * FROM `note`
        WHERE
        (
        DATE_FORMAT(`startdate`,'%m,%d') BETWEEN DATE_FORMAT('".$this->post('start')."','%m,%d') AND DATE_FORMAT('".$this->post('end')."','%m,%d')
        OR
        DATE_FORMAT(`enddate`,'%m,%d') BETWEEN DATE_FORMAT('".$this->post('start')."','%m,%d') AND DATE_FORMAT('".$this->post('end')."','%m,%d')
        OR
        DATE_FORMAT('".$this->post('start')."','%m,%d') BETWEEN DATE_FORMAT(`startdate`,'%m,%d') AND DATE_FORMAT(`enddate`,'%m,%d')
        OR
        DATE_FORMAT('".$this->post('end')."','%m,%d') BETWEEN DATE_FORMAT(`startdate`,'%m,%d') AND DATE_FORMAT(`enddate`,'%m,%d')
        )
        AND `status` = 1 AND  `repeat` = 'Y' AND `createdby` IN(".$this->post('MemberId').") ORDER BY `starttime` , `endtime`-`starttime`
        )

        union

        (
        SELECT * FROM `note`
        WHERE
        (
        DATE_FORMAT(`startdate`,'%d') BETWEEN DATE_FORMAT('".$this->post('start')."','%d') AND DATE_FORMAT('".$this->post('end')."','%d')
        OR
        DATE_FORMAT(`enddate`,'%d') BETWEEN DATE_FORMAT('".$this->post('start')."','%d') AND DATE_FORMAT('".$this->post('end')."','%d')
        OR
        DATE_FORMAT('".$this->post('start')."','%d') BETWEEN DATE_FORMAT(`startdate`,'%d') AND DATE_FORMAT(`enddate`,'%d')
        OR
        DATE_FORMAT('".$this->post('end')."','%d') BETWEEN DATE_FORMAT(`startdate`,'%d') AND DATE_FORMAT(`enddate`,'%d')
        )
        AND `status` = 1 AND  `repeat` = 'M' AND `createdby` IN(".$this->post('MemberId').") ORDER BY `starttime` , `endtime`-`starttime`
        )

        union

        (
        SELECT * FROM `note`
        WHERE
        (
        DATE_FORMAT(`startdate`,'%y,%m,%d') BETWEEN DATE_FORMAT('".$this->post('start')."','%W') AND DATE_FORMAT('".$this->post('end')."','%W')
        OR
        DATE_FORMAT(`enddate`,'%W') BETWEEN DATE_FORMAT('".$this->post('start')."','%W') AND DATE_FORMAT('".$this->post('end')."','%W')
        OR
        DATE_FORMAT('".$this->post('start')."','%W') BETWEEN DATE_FORMAT(`startdate`,'%W') AND DATE_FORMAT(`enddate`,'%W')
        OR
        DATE_FORMAT('".$this->post('end')."','%W') BETWEEN DATE_FORMAT(`startdate`,'%W') AND DATE_FORMAT(`enddate`,'%W')
        )
        AND `status` = 1 AND  `repeat` = 'W' AND `createdby` IN(".$this->post('MemberId').") ORDER BY `starttime` , `endtime`-`starttime`
        )

        ");

        while($r = $results->fetchObject()){
            $d[] =  $r;
        }

        echo json_encode($d?$d : array());

    }

    function inviteMembers(){

        $inviteList = $this->post('inviteArray');
        $noteid=$inviteList[0][noteid];
        $result = $this->db->query("DELETE FROM note_invitee_map WHERE noteid='$noteid'");
        if(is_object($result)){
            foreach ($inviteList as &$value) {
                $result = $this->db->query(" insert into note_invitee_map values('".$value[noteid]."','".$value[email]."','".$value[status]."')");
            }
        }

        echo json_encode($result? array("success" => "success") : array("failure" => "failure" ));

    }

    function getinvitebynoteid(){
        //print_r($_POST['noteid']);
        $result = $this->db->query("SELECT * FROM note_invitee_map where noteid='".$_POST['noteid']."'");
        //print_r($result);
        if(is_object($result))
        {
            while($r = $result->fetchObject()){
                $d[] =  $r;
            }

            echo json_encode($result? array("success" => json_encode($d?$d : array())) : array("failure" => "failure" ));
        }
        else{
            echo json_encode($result? array("success" => "No Data") : array("failure" => "failure" ));
        }
    }

    function share(){
        if(strlen($this->post('email')) > 0 ){
            $email = explode(',',$this->post('email'));
            $id = $this->post('id');
            $type = $this->post('type');
            foreach($email as $k => $e){
                if($k != 0 ) $mail .= ",";
                $mail .= "'$e'";
            }
            $q = "INSERT INTO share_note
            SELECT id AS member_id, $id AS event_id, ( SELECT  `createdby` FROM note WHERE id =$id) AS shared_id, 0 AS status FROM member
            WHERE email IN ($mail)";
            echo $q;
           echo json_encode($this->db->query($q) ? array('success'=>true) : array('success'=>false) );

        }
        echo json_encode(array('success'=>false));
    }

    function shareEvent(){
        $u = session::get('user');
        $result=$this->db->query(" select note.* ,concat(member.firstname , ' ' , member.lastname) as name   from share_note left outer join note on share_note.event_id = note.id left outer join member on share_note.shared_id = member.id
        where member_id = {$u['id']} and share_note.`status` = 0");
        while( $r =$result->fetchObject()){
            $d[] = $r;
        }
        return $d;
        //echo json_encode($d?$d : array());
    }

    function setSharedMemberIds(){
        $sharedMembersList = $this->post('sharedMembersList');
        $memberId=$sharedMembersList[0][memberid];
        //$sharedMembersList = $this->post('sharedmemberslist');
        //$memberId = $this->post('memberid');
        $result = $this->db->query("DELETE FROM shared_calendar WHERE memberid='$memberId'");
        if(is_object($result)){
            foreach ($sharedMembersList as &$value) {
                $result = $this->db->query("INSERT INTO shared_calendar values('".$memberId."','".$value[sharedmemberemail]."','".$value[status]."')");
            }
        }
        echo json_encode($result? array("success" => "success") : array("failure" => "failure" ));
    }

    function getSharedMemberIds(){
        $result = $this->db->query("SELECT * FROM shared_calendar where memberid='".$_POST['memberid']."'");
        if(is_object($result))
        {
            while($r = $result->fetchObject()){
                $d[] =  $r;
            }
            echo json_encode($result? array("success" => json_encode($d?$d : array())) : array("failure" => "failure" ));
        }
        else{
            echo json_encode($result? array("success" => "No Data") : array("failure" => "failure" ));
        }
    }

}
/*
$email = new email();
$email->from('from address');
$email->to('to addrss');
$email->subject('subject');
$email->message('message body');
$email->send();
*/
