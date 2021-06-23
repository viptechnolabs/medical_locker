let changePasswordValidator;

function changePasswordClick(action) {
    changePasswordValidator = $('#change_password_form').validate({
        errorElement: 'span',
        errorClass: 'validation-error',
        rules: {
            current_password: {
                required: true,
                remote: {
                    url: action,
                    type: "post",
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content'),
                        current_password: function () {
                            return $("#current_password").val();
                        }
                    }
                }
            },
            password: {
                required: true
            },
            confirm_password: {
                required: true,
                equalTo: "#password"
            }
        },
        messages: {
            current_password: {
                required: "Please enter current password",
                remote: "Password does not match"
            },
            password: {
                required: "Please enter new password"
            },
            confirm_password: {
                required: "Please enter retype new password",
                equalTo: "Confirm password does not match",
            }
        }
    });
}

$('#change_pass_modal').on('hidden.bs.modal', function () {
    changePasswordValidator.destroy();
    $('#change_password_form').trigger("reset");
})
