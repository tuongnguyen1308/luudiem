<?php

class Mmuc1 extends MY_Model
{
  public function checkAccount($username)
  {
    $this->db->where('sUsername', $username);
    return $this->db->get('tbl_taikhoan')->row_array();
  }
	public function getInfo($mauv)
	{
		$this->db->where('PK_iMaUV', $mauv);
		return $this->db->get('tbl_thongtinungvien')->row_array();
	}
	public function getAccount($username, $password)
	{
		$this->db->where('sUsername', $username);
		$this->db->where('sPassword', sha1($password));
		return $this->db->get('tbl_taikhoan')->row_array();
	}

	public function updatemuc1($info)
	{
		foreach ($info as $key => $value) {
			if (is_array($value)) {
				$info[$key] = implode('|',$value);
			}
		}
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