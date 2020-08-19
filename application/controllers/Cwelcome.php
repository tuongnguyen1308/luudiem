<?php
/**
 * Created by PhpStorm.
 * User: Nguyễn Duy Thành
 * Date: 04/09/2019
 * Time: 03:18 CH
 */

class Cwelcome extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
    	// if (!checkTimeAccess()){
    	// 	setMessages('warning', 'Hiện không trong thời gian cập nhật hồ sơ ứng viên!');
        // }
        $data = array(
            'url'   => base_url(),
            'message' => getMessages(),
            'currentpage' => 'home',
            'csrf' => array(
                'name' => $this->security->get_csrf_token_name(),
                'hash' => $this->security->get_csrf_hash()
            )
        );
        $temp['data'] = $data;
        $temp['template'] = 'Vwelcome';
        $this->load->view('layouts/Vlayout', $temp);
    }
}