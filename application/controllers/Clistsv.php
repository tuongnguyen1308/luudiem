<?php

ini_set('max_execution_time', 3000); 
ini_set('memory_limit','2048M');
ini_set('max_input_vars', 6000);
/**
 * User: Nguyễn Đình Tưởng
 * 5 col
 */

class Clistsv extends MY_Controller
{
    public $Mlistsv;
    public $id = '';
	public function __construct()
	{
		parent::__construct();
        $this->load->model('Mlistsv', 'Mlistsv');
        $this->load->library('excel');
		$this->Mlistsv = new Mlistsv();
	}
    
    public function index()
    {
		$present_page = 1;
		$per_page = 10;
		if ($this->input->get('page')) {
			$present_page = $this->input->get('page');
		}
        if ($this->input->post('submitImport')) {
            $this->importSV();
		}
		else if ($this->input->post('delSV')) {
            $this->delSV();
		}
		else if ($this->input->post('download_demo')) {
			$this->download_demo();
		}
		else if ($this->input->post('btn_export')) {
			$this->getDataToExport();
		}
		else switch ($this->input->post('action')) {
			case 'getNamHoc':
				$this->getNamHoc();
				break;
			
			case 'getDonVi':
				$this->getDonVi();
				break;
			
			case 'getKhoaHoc':
				$this->getKhoaHoc();
				break;
			case 'submit_import':
				$this->importExcelAjax();
				break;
			case 'import_diem':
				$this->import_diem();
				break;
		}
		
		$conditional	= '';
		$listBac		= $this->Mlistsv->getList('tbl_bac');
		$listHe			= $this->Mlistsv->getList('tbl_he');
		$listNganh		= $this->Mlistsv->getList('tbl_nganh');
		$listNam		= '';
		$listDonVi		= '';
		$listKhoaHoc	= '';
		
		$keyword = '';
		
		if ($this->input->post('btn_filter') || $this->input->post('btn_search') || $this->input->post('btn_delete') || $this->input->post('btn_export_word')) {
			$bac = $this->input->post('bac');
			$he = $this->input->post('he');
			$nganh = $this->input->post('nganh');
			$namhoc = $this->input->post('namhoc');
			$donvi = $this->input->post('donvi');
			$khoahoc = $this->input->post('khoahoc');

			if ($bac) {
				$conditional['FK_iMaBac'] = $bac;
			}
			if ($he) {
				$conditional['FK_iMaHe'] = $he;
			}
			if ($nganh) {
				$conditional['FK_iMaNganh'] = $nganh;
			}
			if ($namhoc && $nganh && $he && $bac) {
				$listNam		= $this->Mlistsv->getNamHoc($conditional);
				$conditional['sNam']		= $namhoc;
			}
			if ($donvi) {
				$listDonVi		= $this->Mlistsv->getDonVi($conditional);
				$conditional['PK_iMaDVCTDT'] = $donvi;
			}
			if ($khoahoc) {
				$listKhoaHoc	= $this->Mlistsv->getKhoaHoc($conditional['PK_iMaDVCTDT']);
				$conditional['PK_iMaKhoa']	= $khoahoc;
			}
			$present_page = 1;
			$keyword = $this->input->post('inp_keyword');
			$this->session->set_flashdata('keyword', $keyword);
		}
		if ($this->input->get('filter')) {
			// pr($this->session->flashdata('keyword'));
			$conditional = $this->session->flashdata('filter');
			$keyword = $this->session->flashdata('keyword');
			$tmp_cdt = array(
				'FK_iMaBac'		=> $conditional['FK_iMaBac'],
				'FK_iMaHe'		=> $conditional['FK_iMaHe'],
				'FK_iMaNganh'	=> $conditional['FK_iMaNganh']
			);
			$listNam		= $this->Mlistsv->getNamHoc($tmp_cdt);
			$tmp_cdt['sNam']		= $conditional['sNam'];
			$listDonVi		= $this->Mlistsv->getDonVi($tmp_cdt);
			$tmp_cdt['PK_iMaDVCTDT'] = $conditional['PK_iMaDVCTDT'];
			$listKhoaHoc	= $this->Mlistsv->getKhoaHoc($tmp_cdt['PK_iMaDVCTDT']);
			$tmp_cdt['PK_iMaKhoa']	= $conditional['PK_iMaKhoa'];
			$this->session->set_flashdata('filter', $conditional);
		}

		// $keyword = '';
		// if ($this->input->post('btn_filter') || $this->input->post('btn_search')) {
		// 	$keyword = $this->input->post('inp_keyword');
		// 	$this->session->set_flashdata('keyword', $keyword);
		// }
		if ($this->input->post('btn_delete')) {
			// pr($conditional);
			$this->deleteSVWith($conditional);
		}
		if ($this->input->post('btn_export_word')) {
			// pr($conditional);
			$this->ExportListWord($conditional);
		}
		if (!$this->input->post('btn_reset_filter')) {
			$list_sv = $this->Mlistsv->getDSSVIn($conditional, $keyword, $present_page);
			// pr($list_sv);
			$this->session->set_flashdata('filter', $conditional);
			$this->session->set_flashdata('keyword', $keyword);
			// pr($this->session->flashdata('filter'));
		}
		else {
			$list_sv = $this->Mlistsv->getDSSVIn('', '', $present_page);
			redirect(current_url());
		}

        $session = $this->session->userdata('user');
        $data = array(
			'currentpage'	=> 'list',
			'present_page'	=> $present_page,
			'countPage'		=> $this->Mlistsv->countPage($conditional, $keyword, $present_page),
			'DSSV'          => $list_sv,
			'listBac'		=> $listBac,
			'listHe'		=> $listHe,
			'listNganh'		=> $listNganh,
			'listNam'		=> $listNam,
			'listDonVi'		=> $listDonVi,
			'listKhoaHoc'	=> $listKhoaHoc,
			'list_filter'	=> $conditional,
			'keyword'		=> $this->session->flashdata('keyword'),
			'filter'		=> $this->session->flashdata('filter')
		);
		// pr($data['list_filter']);
		// pr($data['countPage']);
        //pr($data['DSSV']);
        $temp['data'] = $data;
        $temp['template'] = 'Vlistsv';
        $this->load->view('layouts/Vlayout', $temp);
    }

