var url = window.location.href;
$(document).ready(function () {
	$('#formAddAccount').validate({
		groups: {
			nameGroup: "tenTaiKhoan matKhau nhapLaiMatKhau hoTen ngaySinh maQuyen"
		},
		rules: {
			tenTaiKhoan: {
				required: true
			},
			matKhau: {
				required: true,
				minlength: 5
			},
			nhapLaiMatKhau: {
				required: true,
				equalTo: "input[name=matKhau]"
			},
			hoTen: {
				required: true
			},
			ngaySinh: {
				required: true,
				date: true
			},
			maQuyen: {
				required: true
			}
		},
		messages: {
			tenTaiKhoan: {
				required: "Vui lòng nhập tên tài khoản!"
			},
			matKhau: {
				required: "Vui lòng nhập mật khẩu!",
				minlength: "Mật khẩu yêu cầu ít nhất 5 ký tự!"
			},
			nhapLaiMatKhau: {
				required: "Vui lòng nhập lại mật khẩu!",
				equalTo: "Mật khẩu nhập lại không khớp!"
			},
			hoTen: {
				required: "Vui lòng nhập họ và tên"
			},
			ngaySinh: {
				required: "Vui lòng nhập ngày sinh"
			},
			maQuyen: {
				required: "Vui lòng chọn quyền"
			}
		},
		errorPlacement: function (error) {
			$('#errorPlace').html(error);
		}
	});

	$('#formUpdateAccount').validate({
		groups: {
			nameGroup: "tenTaiKhoan matKhau_fix nhapLaiMatKhau hoTen ngaySinh maQuyen"
		},
		rules: {
			tenTaiKhoan: {
				required: true
			},
			matKhau_fix: {
				minlength: 5
			},
			nhapLaiMatKhau: {
				equalTo: "input[name=matKhau_fix]"
			},
			hoTen: {
				required: true
			},
			ngaySinh: {
				required: true,
				date: true
			},
			maQuyen: {
				required: true
			}
		},
		messages: {
			tenTaiKhoan: {
				required: "Vui lòng nhập tên tài khoản!"
			},
			matKhau_fix: {
				minlength: "Mật khẩu yêu cầu ít nhất 5 ký tự!"
			},
			nhapLaiMatKhau: {
				equalTo: "Mật khẩu nhập lại không khớp!"
			},
			hoTen: {
				required: "Vui lòng nhập họ và tên"
			},
			ngaySinh: {
				required: "Vui lòng nhập ngày sinh"
			},
			maQuyen: {
				required: "Vui lòng chọn quyền"
			}
		},
		errorPlacement: function (error) {
			$('#errorPlaceUdt').html(error);
		}
	});

	$(document).on('click', 'button[name=btnFix]', function () {
		let maTK = $(this).val();
		$.ajax({
			type: 'post',
			url: url,
			data:{
				'action': 'getInfoAccount',
				'maTK': maTK
			},
			success: function(response){
				let info = JSON.parse(response);

				$('#modalFix').find('input[name=tenTaiKhoan]').val(info['sTenTK']);
				$('#modalFix').find('input[name=hoTen]').val(info['sHoTen']);
				$('#modalFix').find('input[name=ngaySinh]').val(info['sNgaySinh']);
				$('#modalFix').find('select[name=maQuyen]').val(info['FK_iMaQuyen']);
				$('#modalFix').find('button[name=btnSaveUpdate]').val(info['PK_iMaTK']);
			}
		});
	});
});