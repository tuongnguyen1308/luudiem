<?php

ini_set('max_execution_time', 3000); 
ini_set('memory_limit','2048M');
ini_set('max_input_vars', 6000);
/**
 * User: Nguyễn Đình Tưởng
 * 5 col
 */

class Caddfile extends MY_Controller
{
    public $Maddfile;
    public $id = '';
	public function __construct()
	{
		parent::__construct();
        $this->load->model('Maddfile', 'Maddfile');
        $this->load->library('excel');
		$this->Maddfile = new Maddfile();
	}
    
    public function index()
    {
		if ($this->input->post('download_demo')) {
			$this->download_demo();
		}
        else if ($this->input->post('submit_import')) {
            $this->importSV();
		}
		switch ($this->input->post('action')) {
			case 'get_all_ds_ajax':
				$this->get_all_ds_ajax();
				break;
			case 'submit_import_ajax':
				$this->import_excel_ajax();
				break;
		}
        $data = array(
			'currentpage'	=> 'add'
		);
        $temp['data'] = $data;
        $temp['template'] = 'Vaddfile';
        $this->load->view('layouts/Vlayout', $temp);
    }

	public function importSV()
    {
        // pr($_FILES['importExcel']);
        if (isset($_FILES['importExcel']['name'])) {
			$res = 0;
            $path = $_FILES['importExcel']['tmp_name'];
            $object = PHPExcel_IOFactory::load($path);
            $worksheet = $object->getSheet(0);
			$lastRow		= $worksheet->getHighestRow();
			$hightestCol	= $worksheet->getHighestColumn();
			$lastColumn		= PHPExcel_Cell::columnIndexFromString($hightestCol);
			// pr($hightestCol);
			
			#region insert_ctdt + namtn
			$sTenBac	= $worksheet->getCellByColumnAndRow(3,4)->getValue();
			$sTenDonVi	= $worksheet->getCellByColumnAndRow(3,5)->getValue();
			$sTenHe		= $worksheet->getCellByColumnAndRow(7,4)->getValue();
			$sTenNganh	= $worksheet->getCellByColumnAndRow(7,5)->getValue();
			$iKhoa		= $worksheet->getCellByColumnAndRow(7,6)->getValue();
			$PK_iNamTN	= $worksheet->getCellByColumnAndRow(3,6)->getValue();

			$insert_bac = array(
				'PK_iMaBac'	=> sha1($sTenBac),
				'sTenBac'	=> $sTenBac
			);

			$insert_he = array(
				'PK_iMaHe'	=> sha1($sTenHe),
				'sTenHe'	=> $sTenHe
			);

			$insert_nganh = array(
				'PK_iMaNganh'	=> sha1($sTenNganh),
				'sTenNganh'		=> $sTenNganh
			);
			$PK_iMaCTDT = sha1($sTenBac + $sTenHe + $sTenNganh);
			$insert_ctdt = array(
				'PK_iMaCTDT'	=> $PK_iMaCTDT,
				'FK_iMaBac'		=> $insert_bac['PK_iMaBac'],
				'FK_iMaHe'		=> $insert_he['PK_iMaHe'],
				'FK_iMaNganh'	=> $insert_nganh['PK_iMaNganh'],
				'sNam'			=> $PK_iNamTN
			);
			
			$insert_donvi = array(
				'PK_iMaDonVi'	=> sha1($sTenDonVi),
				'sTenDonVi'		=> $sTenDonVi
			);

			$PK_iMaDVCTDT = sha1($sTenDonVi + $PK_iMaCTDT);
			$insert_dv_ctdt = array(
				'PK_iMaDVCTDT'	=> $PK_iMaDVCTDT,
				'FK_iMaDonVi'	=> $insert_donvi['PK_iMaDonVi'],
				'FK_iMaCTDT'	=> $insert_ctdt['PK_iMaCTDT']
			);

			$PK_iMaKhoa = sha1($iKhoa + $PK_iMaCTDT);
			$insert_khoahoc = array(
				'PK_iMaKhoa'	=> $PK_iMaKhoa,
				'iKhoa'			=> $iKhoa,
				'FK_iMaDVCTDT'	=> $insert_dv_ctdt['PK_iMaDVCTDT']
			);

			$insert_namtn = array(
				'PK_iNamTN'	=> $PK_iNamTN
			);
			$affected_rows	= $this->Maddfile->insert_table('tbl_bac', $insert_bac);
			$affected_rows += $this->Maddfile->insert_table('tbl_he', $insert_he);
			$affected_rows += $this->Maddfile->insert_table('tbl_nganh', $insert_nganh);
			$affected_rows += $this->Maddfile->insert_table('tbl_ctdt', $insert_ctdt);
			$affected_rows += $this->Maddfile->insert_table('tbl_donvi', $insert_donvi);
			$affected_rows += $this->Maddfile->insert_table('tbl_donvi_ctdt', $insert_dv_ctdt);
			$affected_rows += $this->Maddfile->insert_table('tbl_khoa', $insert_khoahoc);
			$affected_rows += $this->Maddfile->insert_table('tbl_namtn', $insert_namtn);
			#endregion

			#region insert_mon mon_ctdt
			$so_cot = $sTenHe == 'Đào tạo từ xa' ? 5 : 3;
			
			$ds_ma_mon_ctdt			= array(); // lưu danh sách mã môn hiện tại trong file excel
			 // danh sách môn chuẩn bị insert
			$insert_ds_mon			= array();
			$insert_ds_mon_ctdt		= array();
			 // danh sách môn đã có trong db
			$already_ds_ma_mon		= $this->Maddfile->get_ds_ma('tbl_mon', 'PK_iMaMon');
			$already_ds_ma_mon_ctdt	= $this->Maddfile->get_ds_ma('tbl_mon_ctdt', 'PK_iMaMon_CTDT');

			for ($column = 7, $i = 1; $column < $lastColumn - 13; $column += $so_cot) {
				$sTenMon = $worksheet->getCellByColumnAndRow($column, 7)->getValue();
				$mon = array(
					'PK_iMaMon'	=> sha1($sTenMon),
					'sTenMon'	=> $sTenMon,
					'sTenMonTA'	=> $worksheet->getCellByColumnAndRow($column, 8)->getValue(),
					'iSoTinChi'	=> $worksheet->getCellByColumnAndRow($column, 9)->getValue()
				);
				if (!in_array($mon['PK_iMaMon'], $already_ds_ma_mon)) {
					array_push($insert_ds_mon, $mon);
				}
				$mon_ctdt = array(
					'PK_iMaMon_CTDT'	=> $mon['PK_iMaMon'].'_'.$insert_ctdt['PK_iMaCTDT'],
					'iSTT'				=> count($insert_ds_mon),
					'FK_iMaMon'			=> $mon['PK_iMaMon'],
					'FK_iMaCTDT'		=> $insert_ctdt['PK_iMaCTDT']
				);
				if (!in_array($mon_ctdt['PK_iMaMon_CTDT'], $already_ds_ma_mon_ctdt)) {
					array_push($insert_ds_mon_ctdt, $mon_ctdt);
				}
				array_push($ds_ma_mon_ctdt, $mon_ctdt['PK_iMaMon_CTDT']);
			}
			$this->Maddfile->insert_batch_table('tbl_mon', $insert_ds_mon);
			$this->Maddfile->insert_batch_table('tbl_mon_ctdt', $insert_ds_mon_ctdt);
			#endregion
			
			#region insert lop sinhvien nhaphoc sinhvien_lop diem

			// danh sách chuẩn bị insert
			$insert_ds_lop		= array();
			$insert_ds_sv		= array();
			$insert_ds_nhaphoc	= array();
			$insert_ds_sv_lop	= array();
			$insert_ds_diem		= array();
			 // danh sách đã có trong db
			$already_ds_ma_lop		= $this->Maddfile->get_ds_ma('tbl_lop_hanh_chinh', 'PK_iMaLop');
			$already_ds_ma_sv		= $this->Maddfile->get_ds_ma('tbl_sinhvien', 'PK_iMaSV');
			$already_ds_ma_nhaphoc	= $this->Maddfile->get_ds_ma('tbl_nhaphoc', 'PK_iMaNhaphoc');
			$already_ds_ma_diem		= $this->Maddfile->get_ds_ma('tbl_diem', 'PK_iMaDiem');
			
			for ($row = 11; $row <= $lastRow; $row++) {
				$ten_lop = $worksheet->getCellByColumnAndRow(1,$row)->getValue();
				$lop = array(
					'PK_iMaLop'	=> sha1($ten_lop),
					'sTenLop'	=> $ten_lop,
					'FK_iMaKhoa'=> $insert_khoahoc['PK_iMaKhoa']
				);
				if (!in_array($lop['PK_iMaLop'], $already_ds_ma_lop) && !in_array($lop, $insert_ds_lop)) {
					array_push($insert_ds_lop, $lop);
				}

				$sv = array(
					'PK_iMaSV'	=> $worksheet->getCellByColumnAndRow(2,$row)->getValue(),
					'sHo'		=> $worksheet->getCellByColumnAndRow(3,$row)->getValue(),
					'sTen'		=> $worksheet->getCellByColumnAndRow(4,$row)->getValue(),
					'dNgaySinh'	=> implode('-', array_reverse(explode('/',$worksheet->getCellByColumnAndRow(5,$row)->getValue()))),
					'sGioiTinh'	=> $worksheet->getCellByColumnAndRow(6,$row)->getValue(),
				);
				if (!in_array($sv['PK_iMaSV'], $already_ds_ma_sv) && !in_array($sv, $insert_ds_sv)) {
					array_push($insert_ds_sv, $sv);
				}

				$nhaphoc = array(
					'PK_iMaNhapHoc'	=> $sv['PK_iMaSV'] . '_' . $insert_ctdt['PK_iMaCTDT'],
					'FK_iMaSV'		=> $sv['PK_iMaSV'],
					'FK_iMaKhoa'	=> $insert_khoahoc['PK_iMaKhoa'],
					'sGDTC'			=> $worksheet->getCellByColumnAndRow($lastColumn-13,$row)->getValue(),
					'sGDQP'			=> $worksheet->getCellByColumnAndRow($lastColumn-12,$row)->getValue(),
					'sCDRNN'		=> $worksheet->getCellByColumnAndRow($lastColumn-11,$row)->getValue(),
					'sXLRenLuyen'	=> $worksheet->getCellByColumnAndRow($lastColumn-10,$row)->getValue(),
					'sTBCTL'		=> $worksheet->getCellByColumnAndRow($lastColumn-9,$row)->getValue(),
					'iSoTCTL'		=> $worksheet->getCellByColumnAndRow($lastColumn-8,$row)->getValue(),
					'iSoTCConNo'	=> $worksheet->getCellByColumnAndRow($lastColumn-7,$row)->getValue(),
					'sXepLoaiTotNghiep'			=> $worksheet->getCellByColumnAndRow($lastColumn-6,$row)->getValue(),
					'sSoQuyetDinhDauVao'		=> $worksheet->getCellByColumnAndRow($lastColumn-5,$row)->getValue(),
					'dNgayQuyetDinhDauVao'		=> implode('-', array_reverse(explode('/',$worksheet->getCellByColumnAndRow($lastColumn-4,$row)->getValue()))),
					'sSoQuyetDinhTotNghiep'		=> $worksheet->getCellByColumnAndRow($lastColumn-3,$row)->getValue(),
					'dNgayQuyetDinhTotNghiep'	=> implode('-', array_reverse(explode('/',$worksheet->getCellByColumnAndRow($lastColumn-2,$row)->getValue()))),
					'iSoHocPhanThiLai'			=> $worksheet->getCellByColumnAndRow($lastColumn-1,$row)->getValue(),
					'FK_iNamTN'					=> $PK_iNamTN
				);
				
				$sv_lop = array(
					'PK_iMaSVLop'	=> $lop['PK_iMaLop'].'_'.$nhaphoc['PK_iMaNhapHoc'],
					'FK_iMaLop'		=> $lop['PK_iMaLop'],
					'FK_iMaNhapHoc'	=> $nhaphoc['PK_iMaNhapHoc']
				);

				if (!in_array($nhaphoc['PK_iMaNhapHoc'], $already_ds_ma_nhaphoc) && !in_array($nhaphoc, $insert_ds_nhaphoc)) {
					array_push($insert_ds_nhaphoc, $nhaphoc);
					array_push($insert_ds_sv_lop, $sv_lop);
				}

				for ($column = 7, $i = 0; $column < $lastColumn - 13;) {
					$diem = array(
						'PK_iMaDiem'	=> $sv_lop['PK_iMaSVLop'].'_'.$i,
						'iDT10'			=> $worksheet->getCellByColumnAndRow($column++, $row)->getValue(),
						'sDTChu'		=> $worksheet->getCellByColumnAndRow($column++, $row)->getValue(),
						'iDT4'			=> $worksheet->getCellByColumnAndRow($column++, $row)->getValue(),
						'FK_iMaSVLop'	=> $sv_lop['PK_iMaSVLop'],
						'FK_iMaMonCTDT'	=> $ds_ma_mon_ctdt[$i++],
					);
					if ($so_cot == 5) {
						$diem['sLichSu']	= $worksheet->getCellByColumnAndRow($column++, $row)->getValue();
						$diem['sNoiMien']	= $worksheet->getCellByColumnAndRow($column++, $row)->getValue();
					}
					
					if (!in_array($diem['PK_iMaDiem'], $already_ds_ma_diem) && !in_array($diem, $insert_ds_diem)) {
						array_push($insert_ds_diem, $diem);
					}
				}
			}
			$this->Maddfile->insert_batch_table('tbl_sinhvien', $insert_ds_sv);
			$this->Maddfile->insert_batch_table('tbl_nhaphoc', $insert_ds_nhaphoc);
			$this->Maddfile->insert_batch_table('tbl_lop_hanh_chinh', $insert_ds_lop);
			$this->Maddfile->insert_batch_table('tbl_sinhvien_lop', $insert_ds_sv_lop);
			$this->Maddfile->insert_batch_table('tbl_diem', $insert_ds_diem);

			#endregion

			setMessages('success', 'Đã thêm file excel');
			redirect(base_url().'addfile');
        }
	}

	

