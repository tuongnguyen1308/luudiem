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
	public function getDSSV($khoahoc = 'all')
	{
		// $this->db->where('FK_iMaTK', $MaUyVien);
		// $this->db->join('dm_nganh','dm_nganh.PK_iMaNganh = tbl_thongtinSV.FK_iMaNganh', 'inner');

		// $this->db->order_by('sLop asc, sTen asc');
		$this->db->join('tbl_sinhvien','PK_iMaSV = FK_iMaSV', 'inner');
		$this->db->join('tbl_sinhvien_lop','PK_iMaNhapHoc = FK_iMaNhapHoc', 'inner');
		$this->db->join('tbl_lop_hanh_chinh','PK_iMaLop = FK_iMaLop', 'inner');
		$this->db->join('tbl_khoa','PK_iMaKhoa = tbl_nhaphoc.FK_iMaKhoa', 'inner');
		$res = $this->db->get('tbl_nhaphoc')->result_array();
		return $res;
	}
	
	public function getListKhoa()
	{
		return $this->db->get('tbl_khoa')->result_array();
	}
	
	public function getSVGrade($masv)
	{
		$this->db->where('FK_iMaNhapHoc', $masv);
		$this->db->join('tbl_mon_ctdt','PK_iMaMon_CTDT = FK_iMaMonCTDT', 'inner');
		$this->db->join('tbl_mon','PK_iMaMon = FK_iMaMon', 'inner');
		$this->db->order_by('iSTT', 'asc');
		return $this->db->get('tbl_diem')->result_array();
		// $this->db->where('FK_iMaTK', $masv);
		// $res = $this->db->get('tbl_diem')->result_array();
		// return $res;
	}
	public function delSV($masv)
	{
		$this->db->where('FK_iMaSV', $masv);
		$this->db->delete('tbl_diem');
		$res += $this->db->affected_rows();
		$this->db->where('PK_iMaSV', $masv);
		$this->db->delete('tbl_sinhvien');
		$res += $this->db->affected_rows();
		return $res;
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
			$rd = $i . time()%1000000000 . rand(100,999);
			$new_grade['PK_iMaDiem'] = $rd;
			$this->db->insert('tbl_diem',$new_grade);
		}
		else {
			return -3;
		}
		return $this->db->affected_rows();
	}


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
				'PK_iMaMon'	=> $stt . time()%10000000 . rand(100,999),
				'sTenMon'	=> $mon['sTenMon'],
				'iSoTinChi'	=> $mon['iSoTinChi']
			);
			$this->db->insert('tbl_mon', $insert);
			return $insert['PK_iMaMon'];
		}
		else {
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
				'PK_iMaMon_CTDT'	=> $mon_ctdt['iSTT'] . time()%10000000 . rand(100,999),
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
	public function insertSV($data_sv, $ctdt)
	{
		$sv = array(
			'PK_iMaSV'	=> $data_sv['iSTT'] . time()%1000000000 . rand(1000,9999),
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
			'FK_iMaKhoa'	=> $ctdt['FK_iMaKhoa']
		);
		$this->db->where($conditional);
		$duplicate = $this->db->get('tbl_nhaphoc')->result_array();
		if(!$duplicate) {
			$nhaphoc = $conditional;
			$nhaphoc['FK_iMaSV'] = $sv['PK_iMaSV'];
			$this->db->insert('tbl_nhaphoc',$nhaphoc);
			return $nhaphoc['PK_iMaNhapHoc'];
		}
		else {
			$this->db->where('PK_iMaSV', $sv['PK_iMaSV']);
			$this->db->delete('tbl_sinhvien');
			return $conditional['PK_iMaNhapHoc'];
		}
	}
	#endregion

	#region insert_lop
	public function insertSV_Lop($data_sv, $ctdt)
	{
		$sv_lop = array(
			'FK_iMaLop'		=> $this->insert_lop_hanh_chinh($data_sv, $ctdt),
			'FK_iMaNhapHoc'	=> $data_sv['sMaSV']
		);
		$this->db->where('FK_iMaNhapHoc', $data_sv['FK_iMaNhapHoc']);
		$this->db->where('FK_iMaLop', $sv_lop['FK_iMaLop']);
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
		$conditional = array(
			'FK_iMaNhapHoc'	=> $diem['FK_iMaNhapHoc'],
			'FK_iMaMonCTDT'	=> $diem['FK_iMaMonCTDT'],
		);
		$this->db->where($conditional);
		$duplicate = $this->db->get('tbl_diem')->row_array();
		if (!$duplicate) {
			$insert = $diem;
			$insert['PK_iMaDiem'] = time()%10000000 . rand(1000,9999);
			$this->db->insert('tbl_diem', $insert);
			return $insert['PK_iMaDiem'];
		}
		else {
			$this->db->where($conditional);
			$this->db->update('tbl_diem', $diem);
			return $duplicate['PK_iMaDiem'];
		}
	}
	public function updateSV($data_sv)
	{
		$this->db->where('PK_iMaNhapHoc',$data_sv['sMaSV']);
		$update = array(
			'PK_iMaNhapHoc'		=> $data_sv['sMaSV'],
			'sGDTC'				=> $data_sv['sGDTC'],
			'sGDQP'				=> $data_sv['sGDQP'],
			'sCDRNN'			=> $data_sv['sCDRNN'],
			'sXLRenLuyen'		=> $data_sv['sXLRenLuyen'],
			'sTBCTL'			=> $data_sv['sTBCTL'],
			'iSoTCTL'			=> $data_sv['iSoTCTL'],
			'iSoTCConNo'		=> $data_sv['iSoTCConNo'],
			'sXepLoaiTotNghiep' => $data_sv['sXepLoaiTotNghiep']
		);
		$this->db->update('tbl_nhaphoc', $update);
		return $this->db->affected_rows();
	}
	#endregion

	public function getDSSVIn($khoahoc)
	{
		$this->db->where('PK_iMaKhoa', $khoahoc);
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
		$res = $this->db->get('tbl_nhaphoc')->result_array();
		foreach ($res as $key => $value) {
			$this->db->where('FK_iMaNhapHoc', $value['PK_iMaNhapHoc']);
			$this->db->join('tbl_mon_ctdt','PK_iMaMon_CTDT = FK_iMaMonCTDT', 'inner');
			$this->db->join('tbl_mon','PK_iMaMon = FK_iMaMon', 'inner');
			$this->db->order_by('iSTT','asc');
			$res[$key]['diem'] = $this->db->get('tbl_diem')->result_array();
		}
		return $res;
	}
}