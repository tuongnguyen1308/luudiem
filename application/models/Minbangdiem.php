<?php

class Minbangdiem extends MY_Model
{
    // public function checkAccount($username)
    // {
    //     $this->db->where('sUsername', $username);
    //     return $this->db->get('tbl_taikhoan')->row_array();
    // }

	// public function getAccount($username, $password)
	// {
	// 	$this->db->where('sUsername', $username);
	// 	$this->db->where('sPassword', sha1($password));
	// 	return $this->db->get('tbl_taikhoan')->row_array();
	// }
	public function getSV($masv)
	{
		$this->db->where('PK_iMaNhapHoc', $masv);
		$this->db->join('tbl_sinhvien','PK_iMaSV = FK_iMaSV', 'inner');
		$this->db->join('tbl_sinhvien_lop','PK_iMaNhapHoc = FK_iMaNhapHoc', 'inner');
		$this->db->join('tbl_lop_hanh_chinh','PK_iMaLop = FK_iMaLop', 'inner');
		$this->db->join('tbl_khoa','PK_iMaKhoa = tbl_nhaphoc.FK_iMaKhoa', 'inner');
		$this->db->join('tbl_donvi_ctdt','PK_iMaDVCTDT = FK_iMaDVCTDT', 'inner');
		$this->db->join('tbl_donvi','PK_iMaDonVi = FK_iMaDonVi', 'inner');
		$this->db->join('tbl_ctdt','PK_iMaCTDT = FK_iMaCTDT', 'inner');
		$this->db->join('tbl_nganh','PK_iMaNganh = FK_iMaNganh', 'inner');
		$this->db->join('tbl_bac','PK_iMaBac = FK_iMaBac', 'inner');
		$this->db->join('tbl_he','PK_iMaHe = FK_iMaHe', 'inner');
		$this->db->select('tbl_nhaphoc.*, sHo, sTen, dNgaySinh, sGioiTinh, sTenLop, iKhoa, sTenNganh, sTenBac, sTenHe, sTenDonVi, iKhoa');
		$res = $this->db->get('tbl_nhaphoc')->row_array();

		$this->db->where('FK_iMaNhapHoc', $masv);
		$this->db->join('tbl_mon_ctdt','PK_iMaMon_CTDT = FK_iMaMonCTDT', 'inner');
		$this->db->join('tbl_mon','PK_iMaMon = FK_iMaMon', 'inner');
		$this->db->order_by('iSTT','asc');
		$this->db->select('sTenMon, sTenMonTA, iSoTinChi, iDT10, sDTChu, iDT4');
		$res['diem'] = $this->db->get('tbl_diem')->result_array();
		// pr($res);
		return $res;
	}
	
}