<?php

ini_set('max_execution_time', 5000); 
ini_set('memory_limit','2048M');
ini_set('max_input_vars', 6000);
/**
 * User: Nguyễn Đình Tưởng
 * 5 col
 */

class Cstatistical extends MY_Controller
{
    public $Mstatistical;
    public $id = '';
	public function __construct()
	{
		parent::__construct();
        $this->load->model('Mstatistical', 'Mstatistical');
        $this->load->library('excel');
		$this->Mstatistical = new Mstatistical();
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
		$listBac		= $this->Mstatistical->getList('tbl_bac');
		$listHe			= $this->Mstatistical->getList('tbl_he');
		$listNganh		= $this->Mstatistical->getList('tbl_nganh');
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
				$listNam		= $this->Mstatistical->getNamHoc($conditional);
				$conditional['sNam']		= $namhoc;
			}
			if ($donvi) {
				$listDonVi		= $this->Mstatistical->getDonVi($conditional);
				$conditional['PK_iMaDVCTDT'] = $donvi;
			}
			if ($khoahoc) {
				$listKhoaHoc	= $this->Mstatistical->getKhoaHoc($conditional['PK_iMaDVCTDT']);
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
			$listNam		= $this->Mstatistical->getNamHoc($tmp_cdt);
			$tmp_cdt['sNam']		= $conditional['sNam'];
			$listDonVi		= $this->Mstatistical->getDonVi($tmp_cdt);
			$tmp_cdt['PK_iMaDVCTDT'] = $conditional['PK_iMaDVCTDT'];
			$listKhoaHoc	= $this->Mstatistical->getKhoaHoc($tmp_cdt['PK_iMaDVCTDT']);
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
			$list_sv = $this->Mstatistical->getDSSVIn($conditional, $keyword, $present_page);
			// pr($list_sv);
			$this->session->set_flashdata('filter', $conditional);
			$this->session->set_flashdata('keyword', $keyword);
			// pr($this->session->flashdata('filter'));
		}
		else {
			$list_sv = $this->Mstatistical->getDSSVIn('', '', $present_page);
			redirect(current_url());
		}

        $session = $this->session->userdata('user');
        $data = array(
			'currentpage'	=> 'statistical',
			'present_page'	=> $present_page,
			'countPage'		=> $this->Mstatistical->countPage($conditional, $keyword, $present_page),
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
        $temp['template'] = 'Vstatistical';
        $this->load->view('layouts/Vlayout', $temp);
    }

	public function getNamHoc()
	{
		$fk_arr = array(
			'FK_iMaBac'		=> $this->input->post('FK_iMaBac'),
			'FK_iMaHe'		=> $this->input->post('FK_iMaHe'),
			'FK_iMaNganh'	=> $this->input->post('FK_iMaNganh')
		);
		$db = $this->Mstatistical->getNamHoc($fk_arr);
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
		$db = $this->Mstatistical->getDonVi($conditional);
		exit(json_encode($db));
	}
	public function getKhoaHoc()
	{
		$conditional = array(
			'FK_iMaDVCTDT'	=> $this->input->post('FK_iMaDVCTDT')
		);
		// pr($conditional);
		$db = $this->Mstatistical->getKhoaHoc($conditional['FK_iMaDVCTDT']);
		exit(json_encode($db));
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
				$this->Mstatistical->delSV($value);
			}
		}
		redirect(base_url().'Ctatistical');
	}

}