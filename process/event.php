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
            $result = $this->db->query(" insert into address values(null,'". $_POST['street']."','".$_POST['city']."','". $_POST['state']."','". $_POST['country']."','". $_POST['longitude']."','". $_POST['latitude']."')");
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

            $result = $this->db->query(" insert into address values(null,'". $_POST['street']."','".$_POST['city']."','". $_POST['state']."','". $_POST['country']."','". $_POST['longitude']."','". $_POST['latitude']."')");
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
            $result = $this->db->query("UPDATE address SET street='". $_POST['street']."',city='".$_POST['city']."',state='".$_POST['state']."',country='".$_POST['country']."',longitude='". $_POST['longitude']."',latitude='". $_POST['latitude']."' WHERE id='$locationid'");
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
            $user = session::get('user');
            $result = $this->db->query(" select note.* ,concat(member.firstname , ' ' , member.lastname) as name  from `note` join member  on member.id = note.createdby WHERE  DATE_FORMAT(startdate, '%m-%d')   = DATE_FORMAT('$date', '%m-%d') AND  member.id = ".$user['id']);
            while($r = $result->fetchObject()){
                $d1[] =  $r;
            }
        }
        $d2 = $this->shareEvent();
        $d3 = $this->sharedCalendar();
        $d4 = $this->inviteNoteRequest();
        $a = array();
        if(isset($d1))
            $a = array_merge($a,$d1);
        if(!empty($d2))
            $a = array_merge($a,$d2);
        if(!empty($d3))
            $a = array_merge($a,$d3);
        if(!empty($d4))
            $a = array_merge($a,$d4);

       echo json_encode($a) ;
    }

    function getAdvanceEventData(){
        $id = $this->db->query("SELECT n.*,a.id as locationid,a.street,a.city,a.state,a.country,a.longitude,a.latitude FROM note n,address a WHERE n.id='".$_POST['id']."' and n.location = a.id");
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
        AND `status` = 1 AND  `repeat` = '' AND `createdby` IN( ".$_POST['MemberId'].") ORDER BY `starttime` , `endtime`-`starttime`
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
        AND `status` = 1 AND  `repeat` = 'Y' AND `createdby` IN(".$_POST['MemberId'].") ORDER BY `starttime` , `endtime`-`starttime`
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
        AND `status` = 1 AND  `repeat` = 'M' AND `createdby` IN(".$_POST['MemberId'].") ORDER BY `starttime` , `endtime`-`starttime`
        )

        union

        (
        SELECT * FROM `note`
        WHERE
        (
        ( DATE_FORMAT('".$this->post('start')."','%d') = DATE_FORMAT('".$this->post('end')."','%d') AND DATE_FORMAT('".$this->post('start')."','%w') = DATE_FORMAT(`startdate`,'%w') )
        OR
        ( DATE_FORMAT('".$this->post('start')."','%d') != DATE_FORMAT('".$this->post('end')."','%d') )
        )
        AND `status` = 1 AND  `repeat` = 'W' AND `createdby` IN(".$_POST['MemberId'].") ORDER BY `starttime` , `endtime`-`starttime`
        )

        UNION

        (
        SELECT * FROM `note`
        WHERE
        (
        ( DATE_FORMAT('".$this->post('start')."','%y,%m,%d') = DATE_FORMAT('".$this->post('end')."','%y,%m,%d') AND DATE_FORMAT('".$this->post('start')."','%y,%m,%d') = DATE_FORMAT(`startdate`,'%y,%m,%d') )
        OR
        ( DATE_FORMAT('".$this->post('start')."','%y,%m,%d') != DATE_FORMAT('".$this->post('end')."','%y,%m,%d') )
        )
        AND
        `id` IN(SELECT `noteid` FROM `note_invitee_map` WHERE `status`=1 AND `email` IN(SELECT `email` FROM `member` WHERE id IN(".$_POST['MemberId'].")))
        )


        ");


        while($r = $results->fetchObject()){
            $d[] =  $r;
        }

        echo json_encode($d?$d : array());

    }

    function inviteMembers(){
        $mail = new email();
        $mail->From = 'gowthammailvaganam@gmail.com';

        $inviteList = $this->post('inviteArray');
        $noteid=$inviteList[0]['noteid'];
        $result = $this->db->query("DELETE FROM note_invitee_map WHERE noteid='$noteid'");
        if(is_object($result)){
            foreach ($inviteList as &$value) {
                $result = $this->db->query(" insert into note_invitee_map values('".$value['noteid']."','".$value['email']."','".$value['status']."')");
                $mail->addAddress($value['email']);
            }
        }

        $this->db->query("select note.* , member.firstname , member.lastname , note_type.description as note_type from note join member on note.createdby = member.id  join note_type on note_type.id = note.notetype where note.id = 1");
        $res = $this->db->fetchObject();

        $mail->isHTML(true);
        $mail->Subject = "CodeHuntersCalendar Share ".$res->note_type ;

        ob_start();
        include "mail_template/share.php";
        $mge = ob_get_contents();
        ob_clean();

        $mail->Body    =$mge;
        $mail->send();

        echo json_encode($result? array("success" => "success") : array("failure" => "failure" ));

    }

    function deleteinviteMembers(){
        $deleteinvite = $this->post('deleteinvite');
        $noteid=$deleteinvite[0]['noteid'];
        $memberEmail = $deleteinvite[0]['memberemail'];
        $result = $this->db->query("UPDATE `note_invitee_map` SET `status`='3' WHERE `email`= '".$memberEmail."' and `noteid`='".$noteid."' ");
        echo json_encode($result? array("success" => "success") : array("failure" => "failure" ));
    }

    function getinvitebynoteid(){
        $result = $this->db->query("SELECT * FROM note_invitee_map where noteid='".$_POST['noteid']."' and `status` IN (0,1)");
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
        $mail = new email();
        $mail->From = 'gowthammailvaganam@gmail.com';

        $email = $this->post('email');
        if(!empty($email) ){
            $id = $this->post('id');
            $type = $this->post('type');
            foreach($email as $k => $e){
                $mail->addAddress($e);
                if($k != 0 ) $m .= ",";
                $m .= "'$e'";
            }
            $q = "INSERT INTO share_note
            SELECT id AS member_id, $id AS event_id, ( SELECT  `createdby` FROM note WHERE id =$id) AS shared_id, 0 AS status FROM member
            WHERE email IN ($m)";
            echo json_encode($this->db->query($q) ? array('success'=>true) : array('success'=>false) );

            $this->db->query("select note.* , member.firstname , member.lastname , note_type.description as note_type from note join member on note.createdby = member.id  join note_type on note_type.id = note.notetype where note.id = $id");
            $res = $this->db->fetchObject();

            $mail->isHTML(true);
            $mail->Subject = "CodeHuntersCalendar Share ".$res->note_type ;

            ob_start();
            include "mail_template/share.php";
            $mge = ob_get_contents();
            ob_clean();

            $mail->Body    =$mge;
            $mail->send();

        }else
        echo json_encode(array('success'=>false));
    }

    function shareEvent(){
        $u = session::get('user');
        $result=$this->db->query(" select note.* ,concat(member.firstname , ' ' , member.lastname) as name   from share_note left outer join note on share_note.event_id = note.id left outer join member on share_note.shared_id = member.id
        where member_id = {$u['id']} and share_note.`status` = 0");
        while( $r =$result->fetchObject()){
            $r->share = 3;
            $r->member_id = $u['id'];
            $d[] = $r;
        }
        return $d;
        //echo json_encode($d?$d : array());
    }

    function setSharedMemberIds(){
        $sharedMembersList = $this->post('sharedMembersList');
        $memberId=$sharedMembersList[0]['memberid'];
        $result = $this->db->query("DELETE FROM shared_calendar WHERE memberid='$memberId'");
        if(is_object($result)){
            foreach ($sharedMembersList as &$value) {
                $result = $this->db->query("INSERT INTO shared_calendar values('".$memberId."','".$value['sharedmemberemail']."','".$value['status']."')");
            }
        }
        echo json_encode($result? array("success" => "success") : array("failure" => "failure" ));
    }

    function getSharedMemberIds(){
        $result = $this->db->query("SELECT * FROM shared_calendar where memberid='".$_POST['memberid']."' and `status` IN (0,1)");
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

    function deleteSharedCalendar(){
        $sharedMembersList = $this->post('sharedMembersList');
        $memberId=$sharedMembersList[0]['memberid'];
        $memberEmail = $sharedMembersList[0]['sharedmemberemail'];
        $result = $this->db->query("UPDATE `shared_calendar` SET `status`='3' WHERE `sharedmemberemail`= '".$memberEmail."' and `memberid`='".$memberId."' ");
        echo json_encode($result? array("success" => "success") : array("failure" => "failure" ));
    }

    function getSharedMemberDetailsByMemberId(){
        $result = $this->db->query("SELECT * FROM `member` WHERE `id` IN(SELECT memberid FROM shared_calendar where status=1 AND sharedmemberemail = (SELECT `email` FROM `member` WHERE id='".$_POST['memberid']."'))  ");
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

    function getAllBirthDaysByMemberId(){
        $results = $this->db->query("SELECT * FROM `note` WHERE `notetype`=3 AND `status`= 1 AND `createdby` IN(".$this->post('MemberId').") ");
        while($r = $results->fetchObject()){
            $d[] =  $r;
        }
        echo json_encode($d?$d : array());
    }

    function sharedCalendar(){
        $user = session::get('user');
        $this->db->query("select member.id , CONCAT(member.firstname ,' ', member.lastname) as name from shared_calendar join member on shared_calendar.memberid = member.id where sharedmemberemail='".$user['email']."' and shared_calendar.status = 0  ");
        while($r = $this->db->fetchObject()){
            $r->share = 1 ;
            $r->subject = $r->name.' shared is calendar' ;
            $d[] = $r;
        }

        return isset($d)?$d : array();
    }

    function inviteNoteRequest(){
        $user = session::get('user');
        $this->db->query("select  CONCAT(member.firstname ,' ', member.lastname) as name , note.*  , note_type.description from note_invitee_map
                    join note on  note_invitee_map.noteid = note.id
                    join member on note.createdby = member.id
                    join note_type on note.notetype = note_type.id
                    where note_invitee_map.email='".$user['email']."' and note_invitee_map.status = 0  ");

        while($r = $this->db->fetchObject()){
            $r->share = 2 ;
            $r->subject = $r->name.' invite '.$r->description ;
            $d[] = $r;
        }

        return isset($d)?$d : array();
    }

    function updateSharedCalendar(){
        $user = session::get('user');
        $this->db->query("UPDATE `shared_calendar` SET `status`='".$_POST['val']."' WHERE `sharedmemberemail`= '".$user['email']."' and `memberid`='".$_POST['memberid']."' ");
        if($_POST['val'] == 1){

        }
    }

    function updateInviteRequest(){
        $user = session::get('user');
        $this->db->query("UPDATE `note_invitee_map` SET `status`='".$_POST['val']."' WHERE `email`= '".$user['email']."' and `noteid`='".$_POST['noteid']."' ");
    }

    function search(){
        $this->db->query("select note.* , member.firstname , member.lastname from note join member on note.createdby = member.id where createdby in (".$_POST['memberid'].") and note.status=1 and ( subject like '".$_GET['str']."%' OR description like '".$_GET['str']."%' )");
        while($r = $this->db->fetchObject())
            $d[] = $r;
        echo json_encode($d?$d : array());
    }

    function getNoteConfigurationByMemberId(){
        $results = $this->db->query("SELECT * FROM `note_configuration` WHERE memberid=".$this->post('MemberId')."");
        while($r = $results->fetchObject()){
            $d[] =  $r;
        }
        echo json_encode($d?$d : array());
    }

    function saveNoteConfiguration(){
        $this->db->query("UPDATE `note_configuration` SET `colorcode`='".$_POST['meeting']."' WHERE `memberid` = '".$_POST['memberId']."' AND `notetypeid` = '1'");
        $this->db->query("UPDATE `note_configuration` SET `colorcode`='".$_POST['note']."' WHERE `memberid` = '".$_POST['memberId']."' AND `notetypeid` = '2'");
        $this->db->query("UPDATE `note_configuration` SET `colorcode`='".$_POST['birthday']."' WHERE `memberid` = '".$_POST['memberId']."' AND `notetypeid` = '3'");
        echo json_encode(array('success'=>1));
    }

    function updateBirthday(){
//    print_r($_POST);
        $id = $this->db->query("UPDATE note SET subject='". $_POST['subject']."',startdate='".$_POST['date']."',enddate='".$_POST['date']."' WHERE id='".$_POST['id']."'");
        if(is_object($id)){
            echo json_encode($id? array("success" => $_POST['id']) : array("failure" => "failure" ));
        }
        else{
            echo json_encode($id? array("success" => "failure") : array("failure" => "failure" ));
        }
    }

    function updateEventShared(){
        $user = session::get('user');
        if($_POST['val'] == 1){
            $this->db->query("select * from note where id = ".$_POST['noteid']);
            $r = $this->db->fetchObject();
            $this->db->query("INSERT INTO `note`
            (`id`, `subject`, `description`, `timeslotid`, `status`, `startdate`, `enddate`, `starttime`, `endtime`, `createddate`, `createdby`, `notetype`, `location`, `repeat`)
             VALUES (null,'$r->subject','$r->description','$r->timeslotid','$r->status','$r->startdate','$r->enddate','$r->starttime','$r->endtime','$r->createddate','".$user['id']."','$r->notetype','$r->location','$r->repeat')");
        }

        $this->db->query("update share_note set status= ".$_POST['val']." where member_id = ".$user['id']." and event_id = ".$_POST['noteid'] ." and  shared_id = ".$_POST['shared_id'] );
    }
}
