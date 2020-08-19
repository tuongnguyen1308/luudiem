<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mdsungvienthamdinh extends MY_Model {

	public function __construct()
	{
		parent::__construct();
		//Do your magic here
	}
	public function getDetailCandidate($maUV)
	{
		$this->db->where('PK_iMaUV', $maUV);
		$this->db->join('dm_chucdanh', 'dm_chucdanh.PK_iMaCD = tbl_ungvien.FK_iChucDanhXet', 'left');
		$this->db->join('dm_doituong', 'dm_doituong.PK_iMaDoiTuong = tbl_ungvien.FK_iMaDoiTuong', 'left');
		$this->db->join('dm_dantoc', 'dm_dantoc.PK_iMaDanToc = tbl_ungvien.FK_iMaDanToc', 'left');
		$this->db->join('dm_tongiao', 'dm_tongiao.PK_iMaTG = tbl_ungvien.FK_iMaTG', 'left');
		$this->db->join('dm_hoidongcoso', 'dm_hoidongcoso.PK_iMaHoiDong = tbl_ungvien.FK_iMaHDCS', 'left');
		$this->db->join('tbl_nganh', 'tbl_nganh.PK_iMaNganh = tbl_ungvien.FK_iMaNganh', 'left');
		$this->db->join('dm_nganh_liennganh', 'dm_nganh_liennganh.PK_iMaNganhLN = tbl_nganh.FK_iMaNganhLN', 'left');
		return $this->db->get('tbl_ungvien')->row_array();
	}

	public function getListTitleMC()
	{
		$this->db->select('tbl_minhchung.*, SUBSTRING(`PK_sMaMinhChung`, 3)*1 as mamc');
		$this->db->order_by('mamc', 'asc');
		return $this->db->get('tbl_minhchung')->result_array();
	}

	public function getProof($maUV, $tableProof)
	{
		switch ($tableProof) {
			case 'tbl_minhchung_qtdt':
				$tableJoin = 'tbl_quatrinhdaotao';
				$primaryKey = 'PK_iMaQTDT';
				$keyJoin = 'PK_iMaQTDT';
				break;
			case 'tbl_minhchung_tndt':
				$tableJoin = 'tbl_thamniendaotao';
				$primaryKey = 'PK_iMaTNDT';
				$keyJoin = 'PK_iMaTNDT';
				break;
			case 'tbl_minhchung_hdhv':
				$tableJoin = 'tbl_huongdanhocvien';
				$primaryKey = 'PK_iMaHocVien';
				$keyJoin = 'PK_iMaHDHV';
				break;
			case 'tbl_minhchung_sachpvdt':
				$tableJoin = 'tbl_sachphucvudaotao';
				$primaryKey = 'PK_iMaSach';
				$keyJoin = 'PK_iMaSach';
				break;
			case 'tbl_minhchung_nvkh':
				$tableJoin = 'tbl_nhiemvukhoahoc';
				$primaryKey = 'PK_iMaNhiemVu';
				$keyJoin = 'PK_iMaNhiemVu';
				break;
			case 'tbl_minhchung_baibao':
				$tableJoin = 'tbl_baibaokhoahoc';
				$primaryKey = 'PK_iMaBaiBao';
				$keyJoin = 'PK_iMaBaiBao';
				break;
			case 'tbl_minhchung_giaiphap':
				$tableJoin = 'tbl_giaiphaphuuich';
				$primaryKey = 'PK_iMaGiaiPhap';
				$keyJoin = 'PK_iMaGiaiPhap';
				break;
			case 'tbl_minhchung_gtqt':
				$tableJoin = 'tbl_giaithuongquocte';
				$primaryKey = 'PK_iMaGiaiThuong';
				$keyJoin = 'PK_iMaGiaiThuong';
				break;
			case 'tbl_minhchung_ngoaingu':
				$tableJoin = 'tbl_trinhdongoaingu';
				$primaryKey = 'PK_iMaTrinhDo';
				$keyJoin = 'PK_iMaTrinhDo';
				break;
			case 'tbl_minhchung_khenthuong':
				$tableJoin = 'tbl_khenthuong';
				$primaryKey = 'PK_iMaKhenThuong';
				$keyJoin = 'PK_iMaKhenThuong';
				break;
			case 'tbl_minhchung_kyluat':
				$tableJoin = 'tbl_kyluat';
				$primaryKey = 'PK_iMaKyLuat';
				$keyJoin = 'PK_iMaKyLuat';
				break;
			case 'tbl_minhchung_ctnc':
				$tableJoin = 'tbl_chuongtrinhnghiencuu';
				$primaryKey = 'PK_iMaChuongTrinh';
				$keyJoin = 'PK_iMaChuongTrinh';
				break;
		}
		if ($tableProof == 'tbl_minhchung_ungvien'){
			$this->db->where('PK_iMaUV', $maUV);
		}
		else{
			$this->db->where('FK_iMaUV', $maUV);
			$this->db->join($tableJoin, $tableJoin.'.'.$primaryKey.'='.$tableProof.'.'.$keyJoin,'inner');
		}
		return $this->db->get($tableProof)->result_array();
	}

}