	public function import_excel_ajax()
    {
		$insert_bac			= $this->input->post('insert_bac');
		$insert_he			= $this->input->post('insert_he');
		$insert_nganh		= $this->input->post('insert_nganh');
		$insert_ctdt		= $this->input->post('insert_ctdt');
		$insert_donvi		= $this->input->post('insert_donvi');
		$insert_dv_ctdt		= $this->input->post('insert_dv_ctdt');
		$insert_khoahoc		= $this->input->post('insert_khoahoc');
		$insert_namtn		= $this->input->post('insert_namtn');
		$insert_ds_mon		= $this->input->post('insert_ds_mon');
		$insert_ds_mon_ctdt	= $this->input->post('insert_ds_mon_ctdt');
		$insert_ds_lop		= $this->input->post('insert_ds_lop');
		$insert_ds_sv		= $this->input->post('insert_ds_sv');
		$insert_ds_nhaphoc	= $this->input->post('insert_ds_nhaphoc');
		$insert_ds_sv_lop	= $this->input->post('insert_ds_sv_lop');
		$insert_ds_diem		= $this->input->post('insert_ds_diem');

		$affected_rows	= $this->Maddfile->insert_table('tbl_bac', $insert_bac);
		$affected_rows += $this->Maddfile->insert_table('tbl_he', $insert_he);
		$affected_rows += $this->Maddfile->insert_table('tbl_nganh', $insert_nganh);
		$affected_rows += $this->Maddfile->insert_table('tbl_ctdt', $insert_ctdt);
		$affected_rows += $this->Maddfile->insert_table('tbl_donvi', $insert_donvi);
		$affected_rows += $this->Maddfile->insert_table('tbl_donvi_ctdt', $insert_dv_ctdt);
		$affected_rows += $this->Maddfile->insert_table('tbl_khoa', $insert_khoahoc);
		$affected_rows += $this->Maddfile->insert_table('tbl_namtn', $insert_namtn);

		$this->Maddfile->insert_batch_table('tbl_mon', $insert_ds_mon);
		$this->Maddfile->insert_batch_table('tbl_mon_ctdt', $insert_ds_mon_ctdt);
		$this->Maddfile->insert_batch_table('tbl_sinhvien', $insert_ds_sv);
		$this->Maddfile->insert_batch_table('tbl_nhaphoc', $insert_ds_nhaphoc);
		$this->Maddfile->insert_batch_table('tbl_lop_hanh_chinh', $insert_ds_lop);
		$this->Maddfile->insert_batch_table('tbl_sinhvien_lop', $insert_ds_sv_lop);
		$this->Maddfile->insert_batch_table('tbl_diem', $insert_ds_diem);
		echo json_encode($affected_rows >= 7);
		exit();
	}
	
