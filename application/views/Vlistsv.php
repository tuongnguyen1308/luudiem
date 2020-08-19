<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <form action="" method="POST" class="form-horizontal" enctype="multipart/form-data">
                            <div class="form-group mb-0" id="customFile" lang="vi">
                                <div class="text-uppercase float-left mt-2">Danh sách sinh viên</div>
                                <div class="float-right">
                                    <span>Thêm file Excel: </span>
                                    <input type="file" name="importExcel" class="" multiple accept=".xlsx, .xls" required>
                                    <button name="submitImport" id="submitImport" value="1" type="submit" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Đang lưu" class="btn btn-sm btn-primary">Lưu</button>
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
                                <th width="10%">Lớp</th>
                                <th class="text-center" width="15%">Mã SV</th>
                                <th class="text-center">Họ và Tên</th>
                                <th class="text-center">Ngày sinh</th>
                                <th width="8%" class="text-center">Giới</th>
                                <th class="text-center">Khoá</th>
                                <!-- <th class="text-center" width="11%">In mẫu</th> -->
                                <th class="text-center">Tác vụ</th>
                            </tr>
                        </thead>
                        <tbody id="tbody">
                            {if !empty($DSSV)}
                                {foreach $DSSV as $key => $value}
                                <tr>
                                    <td class="text-center">{$key+1}</td>
                                    <td class="">{$value.sLop}</td>
                                    <td class="">{$value.sMaSV}</td>
                                    <td class="">{$value.sHo} {$value.sTen}</td>
                                    <td class="text-center">{date('d/m/Y', strtotime($value.dNgaySinh))}</td>
                                    <td class="">{$value.sGioiTinh}</td>
                                    <td class="">{$value.sKhoaHoc}</td>
                                    <!-- <td class="text-center">
                                        <a class="btn btn-success" target="_blank" href="{$url}export09?id={$value.PK_iMaSV}"><i class="fa fa-print" aria-hidden="true"></i></a>
                                    </td> -->
                                    <td class="text-center">
                                        <a href="{$url}info-ung-vien?id={$value.PK_iMaSV}" target="_blank" class="btn btn-primary"><i class="fa fa-pencil" aria-hidden="true"></i> Sửa</a>
                                    </td>
                                    <!-- <button class="btn btn-danger" type="submit" value="{$value.PK_iMaUV}" name="xoaBanTrichNgang" onclick="return confirm('Bạn chắc chắn muốn xóa?')"><i class="fa fa-trash" aria-hidden="true"></i> Xóa</button> -->
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

<!-- <div class="modal fade" id="modalAdd" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-md" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h3 class="modal-title">Thêm ứng viên</h3>
			</div>

			<div class="modal-body">
				<form action="" method="POST" class="form-horizontal" enctype="multipart/form-data">
					<input type="hidden" name="{$csrf['name']}" value="{$csrf['hash']}" />

                    <div class="form-group">
                        <label class="col-md-5 control-label">Chức danh xét tuyển:</label>
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

                    <div class="modal-footer">
                        <button name="addInfoungvien" id="addInfoungvien" type="submit" class="btn btn-primary" value="1">Lưu</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
                    </div>
                </form>
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


        // function load_data() {
        //     $.ajax({
        //         url: url + 'fetchData',
        //         data:{
        //             'action': 'getallrow'
        //         },
        //         method: 'post',
        //         success: function (data) {
        //             $('#tbody').html(data);
        //         }
        //     })
        // }

        // $('#submitImport').on('click', (event) => {
        //     event.preventDefault();
        //     $.ajax({
        //         url: url + 'importSV',
        //         method: 'post',
        //         data: new FormData(this),
        //         contentType: false,
        //         cache: false,
        //         processData: false,
        //         success: function (data) {
        //             $('#submitImport').val('');
        //             load_data();
        //             alert(data);
        //         }
        //     })
        // });
    })
</script>
