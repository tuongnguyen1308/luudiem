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
								<label class="col-form-label font-weight-bold">4. Hướng dẫn NCS, HVCH/CK2/BSNT</label>
								<table class="table table-inverse table-responsive table-bordered dataTable no-footer" width="100%">
									<thead>
										<tr>
											<th>Đối tượng</th>
											<th>Trách nhiệm</th>
											<th>Số lượng</th>
											<th>Ghi chú</th>
										</tr>
									</thead>
									<tbody> 
										<tr>
											<td scope="row" rowspan="2">NCS đã có Quyết định cấp bằng TS</td>
											<td>Chính [12]</td>
											<td><input type="number" min=0 class="form-control" name="data[sHuongDanNCSChinh]" required value="{(!empty($kqtd) && !empty($kqtd.sHuongDanNCSChinh))?$kqtd.sHuongDanNCSChinh:''}"></td>
											<td>
												<textarea class="form-control" name="data[sGhiChuNCSChinh]" required>{(!empty($kqtd) && !empty($kqtd.sGhiChuNCSChinh))?$kqtd.sGhiChuNCSChinh:''}</textarea>
											</td>
										</tr>
										<tr>
											<td>Phụ [13]</td>
											<td><input type="number" min=0 class="form-control" name="data[sHuongDanNCSPhu]" required value="{(!empty($kqtd) && !empty($kqtd.sHuongDanNCSPhu))?$kqtd.sHuongDanNCSPhu:''}"></td>
											<td>
												<textarea class="form-control" name="data[sGhiChuNCSPhu]" required>{(!empty($kqtd) && !empty($kqtd.sGhiChuNCSPhu))?$kqtd.sGhiChuNCSPhu:''}</textarea>
											</td>
										</tr>
										<tr>
											<td scope="row">HVCH/CK2/BSNT đã có Quyết định cấp bằng ThS/CK2/BSNT</td>
											<td>Chính [14]</td>
											<td><input type="number" min=0 class="form-control" name="data[sHuongDanHVCHChinh]" required value="{(!empty($kqtd) && !empty($kqtd.sHuongDanHVCHChinh))?$kqtd.sHuongDanHVCHChinh:''}"></td>
											<td>
												<textarea class="form-control" name="data[sGhiChuHVCH]" required>{(!empty($kqtd) && !empty($kqtd.sGhiChuHVCH))?$kqtd.sGhiChuHVCH:''}</textarea>
											</td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
						<div class="row mt-3">
							<div class="col-12 col-md-12">
								<label class="col-form-label font-weight-bold">5. Thực hiện nhiệm vụ khoa học và công nghệ đã được nghiệm thu</label>
								<table class="table table-inverse table-responsive table-bordered dataTable no-footer" width="100%">
									<thead>
										<tr>
											<th colspan="2">1. Chương trình, dự án, đề tài nghiên cứu</th>
											<th>Trách nhiệm</th>
											<th>Số lượng</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td scope="row">Chương trình (CT)</td>
											<td>Cấp Nhà nước</td>
											<td>Chủ nhiệm, Phó CN, Thư ký [15]</td>
											<td>
												<input type="number" min=0 class="form-control" name="data[sCTCapNhaNuoc]" required value="{(!empty($kqtd) && !empty($kqtd.sCTCapNhaNuoc))?$kqtd.sCTCapNhaNuoc:''}">
											</td>
										</tr>
										<tr>
											<td rowspan="3">Đề tài (ĐT)</td>
											<td>Cấp Nhà nước</td>
											<td>Chủ nhiệm[16]</td>
											<td>
												<input type="number" min=0 class="form-control" name="data[sDeTaiNN]" required value="{(!empty($kqtd) && !empty($kqtd.sDeTaiNN))?$kqtd.sDeTaiNN:''}">
											</td>
										</tr>
										<tr>
											<td>Cấp bộ, nhánh cấp NN, ĐTKH cơ bản</td>
											<td>Chủ nhiệm[17]</td>
											<td>
												<input type="number" min=0 class="form-control" name="data[sDeTaiCapBo]" required value="{(!empty($kqtd) && !empty($kqtd.sDeTaiCapBo))?$kqtd.sDeTaiCapBo:''}">
											</td>
										</tr>
										<tr>
											<td>Cấp cơ sở</td>
											<td>Chủ nhiệm[18]</td>
											<td>
												<input type="number" min=0 class="form-control" name="data[sDeTaiCoSo]" required value="{(!empty($kqtd) && !empty($kqtd.sDeTaiCoSo))?$kqtd.sDeTaiCoSo:''}">
											</td>
										</tr>
										<tr>
											<td scope="row" colspan="2">2. Chương trình đào tạo hoặc chương trình nghiên cứu, ứng dụng khoa học công nghệ của cơ sở giáo dục đại học</td>
											<td>Chủ trì hoặc tham gia xây dựng, phát triển [19]</td>
											<td>
												<input type="number" min=0 class="form-control" name="data[sCTDT]" required value="{(!empty($kqtd) && !empty($kqtd.sCTDT))?$kqtd.sCTDT:''}">
											</td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>

						<div class="row">
							<div class="col-12 mt-3 text-center">
								<input type="hidden" name="data[PK_iMaKQTD]" value="{(isset($kqtd) && !empty($kqtd))?$kqtd.PK_iMaKQTD:''}">
								{if !empty($id)}
								<button name="updatemuc4den5" id="updatemuc4den5" type="submit" class="btn btn-primary" value="1" data-loading-text="<i class='fa fa-spinner fa-spin'></i> Đang lưu">Thẩm định</button>
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

