<!-- <div class="row wrapper border-bottom white-bg page-heading">
	<div class="col-md-10">
		<h2>Hội đồng giáo sư nhà nước</h2>
		<ol class="breadcrumb">
			<li>
				<a href="{$url}">Hệ thống</a>
			</li>
			<li>
				Cá nhân
			</li>
			<li><strong>Đổi mật khẩu</strong></li>
		</ol>
	</div>
	<div class="col"></div>
</div> -->
<div class="wrapper wrapper-content animated fadeInRight">
	<div class="row">
		<div class="col-md-12">
			<div class="ibox float-e-margins">
				<div class="ibox-title">
					<h5>Đổi mật khẩu</h5>
				</div>
				<div class="ibox-content">
					<form action="" method="post" class="form-horizontal" id="formChangePass" style="max-width:400px">
						<input type="hidden" name="{$csrf['name']}" value="{$csrf['hash']}" />
						<div class="form-group row">
							<label class="col-12">Email</label>
							<div class="col-12">
								<input type="email" value="{$session.username}" class="form-control" disabled>
							</div>
						</div>
						<div class="form-group row">
							<label class="col-12">Mật khẩu cũ</label>
							<div class="col-12">
								<input type="password" name="oldpass" class="form-control">
							</div>
						</div>
						<div class="form-group row">
							<label class="col-12">Mật khẩu mới</label>
							<div class="col-12">
								<input type="password" name="newpass" class="form-control">
							</div>
						</div>
						<div class="form-group row">
							<label class="col-12">Xác nhận mật khẩu</label>
							<div class="col-12">
								<input type="password" name="repass" class="form-control">
							</div>
						</div>
						<div class="col-md-offset-2 height-15 m-b-sm" id="errorPlace">

						</div>
						<div class="form-group">
							<div class="col-md-offset-2 col-md-10">
								<button type="submit" name="btnChange" value="ok" class="btn btn-primary">Đổi mật khẩu</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	$(document).ready(function () {
		$('#formChangePass').validate({
			groups: {
				nameGroup: "oldpass newpass repass"
			},
			rules: {
				oldpass: {
					required: true
				},
				newpass: {
					required: true,
					minlength: 5
				},
				repass: {
					required: true,
					equalTo: "input[name=newpass]"
				}
			},
			messages: {
				oldpass: {
					required: "Vui lòng nhập mật khẩu cũ!"
				},
				newpass: {
					required: "Vui lòng nhập mật khẩu mới!",
					minlength: "Mật khẩu yêu cầu ít nhất 5 ký tự!"
				},
				repass: {
					required: "Vui lòng xác nhận lại mật khẩu!",
					equalTo: "Mật khẩu nhập lại không khớp!"
				}
			},
			errorPlacement: function (error) {
				$('#errorPlace').html(error);
			}
		});
	});
</script>