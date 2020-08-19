<?php

class Ctonghop extends MY_Controller
{
    public $Mtonghop;
    public $id = '';
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Mtonghop', 'Mtonghop');
        $this->Mtonghop = new Mtonghop();
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
        $data = array(
            'url'           => base_url(),
            'message'       => getMessages(),
            'currentpage'   => 'tonghop',
            'tonghopketqua'			=> $this->Mtonghop->getTongHop($maungvien),
            'id'					=> $maungvien,
            'csrf'          => array(
                'name' => $this->security->get_csrf_token_name(),
                'hash' => $this->security->get_csrf_hash()
            )
        );
        //pr($data['gettonghop']);
        $temp['data'] = $data;
        $temp['template'] = 'Vtonghop';
        $this->load->view('td_layouts/Vlayout', $temp);
        if ($this->input->post('addTongHop')) {
            $submit = $this->input->post('addTongHop');
            $insert_item = $data['tonghopketqua'];
            $existedData = !empty($data['tonghopketqua']);
            $insert_item['PK_iMaTongHop'] = $existedData ? $insert_item['PK_iMaTongHop'] : time().rand(1000,9999);
            $insert_item['FK_iMaUV'] = $maungvien;
                    $insert_item['iSoDiemSach']		= $this->input->post('iSoDiemSach');
                    $insert_item['iSoDiemSach3']		= $this->input->post('iSoDiemSach3');
                    $insert_item['iSoDiemConLai']	= $this->input->post('iSoDiemConLai');
                    $insert_item['iSoDiemConLai3']	= $this->input->post('iSoDiemConLai3');
                    $insert_item['iDiemTongCong']	= $this->input->post('iDiemTongCong');
                    $insert_item['iDiemTongCong3']	= $this->input->post('iDiemTongCong3');
                    $insert_item['iTongCongSauPGS'] = $this->input->post('iTongCongSauPGS');
                    $insert_item['sNamThieuPGS'] = $this->input->post('sNamThieuPGS');
                    $insert_item['sNamThieuTNDT'] = $this->input->post('sNamThieuTNDT');
                    $insert_item['sGioGiangDayTrucTiep'] = $this->input->post('sGioGiangDayTrucTiep');
                    $insert_item['sGioChuanKhongDu'] = $this->input->post('sGioChuanKhongDu');
                    $insert_item['sHuongDanNCS'] = $this->input->post('sHuongDanNCS') == 'on' ? 'checked' : '';
                    $insert_item['sHuongDanHVCH'] = $this->input->post('sHuongDanHVCH') == 'on' ? 'checked' : '';
                    $insert_item['sThayTheHDNCS'] = $this->input->post('sThayTheHDNCS');
                    $insert_item['sThayTheHDHVCH'] = $this->input->post('sThayTheHDHVCH');

                    $insert_item['sChuTriNVB'] = $this->input->post('sChuTriNVB') == 'on' ? 'checked' : '';
                    $insert_item['sChuTriNVCS'] = $this->input->post('sChuTriNVCS') == 'on' ? 'checked' : '';
                    $insert_item['sThayTheChuTriNVB'] = $this->input->post('sThayTheChuTriNVB');
                    $insert_item['sThayTheChuTriNVCS'] = $this->input->post('sThayTheChuTriNVCS');

                    $insert_item['iCTKH3']			= $this->input->post('iCTKH3') == 'on' ? 'checked' : '';
                    $insert_item['iCTKH4']			= $this->input->post('iCTKH4') == 'on' ? 'checked' : '';
                    $insert_item['sThayTheCTKH5']	= $this->input->post('sThayTheCTKH5');
                    $insert_item['iCTKH2']			= $this->input->post('iCTKH2') == 'on' ? 'checked' : '';
                    $insert_item['sThayTheCTKH3']	= $this->input->post('sThayTheCTKH3');
                    
                    $insert_item['sTongDiemBienSoanSach'] = $this->input->post('sTongDiemBienSoanSach');
                    $insert_item['sTongDiemBienSoanSachThieu'] = $this->input->post('sTongDiemBienSoanSachThieu');
                    
                    $insert_item['sSoDiemBienSoanGTCK'] = $this->input->post('sSoDiemBienSoanGTCK');
                    $insert_item['sSoDiemBienSoanGTCKThieu'] = $this->input->post('sSoDiemBienSoanGTCKThieu');


            foreach ($insert_item as $key => $value) {
                if (is_array($value)) {
                    $insert_item[$key] = implode('|', $value);
                }
            }
            if($existedData) {
                $res = $this->Mtonghop->updateTongHop($insert_item);
            }
            else {
                $res = $this->Mtonghop->insertTongHop($insert_item);
            }
            setMessages($res?'success':'error',$res?'Lưu thành công':'Lưu thất bại');
            redirect(current_url().'?id='.$this->id);
        }
    }
}