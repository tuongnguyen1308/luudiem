<?php

class Clogin extends CI_Controller
{
	public $Mlogin;

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Mlogin', 'Mlogin');
		$this->Mlogin = new Mlogin();
	}

	public function index()
	{
		$this->checkIssetSession();
		if ($this->input->post('login')) {
			$this->checkLogin();
		}

		$data['account'] = $this->session->flashdata('account');
		$data['url'] = base_url();
		$data['message'] = getMessages();
		$data['csrf'] = array(
			'name' => $this->security->get_csrf_token_name(),
			'hash' => $this->security->get_csrf_hash()
		);
		$this->parser->parse('Vlogin', $data);
	}

	/**
	 * Kiểm tra nếu đã tồn tại session thì cho đưa vào welcome luôn
	 */
	public function checkIssetSession()
	{
		$session = getSession();
		if (isset($session) && !empty($session)) {
			$checkAccount = $this->Mlogin->checkAccount($session['username']);
			$this->session->set_userdata('user', $session);
			return redirect('welcome');
		}
	}

	public function checkLogin()
	{
		$username = $this->input->post('username');
		$password = $this->input->post('password');

		$account = $this->Mlogin->getAccount($username, $password);

		if (!empty($account)) {
			if (strtolower($username)==strtolower($account['sUsername']) && sha1($password)==$account['sPassword']) {
				$session = array(
					'username' 	=> $account['sUsername'],
					'ma' 		=> $account['PK_iMaTK'],
					'hoTen' 	=> $account['sHoTen'],
					'chucdanh' 	=> $account['sChucDanh'],
					'nganh' 	=> $account['sNganh'],
					'chuyennganh'=> $account['sChuyenNganh']
				);
				$this->session->set_userdata('user', $session);
				setMessages('success', 'Đăng nhập hệ thống thành công');
				if($account['sMaQuyen']==1)
				{
					return redirect('admin');
				}
				return redirect('welcome');
			}
		}
		$this->session->set_flashdata('account', $username);
		setMessages('error', 'Tên tài khoản hoặc mật khẩu không chính xác. Vui lòng thử lại!');
		return redirect(base_url());
	}

	public function logout()
	{
		$this->session->unset_userdata('user');
		$this->session->sess_destroy();
		redirect(base_url());
		exit();
	}
}