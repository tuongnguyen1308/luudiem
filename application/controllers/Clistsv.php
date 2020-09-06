<?php
/**
 * Created by PhpStorm.
 * User: Nguyễn Duy Thành
 * Date: 04/09/2019
 * Time: 03:18 CH
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
        if ($this->input->post('submitImport')) {
            $this->importSV();
		}
		else if ($this->input->post('delSV')) {
            $this->delSV();
		}
		else if ($this->input->post('action') == 'getSVGrade') {
			$this->getSVGrade();
		}
		else if ($this->input->post('download_demo')) {
			$this->download_demo();
		}
		else if ($this->input->post('export')) {
			$this->getDataToExport();
		}
        $session = $this->session->userdata('user');
        $data = array(
            'currentpage'   => 'list',
            'DSSV'          => $this->Mlistsv->getDSSV($session['ma'])
        );  
        //pr($data['DSSV']);
        $temp['data'] = $data;
        $temp['template'] = 'Vlistsv';
        $this->load->view('layouts/Vlayout', $temp);
    }

	public function getSVGrade()
	{
		$masv = $this->input->post('masv');
		$db = $this->Mlistsv->getSVGrade($masv);
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
				// pr($lastColumn);
				// pr($worksheet->getCellByColumnAndRow(12, 1)->getValue());
                for ($row=4; $row <= $lastRow; $row++) {
					$new_sv = array(
						'PK_iMaSV'	=> $row + time()%1000000000 . rand(000,999),
						'FK_iMaTK'	=> $this->session->userdata('user')['ma'],
						'sLop'		=> $worksheet->getCellByColumnAndRow(1,$row)->getValue(),
						'sMaSV'		=> $worksheet->getCellByColumnAndRow(2,$row)->getValue(),
						'sHo'		=> $worksheet->getCellByColumnAndRow(3,$row)->getValue(),
						'sTen'		=> $worksheet->getCellByColumnAndRow(4,$row)->getValue(),
						'dNgaySinh'	=> date("Y-m-d", strtotime($worksheet->getCellByColumnAndRow(5,$row)->getValue())),
						'sGioiTinh'	=> $worksheet->getCellByColumnAndRow(6,$row)->getValue(),
						'sKhoaHoc'	=> $worksheet->getCellByColumnAndRow(7,$row)->getValue(),
						'sHe'		=> $worksheet->getCellByColumnAndRow(8,$row)->getValue(),
						'sNganhHoc'	=> $worksheet->getCellByColumnAndRow(9,$row)->getValue(),
						'sKhoa'		=> $worksheet->getCellByColumnAndRow(10,$row)->getValue(),
						'sBacHoc'	=> $worksheet->getCellByColumnAndRow(11,$row)->getValue()
					);
					foreach ($new_sv as $key => $value) {
						if (!$value) {
							$res = -2;
							$this->returnWithMess($res, $list_ma_sv);
						}
					}
					$res = $this->Mlistsv->importSV($new_sv);
					if ($res == -1) {
						$this->returnWithMess($res, $list_ma_sv, $new_sv['sMaSV']);
					}
					array_push($list_ma_sv, $res);

					$string = '';
					for ($column = 12; $column < $lastColumn - 9;) {
						$new_grade = array(
							'FK_iMaSV'		=> $new_sv['PK_iMaSV'],
							'sMon'			=> $worksheet->getCellByColumnAndRow($column, 1)->getValue(),
							'iSoTinChi'		=> $worksheet->getCellByColumnAndRow($column, 2)->getValue(),
							'iThangDiem10'	=> $worksheet->getCellByColumnAndRow($column++, $row)->getValue(),
							'sThangDiemChu'	=> $worksheet->getCellByColumnAndRow($column++, $row)->getValue(),
							'iThangDiem4'	=> $worksheet->getCellByColumnAndRow($column++, $row)->getValue()
						);

						foreach ($new_grade as $k => $v) {
							if (!$v) {
								$res = -4;
								$this->returnWithMess($res, $list_ma_sv, $column.' '.$row);
							}
						}
						// pr($new_grade);
						$res = $this->Mlistsv->ImportGrade($new_grade, $column);
						if ($res == -3) {
							$this->returnWithMess($res, $list_ma_sv, $new_grade['sMon']);
						}

						// $string .= $cell;
						// pr($new_grade);
						//  Do what you want with the cell
					}
					// pr($string);
				}
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

	public function getDataToExport()
	{
        $session = $this->session->userdata('user');
		$sv = $this->Mlistsv->getDSSV($session['ma']);
		foreach ($sv as $k => $v) {
			$sv[$k]['diem'] = $this->Mlistsv->getSVGrade($v['PK_iMaSV']);
		}
		// pr($sv);

		$object = new PHPExcel();

		$object->setActiveSheetIndex(0);

		$table_columns = array("STT", "Lớp", "Mã SV", "Họ và", "Tên", "Ngày sinh", "Giới", "Khoá", "Hệ", "Ngành", "Khoa", "Bậc học");

		$column = 0;
		$row = 1;
		$from_col = 'A';
		$to_col = 'A';
		$from_row = 1;
		$to_row = 3;
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
		$to_row = 1;
		foreach ($sv[0]['diem'] as $k => $v) {
			// pr($v);
			$object->getActiveSheet()->mergeCells($from_col.$from_row.':'.$to_col.$to_row);
			$object->getActiveSheet()->mergeCells($from_col.($from_row+1) .':'.$to_col.($to_row+1));
			$object->getActiveSheet()->setCellValueByColumnAndRow($column, $row++, $v['sMon']);
			$object->getActiveSheet()->setCellValueByColumnAndRow($column, $row++, $v['iSoTinChi']);
			$object->getActiveSheet()->setCellValueByColumnAndRow($column++, $row, 'ĐT 10');
			$object->getActiveSheet()->setCellValueByColumnAndRow($column++, $row, 'ĐT Chữ');
			$object->getActiveSheet()->setCellValueByColumnAndRow($column++, $row, 'ĐT 4');
			$row-=2;
			for ($i=0; $i < 3; $i++) { 
				$from_col++;
				$to_col++;
			}
		}
		$column = 0;
		$row = 4;
		foreach ($sv as $k => $v) {
			// pr($v);
			$object->getActiveSheet()->setCellValueByColumnAndRow($column++, $row, ++$k);
			$object->getActiveSheet()->setCellValueByColumnAndRow($column++, $row, $v['sLop']);
			$object->getActiveSheet()->setCellValueByColumnAndRow($column++, $row, $v['sMaSV']);
			$object->getActiveSheet()->setCellValueByColumnAndRow($column++, $row, $v['sHo']);
			$object->getActiveSheet()->setCellValueByColumnAndRow($column++, $row, $v['sTen']);
			$object->getActiveSheet()->setCellValueByColumnAndRow($column++, $row, date('d/m/Y', strtotime($v['dNgaySinh'])));
			$object->getActiveSheet()->setCellValueByColumnAndRow($column++, $row, $v['sGioiTinh']);
			$object->getActiveSheet()->setCellValueByColumnAndRow($column++, $row, $v['sKhoaHoc']);
			$object->getActiveSheet()->setCellValueByColumnAndRow($column++, $row, $v['sHe']);
			$object->getActiveSheet()->setCellValueByColumnAndRow($column++, $row, $v['sNganhHoc']);
			$object->getActiveSheet()->setCellValueByColumnAndRow($column++, $row, $v['sKhoa']);
			$object->getActiveSheet()->setCellValueByColumnAndRow($column++, $row, $v['sBacHoc']);
			foreach ($v['diem'] as $stt => $diem) {
				// pr($diem);
				$object->getActiveSheet()->setCellValueByColumnAndRow($column++, $row, $diem['iThangDiem10']);
				$object->getActiveSheet()->setCellValueByColumnAndRow($column++, $row, $diem['sThangDiemChu']);
				$object->getActiveSheet()->setCellValueByColumnAndRow($column++, $row, $diem['iThangDiem4']);
			}
			$row++;
			$column = 0;
		}
		$center_style = array(
			'alignment' => array(
				'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER
			)
		);
		$object->getDefaultStyle()->applyFromArray($center_style);

		$left_style = array(
			'alignment' => array(
				'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT
			)
		);
		$object->getActiveSheet()->getStyle("D1:E".$row)->applyFromArray($left_style);
	
		$object_writer = PHPExcel_IOFactory::createWriter($object, 'Excel5');
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="Danh sách sinh viên.xls"');
		$object_writer->save('php://output');
	}
}