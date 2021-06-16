
function StatusChange(url, action, message) {
    $.ajax({
        method: "post",
        url: url,
        data: {
            _token: $('meta[name="csrf-token"]').attr('content'),
            action: action,
            message: message,
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