	public function import_diem()
	{
		
		#region insert_sinh_vien_diem
		$sttmon	= $this->input->post('stt_mon');
		$sv		= $this->input->post('sv');
		$ctdt	= $this->input->post('ctdt');
		// pr($ctdt);
		// pr($sv);
		
		$data_sv = array(
			'FK_iMaKhoa'				=> $ctdt['FK_iMaKhoa'],
			'iSTT'						=> $sv[0],
			'sTenLop'					=> $sv[1],
			'sMaSV'						=> $sv[2],
			'sHo'						=> $sv[3],
			'sTen'						=> $sv[4],
			'dNgaySinh'					=> implode('-', array_reverse(explode('/',$sv[5]))),
			'sGioiTinh'					=> $sv[6],
			'sGDTC'						=> $sv[7],
			'sGDQP'						=> $sv[8],
			'sCDRNN'					=> $sv[9],
			'sXLRenLuyen'				=> $sv[10],
			'sTBCTL'					=> $sv[11],
			'iSoTCTL'					=> $sv[12],
			'iSoTCConNo'				=> $sv[13],
			'sXepLoaiTotNghiep'			=> $sv[14],
			'sSoQuyetDinhDauVao'		=> $sv[15],
			'dNgayQuyetDinhDauVao'		=> implode('-', array_reverse(explode('/',$sv[16]))),
			'sSoQuyetDinhTotNghiep'		=> $sv[17],
			'dNgayQuyetDinhTotNghiep'	=> implode('-', array_reverse(explode('/',$sv[18]))),
			'iSoHocPhanThiLai'			=> $sv[19]
		);

		$data_sv['FK_iMaNhapHoc'] = $this->Maddfile->insert_sv($data_sv);
		
		$this->Maddfile->insertSV_Lop($data_sv, $ctdt);
		
		$list_diem_1_sv = $sv[20];
		for ($i = 0, $j = 0; $i < count($list_diem_1_sv);) {
			$diem = array(
				'iDT10'			=> $list_diem_1_sv[$i++],
				'sDTChu'		=> $list_diem_1_sv[$i++],
				'iDT4'			=> $list_diem_1_sv[$i++],
				'sLichSu'		=> $list_diem_1_sv[$i++],
				'sNoiMien'		=> $list_diem_1_sv[$i++],
				'FK_iMaNhapHoc'	=> $data_sv['FK_iMaNhapHoc'],
				'FK_iMaMonCTDT'	=> $sttmon[$j],
			);
			// pr($diem);
			$res = $this->Maddfile->insertDiem($diem, $sttmon[$j++]);
		}
		echo json_encode($res?1:0);
		exit();
		#endregion

	}

