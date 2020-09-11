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
			'url'	=> base_url()
		);
		$this->parser->parse('Vinbangdiem', $data);
	}
}