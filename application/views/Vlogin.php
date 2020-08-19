<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

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
<body>
    <div class="container">
        <div class="banner">
            <div class="col-md-12 col-sm-12 text-center">
                <h1 class="text-uppercase font-weight-bold text-light p-3 bg-success">Hệ thống lưu điểm</h1>
                <!-- <img src="{$url}assets/plugins/img/banner.png" alt="Hội đồng giáo sư nhà nước"> -->
            </div>
        </div>
        <div class="wrapper animated fadeInRight">
            <div class="card w-50 mx-auto" style="min-width:300px">
                <div class="card-body">
                    <div class="col-md-12 col-sm-12">
                        <form action="" method="post" class="form-horizontal">
                            <input type="hidden" name="{$csrf['name']}" value="{$csrf['hash']}" />
                            <div class="para-head text-center m-b">
                                <h2 class="">Đăng nhập</h2>
                                <hr>
                            </div>
                            <div class="para-body m-t-lg">
                                <div class="form-group">
                                    <label class="control-label">Địa chỉ Email</label>
                                    <div class="">
                                        <input type="text" name="username" value="{$account}" class="form-control" placeholder="Email" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Mật khẩu</label>
                                    <div class="">
                                        <input type="password" name="password" class="form-control" placeholder="******" required>
                                    </div>
                                </div>
                                <div class="height-10 text-center m-t-sm hidden-xs" id="errorPlace">

                                </div>
                                <div class="m-t" style="">
                                    <div class="pull-right">
                                        <button type="submit" name="login" value="login" class="btn btn-primary">Đăng nhập</button>
                                    </div>
                                    <div class="pull-left m-t-sm">
                                        Chưa có tài khoản? <a href="{$url}register">Đăng ký</a>
                                    </div>
                                </div>
                                <!-- <div class="col-sm-12 m-t">
                                    <div class="pull-right float-left-xs">
                                        <a target="_blank" href="">
                                            <i class="fa fa-file-text" aria-hidden="true"></i> Hướng dẫn sử dụng (Video)
                                        </a>
                                    </div>
                                    <div class="pull-left">
                                        <a target="_blank" href="">
                                            <i class="fa fa-file-text" aria-hidden="true"></i> Hướng dẫn sử dụng
                                        </a>
                                    </div>
                                </div> -->
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="footer-danger">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="pull-left">
                                Hỗ trợ chuyên môn: 0123456789
                            </div>
                            <div class="pull-right float-left-xs">
                                Hỗ trợ kỹ thuật: 0123456789
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            Hệ thống hiện chỉ hỗ trợ trên 2 trình duyệt <a target="_blank" href="https://www.google.com/chrome/?brand=CHBD&amp;gclid=CjwKCAjwm-fkBRBBEiwA966fZA4dKUN0dbS3yos4i19bvi2_E8VVISNhzrY91RgwbkUNBBkrCoVDqBoCumwQAvD_BwE&amp;gclsrc=aw.ds"><img style="height: 35px;" src="assets/plugins/img/chrome.png"> Google Chrome</a>
                            và
                            <a target="_blank" href="https://www.mozilla.org/vi/firefox/download/thanks/"><img  style="height: 35px;"src="assets/plugins/img/firefox.png"> Mozilla Firefox</a>.
                        </div>
                    </div>
                </div>
            </div>
        </div> -->
    </div>
    
    <!-- Mainly scripts -->
    <script src="assets/plugins/js/jquery-2.1.1.js"></script>
    <script src="assets/plugins/js/bootstrap.min.js"></script>
    <script src="assets/plugins/js/plugins/toastr/toastr.min.js"></script>
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
