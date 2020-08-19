<?php

class Madmin extends MY_Model
{
    public function getDanhSachUngVien()
    {
      // $this->db->where('sMaQuyen !=','1');
      $this->db->select('tbl_thongtinungvien.sHoTen,PK_iMaUV,sGioiTinh,sQueQuan,dNgaySinh');
      $this->db->join('tbl_taikhoan', 'tbl_taikhoan.PK_iMaTK = tbl_thongtinungvien.FK_iMaTK','inner');
      return $this->db->get('tbl_thongtinungvien')->result_array();
    } 
}