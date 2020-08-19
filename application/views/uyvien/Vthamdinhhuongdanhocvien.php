<div class="wrapper wrapper-content animated fadeInRight">
	<form action="" method="post" class="form-horizontal" enctype="multipart/form-data">
		<input type="hidden" name="{$csrf['name']}" value="{$csrf['hash']}" />
		<div class="row">
			<div class="col-md-12">
				<div class="ibox float-e-margins">
					<div class="ibox-title">
						<h5>Danh sách học viên cao học và nghiên cứu sinh</h5>
					</div>
					<div class="ibox-content">
						<table class="table table-bordered">
							<thead>
								<tr>
									<th class="text-center" rowspan="2" width="4%">TT</th>
									<th class="text-center" rowspan="2">Họ tên NCS hoặc HV</th>
									<th class="text-center" colspan="2">Đối tượng</th>
									<th class="text-center" colspan="2">Trách nhiệm HD</th>
									<th class="text-center" rowspan="2" width="20%">Thời gian hướng dẫn</th>
									<th class="text-center" rowspan="2" width="10%">Cơ sở đào tạo</th>
									<th class="text-center" rowspan="2" width="10%">Năm được cấp bằng/có quyết định cấp bằng</th>
									<th class="text-center" rowspan="2" width="11%">Minh chứng</th>
									<th class="text-center" rowspan="2" width="7%">Tác vụ</th>
								</tr>
								<tr>
									<th class="text-center" width="5%">NCS</th>
									<th class="text-center" width="5%">HV</th>
									<th class="text-center" width="6%">Chính</th>
									<th class="text-center" width="5%">Phụ</th>
								</tr>
							</thead>
							{if !empty($listStudent)}
							<tbody>
								{foreach $listStudent as $k => $v}
									<tr>
										<td class="text-center">{$k+1}</td>
										<td>{$v.sTenHocVien}</td>
										<td class="text-center">{if $v.sDoiTuong == 'NCS'}X{/if}</td>
										<td class="text-center">{if $v.sDoiTuong == 'HV'}X{/if}</td>
										<td class="text-center">
											{if $v.sTrachNhiemHD == 'Chính'}X{/if}
										</td>
										<td class="text-center">
											{if $v.sTrachNhiemHD == 'Phụ'}X{/if}
										</td>
										<td class="text-center">
											{$v.sThoiGianBDHD} đến {$v.sThoiGianKTHD}
										</td>
										<td>{$v.sCoSoDaoTao}</td>
										<td class="text-center">{$v.sNamCapBang}</td>
										<td class="text-center">
											<a class="viewMC" data-link="{$v.sFile}" data-name="{$v.sTenTaiLen}" data-mahocvien="{$v.PK_iMaHocVien}" data-toggle="modal" data-target="#modalViewMC">{if !empty($v.sFile)}{count(explode('|', $v.sFile))}{else}0{/if} minh chứng</a>
										</td>
										<td class="text-center">
											<button type="button" class="btn btn-xs btn-success" title="Thẩm định thông tin HVCH/NCS" name="btnFixNCS" value="{$v.PK_iMaHocVien}" data-toggle="modal" data-target="#modalFixNCS">
												Thẩm định
											</button>
										</td>
									</tr>
								{/foreach}
							</tbody>
							{else}
								<td colspan="11">Không có dữ liệu</td>
							{/if}
						</table>
					</div>
				</div>
			</div>
		</div>
	</form>
	<input type="hidden" name="maMC" value="{$maMC}">
</div>

<div class="modal fade" id="modalFixNCS" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
	<form action="" method="POST" class="form-horizontal">
		<input type="hidden" name="{$csrf['name']}" value="{$csrf['hash']}" />
		<div class="modal-dialog modal-md" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
					<h3 class="modal-title">Thẩm định thông tin học viên/nghiên cứu sinh</h3>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="form-group">
							<label class="col-md-4">
								Họ và tên học viên cao học/nghiên cứu sinh
								<span class="text-danger">*</span>
							</label>
							<div class="col-md-8">
								<input type="text" name="hoTenHocVien_fix" class="form-control" disabled>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-4 control-label-left">
								Đối tượng
								<span class="text-danger">*</span>
							</label>
							<div class="col-md-8">
								<label class="checkbox-inline i-checks">
									<input type="radio" value="NCS" name="doiTuong_fix"> NCS
								</label>
								<label class="checkbox-inline i-checks">
									<input type="radio" value="HV" name="doiTuong_fix" > HV
								</label>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-4 control-label-left">
								Trách nhiệm HD
								<span class="text-danger">*</span>
							</label>
							<div class="col-md-8">
								<label class="checkbox-inline i-checks">
									<input type="radio" value="Chính" name="trachNhiemHD_fix"> Chính
								</label>
								<label class="checkbox-inline i-checks">
									<input type="radio" value="Phụ" name="trachNhiemHD_fix"> Phụ
								</label>
							</div>
						</div>
						<div class="form-group">
						<label class="col-md-4 control-label-left">
							Ghi chú
						</label>
						<div class="col-md-8">
						<textarea name="ghiChu" class="form-control"></textarea>						
						</div>
						</div>
						
					</div>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-primary" name="btnSaveUpdateNCS" value="ok" data-loading-text="<i class='fa fa-spinner fa-spin'></i> Đang tải lên">Lưu</button>
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
				<form action="" method="POST" class="form-horizontal" enctype="multipart/form-data">
					<input type="hidden" name="{$csrf['name']}" value="{$csrf['hash']}" />
					<table class="table table-bordered">
						<thead>
							<th class="text-center" width="9%">STT</th>
							<th class="text-center">Tên minh chứng</th>
						</thead>
						<tbody id="bodyViewMC">
						</tbody>
					</table>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript" src="assets/plugins/js/uyvien/thamdinhhuongdanhocvien.js?ver=1.0"></script>