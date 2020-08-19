<?php
/**
 * Created by PhpStorm.
 * User: Nguyễn Duy Thành
 * Date: 03/09/2019
 * Time: 03:59 CH
 */

class MY_Model extends CI_Model
{
	public function getAll($table)
	{
		return $this->db->get($table)->result_array();
	}

	public function getAllOrder($table, $col, $order)
	{
		$this->db->order_by($col, $order);
		return $this->db->get($table)->result_array();
	}

	public function getWhere($table, $colWhere, $valueCompare)
	{
		$this->db->where($colWhere, $valueCompare);
		return $this->db->get($table)->result_array();
	}

    public function getWherePrimary($table, $colWhere, $valueCompare)
    {
        $this->db->where($colWhere, $valueCompare);
        return $this->db->get($table)->row_array();
    }

	public function getMenu($maQuyen)
	{
		$this->db->where('iSTT is NOT NULL');
		$this->db->where('PK_iMaQuyen', $maQuyen);
		$this->db->join('tbl_chucnang_quyen', 'tbl_chucnang_quyen.PK_iMaChucNang = tbl_chucnang.PK_iMaChucNang');
		$this->db->order_by('iSTT', 'asc');
		$chucNang = $this->db->get('tbl_chucnang')->result_array();

		$arrNhomChucNang = $this->db->get('dm_nhomchucnang')->result_array();
		foreach ($arrNhomChucNang as $k => $v){
			$nhomChucNang[$v['PK_iNhomCN']] = $v;
		}

		$myMenu = array();
		foreach ($chucNang as $k => $v){
			if (!empty($v['FK_iNhomCN'])){
				if (!isset($myMenu[$v['FK_iNhomCN']])) {
					$myMenu[$v['FK_iNhomCN']] = $nhomChucNang[$v['FK_iNhomCN']];
				}
				$myMenu[$v['FK_iNhomCN']]['chucNang'][] = $v;
			}
			else{
				$myMenu[$v['sUrl']] = $v;
			}
		}
		return $myMenu;
	}
	
	public function getToken($maUV)
	{
		$this->db->where('FK_iMaUV', $maUV);
		$this->db->select('sThoiGianDangKy, sLanDangNhapCuoi');
		return $this->db->get('tbl_taikhoan')->row_array();
	}
}