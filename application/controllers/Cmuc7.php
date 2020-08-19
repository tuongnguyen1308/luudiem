<?php

class Cmuc7 extends MY_Controller
{
    public $Mmuc7;
    public $id = '';
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Mmuc7', 'Mmuc7');
        $this->Mmuc7 = new Mmuc7();
        if($this->input->get('id'))
        {
            $this->id = $this->input->get('id');
        }
	}

    public function index()
    {
        $session = $this->session->userdata('user');
        // pr($session );
        if ($this->input->post('updatemuc7')) {
            $this->updatemuc7();
        }
        $muc7 = '';
        $maungvien	= '';
        if($this->input->get('id'))
		{
			$maungvien = $this->id;
            $muc7 = $this->Mmuc7->getMuc7($maungvien);
            
            // pr($muc7);
		}
        else {
            setMessages('warning','Vui lòng nhập thông tin cá nhân của ứng viên trước');
            $disable = 'disable';
        }
        $data = array(
            'currentpage'   => 'muc7',
            'id'			=> $maungvien,
            'muc7'          => $muc7
        );
        $temp['data'] = $data;
        $temp['template'] = 'Vmuc7';
        $this->load->view('td_layouts/Vlayout', $temp);
    }
    
    public function updatemuc7()
    {
        $info = $this->input->post('data');
        $info['FK_iMaUV'] = $this->id;
        // pr($info);
        $res = $this->Mmuc7->updatemuc7($info);
        if ($res > 0) {
            setMessages('success', 'Cập nhật thông tin thành công');
        }
        else {
            setMessages('error', 'Cập nhật thông tin thất bại');
        }
        redirect(base_url().'muc7?id='.$info['FK_iMaUV']);
    }
}