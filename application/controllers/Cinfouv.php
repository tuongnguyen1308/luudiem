<?php

class Cinfouv extends MY_Controller
{
    public $Minfouv;

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Minfouv', 'Minfouv');
		$this->Minfouv = new Minfouv();
	}

    public function index()
    {
        $session = $this->session->userdata('user');
        // pr($session );
        if ($this->input->post('updateInfo')) {
            $this->updateInfo($session);
            return redirect('infouv');
        }
        $data = array(
            'currentpage'   => 'info',
            'ds_chucdanh'   => $this->Minfouv->getAll('dm_chucdanh'),
            'ds_nganh'      => $this->Minfouv->getAll('dm_nganh'),
            'info'          => $this->Minfouv->getWherePrimary('tbl_taikhoan','PK_iMaTK',$session['ma']),
            'csrf'          => array(
                'name' => $this->security->get_csrf_token_name(),
                'hash' => $this->security->get_csrf_hash()
            )
        );
        $temp['data'] = $data;
        $temp['template'] = 'Vinfouv';
        $this->load->view('layouts/Vlayout', $temp);
    }
    public function updateInfo($session)
    {
        $info = $this->input->post('data');
        $info['PK_iMaTK'] = $session['ma'];
        $res = $this->Minfouv->updateInfo($info);
        if ($res > 0) {
            setMessages('success', 'Cập nhật thông tin thành công');
        }
        else {
            setMessages('error', 'Cập nhật thông tin thất bại');
        }
        // pr($info);
    }
}