	public function getNamHoc()
	{
		$fk_arr = array(
			'FK_iMaBac'		=> $this->input->post('FK_iMaBac'),
			'FK_iMaHe'		=> $this->input->post('FK_iMaHe'),
			'FK_iMaNganh'	=> $this->input->post('FK_iMaNganh')
		);
		$db = $this->Mlistsv->getNamHoc($fk_arr);
		exit(json_encode($db));
	}
	public function getDonVi()
	{
		$conditional = array(
			'FK_iMaBac'		=> $this->input->post('FK_iMaBac'),
			'FK_iMaHe'		=> $this->input->post('FK_iMaHe'),
			'FK_iMaNganh'	=> $this->input->post('FK_iMaNganh'),
			'sNam'			=> $this->input->post('sNam')
		);
		// pr($conditional);
		$db = $this->Mlistsv->getDonVi($conditional);
		exit(json_encode($db));
	}
	public function getKhoaHoc()
	{
		$conditional = array(
			'FK_iMaDVCTDT'	=> $this->input->post('FK_iMaDVCTDT')
		);
		// pr($conditional);
		$db = $this->Mlistsv->getKhoaHoc($conditional['FK_iMaDVCTDT']);
		exit(json_encode($db));
	}
    
    // public function importSV()
    // {
	// 	$list_ma_sv = array();
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
	// 		$ctdt = $this->Mlistsv->insertCTDT($ctdt);
	// 		#endregion

