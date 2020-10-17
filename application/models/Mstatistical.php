<?php

class Mstatistical extends MY_Model
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
		$this->db->order_by('iKhoa desc, sTen asc');
		$this->db->select('PK_iMaNhapHoc, sGDTC, sGDQP, sCDRNN, sXLRenLuyen, sTBCTL, iSoTCTL, iSoTCConNo, sXepLoaiTotNghiep, sSoQuyetDinhTotNghiep, dNgayQuyetDinhTotNghiep, sSoQuyetDinhDauVao, dNgayQuyetDinhDauVao, iSoHocPhanThiLai, sHo, sTen, dNgaySinh, sGioiTinh, sTenLop, iKhoa');
		$data	= $this->db->get('tbl_nhaphoc')->result_array();
		$res	= floor(count($data)/10);
		if (count($data)%10 > 0) $res++;
		return $res;
	}
	
	public function getDSSVIn($conditional, $keyword = '', $present_page = 1)
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
		$this->db->order_by('iKhoa desc, sTen asc');
		$this->db->select('PK_iMaNhapHoc, sGDTC, sGDQP, sCDRNN, sXLRenLuyen, sTBCTL, iSoTCTL, iSoTCConNo, sXepLoaiTotNghiep, sSoQuyetDinhTotNghiep, dNgayQuyetDinhTotNghiep, sSoQuyetDinhDauVao, dNgayQuyetDinhDauVao, iSoHocPhanThiLai, sHo, sTen, dNgaySinh, sGioiTinh, sTenLop, iKhoa');
		$res = $this->db->get('tbl_nhaphoc')->result_array();
		// pr($res);
		foreach ($res as $key => $value) {
			$this->db->where('FK_iMaNhapHoc', $value['PK_iMaNhapHoc']);
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
		$this->db->order_by('sNam', 'asc');
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
	public function delSV($masv)
	{
		$res = 0;
		$this->db->where('FK_iMaNhapHoc', $masv);
		$this->db->delete('tbl_diem');
		$res += $this->db->affected_rows();
		$this->db->where('FK_iMaNhapHoc', $masv);
		$this->db->delete('tbl_sinhvien_lop');
		$res += $this->db->affected_rows();
		$this->db->where('PK_iMaNhapHoc', $masv);
		$this->db->delete('tbl_nhaphoc');
		$res += $this->db->affected_rows();
		return $res > 0 ? 1 : 0;
	}

	public function deleteSVWith($conditional)
	{
		// pr($conditional);
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
		$this->db->select('PK_iMaNhapHoc');
		$list_ma_sv = $this->db->get('tbl_nhaphoc')->result_array();
		// pr($list_ma_sv);
		$res = 0;
		foreach ($list_ma_sv as $k => $v) {
			$res += $this->delSV($v['PK_iMaNhapHoc']);
		}
		return $res;
	}

	public function getListSV($conditional)
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
		$this->db->order_by('iKhoa desc, sTen asc');
		$this->db->select('tbl_nhaphoc.*, sHo, sTen, dNgaySinh, sGioiTinh, sTenLop, iKhoa, sTenNganh, sTenBac, sTenHe, sTenDonVi, iKhoa');
		$res = $this->db->get('tbl_nhaphoc')->result_array();
		// pr($res);
		foreach ($res as $key => $value) {
			$this->db->where('FK_iMaNhapHoc', $value['PK_iMaNhapHoc']);
			$this->db->join('tbl_mon_ctdt','PK_iMaMon_CTDT = FK_iMaMonCTDT', 'inner');
			$this->db->join('tbl_mon','PK_iMaMon = FK_iMaMon', 'inner');
			$this->db->order_by('iSTT','asc');
			$this->db->select('sTenMon, sTenMonTA, iSoTinChi, iDT10, sDTChu, iDT4');
			$res[$key]['diem'] = $this->db->get('tbl_diem')->result_array();
		}
		return $res;
	}

	// public function importSV($new_sv)
	// {
	// 	$this->db->where('sMaSV',$new_sv['sMaSV']);
	// 	$duplicate = $this->db->get('tbl_sinhvien')->result_array();
	// 	if(!$duplicate) {
	// 		$this->db->insert('tbl_sinhvien',$new_sv);
	// 	}
	// 	else {
	// 		return -1;
	// 	}
	// 	if($this->db->affected_rows() > 0) {
	// 		return $new_sv['PK_iMaSV'];
	// 	}
	// 	else {
	// 		return 0;
	// 	}
	// }

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

	// public function ImportGrade($new_grade, $i)
	// {
	// 	$this->db->where('sMon',$new_grade['sMon']);
	// 	$this->db->where('FK_iMaSV',$new_grade['FK_iMaSV']);
	// 	$duplicate = $this->db->get('tbl_diem')->result_array();
	// 	if(!$duplicate) {
	// 		$rd = $i . time()%1000000000 . rand(100,999);
	// 		$new_grade['PK_iMaDiem'] = $rd;
	// 		$this->db->insert('tbl_diem',$new_grade);
	// 	}
	// 	else {
	// 		return -3;
	// 	}
	// 	return $this->db->affected_rows();
	// }


	#region insert_ctdt
	public function insertCTDT($ctdt)
	{
		$ctdt['FK_iMaNganh']	= $this->insert_a_table('tbl_nganh', 'sTenNganh', $ctdt['sTenNganh'], 'PK_iMaNganh');
		$ctdt['FK_iMaBac']		= $this->insert_a_table('tbl_bac', 'sTenBac', $ctdt['sTenBac'], 'PK_iMaBac');
		$ctdt['FK_iMaHe']		= $this->insert_a_table('tbl_he', 'sTenHe', $ctdt['sTenHe'], 'PK_iMaHe');
		$ctdt['FK_iMaCTDT']		= $this->insert_ctdt($ctdt);

		$ctdt['FK_iMaDonVi'] 	= $this->insert_a_table('tbl_DonVi', 'sTenDonVi', $ctdt['sTenDonVi'], 'PK_iMaDonVi');
		$ctdt['FK_iMaDVCTDT']	= $this->insert_donvi_ctdt($ctdt);
		$ctdt['FK_iMaKhoa']		= $this->insert_khoa($ctdt);
		return $ctdt;
	}

	public function insert_a_table($tbl_name, $field_name, $value, $pk)
	{
		$this->db->where($field_name, $value);
		$duplicate = $this->db->get($tbl_name)->row_array();
		if (!$duplicate) {
			$insert = array(
				$pk => time()%10000000 . rand(100,999),
				$field_name => $value
			);
			// pr($insert);
			$this->db->insert($tbl_name, $insert);
			return $insert[$pk];
		}
		else {
			return $duplicate[$pk];
		}
		
	}

	public function insert_ctdt($ctdt)
	{
		$conditional = array(
			'FK_iMaNganh'	=> $ctdt['FK_iMaNganh'],
			'FK_iMaBac'		=> $ctdt['FK_iMaBac'],
			'FK_iMaHe'		=> $ctdt['FK_iMaHe'],
			'sNam'			=> $ctdt['sNam']
		);
		$this->db->where($conditional);
		$duplicate = $this->db->get('tbl_ctdt')->row_array();

		if (!$duplicate) {
			$insert = array(
				'PK_iMaCTDT'	=> time()%10000000 . rand(100,999),
				'FK_iMaNganh'	=> $ctdt['FK_iMaNganh'],
				'FK_iMaBac'		=> $ctdt['FK_iMaBac'],
				'FK_iMaHe'		=> $ctdt['FK_iMaHe'],
				'sNam'			=> $ctdt['sNam']
			);
			$this->db->insert('tbl_ctdt', $insert);
			return $insert['PK_iMaCTDT'];
		}
		else {
			return $duplicate['PK_iMaCTDT'];
		}
	}
	public function insert_donvi_ctdt($ctdt)
	{
		$conditional = array(
			'FK_iMaDonVi'	=> $ctdt['FK_iMaDonVi'],
			'FK_iMaCTDT'	=> $ctdt['FK_iMaCTDT']
		);
		$this->db->where($conditional);
		$duplicate = $this->db->get('tbl_donvi_ctdt')->row_array();

		if (!$duplicate) {
			$insert = array(
				'PK_iMaDVCTDT'	=> time()%10000000 . rand(100,999),
				'FK_iMaDonVi'	=> $ctdt['FK_iMaDonVi'],
				'FK_iMaCTDT'		=> $ctdt['FK_iMaCTDT']
			);
			$this->db->insert('tbl_donvi_ctdt', $insert);
			return $insert['PK_iMaDVCTDT'];
		}
		else {
			return $duplicate['PK_iMaDVCTDT'];
		}
	}
	public function insert_khoa($ctdt)
	{
		$conditional = array(
			'iKhoa'			=> $ctdt['iKhoa'],
			'FK_iMaDVCTDT'	=> $ctdt['FK_iMaDVCTDT']
		);
		$this->db->where($conditional);
		$duplicate = $this->db->get('tbl_khoa')->row_array();

		if (!$duplicate) {
			$insert = array(
				'PK_iMaKhoa'		=> time()%10000000 . rand(100,999),
				'iKhoa'				=> $ctdt['iKhoa'],
				'FK_iMaDVCTDT'		=> $ctdt['FK_iMaDVCTDT']
			);
			$this->db->insert('tbl_khoa', $insert);
			return $insert['PK_iMaKhoa'];
		}
		else {
			return $duplicate['PK_iMaKhoa'];
		}
	}
	#endregion

	#region insert_mon
	public function insertMon($mon, $ctdt, $stt)
	{
		$mon_ctdt = array(
			'iSTT'			=> $stt,
			'FK_iMaMon'		=> $this->insert_mon($mon, $stt),
			'FK_iMaCTDT'	=> $ctdt['FK_iMaCTDT']
		);

		$mon_ctdt['PK_iMaMon_CTDT'] = $this->insert_mon_ctdt($mon_ctdt);
		return $mon_ctdt['PK_iMaMon_CTDT'];
	}
	
	public function insert_mon($mon, $stt)
	{
		$this->db->where('sTenMon', $mon['sTenMon']);
		$this->db->where('iSoTinChi', $mon['iSoTinChi']);
		$duplicate = $this->db->get('tbl_mon')->row_array();
		if (!$duplicate) {
			$insert = array(
				'PK_iMaMon'	=> $stt . time()%1000000 . rand(1000,9999),
				'sTenMon'	=> $mon['sTenMon'],
				'sTenMonTA'	=> $mon['sTenMonTA'],
				'iSoTinChi'	=> $mon['iSoTinChi']
			);
			$this->db->insert('tbl_mon', $insert);
			return $insert['PK_iMaMon'];
		}
		else {
			$this->db->where('sTenMon', $mon['sTenMon']);
			$this->db->where('iSoTinChi', $mon['iSoTinChi']);
			$this->db->update('tbl_mon', $mon);
			return $duplicate['PK_iMaMon'];
		}
	}

	public function insert_mon_ctdt($mon_ctdt)
	{
		$conditional = array(
			'FK_iMaMon'		=> $mon_ctdt['FK_iMaMon'],
			'FK_iMaCTDT'	=> $mon_ctdt['FK_iMaCTDT']
		);
		$this->db->where($conditional);
		$duplicate = $this->db->get('tbl_mon_ctdt')->row_array();

		if (!$duplicate) {
			$insert = array(
				'PK_iMaMon_CTDT'	=> $mon_ctdt['iSTT'] . time()%1000000 . rand(1000,9999),
				'iSTT'				=> $mon_ctdt['iSTT'],
				'FK_iMaMon'			=> $mon_ctdt['FK_iMaMon'],
				'FK_iMaCTDT'		=> $mon_ctdt['FK_iMaCTDT']
			);
			$this->db->insert('tbl_mon_ctdt', $insert);
			return $insert['PK_iMaMon_CTDT'];
		}
		else {
			return $duplicate['PK_iMaMon_CTDT'];
		}
	}

	#endregion
	
	#region insert_sv
	//ajax fun
	public function insert_sv($data_sv)
	{
		$sv = array(
			'PK_iMaSV'	=> $data_sv['iSTT'] . time()%100000000 . rand(10000,99999),
			'sHo'		=> $data_sv['sHo'],
			'sTen'		=> $data_sv['sTen'],
			'dNgaySinh' => $data_sv['dNgaySinh'],
			'sGioiTinh' => $data_sv['sGioiTinh']
		);
		// pr($sv);
		$this->db->insert('tbl_sinhvien',$sv);
		// pr($this->db->affected_rows());
		$conditional = array(
			'PK_iMaNhapHoc'	=> $data_sv['sMaSV'],
			'FK_iMaKhoa'	=> $data_sv['FK_iMaKhoa']
		);
		$this->db->where($conditional);
		$duplicate = $this->db->get('tbl_nhaphoc')->result_array();
		if(!$duplicate) {
			$nhaphoc = array(
				'PK_iMaNhapHoc'				=> $data_sv['sMaSV'],
				'FK_iMaSV'					=> $sv['PK_iMaSV'],
				'FK_iMaKhoa'				=> $data_sv['FK_iMaKhoa'],
				'sGDTC'						=> $data_sv['sGDTC'],
				'sGDQP'						=> $data_sv['sGDQP'],
				'sCDRNN'					=> $data_sv['sCDRNN'],
				'sXLRenLuyen'				=> $data_sv['sXLRenLuyen'],
				'sTBCTL'					=> $data_sv['sTBCTL'],
				'iSoTCTL'					=> $data_sv['iSoTCTL'],
				'iSoTCConNo'				=> $data_sv['iSoTCConNo'],
				'sXepLoaiTotNghiep' 		=> $data_sv['sXepLoaiTotNghiep'],
				'sSoQuyetDinhDauVao'		=> $data_sv['sSoQuyetDinhDauVao'],
				'dNgayQuyetDinhDauVao'		=> $data_sv['dNgayQuyetDinhDauVao'],
				'sSoQuyetDinhTotNghiep'		=> $data_sv['sSoQuyetDinhTotNghiep'],
				'dNgayQuyetDinhTotNghiep'	=> $data_sv['dNgayQuyetDinhTotNghiep'],
				'iSoHocPhanThiLai'			=> $data_sv['iSoHocPhanThiLai']
			);
			$this->db->insert('tbl_nhaphoc',$nhaphoc);
			return $nhaphoc['PK_iMaNhapHoc'];
		}
		else {
			$this->db->where('PK_iMaSV', $sv['PK_iMaSV']);
			$this->db->delete('tbl_sinhvien');
			return $conditional['PK_iMaNhapHoc'];
		}
	}
	//endd

	public function insertSV($data_sv, $ctdt)
	{
		// pr($data_sv);
		$sv = array(
			'PK_iMaSV'	=> $data_sv['PK_iMaNhapHoc'],
			'sHo'		=> $data_sv['sHo'],
			'sTen'		=> $data_sv['sTen'],
			'dNgaySinh' => $data_sv['dNgaySinh'],
			'sGioiTinh' => $data_sv['sGioiTinh']
		);
		// if($sv['PK_iMaSV'] == '18A31010010') {
		// 	pr($sv);

		// }
		$this->db->where($sv);
		$duplicate = $this->db->get('tbl_sinhvien')->row_array();
		// pr($duplicate);
		if (!$duplicate) {
			$this->db->insert('tbl_sinhvien',$sv);
		}
		// pr($sv);
		// pr($this->db->affected_rows());
		$conditional = array(
			'PK_iMaNhapHoc'	=> $data_sv['PK_iMaNhapHoc'],
			'FK_iMaKhoa'	=> $ctdt['FK_iMaKhoa']
		);
		$this->db->where($conditional);
		$duplicate = $this->db->get('tbl_nhaphoc')->row_array();
		// pr($duplicate);
		$nhaphoc = array(
			'PK_iMaNhapHoc'				=> $data_sv['PK_iMaNhapHoc'],
			'FK_iMaKhoa'				=> $ctdt['FK_iMaKhoa'],
			'FK_iMaSV'					=> $sv['PK_iMaSV'],
			'sGDTC'						=> $data_sv['sGDTC'],
			'sGDQP'						=> $data_sv['sGDQP'],
			'sCDRNN'					=> $data_sv['sCDRNN'],
			'sXLRenLuyen'				=> $data_sv['sXLRenLuyen'],
			'sTBCTL'					=> $data_sv['sTBCTL'],
			'iSoTCTL'					=> $data_sv['iSoTCTL'],
			'iSoTCConNo'				=> $data_sv['iSoTCConNo'],
			'sXepLoaiTotNghiep' 		=> $data_sv['sXepLoaiTotNghiep'],
			'sSoQuyetDinhDauVao'		=> $data_sv['sSoQuyetDinhDauVao'],
			'dNgayQuyetDinhDauVao'		=> $data_sv['dNgayQuyetDinhDauVao'],
			'sSoQuyetDinhTotNghiep'		=> $data_sv['sSoQuyetDinhTotNghiep'],
			'dNgayQuyetDinhTotNghiep'	=> $data_sv['dNgayQuyetDinhTotNghiep'],
			'iSoHocPhanThiLai'			=> $data_sv['iSoHocPhanThiLai']
		);
		if(!$duplicate) {
			$this->db->insert('tbl_nhaphoc',$nhaphoc);
			return $nhaphoc['PK_iMaNhapHoc'];
		}
		else {
			$this->db->where('PK_iMaNhapHoc', $sv['PK_iMaSV']);
			$this->db->update('tbl_nhaphoc', $nhaphoc);
			return $conditional['PK_iMaNhapHoc'];
		}
	}
	#endregion

	#region insert_lop

	public function insertSV_Lop($data_sv, $ctdt)
	{
		$sv_lop = array(
			'FK_iMaLop'		=> $this->insert_lop_hanh_chinh($data_sv, $ctdt),
			'FK_iMaNhapHoc'	=> $data_sv['PK_iMaNhapHoc']
		);
		$this->db->where($sv_lop);
		$duplicate = $this->db->get('tbl_sinhvien_lop')->row_array();
		if (!$duplicate) {
			$insert = array(
				'PK_iMaSVLop'	=> time()%10000000 . rand(1000,9999),
				'FK_iMaNhapHoc'	=> $data_sv['FK_iMaNhapHoc'],
				'FK_iMaLop'		=> $sv_lop['FK_iMaLop']
			);
			$this->db->insert('tbl_sinhvien_lop', $insert);
			return $insert['PK_iMaSVLop'];
		}
		else {
			return $duplicate['PK_iMaSVLop'];
		}
	}
	public function insert_lop_hanh_chinh($data_sv, $ctdt)
	{
		$lophanhchinh = array(
			'sTenLop'		=> $data_sv['sTenLop'],
			'FK_iMaKhoa'	=> $ctdt['FK_iMaKhoa']
		);

		$this->db->where('sTenLop', $data_sv['sTenLop']);
		$this->db->where('FK_iMaKhoa', $ctdt['FK_iMaKhoa']);
		$duplicate = $this->db->get('tbl_lop_hanh_chinh')->row_array();
		if (!$duplicate) {
			$insert = array(
				'PK_iMaLop'	=> time()%10000000 . rand(1000,9999),
				'sTenLop'	=> $data_sv['sTenLop'],
				'FK_iMaKhoa'	=> $ctdt['FK_iMaKhoa']
			);
			$this->db->insert('tbl_lop_hanh_chinh', $insert);
			return $insert['PK_iMaLop'];
		}
		else {
			return $duplicate['PK_iMaLop'];
		}
	}
	#endregion

	#region insert_diem
	public function insertDiem($diem, $FK_iMaNhapHoc)
	{
		// pr($diem);
		$conditional = array(
			'FK_iMaNhapHoc'	=> $diem['FK_iMaNhapHoc'],
			'FK_iMaMonCTDT'	=> $diem['FK_iMaMonCTDT'],
		);
		$this->db->where($conditional);
		$duplicate = $this->db->get('tbl_diem')->row_array();
		// pr($duplicate != null);
		if ($duplicate == null) {
			$insert = $diem;
			$insert['PK_iMaDiem'] = time()%10000000 . rand(1000,9999);
			// pr($insert);
			$this->db->insert('tbl_diem', $insert);
			// pr($this->db->affected_rows());
			return $insert['PK_iMaDiem'];
		}
		else {
			$this->db->where($conditional);
			$this->db->update('tbl_diem', $diem);
			if ($this->db->affected_rows() == 2) {
				pr($duplicate);
			}
			return $duplicate['PK_iMaDiem'];
		}
	}
	// public function updateSV($data_sv)
	// {
	// 	// pr($data_sv);
	// 	$this->db->where('PK_iMaNhapHoc',$data_sv['sMaSV']);
	// 	$update = array(
	// 		'PK_iMaNhapHoc'				=> $data_sv['sMaSV'],
	// 		'sGDTC'						=> $data_sv['sGDTC'],
	// 		'sGDQP'						=> $data_sv['sGDQP'],
	// 		'sCDRNN'					=> $data_sv['sCDRNN'],
	// 		'sXLRenLuyen'				=> $data_sv['sXLRenLuyen'],
	// 		'sTBCTL'					=> $data_sv['sTBCTL'],
	// 		'iSoTCTL'					=> $data_sv['iSoTCTL'],
	// 		'iSoTCConNo'				=> $data_sv['iSoTCConNo'],
	// 		'sXepLoaiTotNghiep' 		=> $data_sv['sXepLoaiTotNghiep'],
	// 		'sSoQuyetDinhDauVao'		=> $data_sv['sSoQuyetDinhDauVao'],
	// 		'dNgayQuyetDinhDauVao'		=> $data_sv['dNgayQuyetDinhDauVao'],
	// 		'sSoQuyetDinhTotNghiep'		=> $data_sv['sSoQuyetDinhTotNghiep'],
	// 		'dNgayQuyetDinhTotNghiep'	=> $data_sv['dNgayQuyetDinhTotNghiep'],
	// 		'iSoHocPhanThiLai'			=> $data_sv['iSoHocPhanThiLai']
	// 	);
	// 	$this->db->update('tbl_nhaphoc', $update);
	// 	return $this->db->affected_rows();
	// }
	#endregion

}