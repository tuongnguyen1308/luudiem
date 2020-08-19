<div class="wrapper wrapper-content animated fadeInRight">
	<form action="" method="post" class="form-horizontal" enctype="multipart/form-data">
		<input type="hidden" name="{$csrf['name']}" value="{$csrf['hash']}" />
		<div class="row">
			<div class="col-md-12">
				<div class="ibox float-e-margins">
					<div class="ibox-title">
						<h5>Danh sách sách phục vụ đào tạo đại học và sau đại học</h5>
					</div>
					<div class="ibox-content">
						<table class="table table-bordered">
							<thead>
								<th class="text-center" width="4%">TT</th>
								<th class="text-center">Tên sách</th>
								<th class="text-center">Loại sách</th>
								<th class="text-center">Nhà xuất bản và năm xuất bản</th>
								<th class="text-center">Nhà xuất uy tín</th>
								<th class="text-center">Số tác giả</th>
								<th class="text-center">Chỉ số ISBN</th>
								<th class="text-center">
									Viết một mình hoặc chủ biên, phần biên soạn
								</th>
								<th class="text-center" width="11%">
									Xác nhận của CSGDĐH (Số văn bản xác nhận sử dụng sách)
								</th>
								<th class="text-center" width="11%">Minh chứng</th>
								<th class="text-center" width="9%">Điểm</th>
							</thead>
							<tbody>
							
							{if !empty($listBook)}
								{$stt = 1}
								{$tongDiem = 0}
								{foreach $listGiaiDoan as $key => $value}
									{if isset($listBook[$value['PK_iMaGiaiDoan']])}
										<tr>
											<td colspan="11">
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
												<td class="text-center" rowspan="2">{$stt++}</td>
												<td>{$v.sTenSach}</td>
												<td class="text-center">{$v.sVietTatLS}</td>
												<td>
													{$v.sNhaXuatBan}, năm {$v.sNamXuatBan}
												</td>
												<td class="text-center">
													{$v.sNXBUyTin}
												</td>
												<td class="text-center">
													{$v.iSoTacGia}
												</td>
												<td class="text-center">
													{$v.sChiSoISBN}
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
													<input type="text" value="{if !empty($thongTinThamDinh[$k])}{$thongTinThamDinh[$k].fDiemSach}{else}0{/if}" name="diemSach[]" class="form-control allownumericwithdecimal">
												</td>
												{if !empty($thongTinThamDinh[$k])}{$tongDiem = $tongDiem + $thongTinThamDinh[$k].fDiemSach}{/if}
											</tr>
											<tr>
												<input type="hidden" name="maSach[]" value="{$v.PK_iMaSach}">
											</tr>
										{/foreach}
									{/if}
								{/foreach}
								
								<tr>
									<td class="text-right" colspan="10">
										Tổng điểm
									</td>
									<td>
										<input type="text" value={$tongDiem} name="tongDiem" class="form-control" disabled>
									</td>
								</tr>
							{else}
								<td colspan="9">Không có dữ liệu</td>
							{/if}
							</tbody>
						</table>
						<p class="text-right">
							<button type="submit" value="btnSaveReviewBook" name="btnSaveReviewBook" class="btn btn-primary" data-loading-text="<i class='fa fa-spinner fa-spin'></i> Đang lưu" title="Thẩm định">Lưu</button>
						</p>
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

<!-- <div class="wrapper wrapper-content animated fadeInRight">
	<form action="" method="post" class="form-horizontal" enctype="multipart/form-data">
		<input type="hidden" name="{$csrf['name']}" value="{$csrf['hash']}" />
		<div class="row">
			<div class="col-md-12">
				<div class="ibox float-e-margins">
					<div class="ibox-title">
						<h5>Thẩm định Kết quả viết sách</h5>
					</div>
					<div class="ibox-content">						
						<table class="table table-bordered">
							<thead>
								<tr>
									<td class="text-center" rowspan="2" colspan="2">Loại sách</td>
									<td class="text-center" colspan="2">Cả quá trình</td>
									<td class="text-center" colspan="2">3 năm cuối</td>
								</tr>
								<tr>
									<td class="text-center" width="17%">Số quyển</td>
									<td class="text-center" width="17%">Số tác giả</td>
									<td class="text-center" width="17%">Số quyển</td>
									<td class="text-center" width="17%">Số tác giả</td>
								</tr>
							</thead>
							<tbody>	
									<tr>
										<td rowspan="4" width="20%">Sách chuyên khảo (22)</td>
									</tr>
										<tr>
										<td class="text-center" width="15%">Viết một mình</td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										</tr>
									<tr> 
										<td class="text-center" width="15%">Chủ Biên</td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
									</tr>
									<tr> 
										<td class="text-center" width="15%">Viết chung</td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
									</tr>		

									<tr>
										<td rowspan="4" width="20%">Giáo trình ĐH,SĐH (23)</td>
									</tr>
										<tr>
											<td class="text-center" width="15%">Vừa chủ biên vừa tham gia</td>
											<td></td>
											<td></td>
											<td></td>
											<td></td>
										</tr>
									<tr> 
										<td class="text-center" width="15%">Chủ Biên</td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
									</tr>
									<tr> 
										<td class="text-center" width="15%">Viết chung</td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
									</tr>				

									<tr>
										<td colspan="2" width="20%" class="text-center">Sách tham khảo (24)</td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
									</tr>
									<tr>
										<td colspan="2" width="20%" class="text-center">Sách hướng dẫn (25)</td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
									</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</form>
	<input type="hidden" name="maMC" value="{$maMC}">
</div> -->
<!--  -->

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


<div class="modal fade" id="modalReview" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
	<form action="" method="POST" class="form-horizontal">
		<input type="hidden" name="{$csrf['name']}" value="{$csrf['hash']}" />
		<div class="modal-dialog modal-md" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
					<h3 class="modal-title">Thẩm định thông tin sách phục vụ đào tạo</h3>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="form-group">
							<input type="hidden" name="maSach">
							<label class="col-md-4 control-label-left">
								Tên sách
								<span class="text-danger">*</span>
							</label>
							<div class="col-md-8">
								<input type="text" name="tenSach_fix" class="form-control" disabled>
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
								3 năm cuối
								<span class="text-danger">*</span>
							</label>
							<div class="col-md-8">
								<label class="checkbox-inline i-checks">
									<input type="radio" value="3NamCuoi" name="3namcuoi" required> Đúng
								</label>
								<label class="checkbox-inline i-checks">
									<input type="radio" value="KP3NamCuoi" name="3namcuoi" required> Còn nghi vấn
								</label>
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label-left">
								Điểm
							</label>
							<div class="col-md-2">
								<input type="text" name="diemSach" class="form-control">
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-primary" name="btnSaveScore" data-loading-text="<i class='fa fa-spinner fa-spin'></i> Đang tải lên">Lưu</button>
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
						
					</div>
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
<script type="text/javascript" src="assets/plugins/js/uyvien/thamdinhsachphucvudaotao.js?ver=1.0"></script>