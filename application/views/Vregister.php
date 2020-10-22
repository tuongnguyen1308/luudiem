<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Hệ thống đăng ký hồ sơ xét công nhận đạt tiêu chuẩn chức danh GS/PGS trực tuyến</title>

    <!-- <link rel="icon" href="{$url}assets/plugins/img/logo.png"> -->

    <link href="{$url}assets/plugins/css/bootstrap.min.css" rel="stylesheet">
    <link href="{$url}assets/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- Toastr style -->
    <link href="{$url}assets/plugins/css/plugins/toastr/toastr.min.css" rel="stylesheet">

    <link href="{$url}assets/plugins/css/animate.css" rel="stylesheet">
    <link href="{$url}assets/plugins/css/style.css" rel="stylesheet">
    <link href="{$url}assets/plugins/css/your_style.css?ver=1.0" rel="stylesheet">
</head>
<body class="grd-bg-white">
	
	<div class="container">
	<h1 id="project-label" class="text-uppercase text-center font-weight-bold text-primary pt-5">Hệ thống lưu điểm</h1>
		<div class="row">
			<div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
				<div class="card card-signin my-5">
					<div class="card-body">
						<h5 class="card-title text-center">Đăng ký</h5>
						<form action="" method="post" id="formReg" class="form-signin">
							<input type="hidden" name="{$csrf['name']}" value="{$csrf['hash']}" />
							<div class="form-label-group">
								<input type="email" id="email" name="email" class="form-control" placeholder="Email address" required autofocus>
								<label for="email" class="user-select-none cursor-text">Địa chỉ Email</label>
							</div>

							<div class="form-label-group">
								<input type="password" id="password" name="pass" class="form-control" placeholder="Mật khẩu" required>
								<label for="password" class="user-select-none cursor-text">Mật khẩu</label>
							</div>

                            <div class="form-label-group">
                                <input type="password" id="repass" name="repass" class="form-control" placeholder="Nhập lại mật khẩu" required>
                                <label for="repass" class="user-select-none cursor-text">Nhập lại Mật khẩu</label>
                            </div>
                            <div class="height-10 text-center m-t-sm" id="errorPlace"></div>
							<!-- <div class="custom-control custom-checkbox mb-3">
								<input type="checkbox" class="custom-control-input" id="customCheck1">
								<label class="custom-control-label" for="customCheck1">Remember password</label>
							</div> -->
							<button name="register" value="reg" class="btn btn-primary btn-block text-uppercase" type="submit">Đăng ký</button>
							<hr class="my-4">
							<div class="text-center">Đã có tài khoản? <a href="{$url}">Đăng nhập</a></div>
							<!-- <button class="btn btn-lg btn-google btn-block text-uppercase" type="submit"><i class="fab fa-google mr-2"></i> Sign in with Google</button>
							<button class="btn btn-lg btn-facebook btn-block text-uppercase" type="submit"><i class="fab fa-facebook-f mr-2"></i> Sign in with Facebook</button> -->
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>

<!-- Mainly scripts -->
<script src="assets/plugins/js/jquery-2.1.1.js"></script>
<script src="assets/plugins/js/bootstrap.min.js"></script>
<script src="assets/plugins/js/plugins/toastr/toastr.min.js"></script>
<script src="assets/plugins/js/plugins/validate/jquery.validate.min.js"></script>
<script src="assets/plugins/js/hethong/dangky.js?ver=1.0"></script>
<script type="text/javascript">
    toastr.options = {
        top: 500,
        closeButton: true,
        progressBar: true,
        showMethod: 'slideDown',
        timeOut: 5000
    };
</script>
{if !empty($message)}
<script type="text/javascript">
    $(document).ready(function() {
        setTimeout(function() {
            toastr.{$message.type}('{$message.message}');
        }, 200);
    });
</script>
{/if}
</body>
</html>
