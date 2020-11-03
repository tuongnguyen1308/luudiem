<?php

ini_set('max_execution_time', 3000); 
ini_set('memory_limit','2048M');
ini_set('max_input_vars', 6000);
/**
 * User: Nguyễn Đình Tưởng
 * 5 col
 */

class Cdssv extends MY_Controller
{
    public $Mdssv;
    public $id = '';
	public function __construct()
	{
		parent::__construct();
        $this->load->model('Mdssv', 'Mdssv');
        $this->load->library('excel');
		$this->Mdssv = new Mdssv();
	}
    
    public function index()
    {
		//check post input
		$present_page = 1;
		$per_page = 10;
		$keyword		= '';
		// if ($this->session->flashdata('keyword') != '' ) {
		// 	$keyword = $this->session->flashdata('keyword');
		// }
		$keyword = $this->input->post('inp_keyword');
		$conditional	= array(
			'PK_iMaNganh'	=> $this->input->post('PK_iMaNganh') != '' ? $this->input->post('PK_iMaNganh') : $this->session->flashdata('filter')['PK_iMaNganh'],
			'FK_iNamTN'		=> $this->input->post('FK_iNamTN') != '' ? $this->input->post('FK_iNamTN') : $this->session->flashdata('filter')['FK_iNamTN']
		);
		if (!$conditional['PK_iMaNganh']) {
			redirect(base_url().'statistical');
		}
		if ($this->input->get('page')) {
			$present_page = $this->input->get('page');
		}
        if ($this->input->post('submitImport')) {
            $this->importSV();
		}
		else if ($this->input->post('delSV')) {
            $this->delSV();
		}
		else if ($this->input->post('btn_export')) {
			$this->getDataToExport();
		}
		if ($this->input->post('btn_export_word')) {
			$this->ExportListWord($conditional);
		}
		else if ($this->input->post('btn_delete')) {
			$this->deleteSVWith($conditional,$keyword);
		}
		// pr($keyword);
		// pr($conditional);
		
		$this->session->set_flashdata('keyword', $keyword);
		$this->session->set_flashdata('filter', $conditional);

		$list_sv = $this->Mdssv->getDSSVIn($conditional, $keyword, $present_page);
		
        $session = $this->session->userdata('user');
        $data = array(
			'currentpage'	=> 'statistical',
			'present_page'	=> $present_page,
			'thongtinloc'	=> $this->Mdssv->getThongTinLoc($conditional),
			'countPage'		=> $this->Mdssv->countPage($conditional, $keyword, $present_page),
			'DSSV'          => $list_sv,
			'conditional'	=> $conditional,
			'keyword'		=> $this->session->flashdata('keyword'),
			'filter'		=> $this->session->flashdata('filter'),
			// 'countSV'		=> count($this->Mdssv->getListSV($conditional, $keyword))
		);
		// pr($data['list_filter']);
		// pr($data['countPage']);
        //pr($data['DSSV']);
        $temp['data'] = $data;
        $temp['template'] = 'Vdssv';
        $this->load->view('layouts/Vlayout', $temp);
    }

	public function getNamHoc()
	{
		$fk_arr = array(
			'FK_iMaBac'		=> $this->input->post('FK_iMaBac'),
			'FK_iMaHe'		=> $this->input->post('FK_iMaHe'),
			'FK_iMaNganh'	=> $this->input->post('FK_iMaNganh')
		);
		$db = $this->Mdssv->getNamHoc($fk_arr);
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
		$db = $this->Mdssv->getDonVi($conditional);
		exit(json_encode($db));
	}
	public function getKhoaHoc()
	{
		$conditional = array(
			'FK_iMaDVCTDT'	=> $this->input->post('FK_iMaDVCTDT')
		);
		// pr($conditional);
		$db = $this->Mdssv->getKhoaHoc($conditional['FK_iMaDVCTDT']);
		exit(json_encode($db));
	}

	public function delSV()
	{
		$sv = $this->input->post('sv');
		$res = $this->Mdssv->delSV($sv);
		if ($res > 0) {
			setMessages('success', 'Đã xoá sinh viên');
		}
		redirect(base_url().'statistical');
	}
	
