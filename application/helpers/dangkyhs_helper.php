<?php
/**
 * Created by PhpStorm.
 * User: Nguyễn Duy Thành
 * Date: 01/09/2019
 * Time: 08:49 SA
 */


if(!function_exists('pr'))
{
    /**
     * @param $data
     */
    function pr($data) {
        echo "<pre>";
        print_r ($data);
        echo "</pre>";
        exit();
    }
}

if (!function_exists('getSession')){
    function getSession($name = 'user'){
        $CI =& get_instance();
        return $CI->session->userdata($name);
    }
}

if (!function_exists('getSegment')){
    function getSegment(){
        $CI =& get_instance();
        return $CI->uri->segment(1);
    }
}

if(! function_exists('notification'))
{
    function setMessages($toastType = "", $message = "", $title = "") {
        $CI =& get_instance();
        $dataMessage = array(
            'type' => $toastType,
            'title' => $title,
            'message' => $message
        );
        $CI->session->set_flashdata('notification', $dataMessage);
    }
}


if(!function_exists('notification'))
{
    function getMessages() {
        $CI =& get_instance();
        return $CI->session->flashdata('notification');
    }
}

if (!function_exists('checkPermission')){
    function checkPermission($userLevel, $route){
        $CI =& get_instance();
        $CI->load->model('Mlogin', 'Mlogin');
        return $CI->Mlogin->checkPermission($userLevel, $route);
    }
}

if (!function_exists('checkTimeAccess')){
    function checkTimeAccess(){
        $CI =& get_instance();
        $CI->load->model('hethong/Mdangky', 'Mdangky');
        return $CI->Mdangky->checkTimeAccess();
    }
}

if (!function_exists('getMenu')){
    function getMenu($maQuyen){
        $CI =& get_instance();
        $CI->load->model('MY_Model', 'model');
        $myMenu = $CI->model->getMenu($maQuyen);
        return $myMenu;
    }
}

if (!function_exists('getListMinhChung')){
    function getListMinhChung($namePrimary, $valuePrimary, $table)
    {
        $CI =& get_instance();
        $CI->load->model('hethong/Mhethong', 'Mhethong');
        return $CI->Mhethong->getListMinhChung($namePrimary, $valuePrimary, $table);
    }
}

if (!function_exists('deleteOneFileMinhChung')){
    function deleteOneFileMinhChung($maMC, $namePrimary, $valuePrimary, $table, $indexDelete)
    {
        $CI =& get_instance();
        $CI->load->model('hethong/Mhethong', 'Mhethong');
        $session = getSession();

        if (empty($session)){
            exit();
        }

        $listFileBefore = getListMinhChung($namePrimary, $valuePrimary, $table);

        $arrFile = explode("|", $listFileBefore['sFile']);
        $arrName = explode("|", $listFileBefore['sTenTaiLen']);

        $filename = $arrFile[$indexDelete];
        $resultDelete = unlink('assets/minhchung/'.$session['maUV'].'/'.$maMC.'/'.$filename);

        if ($resultDelete){
            unset($arrFile[$indexDelete]);
            unset($arrName[$indexDelete]);

            $stringNameInServer = implode("|", $arrFile);
            $stringNameUpload = implode("|", $arrName);

            $arrUpdate['sFile'] = $stringNameInServer;
            $arrUpdate['sTenTaiLen'] = $stringNameUpload;
            $resultUpdate = $CI->Mhethong->updateFileMinhChung($namePrimary, $valuePrimary, $table, $arrUpdate);
            return true;
        }
        else{
            return false;
        }
    }
}

