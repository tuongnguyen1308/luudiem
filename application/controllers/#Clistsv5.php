<?php
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
		}
		
		$conditional	= '';
		$listBac		= $this->Mlistsv->getList('tbl_bac');
		$listHe			= $this->Mlistsv->getList('tbl_he');
		$listNganh		= $this->Mlistsv->getList('tbl_nganh');
		$listNam		= '';
		$listDonVi		= '';
		$listKhoaHoc	= '';
		
		$keyword = '';
		
		if ($this->input->post('btn_filter') || $this->input->post('btn_search') || $this->input->post('btn_delete')) {
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
			$this->deleteSVWith($conditional);
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
			'FK_iMaDVCTDT'		=> $this->input->post('FK_iMaDVCTDT')
		);
		// pr($conditional);
		$db = $this->Mlistsv->getKhoaHoc($conditional['FK_iMaDVCTDT']);
		exit(json_encode($db));
	}
    
    public function importSV()
    {
		$list_ma_sv = array();
        // pr($_FILES['importExcel']);
        if (isset($_FILES['importExcel']['name'])) {
			$res = 0;
            $path = $_FILES['importExcel']['tmp_name'];
            $object = PHPExcel_IOFactory::load($path);
			// pr($object->getWorksheetIterator());
            foreach ($object->getWorksheetIterator() as $worksheet) {
                // pr($worksheet->getHighestColumn());
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
				for ($column = 7, $i = 1; $column < $lastColumn - 13; $column += 5) {
					$mon = array(
						'sTenMon'	=> $worksheet->getCellByColumnAndRow($column, 7)->getValue(),
						'sTenMonTA'	=> $worksheet->getCellByColumnAndRow($column, 8)->getValue(),
						'iSoTinChi'	=> $worksheet->getCellByColumnAndRow($column, 9)->getValue()
					);
					
					array_push($sttmon, $this->Mlistsv->insertMon($mon, $ctdt, $i++));
					// pr($mon);

				}
				#endregion
				// pr($sttmon);
				#region insert_sinh_vien_lop
                for ($row = 11; $row <= $lastRow; $row++) {
					$data_sv = array(
						'iSTT'		=> $worksheet->getCellByColumnAndRow(0,$row)->getValue(),
						'sTenLop'	=> $worksheet->getCellByColumnAndRow(1,$row)->getValue(),
						'sMaSV'		=> $worksheet->getCellByColumnAndRow(2,$row)->getValue(),
						'sHo'		=> $worksheet->getCellByColumnAndRow(3,$row)->getValue(),
						'sTen'		=> $worksheet->getCellByColumnAndRow(4,$row)->getValue(),
						'dNgaySinh'	=> implode('-', array_reverse(explode('/',$worksheet->getCellByColumnAndRow(5,$row)->getValue()))),
						'sGioiTinh'	=> $worksheet->getCellByColumnAndRow(6,$row)->getValue()
					);
					
					foreach ($data_sv as $key => $value) {
						if (!$value) {
							$mess = "Thông tin sinh viên không được để trống";
							return;
							// $this->returnWithMess($res, $list_ma_sv);
						}
					}
					$data_sv['FK_iMaNhapHoc'] = $this->Mlistsv->insertSV($data_sv, $ctdt);
					$this->Mlistsv->insertSV_Lop($data_sv, $ctdt);
					

					$attr = array('sGDTC', 'sGDQP', 'sCDRNN', 'sXLRenLuyen', 'sTBCTL', 'iSoTCTL', 'iSoTCConNo', 'sXepLoaiTotNghiep', 'sSoQuyetDinhDauVao', 'dNgayQuyetDinhDauVao', 'sSoQuyetDinhTotNghiep', 'dNgayQuyetDinhTotNghiep', 'iSoHocPhanThiLai');

					for ($column = 7, $i = 0, $count_attr = 0; $column < $lastColumn;) {
						if ($column < $lastColumn - 13) {
							$diem = array(
								'iDT10'			=> $worksheet->getCellByColumnAndRow($column++, $row)->getValue(),
								'sDTChu'		=> $worksheet->getCellByColumnAndRow($column++, $row)->getValue(),
								'iDT4'			=> $worksheet->getCellByColumnAndRow($column++, $row)->getValue(),
								'sLichSu'		=> $worksheet->getCellByColumnAndRow($column++, $row)->getValue(),
								'sNoiMien'		=> $worksheet->getCellByColumnAndRow($column++, $row)->getValue(),
								'FK_iMaNhapHoc'	=> $data_sv['FK_iMaNhapHoc'],
								'FK_iMaMonCTDT'	=> $sttmon[$i],
							);
							// pr($diem);
							$this->Mlistsv->insertDiem($diem, $sttmon[$i++]);
						}
						else {
							if($column == $lastColumn - 4 || $column == $lastColumn - 2) {
								$data_sv[$attr[$count_attr++]] = implode('-', array_reverse(explode('/',$worksheet->getCellByColumnAndRow($column++, $row)->getValue())));
							}
							else {
								$data_sv[$attr[$count_attr++]] = $worksheet->getCellByColumnAndRow($column++, $row)->getValue();
							}
							

						}

					}
					// pr($data_sv);
					$this->Mlistsv->updateSV($data_sv);
				}

				#endregion

				$res = 1;

			}
			$this->returnWithMess($res, $list_ma_sv, $new_sv['sMaSV']);
        }
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
			$this->Mlistsv->undoImportSV($list_ma_sv);
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

	// public function filter_data()
	// {
	// 	$bac = $this->input->post('bac');
	// 	$he = $this->input->post('he');
	// 	$nganh = $this->input->post('nganh');
	// 	$namhoc = $this->input->post('namhoc');
	// 	$donvi = $this->input->post('donvi');
	// 	$khoahoc = $this->input->post('khoahoc');
		
	// 	$conditional = '';

	// 	if ($bac) {
	// 		$conditional['FK_iMaBac'] = $bac;
	// 	}
	// 	if ($he) {
	// 		$conditional['FK_iMaHe'] = $he;
	// 	}
	// 	if ($nganh) {
	// 		$conditional['FK_iMaNganh'] = $nganh;
	// 	}
	// 	if ($namhoc) {
	// 		$conditional['sNam'] = $namhoc;
	// 	}
	// 	if ($donvi) {
	// 		$conditional['FK_iMaDonVi'] = $donvi;
	// 	}
	// 	if ($khoahoc) {
	// 		$conditional['PK_iMaKhoa'] = $khoahoc;
	// 	}

	// 	$list_sv = $this->Mlistsv->getDSSVIn($conditional);
	// }

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
}