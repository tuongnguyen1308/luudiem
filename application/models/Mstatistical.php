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


	public function getNamTN()
	{
		$this->db->order_by('PK_iNamTN desc');
		return $this->db->get('tbl_namtn')->result_array();
	}

	public function count_sv($namtotnghiep)
	{
		$this->db->where('FK_iNamTN', $namtotnghiep);
		$this->db->join('tbl_khoa', 'PK_iMaKhoa = FK_iMaKhoa', 'inner');
		$this->db->join('tbl_donvi_ctdt', 'PK_iMaDVCTDT = FK_iMaDVCTDT', 'inner');
		$this->db->join('tbl_ctdt', 'PK_iMaCTDT = FK_iMaCTDT', 'inner');
		$this->db->join('tbl_nganh', 'PK_iMaNganh = FK_iMaNganh', 'inner');
		$this->db->order_by('sTenNganh asc');
		$this->db->group_by('sTenNganh');
		$this->db->select('sTenNganh, count(PK_iMaNhapHoc) as iSoLuongSV, PK_iMaNganh, FK_iNamTN');
		return $this->db->get('tbl_nhaphoc')->result_array();
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

	public function getStatistical()
	{
		// $bac	= $this->db->get('tbl_bac');

		// $ds_he		= $this->db->order_by('sTenHe asc')->select('sTenHe')->get('tbl_he')->result_array();
		// $ds_nganh	= $this->db->order_by('sTenNganh asc')->select('sTenNganh')->get('tbl_nganh')->result_array();
		// $ds_khoa	= $this->db->order_by('iKhoa desc')->select('iKhoa')->get('tbl_khoa')->result_array();
		
		$this->db->join('tbl_khoa', 'PK_iMaKhoa = FK_iMaKhoa', 'inner');
		$this->db->join('tbl_donvi_ctdt','PK_iMaDVCTDT = FK_iMaDVCTDT', 'inner');
		$this->db->join('tbl_ctdt','PK_iMaCTDT = FK_iMaCTDT', 'inner');
		$this->db->join('tbl_nganh','PK_iMaNganh = FK_iMaNganh', 'inner');
		// $this->db->join('tbl_bac','PK_iMaBac = FK_iMaBac', 'inner');
		$this->db->join('tbl_he','PK_iMaHe = FK_iMaHe', 'inner');
		$this->db->order_by('sTenHe asc, sTenNganh asc, iKhoa desc');
		$this->db->select('PK_iMaNhapHoc, PK_iMaHe, sTenHe, PK_iMaNganh, sTenNganh, PK_iMaKhoa, iKhoa');
		$this->db->distinct();
		$dssv = $this->db->get('tbl_nhaphoc')->result_array();
		// pr($dssv);
		$res = '';
		foreach ($dssv as $key => $sv) {
			if (isset($res[$sv['sTenHe']][$sv['sTenNganh']][$sv['iKhoa']])) {
				$res[$sv['sTenHe']][$sv['sTenNganh']][$sv['iKhoa']]++;
			}
			else {
				$res[$sv['sTenHe']][$sv['sTenNganh']][$sv['iKhoa']] = 1;
			}
		}
		// pr($res);

		$rowspan_res = '';
		if ($res != null) {
			foreach ($res as $tenhe => $ds_nganh) {
				foreach ($ds_nganh as $tennganh => $ds_khoa) {
					foreach ($ds_khoa as $tenkhoa => $slsv) {
						if (isset($rowspan_res[$tenhe.'_rowspan'])) {
							$rowspan_res[$tenhe.'_rowspan']++;
						}
						else {
							$rowspan_res[$tenhe.'_rowspan'] = 1;
							$rowspan_res[$tenhe] = '';
						}
						if (isset($rowspan_res[$tenhe][$tennganh])) {
							$rowspan_res[$tenhe][$tennganh]++;
						}
						else {
							$rowspan_res[$tenhe][$tennganh] = 1;
						}
						
					}
				}
			}
		}
		// pr($rowspan_res);
		$collapse = array(
			'res'		=> $res,
			'rowspan'	=> $rowspan_res
		);

		return $collapse;
		// pr($res);
		
	}

}