<?php

class Mtonghop extends MY_Model
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
	public function getTongHop($maUngVien)
	{
		$this->db->where('FK_iMaUV', $maUngVien);
		$data = $this->db->get('tbl_tonghop')->row_array();
		return $data;
	}
	public function Explore($data, $col_name) {
		$res = null;
		if (!empty($data[$col_name])) {
			$res = explode('|', $data[$col_name]);
		}
		return $res;
	}
	public function updateTongHop($val)
	{
		$this->db->where('FK_iMaUV', $val['FK_iMaUV']);
		$this->db->update('tbl_tonghop', $val);
		return $this->db->affected_rows();
	}
	public function insertTongHop($val)
	{
		$this->db->insert('tbl_tonghop', $val);
		return $this->db->affected_rows();
	}
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