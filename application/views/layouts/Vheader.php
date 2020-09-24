<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <base href="{$url}">
	<!-- <meta name="viewport" content="width=device-width, initial-scale=1.0"> -->

	<title>Hệ thống lưu điểm</title>

    <!-- <link rel="icon" href="{$url}assets/plugins/img/logo.png"> -->
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
    <script src="{$url}assets/plugins/js/jquery-3.1.1.min.js"></script>
    <script src="{$url}assets/plugins/js/xlsx.full.min.js"></script>
    <script src="{$url}assets/plugins/js/jszip.js"></script>
		<!-- <script src="{$url}assets/plugins/js/jquery-2.1.1.js"></script> -->
    <script src="{$url}assets/plugins/js/popper.min.js"></script>
    <script src="{$url}assets/plugins/js/bootstrap.min.js"></script>
    <script src="{$url}assets/plugins/js/plugins/validate/jquery.validate.min.js"></script>
	
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
					<li class="nav-header" style="width:220px">
							<a href="{$url}infouv">
								<strong class="text-white font-weight-bold">{$session.username}</strong>
							</a>
						<div class="logo-element">
                            QLDT
						</div>
					</li>
                        <!-- <li class="p-3 w-100 {($currentpage=='info')?'active':''}"><a href="{$url}infouv">Thông tin cá nhân</a></li> -->
                        <li class="p-3 w-100 {($currentpage=='list')?'active':''}"><a href="{$url}listsv">Danh sách sinh viên</a></li>
				</ul>
			</div>
		</nav>
		<div id="page-wrapper" class="gray-bg dashbard-1">
			<div class="row border-bottom">
				<nav class="navbar navbar-static-top" role="navigation" style="width:100%">
					<!-- <div class="navbar-header">
            			<div class="navbar-minimalize minimalize-styl-2 btn btn-primary">
            				<i class="fa fa-bars"></i>
            			</div>
            		</div> -->
					<ul class="nav navbar-top-links navbar-right ml-auto">
						<!-- <li class="hidden-xs">
							<a class="m-r-sm text-muted welcome-message">{$session.hoTen}</a>
						</li> -->
						<li><a href="{$url}changepassword">Đổi mật khẩu</a></li>
						<li>
							<a href="{$url}logout">
								<i class="fa fa-sign-out"></i><span class="visible hidden-xs">Đăng xuất</span>
							</a>
						</li>
					</ul>
				</nav>
			</div>

		
