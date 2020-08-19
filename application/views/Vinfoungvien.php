<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
		<!-- panel -->
        <div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-heading text-uppercase">I. Thông tin cá nhân của ứng viên</div>
				<div class="panel-body">
				<input type="hidden" name="maUV" value="{$id}">
					<form method="post">
           <input type="hidden" name="{$csrf.name}" value="{$csrf.hash}">
						<div class="row m-t">
							<div class="col-12 col-md-4">
								<label for="FK_iMaCD" class="col-form-label font-weight-bold">Đăng ký xét đạt tiêu chuẩn chức danh:</label>
								<select class="form-control" name="data[FK_iMaCD]" id="FK_iMaCD">
									{foreach $ds_chucdanh as $k => $v}
										<option value="{$v.PK_iMaCD}" {(!empty($ungvien) && $ungvien.FK_iMaCD == $v.PK_iMaCD)?'selected':''}>{$v.sChucDanh}</option>
									{/foreach}
								</select>
							</div>
							<!-- <div class="col-12 col-md-4 mt-md-4" id="ngaycongnhanPGS">
								<label for="sCongNhanPGS" class="col-form-label font-weight-bold">Ngày bổ nhiệm/công nhận chức danh PGS:</label>
								<input type="date" class="form-control" name="data[sCongNhanPGS]" id="sCongNhanPGS" placeholder="" value="{(!empty($ungvien))?$ungvien.sCongNhanPGS:''}">
							</div> -->
							<div class="col-12 col-md-4 mt-md-4">
								<label for="FK_iMaNganh" class="col-form-label font-weight-bold">Ngành:</label>
								<select class="form-control" name="data[FK_iMaNganh]" id="FK_iMaNganh">
									{foreach $ds_nganh as $k => $v}
										<option value="{$v.PK_iMaNganh}" {(!empty($ungvien) && $ungvien.FK_iMaNganh == $v.PK_iMaNganh)?'selected':''}>{$v.PK_iMaNganh}. {$v.sTenNganh}</option>
									{/foreach}
								</select>
							</div>
							<div class="col-12 col-md-4 mt-md-4">
								<label for="sChuyenNganh" class="col-form-label font-weight-bold">Chuyên ngành:</label>
								<input type="text" class="form-control" name="data[sChuyenNganh]" id="sChuyenNganh" placeholder="Nhập chuyên ngành..." value="{(!empty($ungvien))?$ungvien.sChuyenNganh:''}">
							</div>
						</div>
						<div class="row m-t">
							
							<div class="col-12 col-md-4 mt-4">
								<label for="sHoTen" class="col-form-label font-weight-bold">Họ và tên ứng viên:</label>
								<input type="text" class="form-control text-uppercase" name="data[sHoTen]" id="sHoTen"
										placeholder="Nhập họ và tên ứng viên..." value="{(!empty($ungvien))?$ungvien.sHoTen:''}">
								<!-- <small id="helpId" class="form-text text-muted">Help text</small> -->		
							</div>

							<div class="col-12 col-md-4 mt-4">
								<label for="dNgaySinh" class="col-form-label font-weight-bold">Ngày sinh:</label>
								<input type="date" name="data[dNgaySinh]" id="dNgaySinh" class="form-control" value="{(!empty($ungvien))?$ungvien.dNgaySinh:''}">
								<!-- <small id="helpId" class="form-text text-muted">Help text</small> -->
							</div>

							<div class="col-12 col-md-4 mt-4">
								<label for="sGioiTinh" class="col-form-label font-weight-bold">Giới tính:</label>
								<div class="d-flex form-check mt-md-3">
									<div class="form-group-inline col-sm-6">
										<label class="form-check-label" for="Nam">
											<input class="form-check-input" type="radio" name="data[sGioiTinh]" id="Nam" value="Nam" {(!empty($ungvien) && $ungvien.sGioiTinh == 'Nam')?'checked':''}> Nam
										</label>
									</div>
									<div class="form-group-inline col-sm-6">
										<label class="form-check-label" for="Nữ">
											<input class="form-check-input" type="radio" name="data[sGioiTinh]" id="Nữ" value="Nữ" {(!empty($ungvien) && $ungvien.sGioiTinh == 'Nữ')?'checked':''}> Nữ
										</label>
									</div>
								</div>
							</div>
							</div>
							<div class="row m-t">
							
							<div class="col-12 col-md-4 mt-4">
								<label for="FK_iMaDanToc" class="col-form-label font-weight-bold">Dân tộc:</label>
								<select class="form-control" name="data[FK_iMaDanToc]" id="FK_iMaDanToc">
									{foreach $ds_dantoc as $k => $v}
										<option value="{$v.PK_iMaDanToc}" {(!empty($ungvien) && $ungvien.FK_iMaDanToc == $v.PK_iMaDanToc)?'selected':''}>{$v.sTenDanToc}</option>
									{/foreach}
								</select>
							</div>
							<div class="col-12 col-md-4 ">
								<label for="sCoQuan" class="col-form-label font-weight-bold">Cơ quan đang công tác:</label>
								<input type="text" class="form-control" name="data[sCoQuan]" id="sCoQuan" placeholder="Nhập cơ quan đang công tác..." value="{(!empty($ungvien))?$ungvien.sCoQuan:''}">
							</div>
							<div class="col-12 col-md-4">
								<label for="sQuocTich" class="col-form-label font-weight-bold">Quốc Tịch:</label>
								<input type="text" class="form-control" name="data[sQuocTich]" id="sQuocTich" placeholder="Nhập quốc tịch" value="{(!empty($ungvien))?$ungvien.sQuocTich:''}">
							</div>
						</div>
						<div class="row m-t">
						
						<div class="col-12 col-md-8">
								<label for="sQueQuan" class="col-form-label font-weight-bold">Quê quán (xã/phường, huyện/quận, tỉnh/thành phố):</label>
								<input type="text" class="form-control" name="data[sQueQuan]" id="sQueQuan" placeholder="Nhập thông tin quê quán..." value="{(!empty($ungvien))?$ungvien.sQueQuan:''}">
							</div>
							<div class="col-12 col-md-4">
								<label for="sCoSoXetChucDanh" class="col-form-label font-weight-bold">Đăng ký xét chức danh GS/PGS tại HĐGS CS:</label>
								<select class="form-control" name="data[sCoSoXetChucDanh]" id="FK_iMaDanToc">
								{foreach $hdcs as $val}
									<option value="{$val.sTenHoiDong}" {(!empty($val.sTenHoiDong) && $val.sTenHoiDong == $ungvien.sCoSoXetChucDanh)?'selected':''}>{$val.sTenHoiDong}</option>
                {/foreach}
								</select>
								<!-- <input type="text" class="form-control" name="data[sCoSoXetChucDanh]" id="sCoSoXetChucDanh" placeholder="Tên HĐGS Cơ sở" value="{(!empty($ungvien))?$ungvien.sCoSoXetChucDanh:''}"> -->
							</div>
						</div>
						<div class="row">
							<div class="col-12 mt-3 text-center">
								{if isset($ungvien) && !empty($ungvien)}
									<input type="hidden" name="data[PK_iMaUV]" value="{$ungvien.PK_iMaUV}">
									<button name="updateInfoungvien" id="updateInfoungvien" type="submit" class="btn btn-primary" value="1">Thẩm định</button>
								{else}
									<button name="addInfoungvien" id="addInfoungvien" type="submit" class="btn btn-primary" value="1">Thẩm định</button>
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
    // $(document).ready(function () {
		// if($('#FK_iMaCD').val() == 2) {
		// 	$('#ngaycongnhanPGS').toggle();
		// }
    //     $('.feature').each(function (k, v){
    //         $(v).css("background-color", getRandomColor());
    //     });
		// $('#FK_iMaCD').on('change', () => {
		// 	$('#ngaycongnhanPGS').toggle();
		// });
    // });