if (!function_exists('uploadMinhChung')){
    function uploadMinhChung($maMC, $namePrimary, $valuePrimary, $table)
    {
        $CI =& get_instance();
        $CI->load->model('hethong/Mhethong', 'Mhethong');
        $session = getSession();

        if (empty($session)){
            exit();
        }

        $accessFileTypes = array(
            'doc', 'docx', 'pdf',
            'zip', 'rar',
            'jpg', 'png'
        );

        if (!is_dir('assets/minhchung/'.$session['maUV'].'/'.$maMC))
        {
            mkdir('assets/minhchung/'.$session['maUV'].'/'.$maMC, 0755, true);
        }

        $config['upload_path']  = 'assets/minhchung/'.$session['maUV'].'/'.$maMC.'/';
        $config['allowed_types'] = '*';
        $config['overwrite'] = true;
        $config['max_size'] = '1000000';
        $CI->load->library('upload', $config);

        $listFileBefore = getListMinhChung($namePrimary, $valuePrimary, $table);

        $arrNameInServer = array();
        $arrNameUpload = array();
        //Ko tải file lên nhưng có file từ trước trả về true
        if (count($_FILES[$maMC]['name']) == 1 && $_FILES[$maMC]['size'][0] <= 0 && !empty($listFileBefore)){
            return true;
        }

        if (!empty($_FILES[$maMC]['name'])){
            foreach ($_FILES[$maMC]['name'] as $key => $filename) {
                if (($_FILES[$maMC]['size'][$key] <= 0)){
                    continue;
                }

                $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
                if (!in_array($ext, $accessFileTypes)){
                    setMessages('error', 'Định dạng file không hợp lệ. Hệ thống chỉ chấp nhận file dạng .pdf .doc .docx .zip .rar .jpg .png');
                    return redirect(current_url());
                }

                $_FILES['file'.$key] = array(
                    'name'      => $session['maUV'].'_'.$maMC.'_'.time().'_'.$key.'.'.$ext,
                    'type'      => $_FILES[$maMC]['type'][$key],
                    'tmp_name'  => $_FILES[$maMC]['tmp_name'][$key],
                    'error'     => $_FILES[$maMC]['error'][$key],
                    'size'      => $_FILES[$maMC]['size'][$key]
                );

                if ($CI->upload->do_upload('file'.$key)){
                    $uploadData = $CI->upload->data();
                    $arrNameInServer[] = $uploadData['file_name'];
                    $arrNameUpload[] = $filename;
                }
            }
        }

        if (!empty($arrNameInServer)){
            $stringNameInServer = implode("|", $arrNameInServer);
            $stringNameUpload = implode("|", $arrNameUpload);

            if (!empty($listFileBefore)){
                $arrUpdate['sFile'] = trim($listFileBefore['sFile'].'|'.$stringNameInServer, '|');
                $arrUpdate['sTenTaiLen'] = trim($listFileBefore['sTenTaiLen'].'|'.$stringNameUpload, '|');
                $arrUpdate['sThoiGianTaiLen'] = date('d/m/Y H:i');
                $resultUpload = $CI->Mhethong->updateFileMinhChung($namePrimary, $valuePrimary, $table, $arrUpdate);
            }
            else{
                $arrInsert = array(
                    $namePrimary        => $valuePrimary,
                    'PK_sMaMC'          => $maMC,
                    'sFile'             => $stringNameInServer,
                    'sTenTaiLen'        => $stringNameUpload,
                    'sThoiGianTaiLen'   => date('d/m/Y H:i')
                );
                $resultUpload = $CI->Mhethong->insertFileMinhChung($table, $arrInsert);
            }

            if ($resultUpload > 0){
                return true;
            }
            else{
                return false;
            }
        }
        else{
            if (empty($listFileBefore)){
                setMessages('error', 'Vui lòng chọn file minh chứng để tải lên');
                return redirect(current_url());
            }
        }
    }
}

if (!function_exists('seotag')){
    /*
    * $valueReturn return value day or month or year
    * $dateString date with format dd/mm/yyyy
    * default return date with format yyyy-mm-dd
    */
    function dateconvert($valueReturn = '', $dateString = '01/01/1970')
    {
        $dateSplit = explode("-", $dateString);
        $day = $dateSplit[2];
        $month = $dateSplit[1];
        $year = $dateSplit[0];
        switch ($valueReturn) {
            case 'd':
                return $day;
            case 'm':
                return $month;
            case 'y':
                return $year;
            case 'Y':
                return $year;
            default:
                return $year.'-'.$month.'-'.$day;
        }
    }
}