	public function get_all_ds_ajax()
	{
		$res = array(
			'ds_ma_mon'		=> $this->Maddfile->get_ds_ma('tbl_mon', 'PK_iMaMon'),
			'ds_ma_mon_ctdt'=> $this->Maddfile->get_ds_ma('tbl_mon_ctdt', 'PK_iMaMon_CTDT'),
			'ds_ma_sv'		=> $this->Maddfile->get_ds_ma('tbl_sinhvien', 'PK_iMaSV'),
			'ds_ma_nhaphoc'	=> $this->Maddfile->get_ds_ma('tbl_nhaphoc', 'PK_iMaNhapHoc'),
			'ds_ma_lop'		=> $this->Maddfile->get_ds_ma('tbl_lop_hanh_chinh', 'PK_iMaLop'),
			'ds_ma_diem' 	=> $this->Maddfile->get_ds_ma('tbl_diem', 'PK_iMaDiem')
		);
		
		echo json_encode($res);
		exit();
	}
	

	public function returnWithMess($res, $masv = '')
	{
		switch ($res) {
			case 0:
				setMessages('error', 'Thêm file Excel thất bại');
				break;
			case -1:
				setMessages('error', "Mã sinh viên " . $masv . " bị trùng");
				break;
			case -2:
				setMessages('error', 'Các dòng không được bỏ trống');
				break;
			case -3:
				setMessages('error', "Tên môn " . $masv . " bị trùng");
				break;
			case -4:
				setMessages('error', "Cột " . $masv . " bị bỏ trống");
				break;

			default:
				setMessages('success', 'Thêm file excel thành công');
				break;
		}
		redirect(base_url().'addfile');
	}

	public function download_demo()
	{
		$link = base_url().'assets/demo_file/demo.xlsx';
		$ext  = substr(strrchr($link, '.'), 1);
		header('Content-Description: File Transfer');
		header('Content-Type: application/octet-stream');
		header('Content-Disposition: attachment; filename="demo_file_import_excel.xlsx"');
		readfile($link);
		exit();
	}

	// public function getHash($string)
	// {
	// 	$hash = 0;
	// 	for ($i = 0; $i < count($string); $i++) {
	// 		$chr   = ord($string[$i]);
	// 		$hash  = (($hash << 5) - $hash) + $chr;
	// 		$hash |= 0; // Convert to 32bit integer
	// 	}
	// 	return $hash;
	// }



