<?php

class Cnhanxet extends MY_Controller
{
    public $Mnhanxet;
    public $id = '';
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Mnhanxet', 'Mnhanxet');
        $this->Mnhanxet = new Mnhanxet();
        if($this->input->get('id'))
        {
            $this->id = $this->input->get('id');
        }
	}

    public function index()
    {
        $session = $this->session->userdata('user');
        // pr($session );
        if ($this->input->post('updateInfo')) {
            $this->updateInfo($session);
            return redirect('infouv');
        }
        $maungvien	= '';
        if($this->input->get('id'))
		{
            $maungvien = $this->id;
        }
        else {
            setMessages('warning','Vui lòng nhập thông tin cá nhân của ứng viên trước');
            $disable = 'disable';
        }
        if ($this->input->post('addNhanXet')){
            $this->saveNhanXet();
        }
        if ($this->input->post('updateNhanXet')){
            $this->saveNhanXet();
        }
        $data = array(
            'url'           => base_url(),
            'message'       => getMessages(),
            'currentpage'   => 'nhanxet',
            'nhanxet'         => $this->Mnhanxet->getNhanXet($maungvien),
            'id'					=> $maungvien,
            'csrf'          => array(
                'name' => $this->security->get_csrf_token_name(),
                'hash' => $this->security->get_csrf_hash()
            )
        );
        //pr($data['nhanxet']);
        $temp['data'] = $data;
        $temp['template'] = 'Vnhanxet';
        $this->load->view('td_layouts/Vlayout', $temp);
    }
    public function saveNhanXet()
	{
        $maUngVien = $this->id;
		$manhanxet = time().rand(1000, 9999);
        $arrSave = array(
            'PK_iMaNhanXet' 	=> $manhanxet,
            'FK_iMaUV'			=> $maUngVien,
            'sUuDiem'			=> $this->input->post('uudiem'),
            'sNhuocDiem'		=> $this->input->post('nhuocdiem'),
            'sDanhGiaChung'		=> $this->input->post('danhgiachung'),
        );
        //pr($arrSave);
        $af_row = $this->Mnhanxet->saveNhanXet($maUngVien, $arrSave);
		if ($af_row > 0){
			setMessages('success', 'Lưu nhận xét thành công');
		}
		else{
			setMessages('error', 'Có lỗi xảy ra hoặc thông tin không thay đổi. Vui lòng kiểm tra lại');
		}
		return redirect(current_url()."?id=".$this->id);
	}
}