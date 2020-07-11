<?php

class Modlogin extends CI_Model{

    public function ceklogin($username,$password){
        $this->db->select('*');
        $this->db->from('tbl_user');
        $this->db->where('username',$username);
        $this->db->where('password',$password);
        $query=$this->db->get();
        if($query->num_rows()>0){
            return $query->result();
        }else{
            return 0;
        }

    }



}