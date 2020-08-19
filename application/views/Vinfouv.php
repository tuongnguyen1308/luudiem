<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-heading text-uppercase">Thông tin uỷ viên</div>
				<div class="panel-body">
					<form method="post">
                        <input type="hidden" name="{$csrf.name}" value="{$csrf.hash}">
						<div class="row">
							<div class="col-12 col-md-4">
								<label for="sHoTen" class="col-form-label font-weight-bold">Họ và tên:</label>
								<input type="text" required class="form-control text-uppercase" name="data[sHoTen]" id="sHoTen" placeholder="Ví dụ: NGUYỄN VĂN A" value="{(!empty($info))?$info.sHoTen:''}">
								
							</div>
							<div class="col-12 col-md-4">
								<label for="FK_iMaCD" class="col-form-label font-weight-bold">Chức danh:</label>
								<select class="form-control" name="data[FK_iMaCD]" id="FK_iMaCD">
									{foreach $ds_chucdanh as $k => $v}
										<option value="{$v.PK_iMaCD}" {(!empty($info) && $info.FK_iMaCD == $v.PK_iMaCD)?'selected':''}>{$v.sChucDanh}</option>
									{/foreach}
								</select>
							</div>
							<div class="col-12 col-md-4">
								<label for="sHocVi" class="col-form-label font-weight-bold">Học vị:</label>
								<input type="text" required class="form-control" name="data[sHocVi]" id="sHocVi" value="{(!empty($info))?$info.sHocVi:''}">
							</div>
						</div>
						<div class="row m-t">
							<div class="col-12 col-md-6">
								<label for="FK_iMaNganh" class="col-form-label font-weight-bold">Ngành:</label>
								<select class="form-control" name="data[FK_iMaNganh]" id="FK_iMaNganh">
									{foreach $ds_nganh as $k => $v}
										<option value="{$v.PK_iMaNganh}" {(!empty($info) && $info.FK_iMaNganh == $v.PK_iMaNganh)?'selected':''}>{$v.sTenNganh}</option>
									{/foreach}
								</select>
							</div>
							<div class="col-12 col-md-6">
								<label for="sChuyenNganh" class="col-form-label font-weight-bold">Chuyên ngành:</label>
								<input type="text" required class="form-control" name="data[sChuyenNganh]" id="sChuyenNganh" placeholder="" value="{(!empty($info))?$info.sChuyenNganh:''}">
							</div>
						</div>


						<div class="row">
							<div class="col-12 mt-3 text-center">
								<button name="updateInfo" id="updateInfo" type="submit" class="btn btn-primary" value="1">Cập nhật thông tin</button>
							</div>
						</div>
					</form>
                </div>
			</div>
        </div>
    </div>
</div>
<style type="text/css">
    .mt-3 {
        margin-top: 30px;
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
        $('.feature').each(function (k, v){
            $(v).css("background-color", getRandomColor());
        });
    });
    $(document).ready(() => {
        $('#tbl').DataTable();
    })
</script>