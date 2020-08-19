<?php

class Cinfoungvien extends MY_Controller
{
    public $Minfoungvien;
    public $id = '';
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Minfoungvien', 'Minfoungvien');
        $this->Minfoungvien = new Minfoungvien();
        if($this->input->get('id'))
        {
            $this->id = $this->input->get('id');
        }
	}

    public function index()
    {
        $session = $this->session->userdata('user');
        //pr($session );
        if ($this->input->post('addInfoungvien')) {
            $this->addInfoungvien();
        }
        if ($this->input->post('updateInfoungvien')) {
            $this->updateInfoungvien();
        }
        $maungvien	= '';
        $ungvien = '';
        if($this->input->get('id'))
		{
            $maungvien = $this->id;
            $ungvien = $this->getInfoUV($maungvien);
		}
        $data = array(
            'currentpage'   => 'info-ung-vien',
            'ds_chucdanh'   => $this->Minfoungvien->getAll('dm_chucdanh'),
            'ds_nganh'      => $this->Minfoungvien->getAll('dm_nganh'),
            'ds_dantoc'     => $this->Minfoungvien->getAll('dm_dantoc'),
            'hdcs'          => $this->Minfoungvien->getAll('dm_hoidongcoso'),
            'id'		    => $maungvien,
            'ungvien'       => $ungvien
        );
        $temp['data'] = $data;
        $temp['template'] = 'Vinfoungvien';
        $this->load->view('td_layouts/Vlayout', $temp);
    }
    public function addInfoungvien()
    {
        $session = $this->session->userdata('user');
        $info = $this->input->post('data');
        $info['PK_iMaUV'] = time()%100000000 . rand(00,99);
        $info['FK_iMaTK'] = $session['ma'];
        //pr($info);
        // $info['PK_iMaTK'] = $session['ma'];
        $res = $this->Minfoungvien->addInfo($info);
        if ($res > 0) {
            setMessages('success', 'Cập nhật thông tin thành công');
            redirect(base_url().'info-ung-vien?id='.$info['PK_iMaUV']);
        }
        else {
            setMessages('error', 'Cập nhật thông tin thất bại');
            redirect(base_url().'info-ung-vien');
        }
        // pr($info);
    }
    public function updateInfoungvien()
    {
        $info = $this->input->post('data');
        //pr($info);
        $res = $this->Minfoungvien->updateInfo($info);
        if ($res > 0) {
            setMessages('success', 'Cập nhật thông tin thành công');
        }
        else {
            setMessages('error', 'Cập nhật thông tin thất bại');
        }
        redirect(base_url().'info-ung-vien?id='.$info['PK_iMaUV']);
    }

    public function getInfoUV($mauv)
    {
        return $this->Minfoungvien->getInfoUV($mauv);
    }
}