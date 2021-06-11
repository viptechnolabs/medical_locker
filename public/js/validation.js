let validator;


    validator = $('#hospital_details_update').validate({
        ignore: [],
        errorElement: 'span',
        errorClass: 'validation-error',
        rules: {
            hospital_name: {
                required: true,
                maxlength: 50,
                not_empty:true,
            },
            hospital_details: {
                required: true,
                maxlength: 250,
                not_empty:true,
            },
            hospital_registerno: {
                required: true,
                alpha_numeric: true,
                maxlength: 25,
                not_empty:true,
            },
            hospital_fex_no: {
                required: true,
                digits: true,
                maxlength: 13,
                not_empty:true,
            },
            hospital_pin_cord_no: {
                required: true,
                digits: true,
                maxlength: 13,
                not_empty:true,
            },
            hospital_address: {
                required: true,
                maxlength: 500,
                not_empty:true,
            }
        },
        submitHandler: function (form) {
            $(form).find(':input[type=submit]').prop('disabled', true)
            form.submit();
        },
        messages: {
            hospital_name: {
                required: "Please enter hospital name",
                maxlength: "Please enter maximum 50 characters.",
            },
            hospital_details: {
                required: "Please enter hospital details",
                maxlength: "Please enter maximum 250 characters.",
            },
            hospital_registerno: {
                required: "Please enter hospital register no",
                maxlength: "Please enter maximum 25 characters.",
            },
            hospital_fex_no: {
                required: "Please enter hospital fex no",
                digits: "Please enter only numbers",
                maxlength: "Please enter maximum 13 characters.",
            },
            hospital_pin_cord_no: {
                required: "Please enter hospital pin cord no",
                digits: "Please enter only numbers",
                maxlength: "Please enter maximum 13 characters.",
                not_empty:true,
            },
            hospital_address: {
                required: "Please enter hospital address",
                maxlength: "Please enter maximum 500 characters.",
            }
        }
    });

