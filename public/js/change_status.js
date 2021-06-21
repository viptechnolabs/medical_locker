
function StatusChange(url, action, message, user_type) {
    $.ajax({
        method: "post",
        url: url,
        data: {
            _token: $('meta[name="csrf-token"]').attr('content'),
            action: action,
            message: message,
            user_type: user_type,
        },
        success: function (result) {
            $('#status_change_popup').html(result);
            $('#change_status').modal('show');
        },
        error: function (error) {
            console.log(error);
        }
    });
}

