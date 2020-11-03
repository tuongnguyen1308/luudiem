<?php

class Mdssv extends MY_Model
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

	public function countPage($conditional, $keyword)
	{
		if ($keyword) {
			$this->db->like('PK_iMaNhapHoc', $keyword);
			$this->db->or_like('concat(sHo," ",sTen)', $keyword);
			$this->db->or_like('PK_iMaNhapHoc', $keyword);
		}
		if ($conditional) {
			$this->db->where($conditional);
		}
		// pr($conditional);
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
		$this->db->order_by('iKhoa desc, sTenLop asc, sTen asc, sHo asc');
		$this->db->select('PK_iMaNhapHoc, sGDTC, sGDQP, sCDRNN, sXLRenLuyen, sTBCTL, iSoTCTL, iSoTCConNo, sXepLoaiTotNghiep, sSoQuyetDinhTotNghiep, dNgayQuyetDinhTotNghiep, sSoQuyetDinhDauVao, dNgayQuyetDinhDauVao, iSoHocPhanThiLai, sHo, sTen, dNgaySinh, sGioiTinh, sTenLop, iKhoa');
		$data	= $this->db->get('tbl_nhaphoc')->result_array();
		$res	= floor(count($data)/10);
		if (count($data)%10 > 0) $res++;
		return $res;
	}
	
	public function getDSSVIn($conditional = '', $keyword = '', $present_page = 1)
	{
		// pr($conditional);
		$this->db->limit(10, ($present_page-1)*10);
		if ($keyword) {
			$this->db->like('PK_iMaNhapHoc', $keyword);
			$this->db->or_like('concat(sHo," ",sTen)', $keyword);
			$this->db->or_like('PK_iMaNhapHoc', $keyword);
		}
		if ($conditional) {
			$this->db->where($conditional);
		}
		// pr($conditional);
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
		$this->db->order_by('iKhoa desc, sTenLop asc, sTen asc, sHo asc');
		$this->db->select('PK_iMaNhapHoc, PK_iMaSVLop, PK_iMaSV, sGDTC, sGDQP, sCDRNN, sXLRenLuyen, sTBCTL, iSoTCTL, iSoTCConNo, sXepLoaiTotNghiep, sSoQuyetDinhTotNghiep, dNgayQuyetDinhTotNghiep, sSoQuyetDinhDauVao, dNgayQuyetDinhDauVao, iSoHocPhanThiLai, sHo, sTen, dNgaySinh, sGioiTinh, sTenLop, iKhoa');
		$res = $this->db->get('tbl_nhaphoc')->result_array();
		// pr($res);
		foreach ($res as $key => $value) {
			$this->db->where('FK_iMaSVLop', $value['PK_iMaSVLop']);
			$this->db->join('tbl_mon_ctdt','PK_iMaMon_CTDT = FK_iMaMonCTDT', 'inner');
			$this->db->join('tbl_mon','PK_iMaMon = FK_iMaMon', 'inner');
			$this->db->order_by('iSTT','asc');
			$res[$key]['diem'] = $this->db->get('tbl_diem')->result_array();
		}
		return $res;
	}

	public function getList($table_name)
	{
		return $this->db->get($table_name)->result_array();
	}
	
	public function getNamHoc($conditional)
	{
		$this->db->where($conditional);
		// $this->db->order_by('sNam', 'asc');
		return $this->db->get('tbl_ctdt')->result_array();
	}
	public function getDonVi($conditional)
	{
		$this->db->where($conditional);
		$this->db->join('tbl_ctdt','PK_iMaCTDT = FK_iMaCTDT', 'inner');
		$this->db->join('tbl_donvi','PK_iMaDonVi = FK_iMaDonVi', 'inner');
		$this->db->order_by('sTenDonVi', 'asc');
		return $this->db->get('tbl_donvi_ctdt')->result_array();
	}
	public function getKhoaHoc($conditional)
	{
		$this->db->where('FK_iMaDVCTDT', $conditional);
		$this->db->order_by('iKhoa', 'desc');
		return $this->db->get('tbl_khoa')->result_array();
	}
	public function delSV($sv)
	{
		$res = 0;
		$this->db->where('FK_iMaSVLop', $sv['PK_iMaSVLop']);
		$this->db->delete('tbl_diem');
		$res += $this->db->affected_rows();
		$this->db->where('PK_iMaSVLop', $sv['PK_iMaSVLop']);
		$this->db->delete('tbl_sinhvien_lop');
		$res += $this->db->affected_rows();
		$this->db->where('PK_iMaNhapHoc', $sv['PK_iMaNhapHoc']);
		$this->db->delete('tbl_nhaphoc');
		$res += $this->db->affected_rows();
		$this->db->where('PK_iMaSV', $sv['PK_iMaSV']);
		$this->db->delete('tbl_sinhvien');
		$res += $this->db->affected_rows();
		return $res > 0 ? 1 : 0;
	}

	public function deleteSVWith($conditional, $keyword)
	{
		// pr($conditional);
		if ($keyword) {
			$this->db->like('PK_iMaNhapHoc', $keyword);
			$this->db->or_like('concat(sHo," ",sTen)', $keyword);
			$this->db->or_like('PK_iMaSVLop', $keyword);
		}
		$this->db->where($conditional);
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
		$this->db->select('PK_iMaNhapHoc, PK_iMaSVLop, PK_iMaSV');
		$list_ma_sv = $this->db->get('tbl_nhaphoc')->result_array();
		// pr($list_ma_sv);
		$res = 0;
		foreach ($list_ma_sv as $k => $v) {
			$res += $this->delSV($v);
		}
		return $res;
	}

	public function getListSV($conditional = '', $keyword = '', $type = '')
	{
		if ($keyword) {
			$this->db->like('PK_iMaNhapHoc', $keyword);
			$this->db->or_like('concat(sHo," ",sTen)', $keyword);
			$this->db->or_like('PK_iMaNhapHoc', $keyword);
		}
		if ($conditional) {
			$this->db->where($conditional);
		}
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
		$this->db->order_by('iKhoa desc, sTenLop asc, sTen asc, sHo asc');
		$this->db->select('tbl_nhaphoc.*, PK_iMaSVLop, PK_iMaSV, sHo, sTen, dNgaySinh, sGioiTinh, sTenLop, iKhoa, sTenNganh, sTenBac, sTenHe, sTenDonVi, FK_iNamTN');
		$res = $this->db->get('tbl_nhaphoc')->result_array();
		// pr($res);
		foreach ($res as $key => $value) {
			if ($type == 'word') {
				$this->db->where('iDT10 is not null');
			}
			$this->db->where('FK_iMaSVLop', $value['PK_iMaSVLop']);
			$this->db->join('tbl_mon_ctdt','PK_iMaMon_CTDT = FK_iMaMonCTDT', 'inner');
			$this->db->join('tbl_mon','PK_iMaMon = FK_iMaMon', 'inner');
			$this->db->order_by('iSTT','asc');
			$this->db->select('sTenMon, sTenMonTA, iSoTinChi, iDT10, sDTChu, iDT4, sLichSu, sNoiMien, iSTT');
			$res[$key]['diem'] = $this->db->get('tbl_diem')->result_array();
		}
		return $res;
	}
	public function countSV($conditional)
	{
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
		$this->db->order_by('iKhoa desc, sTenLop asc, sTen asc, sHo asc');
		$this->db->select('tbl_nhaphoc.*, PK_iMaSVLop, PK_iMaSV, sHo, sTen, dNgaySinh, sGioiTinh, sTenLop, iKhoa, sTenNganh, sTenBac, sTenHe, sTenDonVi, iKhoa');
		$res = $this->db->get('tbl_nhaphoc')->result_array();
		// pr($res);
		foreach ($res as $key => $value) {
			$this->db->where('FK_iMaSVLop', $value['PK_iMaSVLop']);
			$this->db->join('tbl_mon_ctdt','PK_iMaMon_CTDT = FK_iMaMonCTDT', 'inner');
			$this->db->join('tbl_mon','PK_iMaMon = FK_iMaMon', 'inner');
			$this->db->order_by('iSTT','asc');
			$this->db->select('sTenMon, sTenMonTA, iSoTinChi, iDT10, sDTChu, iDT4');
			$res[$key]['diem'] = $this->db->get('tbl_diem')->result_array();
		}
		return $res;
	}

	public function getThongTinLoc($conditional)
	{
		$this->db->where('PK_iMaNganh',$conditional['PK_iMaNganh']);
		$this->db->select('sTenNganh');
		$res = $this->db->get('tbl_nganh')->row_array();
		$res['FK_iNamTN'] = $conditional['FK_iNamTN'];
		return $res;
	}

}