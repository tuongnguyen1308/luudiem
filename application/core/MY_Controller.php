<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
class MY_Controller extends CI_Controller
{
	protected $_session;

	public function __construct()
    {
		parent::__construct();
        if (isset($this->session->userdata['user'])) {
            $this->_session = $this->session->userdata['user'];

            // Không có session, đá về trang đăng nhập
            if(!isset($this->_session) || empty($this->_session))
            {
                redirect(base_url());
                exit();
            }

            $currentRoute = str_replace(base_url(), '', current_url());
            // if (!checkPermission($this->_session['maQuyen'], $currentRoute)){
            //     setMessages('error', 'Bạn không có quyền truy cập chức năng này!');
            //     redirect('welcome');
            //     exit();
            // }
        }
        else{
            redirect(base_url());
            exit();
        }
	}
} // End class