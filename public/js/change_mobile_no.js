function getMobilePopup(action, checkMobileAction, userId) {
    $.ajax({
        url: action,
        type: "post",
        data: {},
        success: function (data) {
            $('#update_mobile_popup').html(data);
            $('#change_mobile_modal').modal(true)

            mobilePopupValidation(checkMobileAction, userId);
        },
        error: function (error) {
            console.log(error);
        }
    })
}

function mobilePopupValidation(checkMobileAction, userId) {
    $('#change_mobile_form').validate({
        errorElement: 'span',
        errorClass: 'validation-error',
        rules: {
            mobile_no: {
                required: true,
                remote: {
                    url: checkMobileAction,
                    type: "post",
                    data: {
                        mobile_no: function () {
                            return $("#mobile_no").val();
                        },
                        id: function () {
                            return userId
                        }
                    }
                }
            }
        },
        messages: {
            mobile_no: {
                required: "Please enter new Mobile no",
                remote: "This mobile no  already registered with us."
            }
        },
        submitHandler: function (form) {
            verification_mobile();
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