	// 		$sttmon = array();
	// 		#region import_mon
	// 		$so_cot = $ctdt['sTenDonVi'] == 'Đào tạo từ xa' ? 5 : 3;
	// 		for ($column = 7, $i = 1; $column < $lastColumn - 13; $column += $so_cot) {
	// 			$mon = array(
	// 				'sTenMon'	=> $worksheet->getCellByColumnAndRow($column, 7)->getValue(),
	// 				'sTenMonTA'	=> $worksheet->getCellByColumnAndRow($column, 8)->getValue(),
	// 				'iSoTinChi'	=> $worksheet->getCellByColumnAndRow($column, 9)->getValue()
	// 			);
				
	// 			array_push($sttmon, $this->Mlistsv->insertMon($mon, $ctdt, $i++));
	// 			// pr($mon);

	// 		}
	// 		#endregion
	// 		#region insert_sinh_vien_lop
	// 		for ($row = 11; $row <= $lastRow; $row++) {
	// 			$data_sv = array(
	// 				'iSTT'			=> $worksheet->getCellByColumnAndRow(0,$row)->getValue(),
	// 				'sTenLop'		=> $worksheet->getCellByColumnAndRow(1,$row)->getValue(),
	// 				'PK_iMaNhapHoc'	=> $worksheet->getCellByColumnAndRow(2,$row)->getValue(),
	// 				'sHo'			=> $worksheet->getCellByColumnAndRow(3,$row)->getValue(),
	// 				'sTen'			=> $worksheet->getCellByColumnAndRow(4,$row)->getValue(),
	// 				'dNgaySinh'		=> implode('-', array_reverse(explode('/',$worksheet->getCellByColumnAndRow(5,$row)->getValue()))),
	// 				'sGioiTinh'		=> $worksheet->getCellByColumnAndRow(6,$row)->getValue(),
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
	// 			// pr($data_sv);
				
	// 			$data_sv['FK_iMaNhapHoc'] = $this->Mlistsv->insertSV($data_sv, $ctdt);
	// 			$this->Mlistsv->insertSV_Lop($data_sv, $ctdt);
				
	// 			for ($column = 7, $i = 0, $count_attr = 0; $column < $lastColumn - 13;) {
	// 				$diem = array(
	// 					'iDT10'			=> $worksheet->getCellByColumnAndRow($column++, $row)->getValue(),
	// 					'sDTChu'		=> $worksheet->getCellByColumnAndRow($column++, $row)->getValue(),
	// 					'iDT4'			=> $worksheet->getCellByColumnAndRow($column++, $row)->getValue(),
	// 					'FK_iMaNhapHoc'	=> $data_sv['FK_iMaNhapHoc'],
	// 					'FK_iMaMonCTDT'	=> $sttmon[$i],
	// 				);
	// 				if ($so_cot == 5) {
	// 					$diem['sLichSu'] = $worksheet->getCellByColumnAndRow($column++, $row)->getValue();
	// 					$diem['sNoiMien'] = $worksheet->getCellByColumnAndRow($column++, $row)->getValue();
	// 				}
	// 				// pr($diem);
	// 				$this->Mlistsv->insertDiem($diem, $sttmon[$i++]);

	// 			}
	// 		}

	// 		#endregion

	// 		$res = 1;
	// 		$this->returnWithMess($res, $list_ma_sv, $new_sv['sMaSV']);
    //     }
	// }

