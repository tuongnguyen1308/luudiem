<?php

class Mmau06 extends MY_Model
{
  public function __construct()
	{
		parent::__construct();
		//Do your magic here
	}
    public function getRevInfo($idUV)
	{
		$this->db->where('PK_iMaTK', $idUV);
    $this->db->join('dm_nganh', 'dm_nganh.PK_iMaNganh = tbl_taikhoan.FK_iMaNganh','inner');
    $this->db->join('dm_chucdanh', 'dm_chucdanh.PK_iMaCD = tbl_taikhoan.FK_iMaCD','inner');
		return $this->db->get('tbl_taikhoan')->row_array();
    }
    public function getCanInfo($maUngVien)
    {
        $this->db->where('tbl_thongtinungvien.PK_iMaUV', $maUngVien);
        $this->db->join('dm_chucdanh','tbl_thongtinungvien.FK_iMaCD= dm_chucdanh.PK_iMaCD','inner');
        $this->db->join('dm_dantoc','tbl_thongtinungvien.FK_iMaDanToc = dm_dantoc.PK_iMaDanToc','inner');
        $this->db->join('dm_nganh','tbl_thongtinungvien.FK_iMaNganh = dm_nganh.PK_iMaNganh','inner');
        return $this->db->get('tbl_thongtinungvien')->row_array();
    }
    public function Explore($data) {
		$res = $data;
		if (!empty($data)) {
			$res = explode('|', $data);
		}
		return $res;
	}
    public function getTongHopKQHDDT($mauv)
	{
		$this->db->where('FK_iMaUV', $mauv);
		$data = $this->db->get('tbl_tonghop')->row_array();
		if(!empty($data)) {
			$data['sGioGiangDay'] = $this->Explore($data['sGioGiangDay']);
			$data['sHuongDanChinh'] = $this->Explore($data['sHuongDanChinh']);
			$data['sChuTriNVB'] = $this->Explore($data['sChuTriNVB']);
			$data['sChuTriNVCS'] = $this->Explore($data['sChuTriNVCS']);
			$data['sTongDiemBienSoanSach'] = $this->Explore($data['sTongDiemBienSoanSach']);
			$data['sSoDiemBienSoanGTCK'] = $this->Explore($data['sSoDiemBienSoanGTCK']);
		}
		return $data;
    }
    public function getNhanXet($mauv)
	{		
		$this->db->where('FK_iMaUV', $mauv);
		return $this->db->get('tbl_nhanxet')->row_array();
    }
}