	//old import_batch
	// public function importSV()
    // {
    //     // pr($_FILES['importExcel']);
    //     if (isset($_FILES['importExcel']['name'])) {
	// 		$res = 0;
    //         $path = $_FILES['importExcel']['tmp_name'];
    //         $object = PHPExcel_IOFactory::load($path);
    //         $worksheet = $object->getSheet(0);
	// 		$lastRow		= $worksheet->getHighestRow();
	// 		$hightestCol	= $worksheet->getHighestColumn();
	// 		$lastColumn		= PHPExcel_Cell::columnIndexFromString($hightestCol);
	// 		// pr($hightestCol);
			
	// 		#region insert_ctdt
	// 		$ctdt = array(
	// 			'sTenBac'	=> $worksheet->getCellByColumnAndRow(3,4)->getValue(),
	// 			'sTenDonVi'	=> $worksheet->getCellByColumnAndRow(3,5)->getValue(),
	// 			'sTenHe'	=> $worksheet->getCellByColumnAndRow(7,4)->getValue(),
	// 			'sTenNganh'	=> $worksheet->getCellByColumnAndRow(7,5)->getValue(),
	// 			'iKhoa'		=> $worksheet->getCellByColumnAndRow(7,6)->getValue(),
	// 		);
	// 		$namtotnghiep	= $worksheet->getCellByColumnAndRow(3,6)->getValue();
	// 		$this->Maddfile->insertNamTN($namtotnghiep);
	// 		$ctdt = $this->Maddfile->insertCTDT($ctdt);
	// 		#endregion

	// 		$sttmon = array();
			
	// 		#region import_mon
	// 		$so_cot = $ctdt['sTenHe'] == 'Đào tạo từ xa' ? 5 : 3;
	// 		for ($column = 7, $i = 1; $column < $lastColumn - 13; $column += $so_cot) {
	// 			$mon = array(
	// 				'sTenMon'	=> $worksheet->getCellByColumnAndRow($column, 7)->getValue(),
	// 				'sTenMonTA'	=> $worksheet->getCellByColumnAndRow($column, 8)->getValue(),
	// 				'iSoTinChi'	=> $worksheet->getCellByColumnAndRow($column, 9)->getValue()
	// 			);
				
	// 			array_push($sttmon, $this->Maddfile->insertMon($mon, $ctdt, $i++));
	// 			// pr($mon);

	// 		}
	// 		#endregion
	// 		#region insert_sinh_vien_lop
	// 		//ds insert
	// 		$ds_lop		= array();
	// 		$ds_sv		= array();
	// 		$ds_nhaphoc	= array();
	// 		$ds_sv_lop	= array();
	// 		$ds_diem	= array();
			
	// 		//ds update
	// 		$ds_lop_update		= array();
	// 		$ds_sv_update		= array();
	// 		$ds_nhaphoc_update	= array();
	// 		$ds_sv_lop_update	= array();
	// 		$ds_diem_update		= array();

	// 		//ds đã có
	// 		$ds_ma_lop		= $this->Maddfile->get_ds_ma_lop();
	// 		$ds_ma_sv		= $this->Maddfile->get_ds_ma_sv();
	// 		$ds_ma_nhaphoc	= $this->Maddfile->get_ds_ma_nhaphoc();
	// 		$ds_ma_sv_lop	= $this->Maddfile->get_ds_ma_sv_lop();
	// 		$ds_ma_diem		= $this->Maddfile->get_ds_ma_diem();

	// 		for ($row = 11; $row <= $lastRow; $row++) {
	// 			$ten_lop = $worksheet->getCellByColumnAndRow(1,$row)->getValue();
	// 			$lop = array(
	// 				'PK_iMaLop'	=> $ctdt['FK_iMaKhoa'].'_'.$ten_lop,
	// 				'sTenLop'	=> $ten_lop,
	// 				'FK_iMaKhoa'=> $ctdt['FK_iMaKhoa']
	// 			);
	// 			if (!in_array($lop, $ds_lop)) {
	// 				if (!in_array($lop['PK_iMaLop'], $ds_ma_lop)) {
	// 					array_push($ds_lop, $lop);
	// 				}
	// 				else {
	// 					array_push($ds_lop_update, $lop);
	// 				}
	// 			}

	// 			$sv = array(
	// 				'PK_iMaSV'	=> $worksheet->getCellByColumnAndRow(2,$row)->getValue(),
	// 				'sHo'		=> $worksheet->getCellByColumnAndRow(3,$row)->getValue(),
	// 				'sTen'		=> $worksheet->getCellByColumnAndRow(4,$row)->getValue(),
	// 				'dNgaySinh'	=> implode('-', array_reverse(explode('/',$worksheet->getCellByColumnAndRow(5,$row)->getValue()))),
	// 				'sGioiTinh'	=> $worksheet->getCellByColumnAndRow(6,$row)->getValue(),
	// 			);
	// 			if (!in_array($sv, $ds_sv)) {
	// 				if (!in_array($sv['PK_iMaSV'], $ds_ma_sv)) {
	// 					array_push($ds_sv, $sv);
	// 				}
	// 				else {
	// 					array_push($ds_sv_update, $sv);
	// 				}
	// 			}

