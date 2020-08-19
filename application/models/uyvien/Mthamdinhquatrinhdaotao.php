<?php
/**
 * Created by PhpStorm.
 * User: Nguyễn Duy Thành
 * Date: 06/09/2019
 * Time: 09:43 SA
 */

class Mthamdinhquatrinhdaotao extends MY_Model
{
	public function getQuaTrinhDaoTao($maUV)
	{
		$this->db->where('FK_iMaUV', $maUV);
		$this->db->join('dm_bangcap', 'dm_bangcap.PK_iMaBangCap = tbl_quatrinhdaotao.FK_iMaBangCap');
		$this->db->join('tbl_minhchung_qtdt', 'tbl_quatrinhdaotao.PK_iMaQTDT = tbl_minhchung_qtdt.PK_iMaQTDT', 'inner');
		$this->db->join('tbl_thamdinh_quatrinhdaotao','tbl_thamdinh_quatrinhdaotao.FK_iMaQTDT = tbl_quatrinhdaotao.PK_iMaQTDT','left');
		$this->db->order_by('FK_iMaBangCap', 'asc');
		return $this->db->get('tbl_quatrinhdaotao')->result_array();
	}
	public function insertReviewEducationProcess($data)
	{
		$this->db->insert('tbl_thamdinh_quatrinhdaotao', $data);
		return $this->db->affected_rows();
	}
	public function updateReviewEducationProcess($mauv,$maqtdt,$arrUdt)
	{
		$this->db->where('FK_iMaUyVien', $mauv);
		$this->db->where('FK_iMaQTDT', $maqtdt);
		$this->db->update('tbl_thamdinh_quatrinhdaotao', $arrUdt);
		return $this->db->affected_rows();
	}
	public function checkExistRow($mauv,$maqtdt)
	{
		$this->db->where('FK_iMaUyVien', $mauv);
		$this->db->where('FK_iMaQTDT', $maqtdt);
		return $this->db->get('tbl_thamdinh_quatrinhdaotao')->num_rows();
	}

}
