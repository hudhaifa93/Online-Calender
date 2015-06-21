<?php
/**
 * Created by PhpStorm.
 * User: gowtham
 * Date: 6/14/15
 * Time: 11:39 AM
 */

class Event_m extends CI_Model {

    function saveEvent(){}
    function updateEvent(){}
    function deleteEvent(){}
    function getEvent(){}

    function getMeetingById(){
        $id = $this->input->get('id');
        return $this->db->from('note')->where('id',$id)->get()->first_row();
    }

    function getAllMeeting(){
        //return $this->db->from('note')->get()->result();
        $memberId = $this->input->get('memberId');
        $type = $this->input->get('type');

        $this->db->select('n.*');

        $this->db->from('note n');

        $this->db->join('note_type nt', 'n.notetype = nt.id');

        $where = "n.createdby=$memberId AND nt.description='$type'";

        $this->db->where($where);


        //returns result objects array
        return $this->db->get()->result();



    }

    function insert(){

        //$d['HostName'] = $this->input->get('HostName');
        $d['subject'] = $this->input->post('Subject');
        $d['location'] = $this->input->post('Location');
        $d['startdate'] = $this->input->post('StartDate');
        $d['enddate'] = $this->input->post('EndDate');
        $d['description'] = $this->input->post('Description');

        return $this->db->insert('note',$d) ? true : false ;
    }

    function insertMember(){

        $d['firstname'] = $this->input->post('firstName');
        $d['lastname'] = $this->input->post('lastName');
        $d['status'] = "1";
        $d['email'] = $this->input->post('memberEmail');

        return $this->db->insert('member',$d) ? true : false ;
    }



    function update(){
        $d['asda'] = "";
        $this->db->where('id',1);
        return $this->db->update('note',$d) ? true : false ;
    }
} 