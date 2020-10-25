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
		$count_sv = '';
        if ($this->input->post('btn_filter')) {
            $count_sv = $this->filter_graduate_year();
		}
		

        $session = $this->session->userdata('user');
        $data = array(
			'currentpage'	=> 'statistical',
			'iNamTN'		=> $this->input->post('namtotnghiep'),
			'listNamTN'		=> $this->Mstatistical->getNamTN(),
			'count_sv'		=> $count_sv,
			'statistical'	=> $this->Mstatistical->getStatistical()['res'],
			'rowspan'		=> $this->Mstatistical->getStatistical()['rowspan']
		);
		// pr($data['statistical']);
		// pr($data['countPage']);
        //pr($data['DSSV']);
        $temp['data'] = $data;
        $temp['template'] = 'Vstatistical';
        $this->load->view('layouts/Vlayout', $temp);
    }

	public function filter_graduate_year()
	{
		$namtotnghiep = $this->input->post('namtotnghiep');
		$count_sv = $this->Mstatistical->count_sv($namtotnghiep);
		// pr($db);
		return $count_sv;
		
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

}