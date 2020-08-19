<?php

class Mmuc3 extends MY_Model
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

	public function updatemuc3($info,$tongsonam)
	{
		//xoá data cũ
		$this->db->where('FK_iMaUV',$info['FK_iMaUV']);
		$this->db->delete('tbl_muc3');

		//insert data mới
		for ($i=0; $i < 6; $i++) { 
			$insert = array(
				'PK_iMaMuc3'	=> time()%100000000 . $i,
				'sNamHoc'		=> $info[$i][1],
				'iSoGioTrucTiep'=> $info[$i][2],
				'iSoGioChuan'	=> $info[$i][3],
				'sDanhGia'		=> $info[$i][4],
				'FK_iMaUV'		=> $info['FK_iMaUV'],
				'iSTT' => 	$i+1
			);
			$this->db->insert('tbl_muc3',$insert);
		}
		$insertTG = array(
			'sTongSoNam'		=> $tongsonam,
		);
		$this->db->where('FK_iMaUV',$info['FK_iMaUV']);
		$this->db->update('tbl_kqtd',$insertTG);
		return $this->db->affected_rows();
	}


	public function getMuc3($maungvien)
	{
		$this->db->where('FK_iMaUV',$maungvien);
		// $this->db->order_by('iTongSoTG','asc');
		$this->db->order_by('sNamHoc','asc');
		return $this->db->get('tbl_muc3')->result_array();
	}
	public function getTongSoNam($maungvien)
	{
		$this->db->select('sTongSoNam');
		$this->db->where('FK_iMaUV', $maungvien);		
		return $this->db->get('tbl_kqtd')->row_array();
	}
	// public function setLastLogin($maTK)
	// {
    //     $data = array(
    //         'sLanDangNhapCuoi' => date('d/m/Y H:i:s')
    //     );
	// 	$this->db->where('PK_iMaTK', $maTK);
	// 	$this->db->update('tbl_taikhoan', $data);
	// 	return $this->db->affected_rows();
	// }

	// public function checkPermission($userLevel, $route)
	// {
	// 	$this->db->where('sUrl', $route);
	// 	$this->db->where('PK_iMaQuyen', $userLevel);
	// 	$this->db->join('tbl_chucnang_quyen', 'tbl_chucnang_quyen.PK_iMaChucNang = tbl_chucnang.PK_iMaChucNang');
    //     $result =  $this->db->get('tbl_chucnang')->num_rows();
    //     return ($result > 0 ? true : false);
	// }
}