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
								<h4>3. Thời gian thực hiện nhiệm vụ đào tạo từ trình độ đại học trở lên</h4>
							</div>
							<div class="col-12 col-md-4">
								<label for="iTongSoTG" class="col-form-label font-weight-bold">Tổng số thời gian [8]:</label>
								<input type="text" min="0" class="form-control" name="iTongSoTG" id="iTongSoTG" required value="{(!empty($tongSoNam))? $tongSoNam['sTongSoNam'] : ''}">
							</div>
						</div>
						<div class="row">
							<div class="col-12 col-md-12">
								<label for="iTongSoThoiGian" class="col-form-label font-weight-bold">Trong 06 năm ứng viên đã kê khai, trong đó có 03 năm cuối [9, 10, 11]:</label>
								<table class="table table-striped table-inverse table-responsive table-bordered dataTable no-footer" width="100%">
									<thead>
										<tr>
											<th>TT</th>
											<th>Năm học</th>
											<th>Số giờ trực tiếp trên lớp</th>
											<th>Số giờ chuẩn giảng dạy</th>
											<th>Đánh giá</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td scope="row">1</td>
											<td>
												<input type="hidden" name="data[0][]" value="{(!empty($muc3))?$muc3.0.PK_iMaMuc3:''}">
												<input type="text"  class="form-control" required name="data[0][]" value="{(!empty($muc3))?$muc3.0.sNamHoc:''}">
											</td>
											<td>
												<input type="text" class="form-control" required name="data[0][]" value="{(!empty($muc3))?$muc3.0.iSoGioTrucTiep:''}">
											</td>
											<td>
												<input type="text"  class="form-control" required name="data[0][]" value="{(!empty($muc3))?$muc3.0.iSoGioChuan:''}">
											</td>
											<td>
												<select class="form-control" name="data[0][]" required>
													<option value="">--Đánh giá--</option>
													<option value="du" {(!empty($muc3) && $muc3.0.sDanhGia == 'du')?'selected':''}>Đủ</option>
													<option value="khongdu" {(!empty($muc3) && $muc3.0.sDanhGia == 'khongdu')?'selected':''}>Không đủ</option>
												</select>
											</td>
										</tr>
										<tr>
											<td scope="row">2</td>
											<td>
												<input type="hidden" name="data[1][]" value="{(!empty($muc3))?$muc3.1.PK_iMaMuc3:''}">
												<input type="text"  class="form-control" required name="data[1][]" value="{(!empty($muc3))?$muc3.1.sNamHoc:''}">
											</td>
											<td>
												<input type="text" class="form-control" required name="data[1][]" value="{(!empty($muc3))?$muc3.1.iSoGioTrucTiep:''}">
											</td>
											<td>
												<input type="text"  class="form-control" required name="data[1][]" value="{(!empty($muc3))?$muc3.1.iSoGioChuan:''}">
											</td>
											<td>
												<select class="form-control" name="data[1][]" required>
													<option value="">--Đánh giá--</option>
													<option value="du" {(!empty($muc3) && $muc3.1.sDanhGia == 'du')?'selected':''}>Đủ</option>
													<option value="khongdu" {(!empty($muc3) && $muc3.1.sDanhGia == 'khongdu')?'selected':''}>Không đủ</option>
												</select>
											</td>
										</tr>
										<tr>
											<td scope="row">3</td>
											<td>
												<input type="hidden" name="data[2][]" value="{(!empty($muc3))?$muc3.2.PK_iMaMuc3:''}">
												<input type="text" class="form-control" required name="data[2][]" value="{(!empty($muc3))?$muc3.2.sNamHoc:''}">
											</td>
											<td>
												<input type="text" class="form-control" required name="data[2][]" value="{(!empty($muc3))?$muc3.2.iSoGioTrucTiep:''}">
											</td>
											<td>
												<input type="text" class="form-control" required name="data[2][]" value="{(!empty($muc3))?$muc3.2.iSoGioChuan:''}">
											</td>
											<td>
												<select class="form-control" name="data[2][]" required>
													<option value="">--Đánh giá--</option>
													<option value="du" {(!empty($muc3) && $muc3.2.sDanhGia == 'du')?'selected':''}>Đủ</option>
													<option value="khongdu" {(!empty($muc3) && $muc3.2.sDanhGia == 'khongdu')?'selected':''}>Không đủ</option>
												</select>
											</td>
										</tr>
										<tr>
											<td scope="row">4</td>
											<td>
												<input type="hidden" name="data[3][]" value="{(!empty($muc3))?$muc3.3.PK_iMaMuc3:''}">
												<input type="text" class="form-control" required name="data[3][]" value="{(!empty($muc3))?$muc3.3.sNamHoc:''}">
											</td>
											<td>
												<input type="text" class="form-control" required name="data[3][]" value="{(!empty($muc3))?$muc3.3.iSoGioTrucTiep:''}">
											</td>
											<td>
												<input type="text" class="form-control" required name="data[3][]" value="{(!empty($muc3))?$muc3.3.iSoGioChuan:''}">
											</td>
											<td>
												<select class="form-control" name="data[3][]" required>
													<option value="">--Đánh giá--</option>
													<option value="du" {(!empty($muc3) && $muc3.3.sDanhGia == 'du')?'selected':''}>Đủ</option>
													<option value="khongdu" {(!empty($muc3) && $muc3.3.sDanhGia == 'khongdu')?'selected':''}>Không đủ</option>
												</select>
											</td>
										</tr>
										<tr>
											<td scope="row">5</td>
											<td>
												<input type="hidden" name="data[4][]" value="{(!empty($muc3))?$muc3.4.PK_iMaMuc3:''}">
												<input type="text" class="form-control" required name="data[4][]" value="{(!empty($muc3))?$muc3.4.sNamHoc:''}">
											</td>
											<td>
												<input type="text" class="form-control" required name="data[4][]" value="{(!empty($muc3))?$muc3.4.iSoGioTrucTiep:''}">
											</td>
											<td>
												<input type="text" class="form-control" required name="data[4][]" value="{(!empty($muc3))?$muc3.4.iSoGioChuan:''}">
											</td>
											<td>
												<select class="form-control" name="data[4][]" required>
													<option value="">--Đánh giá--</option>
													<option value="du" {(!empty($muc3) && $muc3.4.sDanhGia == 'du')?'selected':''}>Đủ</option>
													<option value="khongdu" {(!empty($muc3) && $muc3.4.sDanhGia == 'khongdu')?'selected':''}>Không đủ</option>
												</select>
											</td>
										</tr>
										<tr>
											<td scope="row">6</td>
											<td>
												<input type="hidden" name="data[5][]" value="{(!empty($muc3))?$muc3.5.PK_iMaMuc3:''}">
												<input type="text" class="form-control" required name="data[5][]" value="{(!empty($muc3))?$muc3.5.sNamHoc:''}">
											</td>
											<td>
												<input type="text" class="form-control" required name="data[5][]" value="{(!empty($muc3))?$muc3.5.iSoGioTrucTiep:''}">
											</td>
											<td>
												<input type="text" class="form-control" required name="data[5][]" value="{(!empty($muc3))?$muc3.5.iSoGioChuan:''}">
											</td>
											<td>
												<select class="form-control" name="data[5][]" required>
													<option value="">--Đánh giá--</option>
													<option value="du" {(!empty($muc3) && $muc3.5.sDanhGia == 'du')?'selected':''}>Đủ</option>
													<option value="khongdu" {(!empty($muc3) && $muc3.5.sDanhGia == 'khongdu')?'selected':''}>Không đủ</option>
												</select>
											</td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
						

						<div class="row">
							<div class="col-12 mt-3 text-center">
								{if !empty($id)}
								<button name="updatemuc3" id="updatemuc3" type="submit" class="btn btn-primary" value="1" data-loading-text="<i class='fa fa-spinner fa-spin'></i> Đang lưu">Thẩm định</button>
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
		if($('#FK_iMaCD').val() == 2) {
			$('#ngaycongnhanPGS').toggle();
		}
        $('.feature').each(function (k, v){
            $(v).css("background-color", getRandomColor());
        });
		$('#FK_iMaCD').on('change', () => {
			$('#ngaycongnhanPGS').toggle();
		});
    });
</script>
