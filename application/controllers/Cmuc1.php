<?php

class Cmuc1 extends MY_Controller
{
    public $Mmuc1;
    public $id = '';
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Mmuc1', 'Mmuc1');
        $this->Mmuc1 = new Mmuc1();
        if($this->input->get('id'))
        {
            $this->id = $this->input->get('id');
        }
	}

    public function index()
    {
        $session = $this->session->userdata('user');
        // pr($session );
        if ($this->input->post('updatemuc1')) {
            $this->updatemuc1();
        }
        $kqtd = '';
        $maungvien	= '';

        $disable = ''; //không cho nhập nếu chưa có FK_iMaUV

        if($this->input->get('id'))
		{
			$maungvien = $this->id;
            $kqtd = $this->Mmuc1->getKQTD($maungvien);
            if ($kqtd) {
                foreach ($kqtd as $key => $value) {
                    if (strpos($value,'|')) {
                        $kqtd[$key] = explode('|',$value);
                    }
                }
            }
            
            // pr($kqtd);
        }
        else {
            setMessages('warning','Vui lòng nhập thông tin cá nhân của ứng viên trước');
            $disable = 'disable';
        }
        $data = array(
            'currentpage'   => 'muc1',
            'thongtinungvien' => $this->Mmuc1->getInfo($this->input->get('id')),
            'ds_nganh'   => $this->Mmuc1->getAll('dm_nganh'),
            'ds_doituong'   => $this->Mmuc1->getAll('dm_doituong'),
            'id'			=> $maungvien,
            'kqtd'          => $kqtd,
        );
        // pr($data);
        $temp['data'] = $data;
        $temp['template'] = 'Vmuc1';
        $this->load->view('td_layouts/Vlayout', $temp);
    }
    
    public function updatemuc1()
    {
        $info = $this->input->post('data');
        // pr($info);
        $info['FK_iMaUV'] = $this->id;
        $res = $this->Mmuc1->updatemuc1($info);
        if ($res > 0) {
            setMessages('success', 'Cập nhật thông tin thành công');
        }
        else {
            setMessages('error', 'Cập nhật thông tin thất bại');
        }
        redirect(base_url().'muc1?id='.$info['FK_iMaUV']);
    }
}