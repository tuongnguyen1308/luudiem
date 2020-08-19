<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <base href="{$url}">
	<!-- <meta name="viewport" content="width=device-width, initial-scale=1.0"> -->

	<title>Hệ thống đăng ký hồ sơ xét công nhận đạt tiêu chuẩn chức danh GS/PGS trực tuyến</title>

    <link rel="icon" href="{$url}assets/plugins/img/logo.png">
	<link href="{$url}assets/plugins/css/bootstrap.min.css" rel="stylesheet">
	<link href="{$url}assets/plugins/font-awesome/css/font-awesome.css" rel="stylesheet">
    <!-- Toastr style -->
    <link href="{$url}assets/plugins/css/plugins/toastr/toastr.min.css" rel="stylesheet">
    <link href="{$url}assets/plugins/css/plugins/iCheck/custom.css" rel="stylesheet">
    <link href="{$url}assets/plugins/css/plugins/dataTables/datatables.min.css" rel="stylesheet">
    <link href="{$url}assets/plugins/css/plugins/select2/select2.min.css" rel="stylesheet">
    <link href="{$url}assets/plugins/css/plugins/datapicker/datepicker3.css" rel="stylesheet">

	<link href="{$url}assets/plugins/css/animate.css" rel="stylesheet">
	<link href="{$url}assets/plugins/css/style.css" rel="stylesheet">
	<link href="{$url}assets/plugins/css/custom_style.css" rel="stylesheet">

    <script src="assets/plugins/js/jquery-3.1.1.min.js"></script>
    <script src="assets/plugins/js/bootstrap.min.js"></script>
    <script src="assets/plugins/js/plugins/validate/jquery.validate.min.js"></script>
    <script type="text/javascript">
        var tokenName = '{$csrf["name"]}';
        var tokenValue = '{$csrf["hash"]}';
        $(document).ready(function() {
            var token = {};
            token[tokenName] = tokenValue;
            $.ajaxSetup({
                data: token
            });
        });
    </script>
</head>
<style type="text/css">
.navbar-static-side{
	display: none;
}
.modal-dialog{
	/*min-width: 900px;*/
}
</style>
<div class="wrapper" style="font-family: 'Times New Roman', serif; font-size: 14pt;">
	<div class="row">
<!-- <nav class="navbar navbar-default alert-success">
  <div class="container-fluid"> -->
    
    <!-- <ul class="nav navbar-nav">
      
      <li><a href="thongke.html"><i class="fa fa-filter" aria-hidden="true"></i>
Thống kê phiếu bầu</a></li>
      <li><a href="thongkephieu"><i class="fa fa-list" aria-hidden="true"></i>
 Danh sách cử chi</a></li>
      <li><a href="locdem.html"><i class="fa fa-list" aria-hidden="true"></i>
 Danh sách ứng viên</a></li>
    </ul> -->
<!--     
  </div>
</nav> -->
	</div>
	<div class="row">
		<div class="col-md-12 col-xs-12 text-center alert-success" style="padding: 1em;background-color: white;border: 1px solid #DFDADA; margin-bottom: 5px;">
        <div class="navbar-header">
      <a class="navbar-brand" href="#"><i class="fa fa-home" aria-hidden="true"></i></a>
    </div>
			<span class="">DANH SÁCH BẢN TRÍCH NGANG</span>
        <ul class="nav navbar-nav navbar-right"> 
       <li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#">Admin
        <span class="caret"></span></a>
        <ul class="dropdown-menu">
          <!-- <li><a href="#">Đổi Mật Khẩu</a></li> -->
          <li><a href="{base_url()}/logout">Đăng Xuất</a></li>
        </ul>
      </li>
    </ul>
		</div>
	</div>
	
	<!-- <div class="row" >
		<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6  alert-success" style="padding: 1em;background-color: white;border: 1px solid #DFDADA; margin-bottom: 5px;">
			<label class="col-lg-4 col-md-3 col-sm-4 col-xs-12"><h4>Ngành/Liên ngành</h4></label>
			<div class="col-lg-8 col-md-9 col-sm-8 col-xs-12">
				<select class="form-control nganh" name="nganh" required>
					<option value="">--- Chọn ngành/liên ngành ---</option>
					{foreach $listNganh as $k => $v}
					<option value="{$v.PK_iMaNganh}">{$v.sTenNganh}</option>
					{/foreach}
				</select>
			</div>
		</div>
		<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6  alert-success" style="padding: 1em;background-color: white;border: 1px solid #DFDADA; margin-bottom: 5px;">
			<label class="col-lg-4 col-md-3 col-sm-4 col-xs-3"><h4>Tìm kiếm</h4></label>
			<div class="col-lg-8 col-md-9 col-sm-8 col-xs-12">
				<input type="text"id="myInput" class="form-control">
			</div>
		</div>
	</div> -->
</div>
<div class="col-md-12 col-xs-12 text-center">
</div>
<div class="row">
	<div class="col-md-12 col-xs-12"> 
		<div id="kqloc" class="alert-basic">
			<table class="table table-bordered table-hover" >
				<thead>
					<th class="text-center">STT</th>
					<th class="text-center">Họ và tên</th>
					<th class="text-center">Ngày sinh</th>
					<th class="text-center">Giới tính</th>
					<th class="text-center">Quê Quán</th>
					<th class="text-center">Xuất mẫu 06</th>
					<th class="text-center">Xuất mẫu 09</th>
				</thead>
				<tbody> 
					{foreach $listUV as $key => $val}
					
					<tr>
						<td class="text-center">{$key+1}</td>
						<td class="text-uppercase">{$val.sHoTen}</td>
						<td class="text-center">{date('d/m/Y',strtotime($val.dNgaySinh))}</td>
						<td class="text-center">{$val.sGioiTinh}</td>
						<td class="text-center">{$val.sQueQuan}</td>
						<!-- <td class="text-center">{$val.sTenNganh}</td> -->
						<!-- <td class="text-center">{$val.sThoiGianGT}</td> -->
						<!-- <td class="text-center">{$val.sThoiGianGT}</td> -->
						<td class="text-center"><a class="btn btn-success" target="_blank" href="{$url}export06?id={$val.PK_iMaUV}&mauyvien={$val.sUsername}"><i class="fa fa-print" aria-hidden="true"></i></a></td>
						<td class="text-center"><a class="btn btn-success" target="_blank" href="{$url}export09?id={$val.PK_iMaUV}&mauyvien={$val.sUsername}"><i class="fa fa-print" aria-hidden="true"></i></a></td>
					</tr>
					
					{/foreach}
				</tbody>
			</table>
		</div>
	</div>
</div>
</div>
<!-- <script src="assets/plugins/js/gioithieuungvien.js"></script> -->