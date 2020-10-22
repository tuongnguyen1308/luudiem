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
			
			#region insert_ctdt
			$ctdt = array(
				'sTenBac'	=> $worksheet->getCellByColumnAndRow(3,4)->getValue(),
				'sTenDonVi'	=> $worksheet->getCellByColumnAndRow(3,5)->getValue(),
				'sNam'		=> $worksheet->getCellByColumnAndRow(3,6)->getValue(),
				'sTenHe'	=> $worksheet->getCellByColumnAndRow(7,4)->getValue(),
				'sTenNganh'	=> $worksheet->getCellByColumnAndRow(7,5)->getValue(),
				'iKhoa'		=> $worksheet->getCellByColumnAndRow(7,6)->getValue(),
			);
			$ctdt = $this->Maddfile->insertCTDT($ctdt);
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
				
				array_push($sttmon, $this->Maddfile->insertMon($mon, $ctdt, $i++));
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
			$ds_ma_lop		= $this->Maddfile->get_ds_ma_lop();
			$ds_ma_sv		= $this->Maddfile->get_ds_ma_sv();
			$ds_ma_nhaphoc	= $this->Maddfile->get_ds_ma_nhaphoc();
			$ds_ma_sv_lop	= $this->Maddfile->get_ds_ma_sv_lop();
			$ds_ma_diem		= $this->Maddfile->get_ds_ma_diem();

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
			$this->Maddfile->insert_ds_lop($ds_lop);
			
			$this->Maddfile->insert_ds_sv($ds_sv);
			$this->Maddfile->insert_ds_nhaphoc($ds_nhaphoc);
			$this->Maddfile->insert_ds_sv_lop($ds_sv_lop);
			$this->Maddfile->insert_ds_diem($ds_diem);
			$this->Maddfile->update_ds_lop($ds_lop);
			
			$this->Maddfile->update_ds_sv($ds_sv_update);
			$this->Maddfile->update_ds_nhaphoc($ds_nhaphoc_update);
			$this->Maddfile->update_ds_sv_lop($ds_sv_lop_update);
			
			$this->Maddfile->update_ds_diem($ds_diem_update);
			

			#endregion

			$res = 1;
			$this->returnWithMess($res, $new_sv['sMaSV']);
        }
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


}