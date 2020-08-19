<?php
/**
 * Created by PhpStorm.
 * User: Nguyễn Duy Thành
 * Date: 09/10/2019
 * Time: 09:17 SA
 */

class Mthamdinhsach extends MY_Model
{
	public function getListBookPublish($maUV)
	{
		$this->db->where('FK_iMaUV', $maUV);
		$this->db->join('dm_loaisach', 'dm_loaisach.PK_iMaLoaiSach = tbl_sachphucvudaotao.FK_iMaLoaiSach', 'inner');
		$this->db->join('tbl_minhchung_sachpvdt', 'tbl_minhchung_sachpvdt.PK_iMaSach = tbl_sachphucvudaotao.PK_iMaSach', 'inner');
		$listBook = $this->db->get('tbl_sachphucvudaotao')->result_array();
		$newListBook = array();
		foreach ($listBook as $k => $v) {
			$newListBook[$v['FK_iMaGiaiDoan']][] = $v;
		}
		return $newListBook;
	}

	public function getChucDanhHienTai($maUV)
	{
		$this->db->where('PK_iMaUV', $maUV);
		$this->db->select('FK_iChucDanhXet');
		return $this->db->get('tbl_ungvien')->row_array()['FK_iChucDanhXet'];
	}

	public function countSoLuongSachUyTinGDSau($maUV)
	{
		$this->db->where('FK_iMaUV', $maUV);
		$this->db->where('sNXBUyTin', 'Uy tín');
		$this->db->where('FK_iMaGiaiDoan', 2);
		return $this->db->get('tbl_sachphucvudaotao')->num_rows();
	}

	public function updateReviewBook($maSach,$maUyVien,$dataUpdate)
	{
		$this->db->where('FK_iMaSach', $maSach);
		$this->db->where('FK_iMaUyVien', $maUyVien);
		$this->db->update('tbl_thamdinh_sach', $dataUpdate);
		return $this->db->affected_rows();
	}
	
	public function checkExistReviewBook($maSach,$maUyVien)
	{
		$this->db->where('FK_iMaUyVien', $maUyVien);
		$this->db->where('FK_iMaSach', $maSach);
		return $this->db->get('tbl_thamdinh_sach')->num_rows();
	}
	public function getInfoReviewBook($maUngVien,$maUyVien)
	{
		$this->db->where('FK_iMaUyVien', $maUyVien);
		$this->db->where('FK_iMaUV', $maUngVien);
		$this->db->join('tbl_sachphucvudaotao', 'tbl_sachphucvudaotao.PK_iMaSach = tbl_thamdinh_sach.FK_iMaSach', 'inner');
		return $this->db->get('tbl_thamdinh_sach')->result_array();
	}
	public function getInfoReview()
	{
		return $this->db->get('tbl_thamdinh_sach')->result_array();
	}
	public function getInfoBook($maSach)
	{
		$this->db->select('PK_iMaSach,sTenSach');
		$this->db->where('PK_iMaSach', $maSach);
		return $this->db->get('tbl_sachphucvudaotao')->result_array();
	}
	public function thongKeKetQuaVietSach($maUyVien,$maUngVien)
	{
		$this->db->select('sThamDinh3NamCuoi,sThamDinhVaiTro,FK_iLoaiSach,Count(FK_iMaSach) AS soquyen,sum(iThamDinhSoTacGia) AS sotacgia,fDiem');
		$this->db->join('tbl_sachphucvudaotao', 'tbl_sachphucvudaotao.PK_iMaSach = tbl_thamdinh_sach.FK_iMaSach', 'inner');
		$this->db->where('FK_iMaUyVien', $maUyVien);
		$this->db->where('FK_iMaUV', $maUngVien);
		$this->db->group_by('FK_iLoaiSach, sThamDinhVaiTro,sThamDinh3NamCuoi');
		return $this->db->get('tbl_thamdinh_sach')->result_array();
	}

	public function demSach($masach)
	{
		$this->db->where("FK_iLoaiSach", $masach);
		return $this->db->get('tbl_thamdinh_sach')->result_array();
	}

	public function demSoTG($mathamdinh, $thamdinhvt)
	{
		// $this->db->select('sum(iThamDinhSoTacGia) AS sotacgia, count(FK_iLoaiSach) as demsachTG, sThamDinhVaiTro,PK_iMaThamDinhSach');
		$this->db->where("sThamDinh3NamCuoi", $mathamdinh);
		$this->db->where("sThamDinhVaiTro", $thamdinhvt);
		return $this->db->get('tbl_thamdinh_sach')->result_array();
	}

	public function insertThamDinh($arrInsert)
	{
		$this->db->trans_start();
		try {
			$row = $this->db->affected_rows();
			if (!empty($arrInsert)){
				$this->db->insert('tbl_thamdinh_sach', $arrInsert);
				$row += $this->db->affected_rows();
			}
		}
		catch (Exception $e) {
			$row = 0;
		}
		$this->db->trans_complete();
		return $row;
	}
	public function checkPermissionReview($maUngVien,$maUyVien)
	{		
		$this->db->where('FK_iMaUV', $maUngVien);
		$this->db->where('FK_iMaUyVien', $maUyVien);
		return $this->db->get('tbl_phancong_thamdinh')->num_rows();
	}

}