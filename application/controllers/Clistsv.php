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
        $session = $this->session->userdata('user');
        $data = array(
            'currentpage'   => 'list',
            'DSSV'          =>$this->Mlistsv->getDSSV($session['ma'])
        );  
        //pr($data['DSSV']);
        $temp['data'] = $data;
        $temp['template'] = 'Vlistsv';
        $this->load->view('layouts/Vlayout', $temp);
    }


    // public function fetchData()
    // {
    //     $data['DSSV'] = $this->Mlistsv->getDSSV($session['ma']);
    //     $output = '';
    //     foreach ($data['DSSV'] as $key => $value) {
    //         $output .=
    //             '<tr>
    //                 <td>'. $key++ .'</td>
    //                 <td>'.$value['sLop'].'</td>
    //                 <td>'.$value['PK_iMaSV'].'</td>
    //                 <td>'.$value['sHo'] . ' ' . $value['sTen'].'</td>
    //                 <td class="text-center">'. date('d/m/Y', strtotime($value['dNgaySinh']).'</td>
    //                 <td>'.$value['sKhoaHoc'].'</td>
    //                 <td class="text-center">
    //                     <a class="btn btn-success" target="_blank" href="{$url}export09?id={$value.PK_iMaUV}"><i class="fa fa-print" aria-hidden="true"></i></a>
    //                 </td>
    //                 <td class="text-center">
    //                     <a href="{$url}info-ung-vien?id={$value.PK_iMaUV}" target="_blank" class="btn btn-primary"><i class="fa fa-pencil" aria-hidden="true"></i> Thẩm định</a>
    //                 </td>
    //             </tr>';
    //     }
    //     exit($output);
    // }
    
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
}