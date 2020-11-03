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
			$this->deleteSVWith($conditional, $keyword);
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
			'filter'		=> $this->session->flashdata('filter'),
			'countSV'		=> count($this->Mlistsv->getListSV($conditional, $keyword))
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

	public function delSV()
	{
		
		$sv = $this->input->post('sv');
		$res = $this->Mlistsv->delSV($sv);
		if ($res > 0) {
			setMessages('success', 'Đã xoá sinh viên');
		}
		redirect(base_url().'listsv');
	}
	
	public function deleteSVWith($conditional, $keyword)
	{
		$res = $this->Mlistsv->deleteSVWith($conditional, $keyword);
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

	public function getDataToExport()
	{
		$session = $this->session->userdata('user');
		$maKhoaHoc = $this->input->post('khoahoc');
		// pr($maKhoaHoc);
		$conditional['PK_iMaKhoa'] = $maKhoaHoc;
		$sv = $this->Mlistsv->getListSV($conditional);
		// pr($sv);

		if ($sv) {
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
			$object->getActiveSheet()->setCellValueByColumnAndRow(3, $row, $sv[0]['FK_iNamTN']);
			$object->getActiveSheet()->setCellValueByColumnAndRow(6, $row, 'Khoá Học:');
			$object->getActiveSheet()->setCellValueByColumnAndRow(7, $row++, $sv[0]['iKhoa']);
			



			//check Hệ đào tạo:
			$so_cot_trong_mon = $sv[0]['sTenHe'] == 'Đào tạo từ xa' ? 5 : 3;



			$table_columns = array("STT", "Lớp", "Mã SV", "Họ và", "Tên", "Ngày sinh", "Giới");
			foreach($table_columns as $field)
			{
				$object->getActiveSheet()->mergeCells($from_col.$from_row.':'.$to_col.$to_row);
				$object->getActiveSheet()->setCellValueByColumnAndRow($column++, $row, $field);
				$from_col = ++$to_col;
			}
			// pr($test);
			for ($i=1; $i < $so_cot_trong_mon; $i++) { 
				$to_col++;
			}
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
				if ($so_cot_trong_mon == 5) {
					$object->getActiveSheet()->setCellValueByColumnAndRow($column++, $row, 'Lịch sử');
					$object->getActiveSheet()->setCellValueByColumnAndRow($column++, $row, 'Nơi Miễn');
				}
				$row-=3;
				for ($i=1; $i <= $so_cot_trong_mon; $i++) { 
					$from_col++;
					$to_col++;
				}
				if ($sv[0]['diem'][34] == $v) {
					break;
				}
			}
			$to_col = $from_col;
			$to_row = 10;

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
					if ($so_cot_trong_mon == 5) {
						$object->getActiveSheet()->setCellValueByColumnAndRow($column++, $row, $diem['sLichSu']);
						$object->getActiveSheet()->setCellValueByColumnAndRow($column++, $row, $diem['sNoiMien']);
					}
					if ($v['diem'][34] == $diem) {
						break;
					}
				}
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




			//SHEET 2 ======================================================================================================================================================
			// $object->createSheet();
			$object->setActiveSheetIndex(1);


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
			$object->getActiveSheet()->setCellValueByColumnAndRow(3, $row, $sv[0]['FK_iNamTN']);
			$object->getActiveSheet()->setCellValueByColumnAndRow(6, $row, 'Khoá Học:');
			$object->getActiveSheet()->setCellValueByColumnAndRow(7, $row++, $sv[0]['iKhoa']);
			



			//check Hệ đào tạo:
			$so_cot_trong_mon = $sv[0]['sTenHe'] == 'Đào tạo từ xa' ? 5 : 3;



			$table_columns = array("STT", "Lớp", "Mã SV", "Họ và", "Tên", "Ngày sinh", "Giới");
			foreach($table_columns as $field)
			{
				$object->getActiveSheet()->mergeCells($from_col.$from_row.':'.$to_col.$to_row);
				$object->getActiveSheet()->setCellValueByColumnAndRow($column++, $row, $field);
				$from_col = ++$to_col;
			}
			// pr($test);
			for ($i=1; $i < $so_cot_trong_mon; $i++) { 
				$to_col++;
			}
			$to_row = 7;
			for ($i=35; $i < count($sv[0]['diem']); $i++) { 
				$object->getActiveSheet()->mergeCells($from_col.$from_row.':'.$to_col.$to_row);
				$object->getActiveSheet()->mergeCells($from_col.($from_row+1) .':'.$to_col.($to_row+1));
				$object->getActiveSheet()->mergeCells($from_col.($from_row+2) .':'.$to_col.($to_row+2));
				$object->getActiveSheet()->setCellValueByColumnAndRow($column, $row++, $sv[0]['diem'][$i]['sTenMon']);
				$object->getActiveSheet()->setCellValueByColumnAndRow($column, $row++, $sv[0]['diem'][$i]['sTenMonTA']);
				$object->getActiveSheet()->setCellValueByColumnAndRow($column, $row++, $sv[0]['diem'][$i]['iSoTinChi']);
				$object->getActiveSheet()->setCellValueByColumnAndRow($column++, $row, 'ĐT 10');
				$object->getActiveSheet()->setCellValueByColumnAndRow($column++, $row, 'ĐT Chữ');
				$object->getActiveSheet()->setCellValueByColumnAndRow($column++, $row, 'ĐT 4');
				if ($so_cot_trong_mon == 5) {
					$object->getActiveSheet()->setCellValueByColumnAndRow($column++, $row, 'Lịch sử');
					$object->getActiveSheet()->setCellValueByColumnAndRow($column++, $row, 'Nơi Miễn');
				}
				$row-=3;
				for ($i=1; $i <= $so_cot_trong_mon; $i++) { 
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
				for ($i=35; $i < count($v['diem']); $i++) { 
					$object->getActiveSheet()->setCellValueByColumnAndRow($column++, $row, $v['diem'][$i]['iDT10']);
					$object->getActiveSheet()->setCellValueByColumnAndRow($column++, $row, $v['diem'][$i]['sDTChu']);
					$object->getActiveSheet()->setCellValueByColumnAndRow($column++, $row, $v['diem'][$i]['iDT4']);
					if ($so_cot_trong_mon == 5) {
						$object->getActiveSheet()->setCellValueByColumnAndRow($column++, $row, $v['diem'][$i]['sLichSu']);
						$object->getActiveSheet()->setCellValueByColumnAndRow($column++, $row, $v['diem'][$i]['sNoiMien']);
					}
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
		else {
			setMessages('error', 'Không có sinh viên nào để xuất');
			redirect(base_url().'listsv');
		}

		
	}

	public function ExportListWord($conditional)
	{
		// pr($conditional);
		$dssv = $this->Mlistsv->getListSV($conditional, '', 'word');
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