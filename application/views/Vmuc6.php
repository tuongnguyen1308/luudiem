<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
		
		<!-- panel -->
        <div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-heading text-uppercase">II. Kết quả thẩm định</div>
				<div class="panel-body">
					<form method="post">
            <input type="hidden" name="{$csrf.name}" value="{$csrf.hash}">
						<div class="row">
							<div class="col-12 col-md-12">
								<h4>6. Biên soạn sách phục vụ đào tạo</h4>
							</div>
							<div class="col-12 col-md-12">
								<label class="col-form-label font-weight-bold">a) Kết quả chung</label>
								<table class="table table-bordered">
									<thead>
										<th class="text-center" width="4%">TT</th>
										<th class="text-center" width="35%">Tên sách</th>
										<th class="text-center" width="10%">Loại sách</th>
										<th class="text-center" width="10%">Vai trò</th>
										<th class="text-center" width="7%">Số tác giả</th>
										<th class="text-center" width="10%">Số điểm</th>
										<th class="text-center" width="10%">Điểm các sách trong 3 năm cuối</th>
										<th class="text-center" width="7%">Tác vụ</th>
									</thead>
									<tbody>
									{$diem = 0}
									{$diem3namcuoi = 0}
									{if !empty($muc6)}
										{foreach $muc6 as $k => $v}
											{$diem = $diem + $v.iSoDiem}
											{$diem3namcuoi = $diem3namcuoi + $v.iDiemBaNamCuoi}
											<tr>
												<td class="text-center">{$k+1}</td>
												<td>{$v.sTenSach}</td>
												<td class="text-center">{$v.sLoaiSachFull}</td>
												<td class="text-center">{$v.sVaiTroFull}</td>
												<td class="text-center">{$v.iSoTacGia}</td>
												<td class="text-center">{$v.iSoDiem}</td>
												<td class="text-center">{$v.iDiemBaNamCuoi}</td>
												<td class="text-center">
													<button type="button" class="btnFix btn btn-xs btn-warning fa fa-pencil-square-o" title="Sửa thông tin sách phục vụ đào tạo" name="btnFix" value="{$v.PK_iMaSach}" data-sgiaidoan="{$v.sGiaiDoan}" data-stensach="{$v.sTenSach}" data-sloaisach="{$v.sLoaiSach}" data-snhaxuatbanuytin="{$v.sNhaXuatBanUyTin}" data-svaitro="{$v.sVaiTro}" data-isotacgia="{$v.iSoTacGia}" data-isodiem="{$v.iSoDiem}" data-idiembanamcuoi="{$v.iDiemBaNamCuoi}" data-toggle="modal" data-target="#modalAdd" style="padding:3px;">
													</button>
													<button type="submit" class="btn btn-xs btn-danger" title="Xoá sách phục vụ đào tạo" name="btnDeleteSach" value="{$v.PK_iMaSach}" onclick="return confirm('Bạn chắc chắn muốn xoá sách này?');">
														<i class="fa fa-trash-o" aria-hidden="true"></i>
													</button>
												</td>
											</tr>
										{/foreach}
										<tr>
											<td colspan="5">Tổng số điểm do viết sách [25]</td>
											<td><input class="form-control" type="number" name="info[iSoDiem]" step="0.01" value="{$diem}" disabled></td>
											<td><input class="form-control" type="number" name="info[iDiemBaNamCuoi]" step="0.01" value="{$diem3namcuoi}" disabled></td>
											<td></td>
										</tr>
									{else}
										<td colspan="8">Không có dữ liệu</td>
									{/if}
									</tbody>
								</table>
							</div>
							<div class="col-12 col-md-12 text-right">
								<button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modalAdd">
									<i class="fa fa-plus-circle" aria-hidden="true"></i>
									Thêm sách
								</button>
							</div>
							<div class="col-12 col-md-8 mt-3">
								<label for="iSoLuongBBUyTinSauPGS" class="col-form-label font-weight-bold">b) Số lượng (ghi rõ số TT) sách chuyên khảo được xuất bản ở NXB có uy tín, chương sách được xuất bản ở NXB có uy tín trên thế giới sau PGS/ TS [26]:</label>
							</div>
							<div class="col-12 col-md-4 mt-3">
								<input type="text" class="form-control" name="info[iSoLuongBBUyTinSauPGS]" id="iSoLuongBBUyTinSauPGS" placeholder="" value="{(isset($muc6Tong))?$muc6Tong.iSoLuongBBUyTinSauPGS:''}">
							</div>
						</div>

						<div class="row">
							<div class="col-12 mt-3 text-center">
								{if !empty($id)}
								<input type="hidden" name="data[PK_iMaSach]" value="{(isset($muc6addition))?$muc6addition.PK_iMaSach:''}">
								<button name="updatemuc6" id="updatemuc6" type="submit" class="btn btn-primary" value="1" data-loading-text="<i class='fa fa-spinner fa-spin'></i> Đang lưu">Thẩm định</button>
								{/if}
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
		<!-- end-panel -->
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="modalAdd" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
	<form action="" method="POST" class="form-horizontal" enctype="multipart/form-data">
		<input type="hidden" name="{$csrf['name']}" value="{$csrf['hash']}" />
		<div class="modal-dialog modal-md" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
					<h3 id="modal-title" class="modal-title">Thêm sách</h3>
				</div>
				<div class="modal-body ndThem">
					<div class="row">
						<div class="form-group">
							<label class="col-md-4 control-label-left">
								Giai đoạn viết sách
								<span class="text-danger">*</span>
							</label>
							<div class="col-md-8">
									<!-- <label class="checkbox-inline i-checks"> -->
										<input type="radio" value="Truoc" class="form-check-input" id="Truoc" name="data[sGiaiDoan]"> Trước PGS/TS
									<!-- </label> -->
									<!-- <label class="checkbox-inline i-checks"> -->
										<input type="radio" value="Sau" class="form-check-input" id="Sau" name="data[sGiaiDoan]"> Sau PGS/TS
									<!-- </label> -->
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-4 control-label-left">
								Tên sách
								<span class="text-danger">*</span>
							</label>
							<div class="col-md-8">
								<input id="sTenSach" type="text" name="data[sTenSach]" class="form-control" required>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-4 control-label-left">
								Loại sách
								<span class="text-danger">*</span>
							</label>
							<div class="col-md-8">
								<select id="sLoaiSach" class="form-control" name="data[sLoaiSach]" required>
									<option id="" value="">--- Chọn loại sách ---</option>
									<option id="ck" value="ck">Sách chuyên khảo [20]</option>
									<option id="cs" value="cs">Chương sách do NXB uy tín thế giới xuất bản [21]</option>
									<option id="gt" value="gt">Giáo trình [22]</option>
									<option id="tk" value="tk">Sách tham khảo [23]</option>
									<option id="hd" value="hd">Sách hướng dẫn [24]</option>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-4 control-label-left">
								Nhà xuất bản uy tín
								<span class="text-danger">*</span>
							</label>
							<div class="col-md-8">
								<!-- <label class="checkbox-inline i-checks"> -->
									<input type="radio" value="Uy tín" class="sNhaXuatBanUyTin" name="data[sNhaXuatBanUyTin]" required> Uy tín
								<!-- </label> -->
								<!-- <label class="checkbox-inline i-checks"> -->
									<input type="radio" value="Không uy tín" class="sNhaXuatBanUyTin" name="data[sNhaXuatBanUyTin]" required> Không uy tín
								<!-- </label> -->
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-4 control-label-left">
								Vai trò
								<span class="text-danger">*</span>
							</label>
							<div class="col-md-8">
								<select id="sVaiTro" class="form-control" name="data[sVaiTro]" required>
									<option id="" value="">--- Chọn vai trò ---</option>
									<option id="mm" value="mm">Viết một mình</option>
									<option id="cb" value="cb">Chủ biên</option>
									<option id="vc" value="vc">Viết chung</option>
									<option id="cbtg" value="cbtg">Vừa chủ biên vừa tham gia</option>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-4 control-label-left">
								Số lượng tác giả
								<span class="text-danger">*</span>
							</label>
							<div class="col-md-8">
								<input id="iSoTacGia" type="number" name="data[iSoTacGia]" class="form-control">
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-4 control-label-left">
								Điểm
							</label>
							<div class="col-md-8">
								<input id="iSoDiem" class="form-control" type="number" step="0.01" name="data[iSoDiem]">
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-4 control-label-left">
								Điểm các sách trong 3 năm cuối
							</label>
							<div class="col-md-8">
								<input id="iDiemBaNamCuoi" class="form-control" type="number" step="0.01" name="data[iDiemBaNamCuoi]">
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<input id="PK_iMaSach" type="hidden" name="data[PK_iMaSach]">
					<button type="submit" class="btn btn-primary" name="addSach" value="ok" data-loading-text="<i class='fa fa-spinner fa-spin'></i> Đang tải lên">Lưu</button>
					<button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
				</div>
			</div>
		</div>
	</form>
