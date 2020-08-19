<?php

class MmucCTDT extends MY_Model
{
  public function getThamDinh($mauv)
  {
    $this->db->select('sKetQuaDaoTao,sNgoaiNguThanhThao,sGiaoTiepTiengAnh,sTyLePhieuTinNhiem');
    $this->db->where('FK_iMaUV',$mauv);
    return $this->db->get('tbl_kqtd')->row_array();
  }
  public function updateThamDinh($data,$mauv)
  {
    $this->db->where('FK_iMaUV',$mauv);
    $this->db->update('tbl_kqtd',$data);
    return $this->db->affected_rows();
  }
}