<?php
/**
 * Created by PhpStorm.
 * User: Nguyễn Duy Thành
 * Date: 06/09/2019
 * Time: 09:43 SA
 */

class Mthamdinhthongtinchung extends MY_Model
{
    public function getThongTinUngVien($maUV)
	{
		//$this->db->where('PK_iMaUV', $maUV);
		//$this->db->select('FK_iChucDanhXet');
		$this->db->select('*');
		$this->db->from('tbl_ungvien');
		$this->db->join('tbl_phancong_thamdinh', 'tbl_phancong_thamdinh.FK_iMaUV= tbl_ungvien.PK_iMaUV','inner');
		$this->db->join('dm_chucdanh','dm_chucdanh.PK_iMaCD = tbl_ungvien.FK_iChucDanhXet');
		$this->db->join('dm_doituong','dm_doituong.PK_iMaDoiTuong = tbl_ungvien.FK_iMaDoiTuong');
		$this->db->join('dm_nganh_liennganh','dm_nganh_liennganh.PK_iMaNganhLN = tbl_ungvien.FK_iMaNganh');
		$this->db->join('dm_dantoc','dm_dantoc.PK_iMaDanToc = tbl_ungvien.FK_iMaDanToc');
		$this->db->join('dm_tongiao','dm_tongiao.PK_iMaTG = tbl_ungvien.FK_iMaTG');
		$this->db->join('dm_hoidongcoso','dm_hoidongcoso.PK_iMaHoiDong = tbl_ungvien.FK_iMaHDCS');
		$this->db->where('PK_iMaUV', $maUV);
		return $this->db->get()->row_array();
	}
}
