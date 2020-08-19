$(document).ready(function () {
    $('#formReg').validate({
        groups: {
            nameGroup: "email pass repass"
        },
        rules: {
            email: {
                required: true,
                email: true
            },
            pass: {
                required: true,
                minlength: 5
            },
            repass: {
                required: true,
                equalTo: "input[name=pass]"
            }
        },
        messages: {
            email: {
                required: "Vui lòng nhập email!",
                email: "Định dạng email không chính xác!"
            },
            pass: {
                required: "Vui lòng nhập mật khẩu!",
                minlength: "Mật khẩu yêu cầu ít nhất 5 ký tự!"
            },
            repass: {
                required: "Vui lòng nhập lại mật khẩu!",
                equalTo: "Mật khẩu nhập lại không khớp!"
            }
        },
        errorPlacement: function (error) {
            $('#errorPlace').html(error);
        }
    });
});