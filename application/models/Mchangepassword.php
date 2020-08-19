<?php

class Mchangepassword extends MY_Model
{
    public function checkOldPass($username, $password)
    {
        $this->db->where('sUsername', $username);
        $this->db->where('sPassword', sha1($password));
        return $this->db->get('tbl_taikhoan')->num_rows();
    }

    public function updatePassword($username, $newPass)
    {
        $this->db->where('sUsername', $username);
        $this->db->update('tbl_taikhoan', array('sPassword' => sha1($newPass)));
        return $this->db->affected_rows();
    }
}