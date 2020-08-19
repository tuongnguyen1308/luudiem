<?php

class Mmuc6 extends MY_Model
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

	public function updatemuc6($info,$data)
	{
		$this->db->trans_start();
		try {
			$row = 0;
			// if ($info['PK_iMaSach']) {
			// 	$this->db->where('PK_iMaSach',$info['PK_iMaSach']);
			// 	$this->db->update('tbl_sach',$info);
			// }
			// else 
			// {
			// 	$info['PK_iMaSach'] = time()%100000000 . '99';
			// 	$this->db->insert('tbl_sach',$info);
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
	public function addSach($info)
	{
		if ($info['PK_iMaSach']) {
			$this->db->where('PK_iMaSach',$info['PK_iMaSach']);
			$this->db->update('tbl_sach',$info);
		}
		else {
			$info['PK_iMaSach'] = time()%100000000 . rand(00,98);
			$this->db->insert('tbl_sach',$info);
		}
		return $this->db->affected_rows();
	}
	public function xoaSach($masach)
	{
		$this->db->where('PK_iMaSach',$masach);
		return $this->db->delete('tbl_sach'); 
	}

	public function getSach($maungvien)
	{
		$this->db->where('FK_iMaUV',$maungvien);
		$this->db->where('iSoLuongBBUyTinSauPGS', null);
		$listLS = array(
			'ck' => 'Sách chuyên khảo',
			'cs' => 'Chương sách do NXB uy tín thế giới xuất bản',
			'gt' => 'Giáo trình',
			'tk' => 'Sách tham khảo',
			'hd' => 'Sách hướng dẫn',
		);
		$listVT = array(
			'mm'	=> 'Viết một mình',
			'cb'	=> 'Chủ biên',
			'vc'	=> 'Viết chung',
			'cbtg'	=> 'Vừa chủ biên vưa tham gia'
		);
		$res = $this->db->get('tbl_sach')->result_array();
		foreach ($res as $key => $value) {
			$res[$key]['sLoaiSachFull'] = $listLS[$value['sLoaiSach']];
			$res[$key]['sVaiTroFull'] = $listVT[$value['sVaiTro']];
		}
		return $res;
	}

	public function getMuc6($maungvien)
	{
		$this->db->where('FK_iMaUV',$maungvien);
		$this->db->where('iSoLuongBBUyTinSauPGS !=', null);
		return $this->db->get('tbl_sach')->row_array();
	}
	public function getTongSach($maungvien)
	{
		$this->db->where('FK_iMaUV',$maungvien);
		$this->db->select('iSoDiem,iDiemBaNamCuoi,iSoLuongBBUyTinSauPGS');
		return $this->db->get('tbl_kqtd')->row_array();
	}


}