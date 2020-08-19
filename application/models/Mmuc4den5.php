<?php

class Mmuc4den5 extends MY_Model
{
    public function checkAccount($username)
    {
        $this->db->where('sUsername', $username);
        return $this->db->get('tbl_taikhoan')->row_array();
    }

	public function getAccount($username, $password)
	{
		$this->db->where('sUsername', $username);
		$this->db->where('sPassword', sha1($password));
		return $this->db->get('tbl_taikhoan')->row_array();
	}

	public function updatemuc4den5($info)
	{
		if ($info['PK_iMaKQTD']) {
			$this->db->where('PK_iMaKQTD',$info['PK_iMaKQTD']);
			$this->db->update('tbl_kqtd',$info);
		}
		else {
			$info['PK_iMaKQTD'] = time()%100000000 . rand(00,99);
			$this->db->insert('tbl_kqtd',$info);
		}
		return $this->db->affected_rows();
	}


	public function getKQTD($maungvien)
	{
		$this->db->where('FK_iMaUV',$maungvien);
		return $this->db->get('tbl_kqtd')->row_array();
	}
}