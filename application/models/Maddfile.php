<?php

class Maddfile extends MY_Model
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
				'FK_iMaCTDT'	=> $ctdt['FK_iMaCTDT']
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
		$this->db->where('sTenMonTA', $mon['sTenMonTA']);
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
			'FK_iMaCTDT'	=> $mon_ctdt['FK_iMaCTDT'],
			'iSTT'			=> $mon_ctdt['iSTT']
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


	#region insert_batch
	public function insert_ds_lop($ds_lop)
	{
		return $this->db->insert_batch('tbl_lop_hanh_chinh', $ds_lop);
	}

	public function insert_ds_sv($ds_sv)
	{
		return $this->db->insert_batch('tbl_sinhvien', $ds_sv);
	}

	public function insert_ds_nhaphoc($ds_nhaphoc)
	{
		return $this->db->insert_batch('tbl_nhaphoc', $ds_nhaphoc);
	}

	public function insert_ds_sv_lop($ds_sv_lop)
	{
		return $this->db->insert_batch('tbl_sinhvien_lop', $ds_sv_lop);
	}

	public function insert_ds_diem($ds_diem)
	{
		return $this->db->insert_batch('tbl_diem', $ds_diem);
	}
	#endregion

	#region get_ds_ma
	public function get_ds_ma_lop()
	{
		$this->db->select('PK_iMaLop');
		$res = $this->db->get('tbl_lop_hanh_chinh')->result_array();
		return  array_column($res, 'PK_iMaLop');
	}
	public function get_ds_ma_sv()
	{
		$this->db->select('PK_iMaSV');
		$res = $this->db->get('tbl_sinhvien')->result_array();
		return  array_column($res, 'PK_iMaSV');
	}
	public function get_ds_ma_nhaphoc()
	{
		$this->db->select('PK_iMaNhapHoc');
		$res = $this->db->get('tbl_nhaphoc')->result_array();
		return  array_column($res, 'PK_iMaNhapHoc');
	}
	public function get_ds_ma_sv_lop()
	{
		$this->db->select('PK_iMaSVLop');
		$res = $this->db->get('tbl_sinhvien_lop')->result_array();
		return  array_column($res, 'PK_iMaSVLop');
	}
	public function get_ds_ma_diem()
	{
		$this->db->select('PK_iMaDiem');
		$res = $this->db->get('tbl_diem')->result_array();
		return  array_column($res, 'PK_iMaDiem');
	}
	#endregion

	#region update_batch
	public function update_ds_lop($ds_lop_update)
	{
		return $this->db->update_batch('tbl_lop_hanh_chinh', $ds_lop_update, 'PK_iMaLop');
	}

	public function update_ds_sv($ds_sv_update)
	{
		return $this->db->update_batch('tbl_sinhvien', $ds_sv_update, 'PK_iMaSV');
	}

	public function update_ds_nhaphoc($ds_nhaphoc_update)
	{
		return $this->db->update_batch('tbl_nhaphoc', $ds_nhaphoc_update, 'PK_iNhapHoc');
	}

	public function update_ds_sv_lop($ds_sv_lop_update)
	{
		return $this->db->update_batch('tbl_sinhvien_lop', $ds_sv_lop_update, 'PK_iSVLop');
	}

	public function update_ds_diem($ds_diem_update)
	{
		return $this->db->update_batch('tbl_diem', $ds_diem_update, 'PK_iMaDiem');
	}

	#endregion


	#region insert_diem
	#endregion

}