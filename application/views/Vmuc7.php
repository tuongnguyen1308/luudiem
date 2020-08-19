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
								<h4>7. Kết quả nghiên cứu khoa học và công nghệ; sáng chế, giải pháp hữu ích; giải thưởng quốc gia, quốc tế</h4>
							</div>
							<div class="col-12 col-md-12">
								<label class="col-form-label font-weight-bold">a) Kết quả chung</label>
								<table class="table table-inverse table-responsive table-bordered dataTable no-footer" width="100%">
									<thead>
										<tr>
											<th rowspan="2">Các bài báo KH, sáng chế, giải thưởng(*)</th>
											<th colspan="2">Cả quá trình</th>
											<th colspan="2">3 năm cuối</th>
										</tr>
										<tr>
											<th>Số lượng</th>
											<th>Điểm</th>
											<th>Số lượng</th>
											<th>Điểm</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td>1. Bài báo, báo cáo khoa học</td>
											<td></td>
											<td></td>
											<td></td>
											<td></td>
										</tr>
										<tr>
											<td>- Tổng số bài báo, báo cáo KH ứng viên khai/Tổng số bài được tính điểm [27]:</td>
											<td ><input type="number" min=0 class="form-control" name="data[sSL_BBKTrenTongDuocDiem]" value="{(!empty($muc7))?$muc7.sSL_BBKTrenTongDuocDiem:''}"></td>
											<td ><input type="number" step="0.01" min=0 class="form-control" name="data[sD_BBKTrenTongDuocDiem]" value="{(!empty($muc7))?$muc7.sD_BBKTrenTongDuocDiem:''}"></td>
											<td ><input type="number" min=0 class="form-control" name="data[sSL3_BBKTrenTongDuocDiem]" value="{(!empty($muc7))?$muc7.sSL3_BBKTrenTongDuocDiem:''}"></td>
											<td ><input type="number" step="0.01" min=0 class="form-control" name="data[sD3_BBKTrenTongDuocDiem]" value="{(!empty($muc7))?$muc7.sD3_BBKTrenTongDuocDiem:''}"></td>
										</tr>
										<tr>
											<td>- Số bài báo KH và điểm:</td>
											<td></td>
											<td></td>
											<td></td>
											<td></td>
										</tr>
										<tr>
											<td>+ Bài báo đăng trong tạp chí có uy tín [28]:</td>
											<td><input type="number" min=0 class="form-control" name="data[sSL_BBUT]" value="{(!empty($muc7))?$muc7.sSL_BBUT:''}"></td>
											<td><input type="number" min=0 step="0.01" class="form-control" name="data[sD_BBUT]" value="{(!empty($muc7))?$muc7.sD_BBUT:''}"></td>
											<td><input type="number" min=0 class="form-control" name="data[sSL3_BBUT]" value="{(!empty($muc7))?$muc7.sSL3_BBUT:''}"></td>
											<td><input type="number" min=0 step="0.01" class="form-control" name="data[sD3_BBUT]" value="{(!empty($muc7))?$muc7.sD3_BBUT:''}"></td>
										</tr>
										<tr>
											<td>+ Bài báo KH còn lại [29]:</td>
											<td><input type="number" min=0 class="form-control" name="data[sSL_BBCL]" value="{(!empty($muc7))?$muc7.sSL_BBCL:''}"></td>
											<td><input type="number" min=0 step="0.01" class="form-control" name="data[sD_BBCL]" value="{(!empty($muc7))?$muc7.sD_BBCL:''}"></td>
											<td><input type="number" min=0 class="form-control" name="data[sSL3_BBCL]" value="{(!empty($muc7))?$muc7.sSL3_BBCL:''}"></td>
											<td><input type="number" min=0 step="0.01" class="form-control" name="data[sD3_BBCL]" value="{(!empty($muc7))?$muc7.sD3_BBCL:''}"></td>
										</tr>
										<tr>
											<td>2. Sáng chế, giải pháp hữu ích, giải thưởng quốc gia, quốc tế [30]:</td>
											<td><input type="number" min=0 class="form-control" name="data[sSL_SangChe_Muc2]" value="{(!empty($muc7))?$muc7.sSL_SangChe_Muc2:''}"></td>
											<td><input type="number" min=0 step="0.01" class="form-control" name="data[sD_SangChe_Muc2]" value="{(!empty($muc7))?$muc7.sD_SangChe_Muc2:''}"></td>
											<td><input type="number" min=0 class="form-control" name="data[sSL3_SangChe_Muc2]" value="{(!empty($muc7))?$muc7.sSL3_SangChe_Muc2:''}"></td>
											<td><input type="number" min=0 step="0.01" class="form-control" name="data[sD3_SangChe_Muc2]" value="{(!empty($muc7))?$muc7.sD3_SangChe_Muc2:''}"></td>
										</tr>
										<tr>
											<td>3. Tổng số điểm từ các bài báo và sáng chế, giải pháp hữu ích, giải thưởng quốc gia, quốc tế [31]:</td>
											<td><input type="number" min=0 class="form-control" name="data[sSL_Muc3]" value="{(!empty($muc7))?$muc7.sSL_Muc3:''}"></td>
											<td><input type="number" min=0 step="0.01" class="form-control" name="data[sD_Muc3]" value="{(!empty($muc7))?$muc7.sD_Muc3:''}"></td>
											<td><input type="number" min=0 class="form-control" name="data[sSL3_Muc3]" value="{(!empty($muc7))?$muc7.sSL3_Muc3:''}"></td>
											<td><input type="number" min=0 step="0.01" class="form-control" name="data[sD3_Muc3]" value="{(!empty($muc7))?$muc7.sD3_Muc3:''}"></td>
										</tr>
									</tbody>
								</table>
							</div>
							<div class="col-12 col-md-6">
								<label for="sSL_SauPGS" class="col-form-label font-weight-bold">b) Số lượng bài báo đăng trên tạp chí khoa học quốc tế uy tín, sáng chế, giải pháp hữu ích, giải thưởng quốc tế... mà ứng viên là tác giả chính sau khi được công nhận PGS hoặc cấp bằng TS [32]:</label>
							</div>
							<div class="col-12 col-md-6">
								<input type="number" min="0" class="form-control" name="data[sSL_SauPGS]" id="sSL_SauPGS" value="{(!empty($muc7))?$muc7.sSL_SauPGS:''}">
							</div>
						</div>

						<div class="row">
							<div class="col-12 mt-3 text-center">
								<input type="hidden" name="data[PK_iMaMuc7]" value="{(isset($muc7) && !empty($muc7))?$muc7.PK_iMaMuc7:''}">
								{if !empty($id)}
								<button name="updatemuc7" id="updatemuc7" type="submit" class="btn btn-primary" value="1" data-loading-text="<i class='fa fa-spinner fa-spin'></i> Đang lưu">Thẩm định</button>
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

