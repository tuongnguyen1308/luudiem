<?php

class Mmuc7 extends MY_Model
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

	public function updatemuc7($info)
	{
		if ($info['PK_iMaMuc7']) {
			$this->db->where('PK_iMaMuc7',$info['PK_iMaMuc7']);
			$this->db->update('tbl_muc7',$info);
		}
		else {
			$info['PK_iMaMuc7'] = time()%100000000 . rand(00,99);
			$this->db->insert('tbl_muc7',$info);
		}
		return $this->db->affected_rows();
	}


	public function getMuc7($maungvien)
	{
		$this->db->where('FK_iMaUV',$maungvien);
		return $this->db->get('tbl_muc7')->row_array();
	}
}