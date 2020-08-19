<?php

class Mlistsv extends MY_Model
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
	public function getDSSV($MaUyVien)
	{
		// $this->db->where('FK_iMaTK', $MaUyVien);
		// $this->db->join('dm_nganh','dm_nganh.PK_iMaNganh = tbl_thongtinSV.FK_iMaNganh', 'inner');
		$this->db->order_by('sTen', 'asc');
		return $this->db->get('tbl_sinhvien')->result_array();
	}
	public function deleteSV($MaUyVien)
	{
		$this->db->where('FK_iMaTK', $MaUyVien);
		$this->db->join('dm_nganh','dm_nganh.PK_iMaNganh = tbl_thongtinSV.FK_iMaNganh', 'inner');
		return $this->db->get('tbl_thongtinSV')->result_array();
	}
	public function importSV($new_sv)
	{
		$this->db->where('sMaSV',$new_sv['sMaSV']);
		$duplicate = $this->db->get('tbl_sinhvien')->result_array();
		if(!$duplicate) {
			$this->db->insert('tbl_sinhvien',$new_sv);
		}
		else {
			return -1;
		}
		if($this->db->affected_rows() > 0) {
			return $new_sv['PK_iMaSV'];
		}
		else {
			return 0;
		}
	}

	public function undoImportSV($list_ma_sv)
	{
		$res = 0;
		foreach ($list_ma_sv as $key => $value) {
			$this->db->where('FK_iMaSV', $value);
			$this->db->delete('tbl_diem');
			$res += $this->db->affected_rows();
			$this->db->where('PK_iMaSV', $value);
			$this->db->delete('tbl_sinhvien');
			$res += $this->db->affected_rows();
		}
		return $res;
	}

	public function ImportGrade($new_grade, $i)
	{
		$this->db->where('sMon',$new_grade['sMon']);
		$this->db->where('FK_iMaSV',$new_grade['FK_iMaSV']);
		$duplicate = $this->db->get('tbl_diem')->result_array();
		if(!$duplicate) {
			$rd = $i + time()%1000000000 . rand(000,999);
			$new_grade['PK_iMaDiem'] = $rd;
			$this->db->insert('tbl_diem',$new_grade);
		}
		else {
			return -3;
		}
		return $this->db->affected_rows();
	}
}