<?php

class Cmuc6 extends MY_Controller
{
    public $Mmuc6;
    public $id = '';
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Mmuc6', 'Mmuc6');
        $this->Mmuc6 = new Mmuc6();
        if($this->input->get('id'))
        {
            $this->id = $this->input->get('id');
        }
	}

    public function index()
    {
        $session = $this->session->userdata('user');
        // pr($session );
        if ($this->input->post('addSach')) {
            $this->addSach();
        }
        if ($this->input->post('updatemuc6')) {
            $this->updatemuc6();
        }
        if ($this->input->post('btnDeleteSach')) {
            $this->deleteSach();
        }
        $muc6 = '';
        $maungvien	= '';
        if($this->input->get('id'))
		{
			$maungvien = $this->id;
            $muc6 = $this->Mmuc6->getSach($maungvien);    
            // pr($muc6);
		}
        else {
            setMessages('warning','Vui lòng nhập thông tin cá nhân của ứng viên trước');
            $disable = 'disable';
        }
        $data = array(
            'currentpage'   => 'muc6',
            'id'			=> $maungvien,
            'muc6'          => $muc6,
            'muc6addition'  => $this->Mmuc6->getMuc6($maungvien),
            'muc6Tong'      => $this->Mmuc6->getTongSach($maungvien)
        );
        
        // pr($data);
        $temp['data'] = $data;
        $temp['template'] = 'Vmuc6';
        $this->load->view('td_layouts/Vlayout', $temp);
    }
    public function deleteSach()
    {
        $info = $this->input->post('data');
        $info['FK_iMaUV'] = $this->id;
        $masach = $this->input->post('btnDeleteSach');
        $res = $this->Mmuc6->xoaSach($masach);
        if ($res > 0) {
            setMessages('success', 'Xóa thành công!');
        }
        else {
            setMessages('error', 'Xóa thất bại');
        }
        redirect(base_url().'muc6?id='.$info['FK_iMaUV']);
    }

    public function addSach()
    {
        $dataSach = $this->input->post('data');

        $dataSach['FK_iMaUV'] = $this->id;
        $res = $this->Mmuc6->addSach($dataSach);
        if ($res > 0) {
            setMessages('success', 'Cập nhật thông tin thành công');
        }
        else {
            setMessages('error', 'Cập nhật thông tin thất bại');
        }
        redirect(base_url().'muc6?id='.$dataSach['FK_iMaUV']);
    }

    public function updatemuc6()
    {
        $data = $this->input->post('data');
        $info = $this->input->post('info');
        $data['FK_iMaUV'] = $this->id;
        // pr($data);
        $res = $this->Mmuc6->updatemuc6($data, $info);
        if ($res > 0) {
            setMessages('success', 'Cập nhật thông tin thành công');
        }
        else {
            setMessages('success', 'Cập nhật thông tin thành công');
        }
        redirect(base_url().'muc6?id='.$data['FK_iMaUV']);
    }
}