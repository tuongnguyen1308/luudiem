<div class="wrapper wrapper-content animated fadeInRight">
	<form action="" method="post" class="form-horizontal" enctype="multipart/form-data">
		<input type="hidden" name="{$csrf['name']}" value="{$csrf['hash']}" />
		<div class="row">
			<div class="col-md-12">
				<div class="ibox float-e-margins">
					<div class="ibox-title">
						<h5>5. Biên soạn sách phục vụ đào tạo đại học và sau đại học</h5>
						<div class="pull-right">
							<button type="button" class="btn btn-xs btn-primary" data-toggle="modal" data-target="#modalAdd">
								<i class="fa fa-plus-circle" aria-hidden="true"></i>
								Thêm sách
							</button>
						</div>
					</div>
					<div class="ibox-content">
						<div class="row">
							<div class="col-md-12 text-justify">
								<p>(Tách thành 2 giai đoạn: Đối với ứng viên chức danh PGS: Trước khi bảo vệ học vị TS và sau khi bảo vệ học vị TS; đối với ứng viên GS: Trước khi được công nhận chức danh PGS và sau khi được công nhận chức danh PGS)</p>
							</div>
						</div>
						<table class="table table-bordered">
							<thead>
								<th class="text-center" width="4%">TT</th>
								<th class="text-center">Tên sách</th>
								<th class="text-center" width="5%">Loại sách</th>
								<th class="text-center" width="7%">Số tác giả</th>
								<th class="text-center" width="7%">Số điểm</th>
								<th class="text-center" width="7%">Số điểm ba năm cuối</th>
								<th class="text-center" width="13%">
									Viết một mình hoặc chủ biên, phần biên soạn
								</th>
								<th class="text-center" width="17%">
									Xác nhận của CSGDĐH (Số văn bản xác nhận sử dụng sách)
								</th>
								<th class="text-center" width="11%">Minh chứng</th>
								<th class="text-center" width="7%">Tác vụ</th>
							</thead>
							<tbody>
							{if !empty($listBook)}
								{$stt = 1}
								{foreach $listGiaiDoan as $key => $value}
									{if isset($listBook[$value['PK_iMaGiaiDoan']])}
										<tr>
											<td colspan="9">
												{$value.sTenGiaiDoan}
												{if ($chucDanhHienTai == 1)}
													khi được công nhận chức danh PGS
												{elseif ($chucDanhHienTai == 2)}
													khi bảo vệ học vị tiến sĩ
												{/if}
											</td>
										</tr>
										{foreach $listBook[$value['PK_iMaGiaiDoan']] as $k => $v}
											<tr>
												<td class="text-center">{$stt++}</td>
												<td>
													{if !empty($v.sLinkSach)}
														<a href="{$v.sLinkSach}" target="_blank">
															{$v.sTenSach}
														</a>
													{else}
														{$v.sTenSach}
													{/if}
												</td>
												<td class="text-center">{$v.sVietTatLS}</td>
												<td>
													{$v.sNhaXuatBan}, năm {$v.sNamXuatBan}
												</td>
												<td class="text-center">
													{$v.iSoTacGia}
												</td>
												<td class="text-center">
													{$v.sVaiTro}
													{if $v.sTrangBienSoan}({$v.sTrangBienSoan}){/if}
												</td>
												<td class="text-center">{$v.sSoVBXacNhan}</td>
												<td class="text-center">
													<a class="viewMC" data-link="{$v.sFile}" data-name="{$v.sTenTaiLen}" data-masach="{$v.PK_iMaSach}" data-toggle="modal" data-target="#modalViewMC">{if !empty($v.sFile)}{count(explode('|', $v.sFile))}{else}0{/if} minh chứng</a>
												</td>
												<td class="text-center">
													<button type="button" class="btn btn-xs btn-warning" title="Sửa thông tin sách phục vụ đào tạo" name="btnFix" value="{$v.PK_iMaSach}" data-toggle="modal" data-target="#modalFix">
														<i class="fa fa-pencil-square-o" aria-hidden="true"></i>
													</button>
													<button type="submit" class="btn btn-xs btn-danger" title="Xoá sách phục vụ đào tạo" name="btnDeleteSach" value="{$v.PK_iMaSach}" onclick="return confirm('Bạn chắc chắn muốn xoá sách này?');">
														<i class="fa fa-trash-o" aria-hidden="true"></i>
													</button>
												</td>
											</tr>
										{/foreach}
									{/if}
								{/foreach}
							{else}
								<td colspan="9">Không có dữ liệu</td>
							{/if}
							</tbody>
						</table>
						<div class="row">
							<div class="col-md-12 text-justify">
								<p>- Trong đó, sách chuyên khảo xuất bản ở NXB uy tín trên thế giới sau khi được công nhận PGS (đối với ứng viên chức danh GS) hoặc cấp bằng TS (đối với ứng viên chức danh PGS): <strong>{$soLuongUyTinGDSau}</strong></p>
								<p><strong>Các chữ viết tắt:</strong> CK: sách chuyên khảo; GT: sách giáo trình; TK: sách tham khảo; HD: sách hướng dẫn; MM: viết một mình; CB: chủ biên; phần ứng viên biên soạn đánh dấu từ trang ... đến trang ... (ví dụ: 17-56; 145-329).</p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</form>
	<input type="hidden" name="maMC" value="{$maMC}">
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
					<h3 class="modal-title">Bổ sung sách phục vụ đào tạo đại học và sau đại học</h3>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="form-group">
							<label class="col-md-4 control-label-left">
								Giai đoạn viết sách
								<span class="text-danger">*</span>
							</label>
							<div class="col-md-8">
								{foreach $listGiaiDoan as $k => $v}
									<label class="checkbox-inline i-checks">
										<input type="radio" value="{$v.PK_iMaGiaiDoan}" name="giaiDoan" required> {$v.sTenGiaiDoan}
										{if ($chucDanhHienTai == 1)}
											PGS
										{elseif ($chucDanhHienTai == 2)}
											TS
										{/if}
									</label>
								{/foreach}
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-4 control-label-left">
								Tên sách
								<span class="text-danger">*</span>
							</label>
							<div class="col-md-8">
								<input type="text" name="tenSach" class="form-control" required>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-4 control-label-left">
								Loại sách
								<span class="text-danger">*</span>
							</label>
							<div class="col-md-8">
								<select class="form-control" name="loaiSach" required>
									<option value="">--- Chọn loại sách ---</option>
									{foreach $listLoaiSach as $k => $v}
										<option value="{$v.PK_iMaLoaiSach}">{$v.sTenLoaiSach}</option>
									{/foreach}
								</select>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-4 control-label-left">
								Tên nhà xuất bản
								<span class="text-danger">*</span>
							</label>
							<div class="col-md-8">
								<input type="text" name="tenNhaXuatBan" class="form-control" required>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-4 control-label-left">
								Năm xuất bản
								<span class="text-danger">*</span>
							</label>
							<div class="col-md-8">
								<input type="text" name="namXuatBan" class="form-control" maxlength="4" required>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-4 control-label-left">
								Nhà xuất bản uy tín
								<span class="text-danger">*</span>
							</label>
							<div class="col-md-8">
								<label class="checkbox-inline i-checks">
									<input type="radio" value="Uy tín" name="nxbUyTin" required> Uy tín
								</label>
								<label class="checkbox-inline i-checks">
									<input type="radio" value="Không uy tín" name="nxbUyTin" required> Không uy tín
								</label>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-4 control-label-left">
								Số lượng tác giả
								<span class="text-danger">*</span>
							</label>
							<div class="col-md-8">
								<input type="number" name="soTacGia" class="form-control" required>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-4 control-label-left">
								Tên các tác giả
								<span class="text-danger">*</span>
							</label>
							<div class="col-md-8">
								<textarea name="tenTacGia" class="form-control" required></textarea>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-4 control-label-left">
								Vai trò
								<span class="text-danger">*</span>
							</label>
							<div class="col-md-8">
								<label class="checkbox-inline i-checks">
									<input type="radio" value="MM" name="vaiTro" required> Viết một mình
								</label>
								<label class="checkbox-inline i-checks">
									<input type="radio" value="CB" name="vaiTro" required> Chủ biên
								</label>
								<label class="checkbox-inline i-checks">
									<input type="radio" value="Phần biên soạn" name="vaiTro" required> Phần biên soạn
								</label>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-4 control-label-left">
								Chỉ số ISBN
							</label>
							<div class="col-md-8">
								<input type="text" name="chiSoISBN" class="form-control">
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-4 control-label-left">
								Phần biên soạn
							</label>
							<div class="col-md-8">
								<input type="text" name="trangBienSoan" class="form-control">
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-4">
								Số văn bản xác nhận sử dụng sách
							</label>
							<div class="col-md-8">
								<input type="text" name="soVBXacNhan" class="form-control">
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-4">
								Link sách
							</label>
							<div class="col-md-8">
								<input type="text" name="linkSach" class="form-control">
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-4 control-label-left">
								Là công trình tiêu biểu
							</label>
							<div class="col-md-8">
								<label class="checkbox-inline i-checks text-bold">
									<input type="checkbox" value="Có" name="congTrinhTieuBieu">
								</label>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-4 control-label-left">
								Minh chứng
								<span class="text-danger">*</span>
							</label>
							<div class="col-md-8">
								<input type="file" name="{$maMC}[]" class="form-control" multiple accept=".pdf, .doc, .docx, .zip, .rar, .png, .jpg" required>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-primary" name="btnSave" value="ok" data-loading-text="<i class='fa fa-spinner fa-spin'></i> Đang tải lên">Lưu</button>
					<button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
				</div>
			</div>
		</div>
	</form>