    public function importSV()
    {
		$list_ma_sv = array();
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
			
			#region insert_ctdt
			$ctdt = array(
				'sTenBac'	=> $worksheet->getCellByColumnAndRow(3,4)->getValue(),
				'sTenDonVi'	=> $worksheet->getCellByColumnAndRow(3,5)->getValue(),
				'sNam'		=> $worksheet->getCellByColumnAndRow(3,6)->getValue(),
				'sTenHe'	=> $worksheet->getCellByColumnAndRow(7,4)->getValue(),
				'sTenNganh'	=> $worksheet->getCellByColumnAndRow(7,5)->getValue(),
				'iKhoa'		=> $worksheet->getCellByColumnAndRow(7,6)->getValue(),
			);
			$ctdt = $this->Mlistsv->insertCTDT($ctdt);
			#endregion

			$sttmon = array();
			#region import_mon
			$so_cot = $ctdt['sTenHe'] == 'Đào tạo từ xa' ? 5 : 3;
			for ($column = 7, $i = 1; $column < $lastColumn - 13; $column += $so_cot) {
				$mon = array(
					'sTenMon'	=> $worksheet->getCellByColumnAndRow($column, 7)->getValue(),
					'sTenMonTA'	=> $worksheet->getCellByColumnAndRow($column, 8)->getValue(),
					'iSoTinChi'	=> $worksheet->getCellByColumnAndRow($column, 9)->getValue()
				);
				
				array_push($sttmon, $this->Mlistsv->insertMon($mon, $ctdt, $i++));
				// pr($mon);

			}
			#endregion
			#region insert_sinh_vien_lop
			//ds insert
			$ds_lop		= array();
			$ds_sv		= array();
			$ds_nhaphoc	= array();
			$ds_sv_lop	= array();
			$ds_diem	= array();
			
			//ds update
			$ds_lop_update		= array();
			$ds_sv_update		= array();
			$ds_nhaphoc_update	= array();
			$ds_sv_lop_update	= array();
			$ds_diem_update		= array();

			//ds đã có
			$ds_ma_lop		= $this->Mlistsv->get_ds_ma_lop();
			$ds_ma_sv		= $this->Mlistsv->get_ds_ma_sv();
			$ds_ma_nhaphoc	= $this->Mlistsv->get_ds_ma_nhaphoc();
			$ds_ma_sv_lop	= $this->Mlistsv->get_ds_ma_sv_lop();
			$ds_ma_diem		= $this->Mlistsv->get_ds_ma_diem();

			for ($row = 11; $row <= $lastRow; $row++) {
				$ten_lop = $worksheet->getCellByColumnAndRow(1,$row)->getValue();
				$lop = array(
					'PK_iMaLop'	=> $ctdt['FK_iMaKhoa'].'_'.$ten_lop,
					'sTenLop'	=> $ten_lop,
					'FK_iMaKhoa'=> $ctdt['FK_iMaKhoa']
				);
				if (!in_array($lop, $ds_lop)) {
					if (!in_array($lop['PK_iMaLop'], $ds_ma_lop)) {
						array_push($ds_lop, $lop);
					}
					else {
						array_push($ds_lop_update, $lop);
					}
				}

				$sv = array(
					'PK_iMaSV'	=> $worksheet->getCellByColumnAndRow(2,$row)->getValue(),
					'sHo'		=> $worksheet->getCellByColumnAndRow(3,$row)->getValue(),
					'sTen'		=> $worksheet->getCellByColumnAndRow(4,$row)->getValue(),
					'dNgaySinh'	=> implode('-', array_reverse(explode('/',$worksheet->getCellByColumnAndRow(5,$row)->getValue()))),
					'sGioiTinh'	=> $worksheet->getCellByColumnAndRow(6,$row)->getValue(),
				);
				if (!in_array($sv, $ds_sv)) {
					if (!in_array($sv['PK_iMaSV'], $ds_ma_sv)) {
						array_push($ds_sv, $sv);
					}
					else {
						array_push($ds_sv_update, $sv);
					}
				}

				$nhaphoc = array(
					'PK_iMaNhapHoc'	=> $sv['PK_iMaSV'],
					'FK_iMaSV'		=> $sv['PK_iMaSV'],
					'FK_iMaKhoa'	=> $ctdt['FK_iMaKhoa'],
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
					'iSoHocPhanThiLai'			=> $worksheet->getCellByColumnAndRow($lastColumn-1,$row)->getValue()
				);
				if (!in_array($nhaphoc, $ds_nhaphoc)) {
					if (!in_array($nhaphoc['PK_iMaNhapHoc'], $ds_ma_nhaphoc)) {
						array_push($ds_nhaphoc, $nhaphoc);
					}
					else {
						array_push($ds_nhaphoc_update, $nhaphoc);
					}
				}
				
				$sv_lop = array(
					'PK_iMaSVLop'	=> $lop['PK_iMaLop'].'_'.$nhaphoc['PK_iMaNhapHoc'],
					'FK_iMaNhapHoc'	=> $nhaphoc['PK_iMaNhapHoc'],
					'FK_iMaLop'		=> $lop['PK_iMaLop']
				);
				if (!in_array($sv_lop, $ds_sv_lop)) {
					if (!in_array($sv_lop['PK_iMaSVLop'], $ds_ma_sv_lop)) {
						array_push($ds_sv_lop, $sv_lop);
					}
					else {
						array_push($ds_sv_lop_update, $sv_lop);
					}
				}

				for ($column = 7, $i = 0, $count_attr = 0; $column < $lastColumn - 13;) {
					$diem = array(
						'PK_iMaDiem'	=> $nhaphoc['PK_iMaNhapHoc'].'_'.$sttmon[$i],
						'iDT10'			=> $worksheet->getCellByColumnAndRow($column++, $row)->getValue(),
						'sDTChu'		=> $worksheet->getCellByColumnAndRow($column++, $row)->getValue(),
						'iDT4'			=> $worksheet->getCellByColumnAndRow($column++, $row)->getValue(),
						'FK_iMaNhapHoc'	=> $nhaphoc['PK_iMaNhapHoc'],
						'FK_iMaMonCTDT'	=> $sttmon[$i++],
					);
					if ($so_cot == 5) {
						$diem['sLichSu']	= $worksheet->getCellByColumnAndRow($column++, $row)->getValue();
						$diem['sNoiMien']	= $worksheet->getCellByColumnAndRow($column++, $row)->getValue();
					}
					if (!in_array($diem, $ds_diem)) {
						if (!in_array($diem['PK_iMaDiem'], $ds_ma_diem)) {
							array_push($ds_diem, $diem);
						}
						else {
							array_push($ds_diem_update, $diem);
						}
					}
				}
			}
			// pr($ds_lop);
			// pr($ds_diem);
			$res =	$this->Mlistsv->insert_ds_lop($ds_lop);
			// pr($ds_sv);
			// pr($res);
			
			$res =	$this->Mlistsv->insert_ds_sv($ds_sv);
			$res =	$this->Mlistsv->insert_ds_nhaphoc($ds_nhaphoc);
			$res =	$this->Mlistsv->insert_ds_sv_lop($ds_sv_lop);
			
			$res =	$this->Mlistsv->insert_ds_diem($ds_diem);
			
			#endregion

			// $res = $res ? 1 : 0;
			$res = 1;
			$this->returnWithMess($res, $list_ma_sv, $new_sv['sMaSV']);
        }
	}

    public function importExcelAjax()
    {
		$list_ma_sv = array();
        
		$res = 0;
		
		#region insert_ctdt
		$ctdt = array(
			'sTenBac'	=> $this->input->post('bac'),
			'sTenDonVi'	=> $this->input->post('khoa'),
			'sNam'		=> $this->input->post('namhoc'),
			'sTenHe'	=> $this->input->post('he'),
			'sTenNganh'	=> $this->input->post('nganh'),
			'iKhoa'		=> $this->input->post('khoahoc'),
		);
		$ctdt = $this->Mlistsv->insertCTDT($ctdt);
		
		#endregion

		#region import_mon
		$list_mon		= $this->input->post('list_mon');
		$list_mon_ta	= $this->input->post('list_mon_ta');
		$list_stc		= $this->input->post('list_stc');
		
		$sttmon = array();
		for ($i = 0; $i < count($list_mon); $i++) {
			$mon = array(
				'sTenMon'	=> $list_mon[$i],
				'sTenMonTA'	=> $list_mon_ta[$i],
				'iSoTinChi'	=> $list_stc[$i]
			);
			
			array_push($sttmon, $this->Mlistsv->insertMon($mon, $ctdt, $i));
			// pr($mon);

		}
		#endregion

		// $mess = '';
		// if ($res) {
		// 	$mess = 'success';
		// }
		// else {
		// 	$mess = 'fail';
		// }
		$response = array(
			'sttmon'	=> $sttmon,
			'ctdt'		=> $ctdt
		);

		echo json_encode($response);
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

		$data_sv['FK_iMaNhapHoc'] = $this->Mlistsv->insert_sv($data_sv);
		
		$this->Mlistsv->insertSV_Lop($data_sv, $ctdt);
		
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
			$res = $this->Mlistsv->insertDiem($diem, $sttmon[$j++]);
		}
		echo json_encode($res?1:0);
		exit();
		#endregion

	}

	public function delSV()
	{
		$masv = $this->input->post('delSV');
		$res = $this->Mlistsv->delSV($masv);
		if ($res > 0) {
			setMessages('success', 'Đã xoá sinh viên');
		}
		redirect(base_url().'listsv');
	}
	
	public function deleteSVWith($conditional)
	{
		$res = $this->Mlistsv->deleteSVWith($conditional);
		setMessages('success', 'Đã xoá ' . $res . ' sinh viên');
		redirect(base_url().'listsv');
	}

	public function returnWithMess($res, $list_ma_sv, $masv = '')
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
		if($res < 0) {
			foreach ($list_ma_sv as $key => $value) {
				$this->Mlistsv->delSV($value);
			}
		}
		redirect(base_url().'listsv');
	}

	public function download_demo()
	{
		$link = base_url().'assets/demo_file/demo.xlsx';
		$ext  = substr(strrchr($link, '.'), 1);
		header('Content-Description: File Transfer');
		header('Content-Type: application/octet-stream');
		header('Content-Disposition: attachment; filename="demo.xlsx"');
		readfile($link);
		exit();
	}

	public function getDataToExport()
	{
		$session = $this->session->userdata('user');
		$maKhoaHoc = $this->input->post('khoahoc');
		$sv = $this->Mlistsv->getDSSVIn($maKhoaHoc);
		// pr($sv);

		$object = new PHPExcel();

		$object->setActiveSheetIndex(0);


		$column = 0;
		$row = 1;
		$from_col = 'A';
		$to_col = 'A';
		$from_row = 7;
		$to_row = 10;

		$object->getActiveSheet()->setCellValueByColumnAndRow(1, $row, 'TRƯỜNG ĐẠI HỌC MỞ HÀ NỘI');
		$object->getActiveSheet()->setCellValueByColumnAndRow(11, $row++, 'CỘNG HÒA XÃ HỘI CHỦ NGHĨA VIỆT NAM');
		$object->getActiveSheet()->setCellValueByColumnAndRow(1, $row, 'HỘI ĐỒNG XÉT TỐT NGHIỆP');
		$object->getActiveSheet()->setCellValueByColumnAndRow(11, $row++, 'Độc lập - Tự do - Hạnh phúc');
		$object->getActiveSheet()->setCellValueByColumnAndRow(3, $row++, 'KẾT QUẢ HỌC TẬP TOÀN KHÓA CỦA SINH VIÊN');
		$object->getActiveSheet()->setCellValueByColumnAndRow(2, $row, 'Bậc:');
		$object->getActiveSheet()->setCellValueByColumnAndRow(3, $row, $sv[0]['sTenBac']);
		$object->getActiveSheet()->setCellValueByColumnAndRow(6, $row, 'Hệ:');
		$object->getActiveSheet()->setCellValueByColumnAndRow(7, $row++, $sv[0]['sTenHe']);
		$object->getActiveSheet()->setCellValueByColumnAndRow(2, $row, 'Khoa:');
		$object->getActiveSheet()->setCellValueByColumnAndRow(3, $row, $sv[0]['sTenDonVi']);
		$object->getActiveSheet()->setCellValueByColumnAndRow(6, $row, 'Ngành:');
		$object->getActiveSheet()->setCellValueByColumnAndRow(7, $row++, $sv[0]['sTenNganh']);
		$object->getActiveSheet()->setCellValueByColumnAndRow(2, $row, 'Năm Học:');
		$object->getActiveSheet()->setCellValueByColumnAndRow(3, $row, $sv[0]['sNam']);
		$object->getActiveSheet()->setCellValueByColumnAndRow(6, $row, 'Khoá Học:');
		$object->getActiveSheet()->setCellValueByColumnAndRow(7, $row++, $sv[0]['iKhoa']);
		







		$table_columns = array("STT", "Lớp", "Mã SV", "Họ và", "Tên", "Ngày sinh", "Giới");
		foreach($table_columns as $field)
		{
			// echo $test++ . '\n';
			$object->getActiveSheet()->mergeCells($from_col.$from_row.':'.$to_col.$to_row);
			$object->getActiveSheet()->setCellValueByColumnAndRow($column++, $row, $field);
			$from_col = ++$to_col;
		}
		// pr($test);
		$to_col++;
		$to_col++;
		$to_row = 7;
		foreach ($sv[0]['diem'] as $k => $v) {
			// pr($v);
			$object->getActiveSheet()->mergeCells($from_col.$from_row.':'.$to_col.$to_row);
			$object->getActiveSheet()->mergeCells($from_col.($from_row+1) .':'.$to_col.($to_row+1));
			$object->getActiveSheet()->mergeCells($from_col.($from_row+2) .':'.$to_col.($to_row+2));
			$object->getActiveSheet()->setCellValueByColumnAndRow($column, $row++, $v['sTenMon']);
			$object->getActiveSheet()->setCellValueByColumnAndRow($column, $row++, $v['sTenMonTA']);
			$object->getActiveSheet()->setCellValueByColumnAndRow($column, $row++, $v['iSoTinChi']);
			$object->getActiveSheet()->setCellValueByColumnAndRow($column++, $row, 'ĐT 10');
			$object->getActiveSheet()->setCellValueByColumnAndRow($column++, $row, 'ĐT Chữ');
			$object->getActiveSheet()->setCellValueByColumnAndRow($column++, $row, 'ĐT 4');
			$row-=3;
			for ($i=0; $i < 3; $i++) { 
				$from_col++;
				$to_col++;
			}
		}
		$to_col = $from_col;
		$to_row = 10;
		$list_last_col = array('GDTC', 'GDQP', 'CĐRNN', 'XL Rèn Luyện', 'TBC TL', 'Số TC TL', 'Số TC còn nợ', 'Xếp loại tốt nghiệp', 'Số quyết định đầu vào', 'Ngày quyết định đầu vào', 'Số quyết định tốt nghiệp', 'Ngày quyết định tốt nghiệp', 'Số học phần thi lại');
		foreach($list_last_col as $field)
		{
			$object->getActiveSheet()->mergeCells($from_col.$from_row.':'.$to_col.$to_row);
			$object->getActiveSheet()->setCellValueByColumnAndRow($column++, $row, $field);
			$from_col = ++$to_col;
		}
		$lastCol = $column;
		$column = 0;
		$row = 11;
		foreach ($sv as $k => $v) {
			// pr($v);
			$object->getActiveSheet()->setCellValueByColumnAndRow($column++, $row, ++$k);
			$object->getActiveSheet()->setCellValueByColumnAndRow($column++, $row, $v['sTenLop']);
			$object->getActiveSheet()->setCellValueByColumnAndRow($column++, $row, $v['PK_iMaNhapHoc']);
			$object->getActiveSheet()->setCellValueByColumnAndRow($column++, $row, $v['sHo']);
			$object->getActiveSheet()->setCellValueByColumnAndRow($column++, $row, $v['sTen']);
			$object->getActiveSheet()->setCellValueByColumnAndRow($column++, $row, date('d/m/Y', strtotime($v['dNgaySinh'])));
			$object->getActiveSheet()->setCellValueByColumnAndRow($column++, $row, $v['sGioiTinh']);
			foreach ($v['diem'] as $stt => $diem) {
				// pr($diem);
				$object->getActiveSheet()->setCellValueByColumnAndRow($column++, $row, $diem['iDT10']);
				$object->getActiveSheet()->setCellValueByColumnAndRow($column++, $row, $diem['sDTChu']);
				$object->getActiveSheet()->setCellValueByColumnAndRow($column++, $row, $diem['iDT4']);
			}
			$object->getActiveSheet()->setCellValueByColumnAndRow($column++, $row, $v['sGDTC']);
			$object->getActiveSheet()->setCellValueByColumnAndRow($column++, $row, $v['sGDQP']);
			$object->getActiveSheet()->setCellValueByColumnAndRow($column++, $row, $v['sCDRNN']);
			$object->getActiveSheet()->setCellValueByColumnAndRow($column++, $row, $v['sXLRenLuyen']);
			$object->getActiveSheet()->setCellValueByColumnAndRow($column++, $row, $v['sTBCTL']);
			$object->getActiveSheet()->setCellValueByColumnAndRow($column++, $row, $v['iSoTCTL']);
			$object->getActiveSheet()->setCellValueByColumnAndRow($column++, $row, $v['iSoTCConNo']);
			$object->getActiveSheet()->setCellValueByColumnAndRow($column++, $row, $v['sXepLoaiTotNghiep']);
			$object->getActiveSheet()->setCellValueByColumnAndRow($column++, $row, $v['sSoQuyetDinhDauVao']);
			$object->getActiveSheet()->setCellValueByColumnAndRow($column++, $row, date('d/m/Y', strtotime($v['dNgayQuyetDinhDauVao'])));
			$object->getActiveSheet()->setCellValueByColumnAndRow($column++, $row, $v['sSoQuyetDinhTotNghiep']);
			$object->getActiveSheet()->setCellValueByColumnAndRow($column++, $row, date('d/m/Y', strtotime($v['dNgayQuyetDinhTotNghiep'])));
			$object->getActiveSheet()->setCellValueByColumnAndRow($column++, $row, $v['iSoHocPhanThiLai']);
			$row++;
			$column = 0;
		}


		$styleArray = array(
			'alignment' => array(
				'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
				'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
			),
			'font'  => array(
				'size'  => 14,
				'name'  => 'Times New Roman'
			 )
		);
		$object->getDefaultStyle()
			->applyFromArray($styleArray);

		$left_style = array(
			'alignment' => array(
				'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT
			),
			'font'  => array(
				'size'  => 14,
				'name'  => 'Times New Roman'
			 )
		);
		
		$object->getActiveSheet()->getStyle("D10:E".$row)->applyFromArray($left_style);
		$object->getActiveSheet()->getStyle("C4:H6")->applyFromArray($left_style);
		
		$styleArray = array(
			'borders' => array(
			  'allborders' => array(
				'style' => PHPExcel_Style_Border::BORDER_THIN
			  )
			)
		  );
		// pr($lastCol);
		$lastCol = $object->getActiveSheet()->getHighestColumn();
		$object->getActiveSheet()->getStyle('A7:'.$lastCol.--$row)->applyFromArray($styleArray);
		$object->getActiveSheet()->getStyle('A7:'.$lastCol.$row)->getAlignment()->setWrapText(true);
		$object_writer = PHPExcel_IOFactory::createWriter($object, 'Excel5');
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="Danh sách sinh viên.xls"');
		$object_writer->save('php://output');
	}

	public function ExportListWord($conditional)
	{
		// pr($conditional);
		$dssv = $this->Mlistsv->getListSV($conditional);
		$data = array(
			// 'mode'	=> $this->input->get('mode'),
			'dssv'	=> $dssv,
			'url'	=> base_url()
		);
		$data['print'] = false;
		header("Content-Type: application/vnd.ms-word");
		header("Expires: 0");
		header("Cache-Control:  must-revalidate, post-check=0, pre-check=0");
		header("Content-disposition: attachment; filename=".$dssv[0]['sTenBac'].'_'.$dssv[0]['sTenHe'].'_'.$dssv[0]['sTenNganh'].'_'.$dssv[0]['sTenBiKhoaac'].'_DanhSachBangDiem.doc');
		$this->parser->parse('Vindsbangdiem', $data);
		exit();
	}
}