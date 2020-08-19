<?php


class CthamdinhCTDT extends MY_Controller
{
    public $id = '';
    public $MmucCTDT;
    public function __construct()
    {
        parent::__construct();
        $this->load->model('MmucCTDT', 'MmucCTDT');
        $this->MmucCTDT = new MmucCTDT();
    }

    public function index()
    {
        if($this->input->post('thamdinh'))
        {
          $this->updateCTDT();
        }
        $data = array(
            'url'   => base_url(),
            'message' => getMessages(),
            'currentpage' => 'ctdt',
            'id' => $this->input->get('id'),
            'csrf' => array(
                'name' => $this->security->get_csrf_token_name(),
                'hash' => $this->security->get_csrf_hash()
            ),
            'thamdinh' => $this->MmucCTDT->getThamDinh($this->input->get('id')),
        );
        $temp['data'] = $data;
        $temp['template'] = 'VCTDT';
        $this->load->view('td_layouts/Vlayout', $temp);
    }
    public function updateCTDT()
    {
        $data = $this->input->post('data');
        $res = $this->MmucCTDT->updateThamDinh($data,$this->input->get('id'));
        setMessages($res?'success':'error',$res?'Lưu thành công':'Lưu thất bại');
        redirect(current_url().'?id='.$this->input->get('id'));
    }
}