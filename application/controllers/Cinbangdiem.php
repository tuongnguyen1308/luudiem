<?php


class Cinbangdiem extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
        $this->load->model('Minbangdiem', 'Minbangdiem');
		$this->Minbangdiem = new Minbangdiem();
	}

	public function index()
	{
		if ($this->input->get('masv')){
			$masv = $this->input->get('masv');
			$sv = $this->Minbangdiem->getSV($masv);
		}
		else{
			redirect(base_url());
		}

		
		$data = array(
			// 'mode'	=> $this->input->get('mode'),
			'sv'	=> $sv,
			'print'	=> true,
			'url'	=> base_url()
		);
		if($this->input->get('d_f_w') == true) {
			$data['print'] = false;
			header("Content-Type: application/vnd.ms-word");
            header("Expires: 0");
            header("Cache-Control:  must-revalidate, post-check=0, pre-check=0");
            header("Content-disposition: attachment; filename=".$sv['sHo'].$sv['sTen'].'_'.$sv['PK_iMaNhapHoc'].'_BangDiemCaNhan.doc');
		}
		$this->parser->parse('Vinbangdiem', $data);
	}
}