<?php
/**
 * Created by PhpStorm.
 * User: Nguyễn Duy Thành
 * Date: 04/10/2019
 * Time: 10:27 SA
 */

class Mthamdinhhuongdanhocvien extends MY_Model
{
	public function getHocVien($maUV)
	{
		$this->db->where('FK_iMaUV', $maUV);
		$this->db->join('tbl_minhchung_hdhv', 'tbl_minhchung_hdhv.PK_iMaHDHV = tbl_huongdanhocvien.PK_iMaHocVien', 'inner');
		return $this->db->get('tbl_huongdanhocvien')->result_array();
	}

	public function insertThamDinhHocVien($arrIns)
	{
		$this->db->insert('tbl_thamdinh_huongdanhocvien', $arrIns);
		return $this->db->affected_rows();
	}

	public function updateThamDinhHocVien($maUyVien,$maHocVien, $arrUdt)
	{
		$this->db->where('FK_iMaUyVien', $maUyVien);
		$this->db->where('FK_iMaHocVien', $maHocVien);
		$this->db->update('tbl_thamdinh_huongdanhocvien', $arrUdt);
		return $this->db->affected_rows();
	}

    public function checkExistReviewStudentGuide($maUyVien,$maHocVien)
    {
        $this->db->where('FK_iMaUyVien', $maUyVien);
		$this->db->where('FK_iMaHocVien', $maHocVien);
		return $this->db->get('tbl_thamdinh_huongdanhocvien')->num_rows();
	}
	public function getInfoReviewStudentGuide($maUyVien,$maHocVien)
	{
		$this->db->where('FK_iMaUyVien', $maUyVien);
		$this->db->where('FK_iMaHocVien', $maHocVien);
		$this->db->join('tbl_huongdanhocvien', 'tbl_huongdanhocvien.PK_iMaHocVien = tbl_thamdinh_huongdanhocvien.FK_iMaHocVien', 'inner');
		return $this->db->get('tbl_thamdinh_huongdanhocvien')->row_array();
	}
	public function thongKeHocVien()
	{
		$this->db->select('sGhiChu,sThamDinhDoiTuongHocVien,sThamDinhTrachNhiemHuongDan,Count(PK_iThamDinh_HuongDanHocVien) as soluonghocvien');
		$this->db->group_by('sThamDinhDoiTuongHocVien, sThamDinhTrachNhiemHuongDan');
		return $this->db->get('tbl_thamdinh_huongdanhocvien')->result_array();
	}
	
}