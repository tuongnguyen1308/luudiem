<?php

class Cmuc2 extends MY_Controller
{
    public $Mmuc2;
    public $id = '';
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Mmuc2', 'Mmuc2');
        $this->Mmuc2 = new Mmuc2();
        if($this->input->get('id'))
        {
            $this->id = $this->input->get('id');
        }
	}

    public function index()
    {
        $session = $this->session->userdata('user');
        // pr($session );
        if ($this->input->post('addBang')) {
            $this->addBang();
        }
        if ($this->input->post('updatemuc2')) {
            $this->updatemuc2();
        }
        if ($this->input->post('btnDeleteBang')) {
            $this->deleteBang();
        }
        $muc2 = '';
        $maungvien	= '';
        if($this->input->get('id'))
		{
			$maungvien = $this->id;
            $muc2 = $this->Mmuc2->getMuc2($maungvien);    
            // pr($muc2);
		}
        else {
            setMessages('warning','Vui lòng nhập thông tin cá nhân của ứng viên trước');
            $disable = 'disable';
        }
        $data = array(
            'currentpage'   => 'muc2',
            'ds_nganh'      => $this->Mmuc2->getAll('dm_nganh'),
            'id'			=> $maungvien,
            'muc2'          => $muc2
        );

        // pr($data);
        $temp['data'] = $data;
        $temp['template'] = 'Vmuc2';
        $this->load->view('td_layouts/Vlayout', $temp);
    }
    public function deleteBang()
    {
        $info = $this->input->post('data');
        $info['FK_iMaUV'] = $this->id;
        $mabang = $this->input->post('btnDeleteBang');
        $res = $this->Mmuc2->xoaBang($mabang);
        if ($res > 0) {
            setMessages('success', 'Xóa thành công!');
        }
        else {
            setMessages('error', 'Xóa thất bại');
        }
        redirect(base_url().'muc2?id='.$info['FK_iMaUV']);
    }

    public function addBang()
    {
        $data = $this->input->post('data');

        $data['FK_iMaUV'] = $this->id;
        $res = $this->Mmuc2->addBang($data);
        if ($res > 0) {
            setMessages('success', 'Cập nhật thông tin thành công');
        }
        else {
            setMessages('error', 'Cập nhật thông tin thất bại');
        }
        redirect(base_url().'muc2?id='.$data['FK_iMaUV']);
    }

    public function updatemuc2()
    {
        $data = $this->input->post('data');
        $info = $this->input->post('info');
        $data['FK_iMaUV'] = $this->id;
        // pr($data);
        $res = $this->Mmuc2->updatemuc2($data, $info);
        if ($res > 0) {
            setMessages('success', 'Cập nhật thông tin thành công');
        }
        else {
            setMessages('success', 'Cập nhật thông tin thành công');
        }
        redirect(base_url().'muc2?id='.$data['FK_iMaUV']);
    }
}