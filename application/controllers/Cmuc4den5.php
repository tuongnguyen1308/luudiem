<?php

class Cmuc4den5 extends MY_Controller
{
    public $Mmuc4den5;
    public $id = '';
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Mmuc4den5', 'Mmuc4den5');
        $this->Mmuc4den5 = new Mmuc4den5();
        if($this->input->get('id'))
        {
            $this->id = $this->input->get('id');
        }
	}

    public function index()
    {
        $session = $this->session->userdata('user');
        // pr($session );
        if ($this->input->post('updatemuc4den5')) {
            $this->updatemuc4den5();
        }
        $kqtd = '';
        $maungvien	= '';
        if($this->input->get('id'))
		{
			$maungvien = $this->id;
            $kqtd = $this->Mmuc4den5->getKQTD($maungvien);
            // pr($kqtd);
		}
        else {
            setMessages('warning','Vui lòng nhập thông tin cá nhân của ứng viên trước');
            $disable = 'disable';
        }
        $data = array(
            'currentpage'   => 'muc4den5',
            'id'			=> $maungvien,
            'ds_doituong'   => $this->Mmuc4den5->getAll('dm_doituong'),
            'kqtd'          => $kqtd
        );
        $temp['data'] = $data;
        $temp['template'] = 'Vmuc4den5';
        $this->load->view('td_layouts/Vlayout', $temp);
    }
    
    public function updatemuc4den5()
    {
        $info = $this->input->post('data');
        // pr($info);
        $info['FK_iMaUV'] = $this->id;
        $res = $this->Mmuc4den5->updatemuc4den5($info);
        if ($res > 0) {
            setMessages('success', 'Cập nhật thông tin thành công');
        }
        else {
            setMessages('error', 'Cập nhật thông tin thất bại');
        }
        redirect(base_url().'muc4den5?id='.$info['FK_iMaUV']);
    }
}