	// 			$nhaphoc = array(
	// 				'PK_iMaNhapHoc'	=> $sv['PK_iMaSV'],
	// 				'FK_iMaSV'		=> $sv['PK_iMaSV'],
	// 				'FK_iMaKhoa'	=> $ctdt['FK_iMaKhoa'],
	// 				'sGDTC'			=> $worksheet->getCellByColumnAndRow($lastColumn-13,$row)->getValue(),
	// 				'sGDQP'			=> $worksheet->getCellByColumnAndRow($lastColumn-12,$row)->getValue(),
	// 				'sCDRNN'		=> $worksheet->getCellByColumnAndRow($lastColumn-11,$row)->getValue(),
	// 				'sXLRenLuyen'	=> $worksheet->getCellByColumnAndRow($lastColumn-10,$row)->getValue(),
	// 				'sTBCTL'		=> $worksheet->getCellByColumnAndRow($lastColumn-9,$row)->getValue(),
	// 				'iSoTCTL'		=> $worksheet->getCellByColumnAndRow($lastColumn-8,$row)->getValue(),
	// 				'iSoTCConNo'	=> $worksheet->getCellByColumnAndRow($lastColumn-7,$row)->getValue(),
	// 				'sXepLoaiTotNghiep'			=> $worksheet->getCellByColumnAndRow($lastColumn-6,$row)->getValue(),
	// 				'sSoQuyetDinhDauVao'		=> $worksheet->getCellByColumnAndRow($lastColumn-5,$row)->getValue(),
	// 				'dNgayQuyetDinhDauVao'		=> implode('-', array_reverse(explode('/',$worksheet->getCellByColumnAndRow($lastColumn-4,$row)->getValue()))),
	// 				'sSoQuyetDinhTotNghiep'		=> $worksheet->getCellByColumnAndRow($lastColumn-3,$row)->getValue(),
	// 				'dNgayQuyetDinhTotNghiep'	=> implode('-', array_reverse(explode('/',$worksheet->getCellByColumnAndRow($lastColumn-2,$row)->getValue()))),
	// 				'iSoHocPhanThiLai'			=> $worksheet->getCellByColumnAndRow($lastColumn-1,$row)->getValue(),
	// 				'FK_iNamTN'					=> $namtotnghiep
	// 			);
	// 			if (!in_array($nhaphoc, $ds_nhaphoc)) {
	// 				if (!in_array($nhaphoc['PK_iMaNhapHoc'], $ds_ma_nhaphoc)) {
	// 					array_push($ds_nhaphoc, $nhaphoc);
	// 				}
	// 				else {
	// 					array_push($ds_nhaphoc_update, $nhaphoc);
	// 				}
	// 			}
				
	// 			$sv_lop = array(
	// 				'PK_iMaSVLop'	=> $lop['PK_iMaLop'].'_'.$nhaphoc['PK_iMaNhapHoc'],
	// 				'FK_iMaNhapHoc'	=> $nhaphoc['PK_iMaNhapHoc'],
	// 				'FK_iMaLop'		=> $lop['PK_iMaLop']
	// 			);
	// 			if (!in_array($sv_lop, $ds_sv_lop)) {
	// 				if (!in_array($sv_lop['PK_iMaSVLop'], $ds_ma_sv_lop)) {
	// 					array_push($ds_sv_lop, $sv_lop);
	// 				}
	// 			}

	// 			for ($column = 7, $i = 0, $count_attr = 0; $column < $lastColumn - 13;) {
	// 				$diem = array(
	// 					'PK_iMaDiem'	=> $nhaphoc['PK_iMaNhapHoc'].'_'.$sttmon[$i],
	// 					'iDT10'			=> $worksheet->getCellByColumnAndRow($column++, $row)->getValue(),
	// 					'sDTChu'		=> $worksheet->getCellByColumnAndRow($column++, $row)->getValue(),
	// 					'iDT4'			=> $worksheet->getCellByColumnAndRow($column++, $row)->getValue(),
	// 					'FK_iMaNhapHoc'	=> $nhaphoc['PK_iMaNhapHoc'],
	// 					'FK_iMaMonCTDT'	=> $sttmon[$i++],
	// 				);
	// 				if ($so_cot == 5) {
	// 					$diem['sLichSu']	= $worksheet->getCellByColumnAndRow($column++, $row)->getValue();
	// 					$diem['sNoiMien']	= $worksheet->getCellByColumnAndRow($column++, $row)->getValue();
	// 				}
	// 				if (!in_array($diem, $ds_diem)) {
	// 					if (!in_array($diem['PK_iMaDiem'], $ds_ma_diem)) {
	// 						array_push($ds_diem, $diem);
	// 					}
	// 					else {
	// 						array_push($ds_diem_update, $diem);
	// 					}
	// 				}
	// 			}
	// 		}
	// 		$this->Maddfile->insert_ds_lop($ds_lop);
			
	// 		$this->Maddfile->insert_ds_sv($ds_sv);
	// 		$this->Maddfile->insert_ds_nhaphoc($ds_nhaphoc);
	// 		$this->Maddfile->insert_ds_sv_lop($ds_sv_lop);
	// 		$this->Maddfile->insert_ds_diem($ds_diem);
	// 		$this->Maddfile->update_ds_lop($ds_lop);
			
	// 		if ($ds_sv_update != null) {
	// 			$this->Maddfile->update_ds_sv($ds_sv_update);
	// 		}
	// 		if ($ds_nhaphoc_update != null) {
	// 			$this->Maddfile->update_ds_nhaphoc($ds_nhaphoc_update);
	// 		}
	// 		if ($ds_diem_update != null) {
	// 			$this->Maddfile->update_ds_diem($ds_diem_update);
	// 		}
			
			
			
			
			

