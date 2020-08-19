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
<body class="md-skin">
	<div id="wrapper">
		<nav class="navbar-default navbar-static-side" role="navigation">
			<div class="sidebar-collapse">
				<ul class="nav metismenu" id="side-menu">
					<li class="nav-header">
						<div class="dropdown profile-element">
							<span>
							    {assign var="file_path" value="assets/avatars/`$session.maUV`.jpg"}
								{if (file_exists($file_path))}
									<img alt="image" class="img-circle" src="assets/avatars/{$session['maUV']}.jpg?ver={time()}" width="48px" height="48px">
								{else}
									<img alt="image" class="img-circle" src="assets/avatars/default_avatar.png" width="48px" height="48px">
								{/if}
							</span>
							<a href="profile"> <!--  data-toggle="dropdown" class="dropdown-toggle" -->
								<span class="clear">
									<span class="block m-t-xs">
										<strong class="font-bold">{$session.hoTen}</strong>
									</span>
									<!-- <span class="text-muted text-xs block">Cá nhân <b class="caret"></b></span> -->
								</span>
							</a>
							<!-- <ul class="dropdown-menu animated fadeInRight m-t-xs">
								<li><a href="{$url}changepassword">Đổi mật khẩu</a></li>
								<li><a href="{$url}logout">Đăng xuất</a></li>
							</ul> -->
						</div>
						<div class="logo-element">
                            HĐGS
						</div>
					</li>
                    {foreach $myMenu as $k => $v}
                        {if isset($v.chucNang)}
                            <li {if in_array($currentUrl, array_column($v.chucNang, 'sUrl'))}class="active"{/if}>
                                <a href="" title="{$v.sTenNhomCN}">
                                    {if !empty($v.sIcon)}
                                        <i class="{$v.sIcon}"></i>
                                    {/if}
                                    <span class="nav-label">{$v.sTenNhomCN}</span>
                                    <span class="fa arrow"></span>
                                </a>
                                <ul class="nav nav-second-level collapse">
                                    {foreach $v.chucNang as $key => $value}
                                        <li {($currentUrl==$value.sUrl) ? 'class="active"' : ''}>
                                            <a href="{$url}{$value.sUrl}">
                                                {if !empty($value.sIcon)}
                                                    <i class="{$value.sIcon}"></i>
                                                {/if}
                                                {$value.sTenChucNang}
                                            </a>
                                        </li>
                                    {/foreach}
                                </ul>
                            </li>
                        {else}
                            <li {($currentUrl==$v.sUrl) ? 'class="active"' : ''}>
                                <a href="{$url}{$v.sUrl}" title="{$v.sTenChucNang}">
                                    {if !empty($v.sIcon)}
                                        <i class="{$v.sIcon}"></i>
                                    {/if}
                                    <span class="nav-label">{$v.sTenChucNang}</span>
                                </a>
                            </li>
                        {/if}
                    {/foreach}
				</ul>
			</div>
		</nav>
		<div id="page-wrapper" class="gray-bg dashbard-1">
			<div class="row border-bottom">
				<nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
					<div class="navbar-header">
            			<div class="navbar-minimalize minimalize-styl-2 btn btn-primary">
            				<i class="fa fa-bars"></i>
                            <input type="hidden" id="maUV" value="{$session['maUV']}" disabled>
            			</div>
            		</div>
					<ul class="nav navbar-top-links navbar-right">
						<li class="hidden-xs">
							<a class="m-r-sm text-muted welcome-message">{$session.tenTK}</a>
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