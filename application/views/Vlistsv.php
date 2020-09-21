<div class="wrapper wrapper-content">
    <form action="" method="post">
        <input type="hidden" name="{$csrf['name']}" value="{$csrf['hash']}" />
        <h3 class="badge badge-warning text-dark p-2 w-100" style="font-size: 16px !important;"><button type="button" class="btn btn-outline p-0" style="color:#000;font-family:'arial' !important;" disabled>Yêu cầu: Điền đầy đủ các giá trị trong file excel! Xem mẫu tại </button> <button name="download_demo" value="1" class="btn btn-outline font-weight-bold p-0" type="submit">đây!</button></h3>
    </form>
    <div class="row">
		<!-- Thêm file excel -->
        <div class="col-lg-12 mb-2">
            <div class="card">
                <div class="card-header">
                    <form action="" method="POST" class="form-horizontal" enctype="multipart/form-data">
                        <div class="form-group mb-0 text-right" id="customFile" lang="vi">
                            <span class="float-left text-uppercase mt-1">Thêm file excel</span>
                            <div class="float-right">
                                <input id="fileExcel" type="file" name="importExcel" multiple accept=".xlsx, .xls" required>
								<button type="button" id="btn_preview" class="btn btn-sm btn-success mr-2">Xem trước file excel</button>
                                <button name="submitImport" id="submitImport" value="1" type="submit" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Đang lưu" class="btn btn-sm btn-primary mr-2">Lưu bảng Excel vào hệ thống</button>
                            </div>
                        </div>
                        <input type="hidden" name="{$csrf['name']}" value="{$csrf['hash']}" />
                    </form>
                </div>
                <div id="card-body" class="card-body d-none">
                        <div class="float-left">
							<div class="form-inline">
								<div id="prv_bac" class="mr-3"></div>
								<div id="prv_he" class="mr-3"></div>
								<div id="prv_nganh" class="mr-3"></div>
								<div id="prv_namhoc" class="mr-3"></div>
								<div id="prv_khoa" class="mr-3"></div>
								<div id="prv_khoahoc" class="mr-3"></div>
							</div>
                        </div>
						<div class="float-right mb-3">
							<button name="undo_preview_excel" id="undo_preview_excel" value="1" type="button" class="btn btn-sm btn-warning">Huỷ</button>
						</div>
                    <table id="excel_preview" class="table table-striped table-inverse table-bordered" style="display: block; overflow: auto; overflow-x: auto; overflow-y: auto;white-space: nowrap;">
                    </table>
                </div>
            </div>
        </div>

		<!-- Xuất file excel -->
        <div class="col-lg-12 mb-2">
            <div class="card">
                <div class="card-header">
					<span class="float-left text-uppercase mt-1">Xuất file excel</span>
                </div>
                <div class="card-body">
					<form action="" method="POST" class="form-horizontal" enctype="multipart/form-data">
						<div class="form-inline mb-3">
							<span>Chọn Bậc: </span>
							<select name="bac" id="bac" class="form-control mr-3" required>
								<option value="">--Chọn Bậc--</option>
								{foreach $listBac as $k => $v}
									<option value="{$v.PK_iMaBac}">{$v.sTenBac}</option>
								{/foreach}
							</select>
							<span>Chọn Hệ: </span>
							<select name="he" id="he" class="form-control mr-3" required>
								<option value="">--Chọn Hệ--</option>
								{foreach $listHe as $k => $v}
									<option value="{$v.PK_iMaHe}">{$v.sTenHe}</option>
								{/foreach}
							</select>
							<span>Chọn Ngành: </span>
							<select name="nganh" id="nganh" class="form-control mr-3" required>
								<option value="">--Chọn Ngành--</option>
								{foreach $listNganh as $k => $v}
									<option value="{$v.PK_iMaNganh}">{$v.sTenNganh}</option>
								{/foreach}
							</select>
							<span>Chọn Năm học: </span>
							<select name="namhoc" id="namhoc" class="form-control mr-3" required>
								<option value="">--Chọn Năm học--</option>
								<!-- ajax -->
							</select>
						</div>
						<div class="form-inline">
							<span>Chọn Khoa: </span>
							<select name="donvi" id="donvi" class="form-control mr-3" required>
								<option value="">--Chọn Khoa--</option>
							</select>
							<span>Chọn Khoá học: </span>
							<select name="khoahoc" id="khoahoc" class="form-control mr-3" required>
								<option value="">--Chọn Khoá học--</option>
							</select>
							<input type="hidden" name="{$csrf['name']}" value="{$csrf['hash']}" />
							<button name="export" value="1" class="btn btn-sm btn-success" type="submit">Xuất file Excel</button>
						</div>
					</form>

                </div>
            </div>
        </div>

        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <form action="" method="POST" class="form-horizontal" enctype="multipart/form-data">
                        <div class="form-group mb-0 text-right" id="customFile" lang="vi">
                            <span class="float-left text-uppercase">Danh sách sinh viên</span>
                            <!-- <div class="float-right">
                                <span>Thêm file Excel: </span>
                                <input type="file" name="importExcel" class="" multiple accept=".xlsx, .xls" required>
                                <button name="submitImport" id="submitImport" value="1" type="submit" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Đang lưu" class="btn btn-sm btn-primary mr-2">Nhập file Excel</button>
                            </div> -->
                        </div>
                        <input type="hidden" name="{$csrf['name']}" value="{$csrf['hash']}" />
                    </form>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-12">
                            <div class="mb-2">Lọc theo chương trình đào tạo: </div>
                            <form action="" method="POST" class="form-horizontal" enctype="multipart/form-data">
                                <div class="form-inline mb-3">
                                    <span>Bậc: </span>
                                    <select name="bac" id="bac" class="form-control mr-3" required>
                                        <option value="">--Chọn Bậc--</option>
                                        {foreach $listBac as $k => $v}
                                            <option value="{$v.PK_iMaBac}">{$v.sTenBac}</option>
                                        {/foreach}
                                    </select>
                                    <span>Hệ: </span>
                                    <select name="he" id="he" class="form-control mr-3" required>
                                        <option value="">--Chọn Hệ--</option>
                                        {foreach $listHe as $k => $v}
                                            <option value="{$v.PK_iMaHe}">{$v.sTenHe}</option>
                                        {/foreach}
                                    </select>
                                    <span>Ngành: </span>
                                    <select name="nganh" id="nganh" class="form-control mr-3" required>
                                        <option value="">--Chọn Ngành--</option>
                                        {foreach $listNganh as $k => $v}
                                            <option value="{$v.PK_iMaNganh}">{$v.sTenNganh}</option>
                                        {/foreach}
                                    </select>
                                    <span>Năm học: </span>
                                    <select name="namhoc" id="namhoc" class="form-control mr-3" required>
                                        <option value="">--Chọn Năm học--</option>
                                    </select>
                                </div>
                                <div class="form-inline">
                                    <span>Khoa: </span>
                                    <select name="donvi" id="donvi" class="form-control mr-3" required>
                                        <option value="">--Chọn Khoa--</option>
                                    </select>
                                    <span>Khoá học: </span>
                                    <select name="khoahoc" id="khoahoc" class="form-control mr-3" required>
                                        <option value="">--Chọn Khoá học--</option>
                                    </select>
                                    <input type="hidden" name="{$csrf['name']}" value="{$csrf['hash']}" />
                                    <button name="export" value="1" class="btn btn-sm btn-success" type="submit">Lọc</button>
                                </div>
                            </form>
                        </div>
                    </div>
					<div class="mb-2 float-left">Danh sách sinh viên: </div>
                    <div class="form-group float-right">
						<form method="post" action="">
							<input type="hidden" name="{$csrf['name']}" value="{$csrf['hash']}" />
							<button name="delAllSV" value="1" type="submit" class="btn btn-danger btn-sm">Xoá toàn bộ sinh viên</button>
						</form>
                    </div>
                    <table id="tbl" class="table table-striped table-inverse table-bordered">
                        <thead>
                            <tr>
                                <th class="text-center" width="8%">STT</th>
                                <th class="text-center">Khoá</th>
                                <th width="10%">Lớp</th>
                                <th class="text-center" width="15%">Mã SV</th>
                                <th class="text-center">Họ và Tên</th>
                                <th class="text-center">Ngày sinh</th>
                                <th class="text-center">Giới</th>
                                <!-- <th class="text-center" width="11%">In mẫu</th> -->
                                <th class="text-center">Tác vụ</th>
                            </tr>
                        </thead>
                        <tbody id="tbody">
                            {if !empty($DSSV)}
                                {foreach $DSSV as $key => $value}
                                <tr>
                                    <td class="text-center">{$key+1}</td>
                                    <td class="">{$value.iKhoa}</td>
                                    <td class="">{$value.sTenLop}</td>
                                    <td class="">{$value.PK_iMaNhapHoc}</td>
                                    <td class="">{$value.sHo} {$value.sTen}</td>
                                    <td class="text-center">{date('d/m/Y', strtotime($value.dNgaySinh))}</td>
                                    <td class="">{$value.sGioiTinh}</td>
                                    <!-- <td class="text-center">
                                        <a class="btn btn-success" target="_blank" href="{$url}export09?id={$value.PK_iMaSV}"><i class="fa fa-print" aria-hidden="true"></i></a>
                                    </td> -->
                                    <td class="text-center">
										<form action="" method="post">
                                            <a target="_blank" href="{$url}inbangdiem?masv={$value.PK_iMaNhapHoc}&d_f_w=true">
                                                <button class="btn btn-success btn-sm" type="button">
                                                    <i class="fa fa-download" aria-hidden="true" title="Tải file word"></i>
                                                </button>
                                            </a>
                                            <a target="_blank" href="{$url}inbangdiem?masv={$value.PK_iMaNhapHoc}">
                                                <button class="btn btn-success btn-sm" type="button">
                                                    <i class="fa fa-eye" aria-hidden="true" title="Xem điểm"></i>
                                                </button>
                                            </a>
											<!-- <button type="button" class="btn btn-sm btn-success btnView" title="Xem điểm" data-ma="{$value.PK_iMaNhapHoc}" data-toggle="modal" data-target="#modalView">
												<i class="fa fa-eye" aria-hidden="true" title="Xem điểm"></i>
											</button> -->
											<!-- <button type="button" class="btn btn-sm btn-primary btnEdit" title="Sửa" data-ma="{$value.PK_iMaSV}" data-toggle="modal" data-target="#modalFix">
												<i class="fa fa-pencil" aria-hidden="true" title="Sửa"></i>
											</button> -->
											<input type="hidden" name="{$csrf['name']}" value="{$csrf['hash']}" />
											<button class="btn btn-sm btn-danger" type="submit" title="Xoá" value="{$value.PK_iMaNhapHoc}" name="delSV" onclick="return confirm('Bạn chắc chắn muốn xóa?')">
												<i class="fa fa-trash" aria-hidden="true" title="Xoá"></i>
											</button>
										</form>
                                        <!-- <a href="{$url}info-ung-vien?id={$value.PK_iMaSV}" target="_blank" class="btn btn-primary"><i class="fa fa-pencil" aria-hidden="true"></i> Sửa</a> -->
                                    </td>
                                    
                                </tr>
                                {/foreach}
                                {else}
                                <tr>
                                    <td colspan="9" class="text-center">
                                    <i>Chưa có sinh viên nào</i>
                                    </td>
                                </tr>
                                {/if}
                        </tbody>
                    </table>
					<nav class="float-right">
						<ul class="pagination">
							<li class="page-item {if $present_page == 1}disabled{/if}"><a class="page-link" href="{$url}listsv?page=1">Trước</a></li>
							{for $i=1 to $countPage}
								<li class="page-item {if $present_page == $i}active{/if}"><a class="page-link" href="{$url}listsv?page={$i}">{$i}</a></li>
							{/for}
							<li class="page-item {if $present_page == $countPage}disabled{/if}"><a class="page-link" href="{$url}listsv?page={$countPage}">Sau</a></li>
						</ul>
					</nav>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Modal -->
