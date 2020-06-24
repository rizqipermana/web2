<?php

class Modpropinsi extends CI_Model
{

       function __construct()
    {
     
    }

    public function read(){
        $query=$this->db->get('tbl_propinsi');
        if($query->num_rows()>0){
            return $query->result();
        }else{
            return 0;
        }
    }

}