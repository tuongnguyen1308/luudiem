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
								<h4>2. Trình độ đào tạo, chức danh khoa học</h4>
							</div>
							<div class="col-12 col-md-12">
								<table class="table table-bordered">
									<thead>
										<th class="text-center" width="4%">TT</th>
										<th class="text-center">Loại Bằng</th>
										<th class="text-center">Ngành</th>
										<th class="text-center">Chuyên ngành</th>
										<th class="text-center">Ngày cấp bằng</th>
										<th class="text-center" width="7%">Tác vụ</th>
									</thead>
									<tbody>
									{if !empty($muc2)}
										{foreach $muc2 as $k => $v}
											<tr>
												<td class="text-center">{$k+1}</td>
												<td class="text-center">{$v.sLoaiBang}</td>
												<td class="text-center">{$v.sNganh}</td>
												<td class="text-center">{$v.sChuyenNganh}</td>
												<td class="text-center">
													<input class="form-control text-center" type="date" name="date" value="{$v.sNgayCapBang}" disabled style="background-color:#fff;border:none;cursor:context-menu;">
												</td>
												<td class="text-center">
													<button type="button" class="btnFix btn btn-xs btn-warning fa fa-pencil-square-o" title="Sửa thông tin sách phục vụ đào tạo" name="btnFix" value="{$v.PK_iMaMuc2}" data-sLoaiBang="{$v.sLoaiBang}" data-sNganh="{$v.sNganh}" data-sChuyenNganh="{$v.sChuyenNganh}" data-sngaycapbang="{$v.sNgayCapBang}" data-toggle="modal" data-target="#modalAdd" style="padding:3px;">
													</button>
													<button type="submit" class="btn btn-xs btn-danger" title="Xoá sách phục vụ đào tạo" name="btnDeleteBang" value="{$v.PK_iMaMuc2}" onclick="return confirm('Bạn chắc chắn muốn xoá sách này?');">
														<i class="fa fa-trash-o" aria-hidden="true"></i>
													</button>
												</td>
											</tr>
										{/foreach}
									{else}
										<td colspan="6">Không có dữ liệu</td>
									{/if}
									</tbody>
								</table>
							</div>
							<div class="col-12 col-md-12 text-right">
								<button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modalAdd">
									<i class="fa fa-plus-circle" aria-hidden="true"></i>
									Thêm Bằng
								</button>
							</div>
						</div>

						<!-- <div class="row">
							<div class="col-12 mt-3 text-center">
								{if !empty($id)}
								<input type="hidden" name="data[PK_iMaMuc2]" value="{(isset($muc2))?$muc2.PK_iMaMuc2:''}">
								<button name="updatemuc2" id="updatemuc2" type="submit" class="btn btn-primary" value="1" data-loading-text="<i class='fa fa-spinner fa-spin'></i> Đang lưu">Thẩm định</button>
								{/if}
							</div>
						</div> -->
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
					<button type="button" class="close close-modal" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
					<h3 id="modal-title" class="modal-title">Thêm Bằng cấp</h3>
				</div>
				<div class="modal-body ndThem">
					<div class="row">
						<div class="form-group">
							<label class="col-md-4 control-label-left">
								Loại Bằng
								<span class="text-danger">*</span>
							</label>
							<div class="col-md-8">
								<select id="sLoaiBang" class="form-control" name="data[sLoaiBang]" required>
									<option id="" value="">--- Chọn loại bằng ---</option>
									<option id="ck" value="DH">ĐH [3]</option>
									<option id="gt" value="ThS">ThS [4]</option>
									<option id="tk" value="TS">TS [5]</option>
									<option id="hd" value="TSKH">TSKH [6]</option>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-4 control-label-left">
								Ngành
								<span class="text-danger">*</span>
							</label>
							<div class="col-md-8">
								<select class="form-control" name="data[sNganh]" id="sNganh" required>
									<option value="">-- Chọn ngành --</option>
									{foreach $ds_nganh as $k => $v}
										<option value="{$v.sTenNganh}" {(!empty($info) && $info.sNganh == $v.sTenNganh)?'selected':''}>{$v.sTenNganh}</option>
									{/foreach}
								</select>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-4 control-label-left">
								Chuyên Ngành
								<span class="text-danger">*</span>
							</label>
							<div class="col-md-8">
								<input id="sChuyenNganh" type="text" name="data[sChuyenNganh]" class="form-control">
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-4 control-label-left">
								Ngày cấp bằng
								<span class="text-danger">*</span>
							</label>
							<div class="col-md-8">
								<input id="sNgayCapBang" type="date" name="data[sNgayCapBang]" class="form-control">
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<input id="PK_iMaMuc2" type="hidden" name="data[PK_iMaMuc2]">
					<button type="submit" class="btn btn-primary" name="addBang" value="ok" data-loading-text="<i class='fa fa-spinner fa-spin'></i> Đang tải lên">Lưu</button>
					<button type="reset" class="btn btn-default close-modal" data-dismiss="modal">Đóng</button>
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
		$('.close-modal').on('click',() => {
			$('#PK_iMaMuc2').val('');
			$('#sLoaiBang').val('');
			$('#sNganh').val('');
			$('#sChuyenNganh').val('');
			$('#sNgayCapBang').val('');
		});
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
			$('#PK_iMaMuc2').val($(this).val());
			$('#sLoaiBang').val($(this).data('sloaibang'));
			$('#sNganh').val($(this).data('snganh'));
			$('#sChuyenNganh').val($(this).data('schuyennganh'));
			$('#sNgayCapBang').val($(this).data('sngaycapbang'));
		});
    });
</script>

