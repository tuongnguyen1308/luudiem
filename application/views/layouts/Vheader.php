<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <base href="{$url}">
	<!-- <meta name="viewport" content="width=device-width, initial-scale=1.0"> -->

	<title>Hệ thống lưu điểm</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
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
    <link href="{$url}assets/plugins/css/your_style.css?ver=1.0" rel="stylesheet">
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
<body class="main-bg">
	<div id="wrapper">
		<!-- <nav class="navbar-default navbar-static-side" role="navigation" id="menu-noshadow">
			<div class="sidebar-collapse">
				<ul class="nav metismenu" id="side-menu">
					<li class="nav-header" style="width:220px">
							<a href="#">
								<strong class="text-white font-weight-bold">{$session.username}</strong>
							</a>
						<div class="logo-element">
                            QLDT
						</div>
					</li>
                        <li class="p-3 w-100 {($currentpage=='list')?'active':''}"><a href="{$url}listsv">Danh sách sinh viên</a></li>
						<li class="p-3 w-100 {($currentpage=='statistical')?'active':''}"><a href="{$url}statistical">Thống kê</a></li>
				</ul>
			</div>
		</nav>
		<div id="page-wrapper" class="gray-bg dashbard-1"> -->



			
		<!-- Content Wrapper -->
		<div id="content-wrapper" class="d-flex flex-column">

			<!-- Main Content -->
			<div id="content">

				<!-- Topbar -->
				<nav class="navbar border-radius-bottom navbar-expand navbar-light bg-white topbar mb-2 static-top shadow mx-4">

					<ul class="navbar-nav mr-auto">
						<li class="nav-item dropdown no-arrow">
							<a class="nav-link {($currentpage=='add')?'active':''}" href="{$url}addfile">
								<i class="fa fa-list"></i>
								<span>Thêm file Excel</span>
							</a>
						</li>
						<li class="nav-item dropdown no-arrow">
							<a class="nav-link {($currentpage=='list')?'active':''}" href="{$url}listsv">
								<i class="fa fa-list"></i>
								<span>Danh sách sinh viên</span>
							</a>
						</li>
						<li class="nav-item dropdown no-arrow">
							<a class="nav-link {($currentpage=='statistical')?'active':''}" href="{$url}statistical">
								<i class="fa fa-area-chart"></i>
								<span class="">Thống kê</span>
							</a>
						</li>
					</ul>
					<!-- Topbar Navbar -->
					<ul class="navbar-nav ml-auto">
						<li class="nav-item dropdown no-arrow">
						<a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							<span class="mr-2 d-none d-lg-inline"><i class="fa fa-user"></i> {$session.username}</span>
							<!-- <img class="img-profile rounded-circle" src="https://source.unsplash.com/QAB-WJcbgJk/60x60"> -->
						</a>
						<!-- Dropdown - User Information -->
						<div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
							<a class="dropdown-item mt-2 pt-2 pb-2" href="{$url}changepassword">
							<i class="fa fa-key"></i>
							Đổi mật khẩu
							</a>
							<a class="dropdown-item mb-2 pt-2 pb-2" href="{$url}logout" data-toggle="modal" data-target="#logoutModal">
							<i class="fa fa-sign-out"></i>
							Đăng xuất
							</a>
						</li>

					</ul>

				</nav>
				<!-- End of Topbar -->

				<!-- Begin Page Content -->
				<div class="container-fluid">

		
