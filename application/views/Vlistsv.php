<div class="wrapper wrapper-content">

    <div class="row">

        <div class="col-lg-12 mb-3">
            <div class="card">
                <div class="card-header">
                    <form action="" method="POST" class="form-horizontal" enctype="multipart/form-data">
                        <div class="form-group mb-0 text-right" id="customFile" lang="vi">
                            <span class="float-left text-uppercase">Danh sách sinh viên</span>
                        </div>
                        <input type="hidden" name="{$csrf['name']}" value="{$csrf['hash']}" />
                    </form>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-12">
                            <form action="" method="POST" class="form-horizontal row" enctype="multipart/form-data">
                                <div class="form-group col-2 mb-0">
                                    <span>Bậc: </span>
                                    <select name="bac" id="bac" class="form-control mr-3">
                                        <option value="">--Chọn Bậc--</option>
                                        {foreach $listBac as $k => $v}
                                            <option {if isset($list_filter.FK_iMaBac) && $list_filter.FK_iMaBac == $v.PK_iMaBac} selected {/if} value="{$v.PK_iMaBac}">{$v.sTenBac}</option>
                                        {/foreach}
                                    </select>
                                </div>
                                <div class="form-group col-2 mb-0">
                                    <span>Hệ: </span>
                                    <select name="he" id="he" class="form-control mr-3">
                                        <option value="">--Chọn Hệ--</option>
                                        {foreach $listHe as $k => $v}
                                            <option {if isset($list_filter.FK_iMaHe) && $list_filter.FK_iMaHe == $v.PK_iMaHe} selected {/if} value="{$v.PK_iMaHe}">{$v.sTenHe}</option>
                                        {/foreach}
                                    </select>
                                </div>
                                <div class="form-group col-2 mb-0">
                                    <span>Ngành: </span>
                                    <select name="nganh" id="nganh" class="form-control mr-3">
                                        <option value="">--Chọn Ngành--</option>
                                        {foreach $listNganh as $k => $v}
                                            <option {if isset($list_filter.FK_iMaNganh) && $list_filter.FK_iMaNganh == $v.PK_iMaNganh} selected {/if} value="{$v.PK_iMaNganh}">{$v.sTenNganh}</option>
                                        {/foreach}
                                    </select>
                                </div>
                                <div class="form-group col-2 mb-0">
                                <span>Năm học: </span>
                                    <select name="namhoc" id="namhoc" class="form-control mr-3">
                                        <option value="">--Chọn Năm học--</option>
                                        {if $listNam}
                                        {foreach $listNam as $k => $v}
                                            <option {if isset($list_filter.sNam) && $list_filter.sNam == $v.sNam} selected {/if} value="{$v.sNam}">{$v.sNam}</option>
                                        {/foreach}
                                        {/if}
                                    </select>
                                </div>
                                <div class="form-group col-2 mb-0">
                                    <span>Khoa: </span>
                                    <select name="donvi" id="donvi" class="form-control mr-3">
                                        <option value="">--Chọn Khoa--</option>
                                        {if $listDonVi}
                                        {foreach $listDonVi as $k => $v}
                                            <option {if isset($list_filter.PK_iMaDVCTDT) && $list_filter.PK_iMaDVCTDT == $v.PK_iMaDVCTDT} selected {/if} value="{$v.PK_iMaDVCTDT}">{$v.sTenDonVi}</option>
                                        {/foreach}
                                        {/if}
                                    </select>
                                </div>
                                <div class="form-group col-2 mb-0">
                                    <span>Khoá học: </span>
                                    <select name="khoahoc" id="khoahoc" class="form-control mr-3">
                                        <option value="">--Chọn Khoá học--</option>
                                        {if $listKhoaHoc}
                                        {foreach $listKhoaHoc as $k => $v}
                                            <option {if isset($list_filter.PK_iMaKhoa) && $list_filter.PK_iMaKhoa == $v.PK_iMaKhoa} selected {/if} value="{$v.PK_iMaKhoa}">{$v.iKhoa}</option>
                                        {/foreach}
                                        {/if}
                                    </select>
                                </div>
                                <input type="hidden" name="{$csrf['name']}" value="{$csrf['hash']}" />
                                <div class="col-6 mt-3">
                                    <div class="form-inline">
                                        <label for="">Tìm kiếm sinh viên:</label>
                                        <input value="{$keyword}" type="text" class="form-control w-50 ml-2 mr-2" name="inp_keyword" placeholder="Nhập tên hoặc mã sinh viên">
                                        <button name="btn_search" value="1" class="btn btn-sm btn-primary" type="submit" id="btn_search">Tìm kiếm</button>
                                    </div>
                                </div>
                                <div class="col text-right mt-3 group_btn {if empty($list_filter)}d-none{/if}">
                                    {if !empty($list_filter)}<button name="btn_reset_filter" value="1" class="btn btn-sm mr-2 btn-danger" type="submit">Huỷ bộ lọc</button>{/if}
                                    <button name="btn_filter" value="1" class="btn btn-sm mr-2 btn-success" type="submit">Lọc</button>
                                    <button name="btn_export_word" value="1" class="btn btn-sm mr-2 btn-primary" type="submit">Xuất word theo bộ lọc</button>
                                    <button name="btn_delete" value="1" class="btn btn-sm mr-2 btn-danger" type="submit" onclick="return confirm('Xác nhận xoá?')">Xoá các sinh viên theo bộ lọc</button>
                                    <button name="btn_export" value="1" class="btn btn-sm btn-primary" type="submit">Xuất file excel theo bộ lọc</button>
                                </div>
                            </form>
                        </div>
                    </div>
					<div class="mb-2 float-left">Danh sách sinh viên: </div>
                    <div class="form-group float-right">
						<!-- <form method="post" action="">
							<input type="hidden" name="{$csrf['name']}" value="{$csrf['hash']}" />
							<button name="delAllSV" value="1" type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Xoá toàn bộ sinh viên?');">Xoá toàn bộ sinh viên</button>
						</form> -->
                    </div>
                    <table id="tbl" class="table table-striped table-inverse table-bordered">
                        <thead>
                            <tr>
                                <th class="text-center" width="5%">STT</th>
                                <th class="text-center" width="8%">Khoá</th>
                                <th class="text-center" width="10%">Lớp</th>
                                <th class="text-center" width="10%">Mã SV</th>
                                <th class="text-center" width="35%">Họ và Tên</th>
                                <th class="text-center" width="10%">Ngày sinh</th>
                                <th class="text-center" width="7%">Giới</th>
                                <!-- <th class="text-center" width="11%">In mẫu</th> -->
                                <th class="text-center" width="15%">Tác vụ</th>
                            </tr>
                        </thead>
                        <tbody id="tbody">
                            {if !empty($DSSV)}
                                {foreach $DSSV as $key => $value}
                                <tr>
                                    <td class="text-center">{($present_page-1)*10 + $key+1}</td>
                                    <td class="text-center">{$value.iKhoa}</td>
                                    <td class="">{$value.sTenLop}</td>
                                    <td class="">{$value.PK_iMaSV}</td>
                                    <td class="">{$value.sHo} {$value.sTen}</td>
                                    <td class="text-center">{date('d/m/Y', strtotime($value.dNgaySinh))}</td>
                                    <td class="">{$value.sGioiTinh}</td>
                                    <td class="text-center">
										<form action="" method="post">
                                            <a target="_blank" href="{$url}inbangdiem?masv={$value.PK_iMaNhapHoc}&d_f_w=true">
                                                <button class="btn btn-success btn-sm" type="button">
                                                    <i class="fa fa-download" aria-hidden="true" title="Tải file word"></i>
                                                </button>
                                            </a>
                                            <a target="_blank" href="{$url}inbangdiem?masv={$value.PK_iMaNhapHoc}">
                                                <button class="btn btn-primary btn-sm" type="button">
                                                    <i class="fa fa-eye" aria-hidden="true" title="Xem điểm"></i>
                                                </button>
                                            </a>
											<input type="hidden" name="{$csrf['name']}" value="{$csrf['hash']}" />
                                            <input type="hidden" name="sv[PK_iMaSV]" value="{$value.PK_iMaSV}">
                                            <input type="hidden" name="sv[PK_iMaSVLop]" value="{$value.PK_iMaSVLop}">
                                            <input type="hidden" name="sv[PK_iMaNhapHoc]" value="{$value.PK_iMaNhapHoc}">
											<button class="btn btn-sm btn-danger" type="submit" title="Xoá" value="{$value.PK_iMaNhapHoc}" name="delSV" onclick="return confirm('Bạn chắc chắn muốn xóa?')">
												<i class="fa fa-trash" aria-hidden="true" title="Xoá"></i>
											</button>
										</form>
                                    </td>
                                    
                                </tr>
                                {/foreach}
                                {else}
                                <tr>
                                    <td colspan="8" class="text-center">
                                    <i>Chưa có sinh viên nào</i>
                                    </td>
                                </tr>
                                {/if}
                        </tbody>
                    </table>
                    {if $countPage > 0}
                    <nav class="float-left"> Hiển thị {count($DSSV)}/{$countSV} sinh viên</nav>
					<nav class="float-right">
						<ul class="pagination mb-0">
							<li class="page-item m-1 mr-3">Trang {$present_page}/{$countPage}</li>
							<li class="page-item {if $present_page == 1}disabled{/if}"><a class="page-link" href="{$url}listsv?page={$present_page-1}{if !empty($filter)}&filter=1{/if}">Trước</a></li>
							{for $i=1 to $countPage}
                                {if $i <= $present_page+3 && $i >= $present_page-3}
								<li class="page-item {if $present_page == $i}active{/if}"><a class="page-link" href="{$url}listsv?page={$i}{if !empty($filter)}&filter=1{/if}">{$i}</a></li>
                                {/if}
							{/for}
							<li class="page-item {if $present_page >= $countPage}disabled{/if}"><a class="page-link" href="{$url}listsv?page={$present_page+1}{if !empty($filter)}&filter=1{/if}">Sau</a></li>
						</ul>
					</nav>
                    {/if}
                </div>
            </div>
        </div>
    </div>
</div>

<style type="text/css">

    .container{
        padding: 0px !important;
    }
    .custom-file-input ~ .custom-file-label::after {
        content: "Chọn";
    }
    .welcome-text{
        font-size: 40px;
        margin-top: 10px;
    }
    .feature{
        background-color: #ddd;
        width: 100%;
        height: 3cm;
        margin: 5px;
        padding: 25px;
        color: #fff;
        font-weight: bold;
        text-align: center;
        display: table;
    }
    .nameFeature{
        display: table-cell;
        vertical-align: middle;
    }
    @media screen and (max-width: 768px){
        .welcome-text{
            font-size: 30px;
            margin-top: 10px;
            padding-left: 15px;
            padding-right: 15px;
        }
    }
    @media screen and (max-width: 425px){
        .welcome-text{
            font-size: 25px;
            margin-top: 10px;
            padding-left: 10px;
            padding-right: 10px;
        }
    }
</style>
<script src="{$url}assets/plugins/js/vlistsv.js"></script>
