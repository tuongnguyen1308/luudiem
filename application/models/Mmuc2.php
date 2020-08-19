<?php

class Mmuc2 extends MY_Model
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

	public function updatemuc2($info,$data)
	{
		$this->db->trans_start();
		try {
			$row = 0;
			// if ($info['PK_iMaMuc2']) {
			// 	$this->db->where('PK_iMaMuc2',$info['PK_iMaMuc2']);
			// 	$this->db->update('tbl_muc2',$info);
			// }
			// else 
			// {
			// 	$info['PK_iMaMuc2'] = time()%100000000 . '99';
			// 	$this->db->insert('tbl_muc2',$info);
			// }

			$this->db->where('FK_iMaUV',$info['FK_iMaUV']);
			$this->db->update('tbl_kqtd',$data);
			$row += $this->db->affected_rows();
		}
		catch (Exception $e) {
			$row = 0;
		}
		$this->db->trans_complete();
		return $row;
	}
	public function addBang($info)
	{
		if ($info['PK_iMaMuc2']) {
			$this->db->where('PK_iMaMuc2',$info['PK_iMaMuc2']);
			$this->db->update('tbl_muc2',$info);
		}
		else {
			$info['PK_iMaMuc2'] = time()%100000000 . rand(00,98);
			$this->db->insert('tbl_muc2',$info);
		}
		return $this->db->affected_rows();
	}
	public function xoaBang($mabang)
	{
		$this->db->where('PK_iMaMuc2',$mabang);
		return $this->db->delete('tbl_muc2'); 
	}


	public function getMuc2($maungvien)
	{
		$this->db->where('FK_iMaUV',$maungvien);
		$this->db->order_by('sLoaiBang','asc');
		return $this->db->get('tbl_muc2')->result_array();
	}


}