<?php

class Cregister extends CI_Controller
{
	public $Mregister;

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Mregister', 'Mregister');
		$this->Mregister = new Mregister();
	}

	public function index()
	{
		$this->checkIssetSession();
		if ($this->input->post('register')) {
			$this->registerAccount();
		}

		$data['account'] = $this->session->flashdata('account');
		$data['url'] = base_url();
		$data['message'] = getMessages();
		$data['csrf'] = array(
			'name' => $this->security->get_csrf_token_name(),
			'hash' => $this->security->get_csrf_hash()
		);
		$this->parser->parse('Vregister', $data);
	}

	/**
	 * Kiểm tra nếu đã tồn tại session thì cho đưa vào welcome luôn
	 */
	public function checkIssetSession()
	{
		$session = getSession();
		if (isset($session) && !empty($session)) {
			$checkAccount = $this->Mregister->checkAccount($session['username']);
			$this->session->set_userdata('user', $session);
			return redirect('welcome');
		}
	}

	public function registerAccount()
	{
		$email = strtolower($this->input->post('email'));
		$pass = $this->input->post('pass');
		$repass = $this->input->post('repass');
		if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
			setMessages('error', 'Email không đúng định dạng. Vui lòng thử lại!');
			return redirect('register');
		}
		else{
			$check = $this->Mregister->checkIssetAccount($email);
			if ($check){
				setMessages('error', 'Email đã đăng ký với hệ thống. Vui lòng thử lại!');
				return redirect('register');
			}

			if ($pass !== $repass){
				setMessages('error', 'Mật khẩu và mật khẩu nhập lại không khớp!');
				return redirect('register');
			}

			$maUV = time().rand(1000,9999);
			$arr_TaiKhoan = array(
				'PK_iMaTK'	=> $maUV,
				'sUsername'	=> $email,
				'sPassword'	=> sha1($pass)
			);

			$result = $this->Mregister->insertAccount($arr_TaiKhoan);
			if ($result){
				setMessages('success', 'Đăng ký tài khoản thành công. Vui lòng đăng nhập vào hệ thống!');
				$this->session->set_flashdata('account', $email);
				return redirect(base_url());
			}
		}
		setMessages('error', 'Có lỗi xảy ra. Vui lòng thử lại!');
		return redirect('register');
	}
}