	// 		#endregion

	// 		$res = 1;
	// 		$this->returnWithMess($res, $new_sv['sMaSV']);
    //     }
	// }
	

	//very_old import
    // public function importSV()
    // {
    //     // pr($_FILES['importExcel']);
    //     if (isset($_FILES['importExcel']['name'])) {
	// 		$res = 0;
    //         $path = $_FILES['importExcel']['tmp_name'];
    //         $object = PHPExcel_IOFactory::load($path);
    //         $worksheet = $object->getSheet(0);
	// 		$lastRow		= $worksheet->getHighestRow();
	// 		$hightestCol	= $worksheet->getHighestColumn();
	// 		$lastColumn		= PHPExcel_Cell::columnIndexFromString($hightestCol);
	// 		// pr($hightestCol);
			
	// 		#region insert_ctdt
	// 		$ctdt = array(
	// 			'sTenBac'	=> $worksheet->getCellByColumnAndRow(3,4)->getValue(),
	// 			'sTenDonVi'	=> $worksheet->getCellByColumnAndRow(3,5)->getValue(),
	// 			'sNam'		=> $worksheet->getCellByColumnAndRow(3,6)->getValue(),
	// 			'sTenHe'	=> $worksheet->getCellByColumnAndRow(7,4)->getValue(),
	// 			'sTenNganh'	=> $worksheet->getCellByColumnAndRow(7,5)->getValue(),
	// 			'iKhoa'		=> $worksheet->getCellByColumnAndRow(7,6)->getValue(),
	// 		);
	// 		$ctdt = $this->Maddfile->insertCTDT($ctdt);
	// 		#endregion

	// 		$sttmon = array();
			
	// 		#region import_mon
	// 		$so_cot = $ctdt['sTenHe'] == 'Đào tạo từ xa' ? 5 : 3;
	// 		for ($column = 7, $i = 1; $column < $lastColumn - 13; $column += $so_cot) {
	// 			$mon = array(
	// 				'sTenMon'	=> $worksheet->getCellByColumnAndRow($column, 7)->getValue(),
	// 				'sTenMonTA'	=> $worksheet->getCellByColumnAndRow($column, 8)->getValue(),
	// 				'iSoTinChi'	=> $worksheet->getCellByColumnAndRow($column, 9)->getValue()
	// 			);
				
	// 			array_push($sttmon, $this->Maddfile->insertMon($mon, $ctdt, $i++));
	// 			// pr($mon);

	// 		}
	// 		#endregion
	// 		#region insert_sinh_vien_lop
	// 		//ds insert
	// 		$ds_lop		= array();
	// 		$ds_sv		= array();
	// 		$ds_nhaphoc	= array();
	// 		$ds_sv_lop	= array();
	// 		$ds_diem	= array();
			
	// 		//ds update
	// 		$ds_lop_update		= array();
	// 		$ds_sv_update		= array();
	// 		$ds_nhaphoc_update	= array();
	// 		$ds_sv_lop_update	= array();
	// 		$ds_diem_update		= array();

	// 		//ds đã có
	// 		$ds_ma_lop		= $this->Maddfile->get_ds_ma_lop();
	// 		$ds_ma_sv		= $this->Maddfile->get_ds_ma_sv();
	// 		$ds_ma_nhaphoc	= $this->Maddfile->get_ds_ma_nhaphoc();
	// 		$ds_ma_sv_lop	= $this->Maddfile->get_ds_ma_sv_lop();
	// 		$ds_ma_diem		= $this->Maddfile->get_ds_ma_diem();

	// 		for ($row = 11; $row <= $lastRow; $row++) {
	// 			$ten_lop = $worksheet->getCellByColumnAndRow(1,$row)->getValue();
	// 			$lop = array(
	// 				'PK_iMaLop'	=> $ctdt['FK_iMaKhoa'].'_'.$ten_lop,
	// 				'sTenLop'	=> $ten_lop,
	// 				'FK_iMaKhoa'=> $ctdt['FK_iMaKhoa']
	// 			);
	// 			if (!in_array($lop, $ds_lop)) {
	// 				if (!in_array($lop['PK_iMaLop'], $ds_ma_lop)) {
	// 					array_push($ds_lop, $lop);
	// 				}
	// 				else {
	// 					array_push($ds_lop_update, $lop);
	// 				}
	// 			}

	// 			$sv = array(
	// 				'PK_iMaSV'	=> $worksheet->getCellByColumnAndRow(2,$row)->getValue(),
	// 				'sHo'		=> $worksheet->getCellByColumnAndRow(3,$row)->getValue(),
	// 				'sTen'		=> $worksheet->getCellByColumnAndRow(4,$row)->getValue(),
	// 				'dNgaySinh'	=> implode('-', array_reverse(explode('/',$worksheet->getCellByColumnAndRow(5,$row)->getValue()))),
	// 				'sGioiTinh'	=> $worksheet->getCellByColumnAndRow(6,$row)->getValue(),
	// 			);
	// 			if (!in_array($sv, $ds_sv)) {
	// 				if (!in_array($sv['PK_iMaSV'], $ds_ma_sv)) {
	// 					array_push($ds_sv, $sv);
	// 				}
	// 				else {
	// 					array_push($ds_sv_update, $sv);
	// 				}
	// 			}