<!-- <div class="modal fade" id="modalFix" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Sửa thông tin</h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
			</div>
			<form action="" method="post" enctype="multipart/form-data">
				<input type="hidden" name="{$csrf['name']}" value="{$csrf['hash']}" />
				<div class="modal-body">
					<div class="form-group">
                        <label class="col-md-5 control-label">Họ tên:</label>
                        <div class="col-md-7">
                            <select class="form-control" name="data[FK_iMaCD]" id="FK_iMaCD">
                                {foreach $ds_chucdanh as $k => $v}
                                    <option value="{$v.PK_iMaCD}">{$v.sChucDanh}</option>
                                {/foreach}
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-5 control-label">Ngày bổ nhiệm/công nhận chức danh PGS:</label>
                        <div class="col-md-7">
                            <input type="date" class="form-control" name="data[sCongNhanPGS]" id="sCongNhanPGS" placeholder="" value="{(!empty($ungvien))?$ungvien.sCongNhanPGS:''}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-5 control-label">Ngành:</label>
                        <div class="col-md-7">
                            <select class="form-control" name="data[FK_iMaNganh]" id="FK_iMaNganh">
                                {foreach $ds_nganh as $k => $v}
                                    <option value="{$v.PK_iMaNganh}">{$v.sTenNganh}</option>
                                {/foreach}
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-5 control-label">Chuyên ngành:</label>
                        <div class="col-md-7">
                            <input type="text" class="form-control" name="data[sChuyenNganh]" id="sChuyenNganh" placeholder="" value="{(!empty($ungvien))?$ungvien.sChuyenNganh:''}">
                        </div>
                    </div>

                    <div class="form-group">
                    <label class="col-md-5 control-label">Họ và tên ứng viên:</label>
                    <div class="col-md-7">
                    <input type="text" class="form-control text-uppercase" name="data[sHoTen]" id="sHoTen" placeholder="Ví dụ: NGUYỄN VĂN A" value="{(!empty($ungvien))?$ungvien.sHoTen:''}">
                    </div>
                    </div>

                    <div class="form-group">
                    <label class="col-md-5 control-label">Giới tính:</label>
                    <div class="col-md-7">
                            <div class="form-group-inline col-sm-6">
                                <label class="form-check-label" for="Nam">
                                    <input class="form-check-input" type="radio" name="data[sGioiTinh]" id="Nam" value="Nam" {(!empty($ungvien) && $ungvien.sGioiTinh == 'Nam')?'checked':''}> Nam
                                </label>
                            </div>
                            <div class="form-group-inline col-sm-6">
                                <label class="form-check-label" for="Nữ">
                                    <input class="form-check-input" type="radio" name="data[sGioiTinh]" id="Nữ" value="Nữ" {(!empty($ungvien) && $ungvien.sGioiTinh == 'Nữ')?'checked':''}> Nữ
                                </label>
                            </div>
                    </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-5 control-label">Ngày sinh:</label>
                        <div class="col-md-7">
                            <input type="date" name="data[dNgaySinh]" id="dNgaySinh" class="form-control" value="{(!empty($ungvien))?$ungvien.dNgaySinh:''}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-5 control-label">Dân tộc:</label>
                        <div class="col-md-7">
                            <select class="form-control" name="data[FK_iMaDanToc]" id="FK_iMaDanToc">
                                {foreach $ds_dantoc as $k => $v}
                                    <option value="{$v.PK_iMaDanToc}">{$v.sTenDanToc}</option>
                                {/foreach}
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-5 control-label">Quê quán (xã/phường, huyện/quận, tỉnh/thành phố):</label>
                        <div class="col-md-7">
                        <input type="text" class="form-control" name="data[sQueQuan]" id="sQueQuan" placeholder="" value="{(!empty($ungvien))?$ungvien.sQueQuan:''}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-5 control-label">Cơ quan đang công tác:</label>
                        <div class="col-md-7">
                            <input type="text" class="form-control" name="data[sCoQuan]" id="sCoQuan" placeholder="" value="{(!empty($ungvien))?$ungvien.sCoQuan:''}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-5 control-label">Đăng ký xét chức danh GS/PGS tại HĐGS Cơ sở:</label>
                        <div class="col-md-7">
                        <input type="text" class="form-control" name="data[sCoSoXetChucDanh]" id="sCoSoXetChucDanh" placeholder="" value="{(!empty($ungvien))?$ungvien.sCoSoXetChucDanh:''}">
                        </div>
                    </div>
				</div>
				<div class="modal-footer">
					<button type="reset" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
					<button type="submit" class="btn btn-primary">Lưu</button>
				</div>
			</form>
		</div>
	</div>
</div>
<div class="modal fade" id="modalView" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Xem điểm</h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
			</div>
			<div class="modal-body row">
				<table class="col-6 table table-striped table-inverse table-responsive pl-0 pr-1">
					<thead>
						<tr>
                            <th>Tên môn</th>
                            <th>ĐT 10</th>
                            <th>ĐT chữ</th>
                            <th>ĐT 4</th>
						</tr>
					</thead>
					<tbody id="list_grade">
					</tbody>
				</table>
				<table class="col-6 table table-striped table-inverse table-responsive pr-0 pl-1">
					<thead>
						<tr>
                            <th>Tên môn</th>
                            <th>ĐT 10</th>
                            <th>ĐT chữ</th>
                            <th>ĐT 4</th>
						</tr>
					</thead>
					<tbody id="list_grade2">
					</tbody>
				</table>
			</div>
			<div class="modal-footer">
				<button type="reset" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
				<button type="submit" class="btn btn-primary">Lưu</button>
			</div>
		</div>
	</div>
</div> -->

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
