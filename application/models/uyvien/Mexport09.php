<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mexport09 extends MY_Model {
  public function get09($mauv)
  {
    $this->db->where('PK_iMaUV',$mauv);
    $this->db->join('dm_nganh','dm_nganh.PK_iMaNganh = tbl_thongtinungvien.FK_iMaNganh','left');
    $this->db->join('dm_dantoc','dm_dantoc.PK_iMaDanToc = tbl_thongtinungvien.FK_iMaDanToc','left');
    $this->db->join('dm_chucdanh','dm_chucdanh.PK_iMaCD = tbl_thongtinungvien.FK_iMaCD','left');
    $this->db->join('tbl_kqtd','tbl_kqtd.FK_iMaUV = tbl_thongtinungvien.PK_iMaUV','left');
    $this->db->join('tbl_muc7','tbl_muc7.FK_iMaUV = tbl_thongtinungvien.PK_iMaUV','left');
    $this->db->join('tbl_tonghop','tbl_tonghop.FK_iMaUV = tbl_thongtinungvien.PK_iMaUV','left');
    $this->db->join('dm_doituong','tbl_kqtd.FK_iMaDoiTuong = dm_doituong.PK_iMaDoiTuong','left');
    return $this->db->get('tbl_thongtinungvien')->row_array();
  }
  public function getThongTinUyVien($mauv)
  {
    $this->db->where('sUsername',$mauv);
    $this->db->join('dm_chucdanh','dm_chucdanh.PK_iMaCD = tbl_taikhoan.FK_iMaCD','inner');
    return $this->db->get('tbl_taikhoan')->row_array();
  }
  public function get03($mauv)
  {
    $this->db->where('FK_iMaUV',$mauv);    
    $this->db->select('iSoGioChuan');    
    $this->db->limit('3');    
    $this->db->order_by('iSTT','desc');
    return $this->db->get('tbl_muc3')->result_array();
  }
  public function countSach($mauv)
  {
    $this->db->where('FK_iMaUV',$mauv); 
    $listBook = $this->db->get('tbl_sach')->result_array();
    // pr($listBook);
    $newListBook = array(
      'SLCK' => 0,
      'SLCS' => 0,
      'SLGT' => 0,
      'SLSTK' => 0,
      'SLSHD' => 0,
      'Tongdiemsach' => 0,
      'diem3namcuoi' => 0,
      'CKUT' => 0,
      'DCS' => 0,
      'DCK' => 0,
      'DGT' => 0,
      'DSTK' => 0,
      'DSHD' => 0,
    );
    
    foreach ($listBook as $k => $v) {
      if($v['sLoaiSach'] =='ck')
          {
              $newListBook['SLCK']++;
              $newListBook['DCK']+=$v['iSoDiem'];
              $newListBook['Tongdiemsach']+=$v['iSoDiem'];
              // if($v['Td_FK_iMaGiaiDoan'] == 2 && $v['Td_FK_iMaGiaiDoan']== 'Uy tín')
              // {
              //     $newListBook['CKUT']++;
              // }
          }
          if($v['sLoaiSach'] =='cs' && $v['sNhaXuatBanUyTin'] == 'Uy tín')
          {
              $newListBook['SLCS']++;
              $newListBook['DCS']+=$v['iSoDiem'];
              $newListBook['Tongdiemsach']+=$v['iSoDiem'];
          }
      if($v['sLoaiSach'] =='gt')
      {
          $newListBook['SLGT']++;
          $newListBook['DGT']+=$v['iSoDiem'];                
          $newListBook['Tongdiemsach']+=$v['iSoDiem'];

      }
      if($v['sLoaiSach'] =='tk')
      {
          $newListBook['SLSTK']++;
          $newListBook['DSTK']+=$v['iSoDiem'];
          $newListBook['Tongdiemsach']+=$v['iSoDiem'];

      }
      if($v['sLoaiSach'] =='hd')
      {
          $newListBook['SLSHD']++;
          $newListBook['DSHD']+=$v['iSoDiem'];
          $newListBook['Tongdiemsach']+=$v['iSoDiem'];

      }
    }
    // pr($newListBook);
    return $newListBook;
  }
}


