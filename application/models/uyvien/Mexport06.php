<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mexport06 extends MY_Model {

  public function getInfo($mauv)
  {
    $this->db->where('PK_iMaUV', $mauv);
    $this->db->join('dm_nganh', 'dm_nganh.PK_iMaNganh = tbl_thongtinungvien.FK_iMaNganh', 'inner');
    $this->db->join('dm_chucdanh', 'dm_chucdanh.PK_iMaCD = tbl_thongtinungvien.FK_iMaCD', 'left');
    $this->db->join('dm_dantoc', 'dm_dantoc.PK_iMaDanToc = tbl_thongtinungvien.FK_iMaDanToc', 'left');
    $this->db->join('tbl_kqtd', 'tbl_kqtd.FK_iMaUV = tbl_thongtinungvien.PK_iMaUV', 'left');
    $this->db->join('dm_doituong', 'dm_doituong.PK_iMaDoiTuong = tbl_kqtd.FK_iMaDoiTuong', 'left');
		return $this->db->get('tbl_thongtinungvien')->row_array();
  }
  public function getMuc3($mauv)
  {
    $this->db->where('PK_iMaUV', $mauv); 
    $this->db->join('tbl_muc3', 'tbl_muc3.FK_iMaUV = tbl_thongtinungvien.PK_iMaUV', 'left');
    return $this->db->get('tbl_thongtinungvien')->result_array();
  }
  public function getTongHop($mauv)
  {
    $this->db->where('FK_iMaUV', $mauv); 
    return $this->db->get('tbl_tonghop')->row_array();
  }
  public function getNhanXet($mauv)
  {
    $this->db->where('FK_iMaUV', $mauv);
    return $this->db->get('tbl_nhanxet')->row_array();
  }
  public function getMuc7($mauv)
  {
    $this->db->where('FK_iMaUV', $mauv); 
    return $this->db->get('tbl_muc7')->row_array();
	}
  public function getInfoUyVien($username)
  {
    $this->db->where('sUsername', $username);
    $this->db->join('dm_nganh', 'dm_nganh.PK_iMaNganh = tbl_taikhoan.FK_iMaNganh', 'inner');
    $this->db->join('dm_chucdanh', 'dm_chucdanh.PK_iMaCD = tbl_taikhoan.FK_iMaCD', 'inner');
    return $this->db->get('tbl_taikhoan')->row_array();
  }
  public function getThamDinh($mauv)
  {
    $this->db->where('FK_iMaUV', $mauv);
    return $this->db->get('tbl_kqtd')->row_array();
  }
  public function getTdSach($mauv)
	{
		$this->db->where('FK_iMaUV', $mauv);
		// $this->db->where('FK_iMaUyVien', $mauyv);
		// $this->db->where('sTruongThamDinh !=','stt');
		$muc6 = $this->db->get('tbl_sach')->result_array();
		$res = array(
			'ck_mm'	=> array(),
			'ck_cb'	=> array(),
			'ck_vc'	=> array(),
			'cs_mm'	=> array(),
			'cs_vc'	=> array(),
			// 'gt_mm'	=> array(),
			'gt_vcbvbs'	=> array(),
			'gt_cb'	=> array(),
			'gt_vc'	=> array(),
			'tk'	=> array(),
			'hd'	=> array(),
			'tong'	=> 0,
			'tong3'	=> 0
		);
		
		foreach ($muc6 as $key => $value) {
			
			
			switch ($value['sLoaiSach']) {
				case 'ck':
					switch ($value['sVaiTro']) {

						case 'mm':
							$res['tong'] += $value['iSoDiem'];
							$res['tong3'] += $value['iDiemBaNamCuoi'];
							array_push($res['ck_mm'], $value);
						break;

						case 'cb':
							$res['tong'] += $value['iSoDiem'];
							$res['tong3'] += $value['iDiemBaNamCuoi'];
							array_push($res['ck_cb'], $value);
						break;
						case 'vc':
							$res['tong'] += $value['iSoDiem'];
							$res['tong3'] += $value['iDiemBaNamCuoi'];
							array_push($res['ck_vc'], $value);
						break;
					}
				break;
				case 'cs':
					switch ($value['sVaiTro']) {

						case 'mm':
							$res['tong'] += $value['iSoDiem'];
							$res['tong3'] += $value['iDiemBaNamCuoi'];
							array_push($res['cs_mm'], $value);
						break;
						case 'vc':
							$res['tong'] += $value['iSoDiem'];
							$res['tong3'] += $value['iDiemBaNamCuoi'];
							array_push($res['cs_vc'], $value);
						break;
					}
				break;
				case 'gt':
					switch ($value['sVaiTro']) {
						case 'cbtg':
							$res['tong'] += $value['iSoDiem'];
							$res['tong3'] += $value['iDiemBaNamCuoi'];
							array_push($res['gt_vcbvbs'], $value);
						break;
						case 'cb':
							$res['tong'] += $value['iSoDiem'];
							$res['tong3'] += $value['iDiemBaNamCuoi'];
							array_push($res['gt_cb'], $value);
						break;
						case 'vc':
							$res['tong'] += $value['iSoDiem'];
							$res['tong3'] += $value['iDiemBaNamCuoi'];
							array_push($res['gt_vc'], $value);
						break;
					}
				break;
				case 'tk':
					$res['tong'] += $value['iSoDiem'];
					$res['tong3'] += $value['iDiemBaNamCuoi'];
					array_push($res['tk'], $value);
				break;
				case 'hd':
					$res['tong'] += $value['iSoDiem'];
					$res['tong3'] += $value['iDiemBaNamCuoi'];
					array_push($res['hd'], $value);
				break;
			}
		} 
		// pr($res);
		// pr($muc6);


		$result = array($res);
		$count = array(
			'ck' => 0,
			'ck_mm' => 0,
			'ck_cb' => 0,
			'ck_vc' => 0,
			'cs' => 0,
			'cs_mm' => 0,
			'cs_vc' => 0,
			'gt' => 0,
			// 'gt_mm' => 0,
			'gt_vcbvbs' => 0,
			'gt_cb' => 0,
			'gt_vc' => 0,
			'tk' => 0,
			'hd' => 0
		);
		foreach ($result[0] as $key => $value) {
			switch ($key) {
				case 'ck_mm':
					$count['ck_mm'] += count($value);
					$count['ck'] += count($value);
				break;
				case 'ck_cb':
					$count['ck_cb'] += count($value);
					$count['ck'] += count($value);
				break;
				case 'ck_vc':
					$count['ck_vc'] += count($value);
					$count['ck'] += count($value);
				break;
				case 'cs_mm':
					$count['cs_mm'] += count($value);
					$count['cs'] += count($value);
				break;
				case 'cs_vc':
					$count['cs_vc'] += count($value);
					$count['cs'] += count($value);
				break;
				// case 'gt_mm':
				// 	$count['gt_mm'] += count($value);
				// 	$count['gt'] += count($value);

				case 'gt_vcbvbs':
					$count['gt_vcbvbs'] += count($value);
					$count['gt'] += count($value);

				break;
				case 'gt_cb':
					$count['gt_cb'] += count($value);
					$count['gt'] += count($value);
				break;
				case 'gt_vc':
					$count['gt_vc'] += count($value);
					$count['gt'] += count($value);
				break;
				case 'tk':
					$count['tk'] += count($value);
				break;
				case 'hd':
					$count['hd'] += count($value);
				break;
			}
		}
		// kiểm tra xem có hàng trống không, nếu không có dữ liệu sẽ chừa 1 hàng
		if ($count['ck_mm'] == 0) {
			$count['ck_mm'] = 1;
			$count['ck']++;
		}
		if ($count['ck_cb'] == 0) {
			$count['ck_cb'] = 1;
			$count['ck']++;
		}
		if ($count['ck_vc'] == 0) {
			$count['ck_vc'] = 1;
			$count['ck']++;
		}
		if ($count['cs_mm'] == 0) {
			$count['cs_mm'] = 1;
			$count['cs']++;
		}
		if ($count['cs_vc'] == 0) {
			$count['cs_vc'] = 1;
			$count['cs']++;
		}
		// if ($count['gt_mm'] == 0) {
		// 	$count['gt_mm'] = 1;
		// 	$count['gt']++;
		// }

		if ($count['gt_vcbvbs'] == 0) {
			$count['gt_vcbvbs'] = 1;
			$count['gt']++;
		}
		if ($count['gt_cb'] == 0) {
			$count['gt_cb'] = 1;
			$count['gt']++;
		}
		if ($count['gt_vc'] == 0) {
			$count['gt_vc'] = 1;
			$count['gt']++;
		}
		if ($count['tk'] == 0) {
			$count['tk']++;
		}
		if ($count['hd'] == 0) {
			$count['hd']++;
		}
		// end kiểm tra
		$result['count'] = $count;

		$this->db->where('FK_iMaUV', $mauv);
		// $this->db->where('FK_iMaUyVien', $mauyv);
		// $this->db->where('sTruongThamDinh =','stt');
		$result['soTT'] = $this->db->get('tbl_sach')->row_array();
		// pr($result);
		return $result;
	}

}