</script>



<!-- <div class="row">
	<div class="col-12 col-md-4 mt-3">
		<label for="hokhau" class="col-form-label font-weight-bold">8. Hộ khẩu thường trú:</label>
		<input type="text" class="form-control" name="hokhau" id="hokhau" placeholder="" value="{(!empty($ungvien))?$ungvien.hokhau:''}">
	</div>
	<div class="col-12 col-md-4 mt-3">
		<label for="matinh_thuongtru" class="col-form-label font-weight-bold">Mã tỉnh:</label>
		<input type="text" name="matinh_thuongtru" id="matinh_thuongtru" class="form-control number" placeholder="00" maxlength="2" value="{(!empty($ungvien))?$ungvien.matinh_thuongtru:''}">						
	</div>
	<div class="col-12 col-md-4 mt-3">
		<label for="mahuyen_thuongtru" class="col-form-label font-weight-bold">Mã huyện:</label>
		<input type="text" name="mahuyen_thuongtru" id="mahuyen_thuongtru" class="form-control number" placeholder="00" maxlength="2" value="{(!empty($ungvien))?$ungvien.mahuyen_thuongtru:''}">
	</div>
</div>
<div class="row">
	<div class="col-12 col-md-6 mt-3">
		<label class="form-check-label ml-4">
			<input type="checkbox" class="form-check-input" name="trangthai_hokhauthuongtru1" id="trangthai_hokhauthuongtru1" value="checked" {(isset($ungvien.trangthai_hokhauthuongtru.0) && $ungvien.trangthai_hokhauthuongtru.0 == 'checked')?'checked':''}>
			Hộ khẩu thường trú trên 18 tháng tại Nam
		</label>
	</div>
	<div class="col-12 col-md-6 mt-3">
		<label class="form-check-label ml-4">
			<input type="checkbox" class="form-check-input" name="trangthai_hokhauthuongtru2" id="trangthai_hokhauthuongtru2" value="checked" {(isset($ungvien.trangthai_hokhauthuongtru.1) && $ungvien.trangthai_hokhauthuongtru.1 == 'checked')?'checked':''}>
		Hộ khẩu thường trú trên 18 tháng tại xã đặc biệt khó khăn
		</label>
	</div>
</div> -->
