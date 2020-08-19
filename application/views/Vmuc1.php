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
								<h4>1. Đối tượng</h4>
							</div>
							<div class="col-12 col-md-6">
								<label for="FK_iMaDoiTuong" class="col-form-label font-weight-bold">Đối tượng:</label>
								<select class="form-control" name="data[FK_iMaDoiTuong]" id="FK_iMaDoiTuong">
									{foreach $ds_doituong as $k => $v}
										<option value="{$v.PK_iMaDoiTuong}" {(!empty($create) && $create.FK_iMaDoiTuong == $v.PK_iMaDoiTuong)?'selected':''}>{$v.sTenDoiTuong} [{$k+1}]</option>
									{/foreach}
								</select>
							</div>
							<div class="col-12 col-md-6">
								<label for="sNoiTG" class="col-form-label font-weight-bold">Nơi thỉnh giảng:</label>
								<input type="text" class="form-control" name="data[sNoiTG]" id="sNoiTG" placeholder="" value="{(!empty($kqtd))?$kqtd.sNoiTG:''}">
							</div>	
						</div>
						<!-- <div class="row">
							<div class="col-12 col-md-12">
								<h4>2. Trình độ đào tạo, chức danh khoa học:</h4>
							</div>
							</div>
							<div class="row m-t">
							<div class="col-12 col-md-4">
								<label for="sBangDH" class="col-form-label font-weight-bold">Ngày cấp bằng ĐH [3]:</label>
								<input type="date" name="data[sNgayCapBangDH]" id="sBangDH" class="form-control" value="{(!empty($kqtd))?$kqtd.sNgayCapBangDH:''}">
							</div>
							<div class="col-12 col-md-4">
								<label for="FK_iMaNganh" class="col-form-label font-weight-bold">Ngành:</label>
								<select class="form-control" name="data[sNganhDH]" id="sNganhDaiHoc">
								<option value="">---Chọn ngành---<option>
									{foreach $ds_nganh as $k => $v}
										<option value="{$v.sTenNganh}" {(!empty($kqtd) && $kqtd.sNganhDH == $v.sTenNganh)?'selected':''}>{$v.PK_iMaNganh}. {$v.sTenNganh}</option>
									{/foreach}
								</select>
							</div>
							<div class="col-12 col-md-4">
								<label for="sBangDH" class="col-form-label font-weight-bold">Chuyên ngành:</label>
								<input type="text" class="form-control" name="data[sChuyenNganhDH]" id="sBangDH1" placeholder="" value="{(!empty($kqtd))?$kqtd.sChuyenNganhDH:''}">
							</div>
							</div>
							<div class="row m-t">
							<div class="col-12 col-md-4">
								<label for="sBangThS" class="col-form-label font-weight-bold">Ngày cấp bằng ThS [4]:</label>
								<input type="date" name="data[sNgayCapBangThS]" id="sBangThS" class="form-control" value="{(!empty($kqtd))?$kqtd.sNgayCapBangThS:''}">
							</div>
							<div class="col-12 col-md-4 mt-md-4">
								<label for="FK_iMaNganh" class="col-form-label font-weight-bold">Ngành:</label>
								<select class="form-control" name="data[sNganhThS]" id="sNganhThS">
									<option value="">---Chọn ngành---<option>
									{foreach $ds_nganh as $k => $v}
										<option value="{$v.sTenNganh}" {(!empty($kqtd) && $kqtd.sNganhThS == $v.sTenNganh)?'selected':''}>{$v.PK_iMaNganh}. {$v.sTenNganh}</option>
									{/foreach}
								</select>
							</div>
							<div class="col-12 col-md-4">
								<label for="sBangThS1" class="col-form-label font-weight-bold">Chuyên ngành:</label>
								<input type="text" class="form-control" name="data[sChuyenNganhThS]" id="sBangThS1" placeholder="" value="{(!empty($kqtd))?$kqtd.sChuyenNganhThS:''}">
							</div>
							</div>
							<div class="row m-t">
							<div class="col-12 col-md-4">
								<label for="sBangTS" class="col-form-label font-weight-bold">Ngày cấp bằng TS [5]:</label>
								<input type="date" name="data[sNgayCapBangTS]" id="sBangTS" class="form-control" value="{(!empty($kqtd))?$kqtd.sNgayCapBangTS:''}">
							</div>
							<div class="col-12 col-md-4 mt-md-4">
								<label for="FK_iMaNganh" class="col-form-label font-weight-bold">Ngành:</label>
								<select class="form-control" name="data[sNganhTS]" id="sNganhTS">
								<option value="">---Chọn ngành---<option>
									{foreach $ds_nganh as $k => $v}
										<option value="{$v.sTenNganh}" {(!empty($kqtd) && $kqtd.sNganhTS == $v.sTenNganh)?'selected':''}>{$v.PK_iMaNganh}. {$v.sTenNganh}</option>
									{/foreach}
								</select>
							</div>
							<div class="col-12 col-md-4">
								<label for="sBangTS1" class="col-form-label font-weight-bold">Chuyên ngành:</label>
								<input type="text" class="form-control" name="data[sChuyenNganhTS]" id="sBangTS1" placeholder="" value="{(!empty($kqtd))?$kqtd.sChuyenNganhTS:''}">
							</div>
							</div>
							<div class="row m-t">
							<div class="col-12 col-md-4">
								<label for="sBangTSKH" class="col-form-label font-weight-bold">Ngày cấp bằng TSKH [6]:</label>
								<input type="date" name="data[sNgayCapBangTSKH]" id="sBangTSKH" class="form-control" value="{(!empty($kqtd))?$kqtd.sNgayCapBangTSKH:''}">
							</div>
							<div class="col-12 col-md-4 mt-md-4">
								<label for="FK_iMaNganh" class="col-form-label font-weight-bold">Ngành:</label>
								<select class="form-control" name="data[sNganhTSKH]" id="sNganhTSKH">
								<option value="">---Chọn ngành---<option>
									{foreach $ds_nganh as $k => $v}
										<option value="{$v.sTenNganh}" {(!empty($kqtd) && $kqtd.sNganhTSKH == $v.sTenNganh)?'selected':''}>{$v.PK_iMaNganh}. {$v.sTenNganh}</option>
									{/foreach}
								</select>
							</div>
							<div class="col-12 col-md-4">
								<label for="sBangTSKH1" class="col-form-label font-weight-bold">Chuyên ngành:</label>
								<input type="text" class="form-control" name="data[sChuyenNganhTSKH]" id="sBangTSKH1" placeholder="" value="{(!empty($kqtd))?$kqtd.sChuyenNganhTSKH:''}">
							</div>
						</div> -->
						{if ($thongtinungvien.FK_iMaCD == 1)}
						<div class="row" id="congnhanPGS">
							<div class="col-12 col-md-6 mt-3">
								<label for="sCongNhanPGS" class="col-form-label font-weight-bold">Ngày bổ nhiệm/công nhận chức danh PGS [7]:</label>
								<input type="date" class="form-control" name="data[sNgayCapBangPGS]" id="sCongNhanPGS" placeholder="" value="{(!empty($kqtd))?$kqtd.sNgayCapBangPGS:''}">
							</div>
							<div class="col-12 col-md-6 mt-3">
								<label for="sCongNhanPGS1" class="col-form-label font-weight-bold">Thuộc ngành:</label>
								<select class="form-control" name="data[sNganhPGS]" id="sCongNhanPGS1">
								<option value="">---Chọn ngành---<option>
									{foreach $ds_nganh as $k => $v}
										<option value="{$v.sTenNganh}" {(!empty($kqtd) && $kqtd.sNganhPGS == $v.sTenNganh)?'selected':''}>{$v.sTenNganh}</option>
									{/foreach}
								</select>
							</div>
						</div>
						{/if}

						<div class="row">
							<div class="col-12 mt-3 text-center">
								<input type="hidden" name="data[PK_iMaKQTD]" value="{(isset($kqtd) && !empty($kqtd))?$kqtd.PK_iMaKQTD:''}">
								{if !empty($id)}
								<button name="updatemuc1" id="updatemuc1" type="submit" class="btn btn-primary" value="1" data-loading-text="<i class='fa fa-spinner fa-spin'></i> Đang lưu">Thẩm định</button>
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

