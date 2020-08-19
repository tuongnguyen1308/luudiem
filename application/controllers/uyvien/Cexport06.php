<?php

define('REDIRECTURL', 'export06');
class Cexport06 extends CI_Controller
{
    public $Mexport06;
    public function __construct()
    {
        parent::__construct();
        $this->load->model('uyvien/Mexport06', 'Mexport06');
		$this->Mexport06 = new Mexport06();
    }
 
    public function index()
    {
        $session = getSession();
        $maungvien = $this->input->get('id');
        $mauyvien = $session['username'];
        if($this->input->get('mauyvien'))
        {
            $mauyvien = $this->input->get('mauyvien');
        }
        
        // $maungvien = 1;
        $data = array(
            'sThongTinUngVien' => $this->Mexport06->getInfo($maungvien),
            'sThongTinUyVien'  => $this->Mexport06->getInfoUyVien($mauyvien),
            'sThongTinThamDinh'=> $this->Mexport06->getThamDinh($maungvien),
            'sMuc3' => $this->Mexport06->getMuc3($maungvien),
            'sMuc7' => $this->Mexport06->getMuc7($maungvien),
            'sNhanXet' => $this->Mexport06->getNhanXet($maungvien),
            'sTongHop' => $this->Mexport06->getTongHop($maungvien),
            'muc6'	   => $this->Mexport06->getTdSach($maungvien),
            'url' => base_url(),
            'mode' => 'print',
            'maUV' => $maungvien
        );
        // pr($data);
        $view = 'uyvien/Vexport06';
        $this->parser->parse($view, $data);
    }
}