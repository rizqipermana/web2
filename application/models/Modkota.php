<?php

class Modkota extends CI_Model
{

       function __construct()
    {
     
    }

    public function getid($id_propinsi){
        $this->db->from('tbl_kota');
        $this->db->where('id_propinsi',$id_propinsi);
        $query=$this->db->get();
        if($query->num_rows()>0){
            return $query->result();
        }else{
            return 0;
        }
        
    }
}