<div class="wrapper wrapper-content animated fadeInRight">
	<div class="row">
		<div class="ibox float-e-margins">
			<div class="ibox-title">
				<h5>Danh sách ứng viên đã được thẩm định</h5>
			</div>
			<div class="ibox-content">
				<form action="" method="post" class="form-horizontal">
					<input type="hidden" name="{$csrf['name']}" value="{$csrf['hash']}" />
					<div class="row">
						<div class="col-md-12">
							<table class="table table-bordered datatable">
								<thead>
									<th class="text-center">TT</th>
									<th class="text-center" width="18%">Họ và tên</th>
									<th class="text-center">Ngày sinh</th>
									<th class="text-center">Số điện thoại</th>
									<th class="text-center">Đánh giá</th>
									<th class="text-center">Nhận xét</th>
									<th class="text-center">Trạng thái</th>
									<th class="text-center" width="15%">Tác vụ</th>
								</thead>
								<tbody>
									{if !empty($listungvien)}
										{foreach $listungvien as $k => $v}
											{if $danhgia[$v.PK_iMaUV]!=NULL && $nhanxet[$v.PK_iMaUV] !=NULL}
												<tr>
													<td class="text-center">{$k+1}</td>
													<td>{$v.sHoTen}</td>
													<td class="text-center">{$v.sNgaySinh}</td>
													<td class="text-center">{$v.sDienThoaiDiDong}</td>
													<td>{$danhgia[$v.PK_iMaUV]}</td>
													<td>
														{$nhanxet[$v.PK_iMaUV]}
													</td>
													<td class="text-center">
														<span class="label label-primary">Đã thẩm định</span>
													</td>
													<td class="text-center">
														{$time = "{$thoigiandangky[$v.PK_iMaUV]}{$landangnhapcuoi[$v.PK_iMaUV]}"}
														<a href="{$url}bandangky?id={sha1($v.PK_iMaUV)}&token={sha1(md5($time))}" target="_blank" class="btn btn-xs btn-primary" title="Xem bản đăng ký ứng viên">
															<i class="fa fa-eye" aria-hidden="true"></i>
														</a>
														<button type="button" class="btn btn-xs btn-primary" name="btnViewMinhChung" value="{$v.PK_iMaUV}" title="Xem danh sách minh chứng của ứng viên" data-toggle="modal" data-target="#modalViewMc">
															<i class="fa fa-list-alt" aria-hidden="true"></i>
														</button>
														<a href="{$url}thamdinh?id={$v.PK_iMaUV}" target="_blank" class="btn btn-xs btn-primary" title="Thẩm định">
															Thẩm định
														</a>
													</td>
												</tr>
											{/if}
										{/foreach}
									{else}
										<td colspan="8">Không có dữ liệu</td>
									{/if}
								</tbody>
							</table>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="ibox float-e-margins">
			<div class="ibox-title">
				<h5>Danh sách ứng viên chưa thẩm định</h5>
			</div>
			<div class="ibox-content">
				<form action="" method="post" class="form-horizontal">
					<input type="hidden" name="{$csrf['name']}" value="{$csrf['hash']}" />
					<div class="row">
						<div class="col-md-12">
							<table class="table table-bordered datatable">
								<thead>
									<th class="text-center">TT</th>
									<th class="text-center" width="18%">Họ và tên</th>
									<th class="text-center">Ngày sinh</th>
									<th class="text-center">Số điện thoại</th>
									<th class="text-center">Đánh giá</th>
									<th class="text-center">Nhận xét</th>
									<th class="text-center">Trạng thái</th>
									<th class="text-center" width="15%">Tác vụ</th>
								</thead>
								<tbody>
									{if !empty($listungvien)}
										{foreach $listungvien as $k => $v}
											{if $danhgia[$v.PK_iMaUV]==NULL || $nhanxet[$v.PK_iMaUV] ==NULL}
												<tr>
													<td class="text-center">{$k+1}</td>
													<td>{$v.sHoTen}</td>
													<td class="text-center">{$v.sNgaySinh}</td>
													<td class="text-center">{$v.sDienThoaiDiDong}</td>
													<td>{$danhgia[$v.PK_iMaUV]}</td>
													<td>
														{$nhanxet[$v.PK_iMaUV]}
													</td>
													<td class="text-center">
														<span class="label label-danger">Chưa Thẩm định</span>
													</td>
													<td class="text-center">
														{$time = "{$thoigiandangky[$v.PK_iMaUV]}{$landangnhapcuoi[$v.PK_iMaUV]}"}
														<a href="{$url}bandangky?id={sha1($v.PK_iMaUV)}&token={sha1(md5($time))}" target="_blank" class="btn btn-xs btn-primary" title="Xem bản đăng ký ứng viên">
															<i class="fa fa-eye" aria-hidden="true"></i>
														</a>
														<button type="button" class="btn btn-xs btn-primary" name="btnViewMinhChung" value="{$v.PK_iMaUV}" title="Xem danh sách minh chứng của ứng viên" data-toggle="modal" data-target="#modalViewMc">
															<i class="fa fa-list-alt" aria-hidden="true"></i>
														</button>
														<a href="{$url}review_book?id={$v.PK_iMaUV}" target="_blank" class="btn btn-xs btn-primary" title="Thẩm định">
															Thẩm định
														</a>
													</td>
												</tr>
											{/if}
										{/foreach}
									{else}
										<td colspan="8">Không có dữ liệu</td>
									{/if}
								</tbody>
							</table>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<!-- Modal View MC -->
<div class="modal fade" id="modalViewMc" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
	<form action="" method="POST" class="form-horizontal" enctype="multipart/form-data">
		<input type="hidden" name="{$csrf['name']}" value="{$csrf['hash']}" />
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header text-center">
					<h2 class="modal-title" id="titleMinhChung">Danh sách minh chứng</h2>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-md-12" id="contentListMinhChung">
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
				</div>
			</div>
		</div>
	</form>
</div>
<script type="text/javascript" src="assets/plugins/js/uyvien/dsungviendathamdinh.js?ver=1.0"></script>