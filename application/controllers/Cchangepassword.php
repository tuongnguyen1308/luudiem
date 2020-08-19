<?php

define('REDIRECTURL', 'changepassword');
class Cchangepassword extends MY_Controller
{
	public $Mchangepassword;
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Mchangepassword', 'Mchangepassword');
		$this->Mchangepassword = new Mchangepassword();
	}

	public function index()
	{
		if ($this->input->post('btnChange')){
			$this->saveNewPassword();
		}
        $data = array(
			'currentpage'   => 'changepassword',
			'session'		=> getSession()
        );
        $temp['data'] = $data;
		$temp['template'] = 'Vchangepassword';
		$this->load->view('layouts/Vlayout', $temp);
	}

	public function saveNewPassword()
	{
		$session = getSession();
		$email = $session['username'];
		$oldPass = $this->input->post('oldpass');
		$newPass = $this->input->post('newpass');
		$rePass = $this->input->post('repass');
		// pr($oldPass);
		$checkOldPass = $this->Mchangepassword->checkOldPass($email, $oldPass);
		if (!$checkOldPass){
			setMessages('error', 'Mật khẩu cũ không chính xác. Vui lòng thử lại!');
			return redirect(REDIRECTURL);
		}

		if ($oldPass === $newPass){
			setMessages('error', 'Mật khẩu mới không được giống mật khẩu cũ!');
			return redirect(REDIRECTURL);
		}

		if ($newPass !== $rePass){
			setMessages('error', 'Mật khẩu xác nhận không khớp với mật khẩu!');
			return redirect(REDIRECTURL);
		}

		$result = $this->Mchangepassword->updatePassword($email, $newPass);
		if ($result > 0){
			setMessages('success', 'Đổi mật khẩu thành công!');
		}
		else{
			setMessages('warning', 'Có lỗi xảy ra. Vui lòng thử lại!');
		}
		return redirect(REDIRECTURL);
	}
}