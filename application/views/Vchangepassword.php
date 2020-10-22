<div class="wrapper wrapper-content" style="font-family: 'Segoe UI';">
	<div class="row">
		<div class="col-sm-8 col-md-6 col-lg-4 mx-auto">
			<div class="card card-signin my-5">
				<div class="card-body">
					<h5 class="card-title text-center">Đổi mật khẩu</h5>
					<form action="" method="post" id="formReg" class="form-signin">
						<input type="hidden" name="{$csrf['name']}" value="{$csrf['hash']}" />
						<div class="form-label-group">
							<input type="email" id="email" name="email" value="{$session.username}" class="form-control" placeholder="Email address" required disabled>
							<label for="email" class="user-select-none cursor-text">Địa chỉ Email</label>
						</div>

						<div class="form-label-group">
							<input type="password" id="oldpass" name="oldpass" class="form-control" placeholder="Mật khẩu" required autofocus>
							<label for="oldpass" class="user-select-none cursor-text">Mật khẩu cũ</label>
						</div>
						<div class="form-label-group">
							<input type="password" id="newpass" name="newpass" class="form-control" placeholder="Mật khẩu" required>
							<label for="newpass" class="user-select-none cursor-text">Mật khẩu mới</label>
						</div>

						<div class="form-label-group">
							<input type="password" id="repass" name="repass" class="form-control" placeholder="Nhập lại mật khẩu" required>
							<label for="repass" class="user-select-none cursor-text">Xác nhận mật khẩu mới</label>
						</div>
						<div class="height-10 text-center m-t-sm" id="errorPlace"></div>
						<button name="btnChange" value="ok" class="btn btn-primary btn-block text-uppercase" type="submit">Đổi mật khẩu</button>
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