	public function deleteSVWith($conditional, $keyword)
	{
		$res = $this->Mdssv->deleteSVWith($conditional, $keyword);
		setMessages('success', 'Đã xoá ' . $res . ' sinh viên');
		redirect(base_url().'statistical');
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
				$this->Mdssv->delSV($value);
			}
		}
		redirect(base_url().'dssv');
	}

	public function getDataToExport()
	{
		$session = $this->session->userdata('user');
		$conditional	= array(
			'PK_iMaNganh'	=> $this->session->flashdata('filter')['PK_iMaNganh'],
			'FK_iNamTN'		=> $this->session->flashdata('filter')['FK_iNamTN']
		);
		$sv = $this->Mdssv->getListSV($conditional);
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
				if ($v['iSTT'] == 35) {
					break;
				}
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
				$object->getActiveSheet()->setCellValueByColumnAndRow($column++, $row, $v['PK_iMaSV']);
				$object->getActiveSheet()->setCellValueByColumnAndRow($column++, $row, $v['sHo']);
				$object->getActiveSheet()->setCellValueByColumnAndRow($column++, $row, $v['sTen']);
				$object->getActiveSheet()->setCellValueByColumnAndRow($column++, $row, date('d/m/Y', strtotime($v['dNgaySinh'])));
				$object->getActiveSheet()->setCellValueByColumnAndRow($column++, $row, $v['sGioiTinh']);
				foreach ($v['diem'] as $stt => $diem) {
					if ($diem['iSTT'] == 35) {
						break;
					}
					$object->getActiveSheet()->setCellValueByColumnAndRow($column++, $row, $diem['iDT10']);
					$object->getActiveSheet()->setCellValueByColumnAndRow($column++, $row, $diem['sDTChu']);
					$object->getActiveSheet()->setCellValueByColumnAndRow($column++, $row, $diem['iDT4']);
					if ($so_cot_trong_mon == 5) {
						$object->getActiveSheet()->setCellValueByColumnAndRow($column++, $row, $diem['sLichSu']);
						$object->getActiveSheet()->setCellValueByColumnAndRow($column++, $row, $diem['sNoiMien']);
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
			$object->createSheet();
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
				if ($v['iSTT'] > 34) {
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
				}
			}
			// for ($i=35; $i < count($sv[0]['diem']); $i++) { 
			// 	$object->getActiveSheet()->mergeCells($from_col.$from_row.':'.$to_col.$to_row);
			// 	$object->getActiveSheet()->mergeCells($from_col.($from_row+1) .':'.$to_col.($to_row+1));
			// 	$object->getActiveSheet()->mergeCells($from_col.($from_row+2) .':'.$to_col.($to_row+2));
			// 	$object->getActiveSheet()->setCellValueByColumnAndRow($column, $row++, $sv[0]['diem'][$i]['sTenMon']);
			// 	$object->getActiveSheet()->setCellValueByColumnAndRow($column, $row++, $sv[0]['diem'][$i]['sTenMonTA']);
			// 	$object->getActiveSheet()->setCellValueByColumnAndRow($column, $row++, $sv[0]['diem'][$i]['iSoTinChi']);
			// 	$object->getActiveSheet()->setCellValueByColumnAndRow($column++, $row, 'ĐT 10');
			// 	$object->getActiveSheet()->setCellValueByColumnAndRow($column++, $row, 'ĐT Chữ');
			// 	$object->getActiveSheet()->setCellValueByColumnAndRow($column++, $row, 'ĐT 4');
			// 	if ($so_cot_trong_mon == 5) {
			// 		$object->getActiveSheet()->setCellValueByColumnAndRow($column++, $row, 'Lịch sử');
			// 		$object->getActiveSheet()->setCellValueByColumnAndRow($column++, $row, 'Nơi Miễn');
			// 	}
			// 	$row-=3;
			// 	for ($i=1; $i <= $so_cot_trong_mon; $i++) { 
			// 		$from_col++;
			// 		$to_col++;
			// 	}
			// }


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
				$object->getActiveSheet()->setCellValueByColumnAndRow($column++, $row, $v['PK_iMaSV']);
				$object->getActiveSheet()->setCellValueByColumnAndRow($column++, $row, $v['sHo']);
				$object->getActiveSheet()->setCellValueByColumnAndRow($column++, $row, $v['sTen']);
				$object->getActiveSheet()->setCellValueByColumnAndRow($column++, $row, date('d/m/Y', strtotime($v['dNgaySinh'])));
				$object->getActiveSheet()->setCellValueByColumnAndRow($column++, $row, $v['sGioiTinh']);
				foreach ($v['diem'] as $stt => $diem) {
					if ($diem['iSTT'] > 34) {
						$object->getActiveSheet()->setCellValueByColumnAndRow($column++, $row, $diem['iDT10']);
						$object->getActiveSheet()->setCellValueByColumnAndRow($column++, $row, $diem['sDTChu']);
						$object->getActiveSheet()->setCellValueByColumnAndRow($column++, $row, $diem['iDT4']);
						if ($so_cot_trong_mon == 5) {
							$object->getActiveSheet()->setCellValueByColumnAndRow($column++, $row, $diem['sLichSu']);
							$object->getActiveSheet()->setCellValueByColumnAndRow($column++, $row, $diem['sNoiMien']);
						}
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
			redirect(base_url().'dssv');
		}

		
	}

	public function ExportListWord($conditional)
	{
		// pr($conditional);
		$dssv = $this->Mdssv->getListSV($conditional, '', 'word');
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