</div>

<div class="modal fade" id="modalFix" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
	<form action="" method="POST" class="form-horizontal">
		<input type="hidden" name="{$csrf['name']}" value="{$csrf['hash']}" />
		<div class="modal-dialog modal-md" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
					<h3 class="modal-title">Chỉnh sửa thông tin sách phục vụ đào tạo</h3>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="form-group">
							<label class="col-md-4 control-label-left">
								Giai đoạn viết sách
								<span class="text-danger">*</span>
							</label>
							<div class="col-md-8">
								{foreach $listGiaiDoan as $k => $v}
									<label class="checkbox-inline i-checks">
										<input type="radio" value="{$v.PK_iMaGiaiDoan}" name="giaiDoan_fix" required> {$v.sTenGiaiDoan}
										{if ($chucDanhHienTai == 1)}
											PGS
										{elseif ($chucDanhHienTai == 2)}
											TS
										{/if}
									</label>
								{/foreach}
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-4 control-label-left">
								Tên sách
								<span class="text-danger">*</span>
							</label>
							<div class="col-md-8">
								<input type="text" name="tenSach_fix" class="form-control" required>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-4 control-label-left">
								Loại sách
								<span class="text-danger">*</span>
							</label>
							<div class="col-md-8">
								<select class="form-control" name="loaiSach_fix" required>
									<option value="">--- Chọn loại sách ---</option>
									{foreach $listLoaiSach as $k => $v}
										<option value="{$v.PK_iMaLoaiSach}">{$v.sTenLoaiSach}</option>
									{/foreach}
								</select>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-4 control-label-left">
								Tên nhà xuất bản
								<span class="text-danger">*</span>
							</label>
							<div class="col-md-8">
								<input type="text" name="tenNhaXuatBan_fix" class="form-control" required>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-4 control-label-left">
								Năm xuất bản
								<span class="text-danger">*</span>
							</label>
							<div class="col-md-8">
								<input type="text" name="namXuatBan_fix" class="form-control" maxlength="4" required>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-4 control-label-left">
								Nhà xuất bản uy tín
								<span class="text-danger">*</span>
							</label>
							<div class="col-md-8">
								<label class="checkbox-inline i-checks">
									<input type="radio" value="Uy tín" name="nxbUyTin_fix" required> Uy tín
								</label>
								<label class="checkbox-inline i-checks">
									<input type="radio" value="Không uy tín" name="nxbUyTin_fix" required> Không uy tín
								</label>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-4 control-label-left">
								Số lượng tác giả
								<span class="text-danger">*</span>
							</label>
							<div class="col-md-8">
								<input type="number" name="soTacGia_fix" class="form-control" required>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-4 control-label-left">
								Tên các tác giả
								<span class="text-danger">*</span>
							</label>
							<div class="col-md-8">
								<textarea name="tenTacGia_fix" class="form-control" required></textarea>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-4 control-label-left">
								Vai trò
								<span class="text-danger">*</span>
							</label>
							<div class="col-md-8">
								<label class="checkbox-inline i-checks">
									<input type="radio" value="MM" name="vaiTro_fix" required> Viết một mình
								</label>
								<label class="checkbox-inline i-checks">
									<input type="radio" value="CB" name="vaiTro_fix" required> Chủ biên
								</label>
								<label class="checkbox-inline i-checks">
									<input type="radio" value="Phần biên soạn" name="vaiTro_fix" required> Phần biên soạn
								</label>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-4 control-label-left">
								Chỉ số ISBN
							</label>
							<div class="col-md-8">
								<input type="text" name="chiSoISBN_fix" class="form-control">
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-4 control-label-left">
								Phần biên soạn
							</label>
							<div class="col-md-8">
								<input type="text" name="trangBienSoan_fix" class="form-control">
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-4">
								Số văn bản xác nhận sử dụng sách
							</label>
							<div class="col-md-8">
								<input type="text" name="soVBXacNhan_fix" class="form-control">
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-4">
								Link sách
							</label>
							<div class="col-md-8">
								<input type="text" name="linkSach_fix" class="form-control">
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-4 control-label-left">
								Là công trình tiêu biểu
							</label>
							<div class="col-md-8">
								<label class="checkbox-inline i-checks text-bold">
									<input type="checkbox" value="Có" name="congTrinhTieuBieu_fix">
								</label>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-primary" name="btnSaveUpdateSach" value="ok" data-loading-text="<i class='fa fa-spinner fa-spin'></i> Đang tải lên">Lưu</button>
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
					<div class="form-group">
						<div class="col-md-7 col-sm-12">
							<input type="file" name="{$maMC}[]" class="form-control" multiple accept=".pdf, .doc, .docx, .zip, .rar, .png, .jpg">
						</div>
						<div class="col-md-2 col-sm-6">
							<button type="submit" class="btn btn-sm btn-primary" name="btnBoSungMC" value="ok" data-loading-text="<i class='fa fa-spinner fa-spin'></i> Đang tải">
								<i class="fa fa-upload" aria-hidden="true"></i> Bổ sung
							</button>
						</div>
						<div class="col-md-3 col-sm-6">
							<button type="submit" class="btn btn-sm btn-danger pull-right" name="btnDeleteAllMC" value="ok" data-loading-text="Loading...">
								<i class="fa fa-trash-o" aria-hidden="true"></i> Xoá toàn bộ
							</button>
						</div>
					</div>
					<table class="table table-bordered">
						<thead>
							<th class="text-center" width="9%">STT</th>
							<th class="text-center">Tên minh chứng</th>
							<th class="text-center" width="12%">Tác vụ</th>
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
<script type="text/javascript" src="assets/plugins/js/ungvien/sachphucvudaotao.js?ver=1.0"></script>