if (!function_exists('seotag')){
    function seotag($str)
    {
        $str = trim($str);
        $str = preg_replace("/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/", 'a', $str);
        $str = preg_replace("/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/", 'e', $str);
        $str = preg_replace("/(ì|í|ị|ỉ|ĩ)/", 'i', $str);
        $str = preg_replace("/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/", 'o', $str);
        $str = preg_replace("/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/", 'u', $str);
        $str = preg_replace("/(ỳ|ý|ỵ|ỷ|ỹ)/", 'y', $str);
        $str = preg_replace("/(đ)/", 'd', $str);    
        $str = html_entity_decode ($str);
        $str = str_replace(array(' ','_'), '-', $str); 
        $str = html_entity_decode ($str);
        $str = str_replace("ç","c",$str);
        $str = str_replace("Ç","C",$str);
        $str = str_replace(" / ","-",$str);
        $str = str_replace("/","-",$str);
        $str = str_replace(" - ","-",$str);
        // $str = str_replace("_","-",$str);
        $str = str_replace(" ","_",$str);
        $str = str_replace("ß", "ss", $str);
        $str = str_replace("&", "", $str);
        $str = str_replace("%", "percent", $str);
        $str = str_replace("----","-",$str);
        $str = str_replace("---","-",$str);
        $str = str_replace("--","-",$str);
        $str = str_replace(",","",$str);
        $str = str_replace("(","",$str);
        $str = str_replace(")","",$str);
        // In hoa
        $str = preg_replace("/(À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ)/", 'A', $str);
        $str = preg_replace("/(È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ)/", 'E', $str);
        $str = preg_replace("/(Ì|Í|Ị|Ỉ|Ĩ)/", 'I', $str);
        $str = preg_replace("/(Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ)/", 'O', $str);
        $str = preg_replace("/(Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ)/", 'U', $str);
        $str = preg_replace("/(Ỳ|Ý|Ỵ|Ỷ|Ỹ)/", 'Y', $str);
        $str = preg_replace("/(Đ)/", 'D', $str);
        $str = strtolower($str);

        return $str; // Trả về chuỗi đã chuyển
    } // End seotag
}

function adddotstring($strNum) {
   $len = strlen($strNum);
   $counter = 3;
   $result = "";
   while ($len - $counter >= 0)
   {
       $con = substr($strNum, $len - $counter , 3);
       $result = ','.$con.$result;
       $counter+= 3;
   }
   $con = substr($strNum, 0 , 3 - ($counter - $len) );
   $result = $con.$result;
   if(substr($result,0,1)==','){
       $result=substr($result,1,$len+1);
   }
   return $result;
    //return $strNum;
}

function numberToRoman($number) {
    $map = array('M' => 1000, 'CM' => 900, 'D' => 500, 'CD' => 400, 'C' => 100, 'XC' => 90, 'L' => 50, 'XL' => 40, 'X' => 10, 'IX' => 9, 'V' => 5, 'IV' => 4, 'I' => 1);
    $returnValue = '';
    while ($number > 0) {
        foreach ($map as $roman => $int) {
            if($number >= $int) {
                $number -= $int;
                $returnValue .= $roman;
                break;
            }
        }
    }
    return $returnValue;
}

#get user ip
function get_client_ip_env() {
    $ipaddress = '';
    if (getenv('HTTP_CLIENT_IP'))
        $ipaddress = getenv('HTTP_CLIENT_IP');
    else if(getenv('HTTP_X_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
    else if(getenv('HTTP_X_FORWARDED'))
        $ipaddress = getenv('HTTP_X_FORWARDED');
    else if(getenv('HTTP_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_FORWARDED_FOR');
    else if(getenv('HTTP_FORWARDED'))
        $ipaddress = getenv('HTTP_FORWARDED');
    else if(getenv('REMOTE_ADDR'))
        $ipaddress = getenv('REMOTE_ADDR');
    else
        $ipaddress = 'UNKNOWN';

    return $ipaddress;
}


function unique_filename_upload($filename)
{
    return date('d-m-Y', time()) . '__' . date('H-i-s', time()) . '__' . $filename;
}
function setDuoianh($ten)
{
    $st='';

    for($i=strlen($ten)-1; $i>1 ; $i--){
        $st=$st.$ten[$i];

        if($ten[$i]=='.'){
            break;
        }
    }
    // $mangfile['duoi'] = $s;
    // $mangfile['ten'] = substr($ten,0,$i);
    // return $mangfile;
    $st=strrev($st);
    return $st;
}

function getMangFile($mang,$name)
{
    $s='';
    $mangfile = array();
    for ($j=2; $j < count($mang); $j++) {
        $ten = $mang[$j];
        for($i=strlen($ten)-1; $i>0 ; $i--){
            $s=$s.$ten[$i];

            if($ten[$i]=='.'){
                break;
            }
        }
        $namefile = substr($ten,0,$i);
        $mangfile[] = $namefile;
    }
    return $mangfile;
}