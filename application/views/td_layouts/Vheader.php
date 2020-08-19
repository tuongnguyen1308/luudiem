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
		<script type="text/javascript" src="assets/plugins/ckeditor/ckeditor.js"></script>
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
<body class="md-skin">
	<div id="wrapper">
		<nav class="navbar-default navbar-static-side" role="navigation" id="menu-noshadow">
			<div class="sidebar-collapse">
				<ul class="nav metismenu" id="side-menu">
					<li class="nav-header">
						<div class="dropdown profile-element">
							<!-- <span>
							    {assign var="file_path" value="assets/avatars/`$session.maUV`.jpg"}
								{if (file_exists($file_path))}
									<img alt="image" class="img-circle" src="assets/avatars/{$session['maUV']}.jpg?ver={time()}" width="48px" height="48px">
								{else}
									<img alt="image" class="img-circle" src="assets/avatars/default_avatar.png" width="48px" height="48px">
								{/if}
							</span> -->
							<a href="profile"> <!--  data-toggle="dropdown" class="dropdown-toggle" -->
								<span class="clear">
									<span class="block m-t-xs">
										<strong class="font-bold">{$session.hoTen}</strong>
									</span>
									<!-- <span class="text-muted text-xs block">Cá nhân <b class="caret"></b></span> -->
								</span>
							</a>
							<ul class="dropdown-menu animated fadeInRight m-t-xs">
								<li><a href="{$url}changepassword">Đổi mật khẩu</a></li>
								<li><a href="{$url}logout">Đăng xuất</a></li>
							</ul>
						</div>
						<div class="logo-element">
                            HĐGS
						</div>
					</li>
					<li class="{($currentpage=='info-ung-vien')?'active':''}"><a href="{$url}info-ung-vien{if isset($id) && !empty($id)}?id={$id}{/if}">Thông tin ứng viên</a></li>
					<li class="{($currentpage=='muc1')?'active':''}"><a href="{$url}muc1{if isset($id) && !empty($id)}?id={$id}{/if}">Thẩm định mục 1</a></li>
					<li class="{($currentpage=='muc2')?'active':''}"><a href="{$url}muc2{if isset($id) && !empty($id)}?id={$id}{/if}">Thẩm định mục 2</a></li>
					<li class="{($currentpage=='muc3')?'active':''}"><a href="{$url}muc3{if isset($id) && !empty($id)}?id={$id}{/if}">Thẩm định mục 3</a></li>
					<li class="{($currentpage=='muc4den5')?'active':''}"><a href="{$url}muc4den5{if isset($id) && !empty($id)}?id={$id}{/if}">Thẩm định mục 4-5</a></li>
					<li class="{($currentpage=='muc6')?'active':''}"><a href="{$url}muc6{if isset($id) && !empty($id)}?id={$id}{/if}">Thẩm định mục 6</a></li>
					<li class="{($currentpage=='muc7')?'active':''}"><a href="{$url}muc7{if isset($id) && !empty($id)}?id={$id}{/if}">Thẩm định mục 7</a></li>
					<li class="{($currentpage=='tonghop')?'active':''}"><a href="{$url}tonghop{if isset($id) && !empty($id)}?id={$id}{/if}">Tổng hợp kết quả hoạt động và đào tạo</a></li>
					<li class="{($currentpage=='nhanxet')?'active':''}"><a href="{$url}nhanxet{if isset($id) && !empty($id)}?id={$id}{/if}">Nhận xét của người thẩm định</a></li>
					<li class="{($currentpage=='ctdt')?'active':''}"><a href="{$url}ctdt{if isset($id) && !empty($id)}?id={$id}{/if}">Thẩm định CTĐT, NCKH, Ngoại Ngữ, Tỷ lệ phiếu tín nhiệm</a></li>
					<li class="{($currentpage=='mau06')?'active':''}"><a target="_blank" href="{$url}export06{if isset($id) && !empty($id)}?id={$id}{/if}">In mẫu 06</a></li>
					<li class="{($currentpage=='mau09')?'active':''}"><a target="_blank" href="{$url}export09{if isset($id) && !empty($id)}?id={$id}{/if}">In mẫu 09</a></li>
				</ul>
			</div>
		</nav>
		<div id="page-wrapper" class="gray-bg dashbard-1">
			<div class="row border-bottom">
				<nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
					<div class="navbar-header">
            			<div class="navbar-minimalize minimalize-styl-2 btn btn-primary">
            				<i class="fa fa-bars"></i>
            			</div>
            		</div>
					<ul class="nav navbar-top-links navbar-right">
						<li class="hidden-xs">
							<a class="m-r-sm text-muted welcome-message">{$session.hoTen}</a>
						</li>
						<li><a href="{$url}changepassword">Đổi mật khẩu</a></li>
						<li>
							<a href="{$url}logout">
								<i class="fa fa-sign-out"></i><span class="visible hidden-xs">Đăng xuất</span>
							</a>
						</li>
					</ul>
				</nav>
			</div>

		
