<?php

class Cmuc3 extends MY_Controller
{
    public $Mmuc3;
    public $id = '';
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Mmuc3', 'Mmuc3');
        $this->Mmuc3 = new Mmuc3();
        if($this->input->get('id'))
        {
            $this->id = $this->input->get('id');
        }
	}

    public function index()
    {
        $session = $this->session->userdata('user');
        // pr($session );
        if ($this->input->post('updatemuc3')) {
            $this->updatemuc3();
        }
        $muc3 = '';
        $maungvien	= '';
        if($this->input->get('id'))
		{
			$maungvien = $this->id;
            $muc3 = $this->Mmuc3->getMuc3($maungvien);
            // pr($muc3);
		}
        else {
            setMessages('warning','Vui lòng nhập thông tin cá nhân của ứng viên trước');
            $disable = 'disable';
        }
        $data = array(
            'currentpage'   => 'muc3',
            'id'			=> $maungvien,
            'muc3'          => $muc3,
            'tongSoNam' => $this->Mmuc3->getTongSoNam($maungvien)
        );

        // pr($data['tongSoNam']);

        $temp['data'] = $data;
        $temp['template'] = 'Vmuc3';
        $this->load->view('td_layouts/Vlayout', $temp);
    }
    
    public function updatemuc3()
    {
        $info = $this->input->post('data');
        $info['FK_iMaUV'] = $this->id;
        $tongsonam = $this->input->post('iTongSoTG');
        $res = $this->Mmuc3->updatemuc3($info, $tongsonam);
        if ($res > 0) {
            setMessages('success', 'Cập nhật thông tin thành công');
        }
        else {
            setMessages('success', 'Cập nhật thông tin thành công');
        }
        redirect(base_url().'muc3?id='.$info['FK_iMaUV']);
    }
}