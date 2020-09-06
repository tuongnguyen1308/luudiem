<div class="wrapper wrapper-content animated fadeInRight">
    <form action="" method="post">
        <input type="hidden" name="{$csrf['name']}" value="{$csrf['hash']}" />
        <h3 class="badge badge-warning text-dark p-2 w-100" style="font-size: 16px !important;"><button type="button" class="btn btn-outline p-0" style="color:#000;" disabled>Yêu cầu: Các ô điểm trong file excel không được bỏ trống! Xem mẫu tại </button> <button name="download_demo" value="1" class="btn btn-outline font-weight-bold p-0" type="submit">đây!</button></h3>
    </form>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <form action="" method="POST" class="form-horizontal" enctype="multipart/form-data">
                        <input type="hidden" name="{$csrf['name']}" value="{$csrf['hash']}" />
                        <button name="export" value="1" class="float-right btn btn-sm btn-success" type="submit">Xuất Excel</button>
                    </form>
                    <form action="" method="POST" class="form-horizontal" enctype="multipart/form-data">
                            <div class="form-group mb-0" id="customFile" lang="vi">
                                <div class="text-uppercase float-left mt-2">Danh sách sinh viên</div>
                                <div class="float-right">
                                    <span>Thêm file Excel: </span>
                                    <input type="file" name="importExcel" class="" multiple accept=".xlsx, .xls" required>
                                    <button name="submitImport" id="submitImport" value="1" type="submit" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Đang lưu" class="btn btn-sm btn-primary mr-2">Lưu</button>
                                </div>
                            </div>
                        <input type="hidden" name="{$csrf['name']}" value="{$csrf['hash']}" />
                    </form>
                </div>

                <div class="card-body">
                    <table id="tbl" class="table table-striped table-inverse table-bordered">
                        <thead>
                            <tr>
                                <th class="text-center" width="8%">STT</th>
                                <th class="text-center">Khoá</th>
                                <th width="10%">Lớp</th>
                                <th class="text-center" width="15%">Mã SV</th>
                                <th class="text-center">Họ và Tên</th>
                                <th class="text-center">Ngày sinh</th>
                                <th width="8%" class="text-center">Giới</th>
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
											<button type="button" class="btn btn-sm btn-success btnView" title="Xem điểm" data-ma="{$value.PK_iMaNhapHoc}" data-toggle="modal" data-target="#modalView">
												<i class="fa fa-eye" aria-hidden="true" title="Xem điểm"></i>
											</button>
											<!-- <button type="button" class="btn btn-sm btn-primary btnEdit" title="Sửa" data-ma="{$value.PK_iMaSV}" data-toggle="modal" data-target="#modalFix">
												<i class="fa fa-pencil" aria-hidden="true" title="Sửa"></i>
											</button> -->
											<input type="hidden" name="{$csrf['name']}" value="{$csrf['hash']}" />
											<button class="btn btn-sm btn-danger" type="submit" title="Xoá" value="{$value.PK_iMaSV}" name="delSV" onclick="return confirm('Bạn chắc chắn muốn xóa?')">
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
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="modalFix" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
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
<script type="text/javascript">
    function getRandomColor() {
        var letters = '0123456789ABCDEF';
        var color = '#';
        for (var i = 0; i < 6; i++) {
            color += letters[Math.floor(Math.random() * 16)];
        }
        return color;
    }
    $(document).ready(function () {
        $('.feature').each(function (k, v){
            $(v).css("background-color", getRandomColor());
        });
    });
    $(document).ready(() => {
        var url = window.location.href;
        $('#tbl').DataTable();



		$(".btnView").click(function(){
			$.post(
				"",
				{
					action: 'getSVGrade',
					masv: $(this).data('ma')
				},
				function(res){
                    console.log(res.length);
                    let i = 0;
                    $('#list_grade').html('');
                    $('#list_grade2').html('');
					res.forEach(mon => {
                        let list_grade = '<tr>';
                        list_grade += '<td>' + mon['sTenMon'] + '</td>';
                        list_grade += '<td>' + mon['iDT10'] + '</td>';
                        list_grade += '<td>' + mon['sDTChu'] + '</td>';
                        list_grade += '<td>' + mon['iDT4'] + '</td>';
                        list_grade += '</tr>';
                        if (i++ < res.length / 2) {
                            $('#list_grade').append(list_grade);
                        }
                        else {
                            $('#list_grade2').append(list_grade);
                        }
					});
			}, 'json');
		});
    })
</script>
