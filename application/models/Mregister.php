<?php

class Mregister extends MY_Model
{

    public function checkIssetAccount($email){
        $this->db->where('sUsername', $email);
        $row = $this->db->get('tbl_taikhoan')->num_rows();
        return ($row > 0 ? true : false);
    }

    public function insertAccount($arrTK){
        $this->db->trans_start();
        $this->db->insert('tbl_taikhoan', $arrTK);
        $this->db->trans_complete();
        return $this->db->trans_status();
    }
}