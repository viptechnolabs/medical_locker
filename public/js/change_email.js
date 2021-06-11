function getEmailPopup(action, checkEmailAction, userId) {
    //alert(userId);
    $.ajax({
        url: action,
        type: "post",
        data: {},
        success: function (data) {
            $('#update_email_popup').html(data);
            $('#change_email_modal').modal(true)

            emailPopupValidation(checkEmailAction, userId);
        },
        error: function (error) {
            console.log(error);
        }
    })
}

function emailPopupValidation(checkEmailAction, userId) {
    $('#change_email_form').validate({
        errorElement: 'span',
        errorClass: 'validation-error',
        rules: {
            email: {
                required: true,
                email: true,
                remote: {
                    url: checkEmailAction,
                    type: "post",
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content'),
                        email: function () {
                            return $("#email").val();
                        },
                        id: function () {
                            return userId
                        }
                    }
                }
            }
        },
        messages: {
            email: {
                required: "Please enter new email",
                remote: "This email already registered with us."
            }
        },
        submitHandler: function (form) {
            verification_mail();
        },
        success: function (result) {
            console.log(result);
        },
        error: function (error) {
            console.log(error);
            $("#change_email_modal").modal('hide');
        }
    });
}