	// 			$nhaphoc = array(
	// 				'PK_iMaNhapHoc'	=> $sv['PK_iMaSV'],
	// 				'FK_iMaSV'		=> $sv['PK_iMaSV'],
	// 				'FK_iMaKhoa'	=> $ctdt['FK_iMaKhoa'],
	// 				'sGDTC'			=> $worksheet->getCellByColumnAndRow($lastColumn-13,$row)->getValue(),
	// 				'sGDQP'			=> $worksheet->getCellByColumnAndRow($lastColumn-12,$row)->getValue(),
	// 				'sCDRNN'		=> $worksheet->getCellByColumnAndRow($lastColumn-11,$row)->getValue(),
	// 				'sXLRenLuyen'	=> $worksheet->getCellByColumnAndRow($lastColumn-10,$row)->getValue(),
	// 				'sTBCTL'		=> $worksheet->getCellByColumnAndRow($lastColumn-9,$row)->getValue(),
	// 				'iSoTCTL'		=> $worksheet->getCellByColumnAndRow($lastColumn-8,$row)->getValue(),
	// 				'iSoTCConNo'	=> $worksheet->getCellByColumnAndRow($lastColumn-7,$row)->getValue(),
	// 				'sXepLoaiTotNghiep'			=> $worksheet->getCellByColumnAndRow($lastColumn-6,$row)->getValue(),
	// 				'sSoQuyetDinhDauVao'		=> $worksheet->getCellByColumnAndRow($lastColumn-5,$row)->getValue(),
	// 				'dNgayQuyetDinhDauVao'		=> implode('-', array_reverse(explode('/',$worksheet->getCellByColumnAndRow($lastColumn-4,$row)->getValue()))),
	// 				'sSoQuyetDinhTotNghiep'		=> $worksheet->getCellByColumnAndRow($lastColumn-3,$row)->getValue(),
	// 				'dNgayQuyetDinhTotNghiep'	=> implode('-', array_reverse(explode('/',$worksheet->getCellByColumnAndRow($lastColumn-2,$row)->getValue()))),
	// 				'iSoHocPhanThiLai'			=> $worksheet->getCellByColumnAndRow($lastColumn-1,$row)->getValue()
	// 			);
	// 			if (!in_array($nhaphoc, $ds_nhaphoc)) {
	// 				if (!in_array($nhaphoc['PK_iMaNhapHoc'], $ds_ma_nhaphoc)) {
	// 					array_push($ds_nhaphoc, $nhaphoc);
	// 				}
	// 				else {
	// 					array_push($ds_nhaphoc_update, $nhaphoc);
	// 				}
	// 			}
				
	// 			$sv_lop = array(
	// 				'PK_iMaSVLop'	=> $lop['PK_iMaLop'].'_'.$nhaphoc['PK_iMaNhapHoc'],
	// 				'FK_iMaNhapHoc'	=> $nhaphoc['PK_iMaNhapHoc'],
	// 				'FK_iMaLop'		=> $lop['PK_iMaLop']
	// 			);
	// 			if (!in_array($sv_lop, $ds_sv_lop)) {
	// 				if (!in_array($sv_lop['PK_iMaSVLop'], $ds_ma_sv_lop)) {
	// 					array_push($ds_sv_lop, $sv_lop);
	// 				}
	// 				else {
	// 					array_push($ds_sv_lop_update, $sv_lop);
	// 				}
	// 			}

	// 			for ($column = 7, $i = 0, $count_attr = 0; $column < $lastColumn - 13;) {
	// 				$diem = array(
	// 					'PK_iMaDiem'	=> $nhaphoc['PK_iMaNhapHoc'].'_'.$sttmon[$i],
	// 					'iDT10'			=> $worksheet->getCellByColumnAndRow($column++, $row)->getValue(),
	// 					'sDTChu'		=> $worksheet->getCellByColumnAndRow($column++, $row)->getValue(),
	// 					'iDT4'			=> $worksheet->getCellByColumnAndRow($column++, $row)->getValue(),
	// 					'FK_iMaNhapHoc'	=> $nhaphoc['PK_iMaNhapHoc'],
	// 					'FK_iMaMonCTDT'	=> $sttmon[$i++],
	// 				);
	// 				if ($so_cot == 5) {
	// 					$diem['sLichSu']	= $worksheet->getCellByColumnAndRow($column++, $row)->getValue();
	// 					$diem['sNoiMien']	= $worksheet->getCellByColumnAndRow($column++, $row)->getValue();
	// 				}
	// 				if (!in_array($diem, $ds_diem)) {
	// 					if (!in_array($diem['PK_iMaDiem'], $ds_ma_diem)) {
	// 						array_push($ds_diem, $diem);
	// 					}
	// 					else {
	// 						array_push($ds_diem_update, $diem);
	// 					}
	// 				}
	// 			}
	// 		}
	// 		$this->Maddfile->insert_ds_lop($ds_lop);
			
	// 		$this->Maddfile->insert_ds_sv($ds_sv);
	// 		$this->Maddfile->insert_ds_nhaphoc($ds_nhaphoc);
	// 		$this->Maddfile->insert_ds_sv_lop($ds_sv_lop);
	// 		$this->Maddfile->insert_ds_diem($ds_diem);
	// 		$this->Maddfile->update_ds_lop($ds_lop);
			
	// 		$this->Maddfile->update_ds_sv($ds_sv_update);
	// 		$this->Maddfile->update_ds_nhaphoc($ds_nhaphoc_update);
	// 		$this->Maddfile->update_ds_sv_lop($ds_sv_lop_update);
			
	// 		$this->Maddfile->update_ds_diem($ds_diem_update);
			

	// 		#endregion

	// 		$res = 1;
	// 		$this->returnWithMess($res, $new_sv['sMaSV']);
    //     }
	// }


}