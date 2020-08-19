<?php
define('REDIRECTURL', 'export09');
class Cexport09 extends CI_Controller
{
    public $Mexport09;
    public function __construct()
    {
        parent::__construct();
        $this->load->model('uyvien/Mexport09', 'Mexport09');
		$this->Mexport09 = new Mexport09();
    }

    public function index()
    {
        $session = getSession();
        $view = 'uyvien/Vexport09';
        $maungvien = $this->input->get('id');
        $data = array(
            'sThongTinUngVien' => $this->Mexport09->get09($maungvien),
            'sThongTinUyVien' => $this->Mexport09->getThongTinUyVien($session['username']),
            'sMuc3' => $this->Mexport09->get03($maungvien),
            'sSach' => $this->Mexport09->countSach($maungvien),
            'url' => base_url()
        );
        //  pr($data['sSach']);   
        $this->parser->parse($view, $data);
    }
}