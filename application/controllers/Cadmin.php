<?php
/**
 * Created by PhpStorm.
 * User: Nguyễn Văn bảo
 * Time: 03:18 CH
 */

class Cadmin extends MY_Controller
{
	public $Madmin;
	public $id = '';
public function __construct()
{
	parent::__construct();
	$this->load->model('Madmin', 'Madmin');
	$this->Madmin = new Madmin();
}
	
	public function index()
	{
			$session = $this->session->userdata('user');
			/* if ($this->input->post('addInfoungvien')) {
					$this->addInfoungvien();
			} */
			$data = array(
					'listUV'     => $this->Madmin->getDanhSachUngVien(),
					'csrf' => array(
							'name' => $this->security->get_csrf_token_name(),
							'hash' => $this->security->get_csrf_hash()
					)
			);  
			// pr($data);
			//pr($data['DSUngVien']);
			$temp['data'] = $data;
			// $temp['template'] = 'Vadmin';
			$this->parser->parse('Vadmin', $data);
			// $this->load->view('layouts/Vlayout', $temp);
	}
}