</div>






<style type="text/css">
	input[type=radio] {
		transform: scale(1.3);
	}
    .mt-3 {
        margin-top: 30px;
    }
    .mt-2 {
        margin-top: 20px;
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
        
        .mt-md-3 {
            margin-top: 30px;
        }
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
			$('#modalAdd ndThem').on('hidden.bs.modal', function (e) {
			$(this)
				.find("input,textarea,select")
					.val('')
					.end()
				.find("input[type=checkbox], input[type=radio]")
					.prop("checked", "")
					.end();
			});

        $('.feature').each(function (k, v){
            $(v).css("background-color", getRandomColor());
        });
			$('.btnFix').click(function(){
			console.log($(this));
			$('#PK_iMaSach').val($(this).val());
			$('#sTenSach').val($(this).data('stensach'));
			$('input[name="data[sGiaiDoan]"][value="'+$(this).data('sgiaidoan')+'"]').prop('checked',true)
			$('#sLoaiSach').val($(this).data('sloaisach'));
			$('input[name="data[sNhaXuatBanUyTin]"][value="'+$(this).data('snhaxuatbanuytin')+'"]').prop('checked',true);
			$('#sVaiTro').val($(this).data('svaitro'));
			$('#iSoTacGia').val($(this).data('isotacgia'));
			$('#iSoDiem').val($(this).data('isodiem'));
			$('#iDiemBaNamCuoi').val($(this).data('idiembanamcuoi'));
			// $('.i-checks').iCheck({
			// 		checkboxClass: 'icheckbox_square-green',
			// 		radioClass: 'iradio_square-green',
			// });
		});
    });
</script>

