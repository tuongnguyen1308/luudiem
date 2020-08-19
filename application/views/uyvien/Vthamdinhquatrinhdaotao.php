<div class="wrapper wrapper-content animated fadeInRight">
	<form action="" method="post" class="form-horizontal" enctype="multipart/form-data">
		<input type="hidden" name="{$csrf['name']}" value="{$csrf['hash']}" />
		<div class="row">
			<div class="col-md-12">
				<div class="ibox float-e-margins">
					<div class="ibox-title">
						<h5>Quá trình đào tạo</h5>
					</div>
					<div class="ibox-content">
						<table class="table table-bordered">
							<thead>
								<th class="text-center">TT</th>
								<th class="text-center" width="9%">Bằng cấp</th>
								<th class="text-center" width="9%">Ngành</th>
								<th class="text-center">Chuyên ngành</th>
								<th class="text-center" width="9%">Ngày cấp bằng</th>
								<th class="text-center">Nơi cấp bằng</th>
								<th class="text-center" width="9%">Minh chứng</th>
								<th class="text-center" width="15%">Thẩm định</th>
							</thead>
							{if !empty($thongTinQuaTrinhDaoTao)}
							<tbody>
								{foreach $thongTinQuaTrinhDaoTao as $k => $v}
									<tr>
										<td class="text-center">{$k+1}</td>
										<td data-mabangcap="{$v.FK_iMaBangCap}">{$v.sTenBangCap}</td>
										<td>{$v.sTenNganh}</td>
										<td>{$v.sTenChuyenNganh}</td>
										<td class="text-center">{$v.sNgayCapBang}</td>
										<td>{$v.sNoiCapBang}</td>
										<td class="text-center">
											<a class="viewMC" data-link="{$v.sFile}" data-name="{$v.sTenTaiLen}" data-maqtdt="{$v.PK_iMaQTDT}" data-toggle="modal" data-target="#modalViewMC">{if !empty($v.sFile)}{count(explode('|', $v.sFile))}{else}0{/if} minh chứng</a>
										</td>
										<td>
										<p>
										<label class="checkbox-inline i-checks text-bold">
											<p><input type="radio" value="ok" name="bangCap{$k}" {($v.sXacThucThongTin == "ok") ? 'checked' : ''} required> Đúng 
											</p>
											<p>
											<input type="radio" value="fail" name="bangCap{$k}"{($v.sXacThucThongTin == "fail") ? 'checked' : ''}  required> Còn nghi vấn
											</p>
											<p>
											<input type="radio" value="notselect" name="bangCap{$k}" {($v.sXacThucThongTin == "notselect") ? 'checked' : ''} required> Chưa thẩm định
											</p>
										</label>
										</p>
							
										</p>
										</td>
									</tr>
								{/foreach}
							</tbody>
							{/if}
						</table>
						<input type="hidden" name="maMC" value="{$maMC}">
						<button type="submit" class="btn btn-primary" name="btnLuuThamDinh" value="save">Lưu</button>
					</div>
				</div>
			</div>
		</div>
	</form>
</div>


<div class="modal fade" id="modalFixBangCap" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
	<form action="" method="POST" class="form-horizontal">
		<input type="hidden" name="{$csrf['name']}" value="{$csrf['hash']}" />
		<div class="modal-dialog modal-md" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
					<h3 class="modal-title">Chỉnh sửa thông tin bằng cấp</h3>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-md-12 form-group">
							<label class="col-md-4 control-label-left">
								Bằng cấp
								<span class="text-danger">*</span>
							</label>
							<div class="col-md-8">
								<select name="fix_bangCap" class="form-control" required>
									<option value="">--- Chọn bằng cấp ---</option>
									{foreach $listBangCap as $k => $v}
										<option value="{$v.PK_iMaBangCap}">{$v.sTenBangCap}</option>
									{/foreach}
								</select>
							</div>
						</div>
						<div class="col-md-12 form-group">
							<label class="col-md-4 control-label-left">
								Ngành
								<span class="text-danger">*</span>
							</label>
							<div class="col-md-8">
								<input type="text" name="fix_tenNganh" class="form-control" autocomplete="off" required>
							</div>
						</div>
						<div class="col-md-12 form-group">
							<label class="col-md-4 control-label-left">
								Chuyên ngành
								<span class="text-danger">*</span>
							</label>
							<div class="col-md-8">
								<input type="text" name="fix_tenChuyenNganh" class="form-control" autocomplete="off" required>
							</div>
						</div>
						<div class="col-md-12 form-group">
							<label class="col-md-4 control-label-left">
								Ngày cấp bằng
								<span class="text-danger">*</span>
							</label>
							<div class="col-md-8">
								<input type="text" name="fix_ngayCapBang" placeholder="dd/mm/yyyy" class="form-control checkdate" autocomplete="off" required>
							</div>
						</div>
						<div class="col-md-12 form-group">
							<label class="col-md-4 control-label-left">
								Nơi cấp bằng (trường, nước)
								<span class="text-danger">*</span>
							</label>
							<div class="col-md-8">
								<textarea name="fix_noiCapBang" class="form-control" required></textarea>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-primary" name="btnSaveUpdateBangCap" value="ok" data-loading-text="<i class='fa fa-spinner fa-spin'></i> Đang tải lên">Lưu</button>
					<button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
				</div>
			</div>
		</div>
	</form>
</div>

<div class="modal fade" id="modalViewMC" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-md" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h3 class="modal-title" id="tieuDeViewMc"></h3>
			</div>
			<div class="modal-body">
					<table class="table table-bordered">
						<thead>
							<th class="text-center" width="10%">STT</th>
							<th class="text-center">Tên minh chứng</th>
							<th class="text-center" width="12%">Tác vụ</th>
						</thead>
						<tbody id="bodyViewMC">
						</tbody>
					</table>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript" src="assets/plugins/js/ungvien/quatrinhdaotao.js?ver=1.0"></script>
