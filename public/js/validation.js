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
            },
            hospital_address: {
                required: "Please enter hospital address",
                maxlength: "Please enter maximum 500 characters.",
            }
        }
    });



validator = $('#add_doctor').validate({
    ignore: [],
    errorElement: 'span',
    errorClass: 'validation-error',
    rules: {
        name: {
            required: true,
            maxlength: 100,
            not_empty:true,
        },
        specialist: {
            required: true,
            maxlength: 100,
        },
        email: {
            email: true,
            required: true,
            maxlength: 100,
            not_empty:true,
        },
        mobile_no: {
            required: true,
            digits: true,
            maxlength: 13,
            not_empty:true,
        },
        address: {
            required: true,
            maxlength: 500,
            not_empty:true,
        },
        state: {
            required: true,
            not_empty:true,
        },
        city: {
            required: true,
            not_empty:true,
        },
        pin_code: {
            required: true,
            digits: true,
            maxlength: 13,
            not_empty:true,
        },
        aadhar_no: {
            required: true,
            digits: true,
            maxlength: 13,
            not_empty:true,
        },
        gender: {
            required: true,
            not_empty:true,
        },
        dob: {
            required: true,
            not_empty:true,
        },
        profile_photo: {
            required: true,
            not_empty:true,
        },
        document: {
            required: true,
            not_empty:true,
        },
    },
    submitHandler: function (form) {
        $(form).find(':input[type=submit]').prop('disabled', true)
        form.submit();
    },
    messages: {
        name: {
            required: "Please enter doctor name",
            maxlength: "Please enter maximum 100 characters.",
        },
        specialist: {
            required: "Please enter specialist.",
            maxlength: "Please enter maximum 100 characters.",
        },
        email: {
            required: "Please enter email id",
            email: "Please enter valid email address",
            maxlength: "Please enter maximum 100 characters.",
        },
        mobile_no: {
            required: "Please enter mobile no",
            digits: "Please enter only numbers",
            maxlength: "Please enter maximum 13 characters.",
        },
        state: {
            required: "Please enter state",
        },
        city: {
            required: "Please enter city",
            maxlength: "Please enter maximum 500 characters.",
        },
        address: {
            required: "Please enter doctor address",
            maxlength: "Please enter maximum 500 characters.",
        },
        pin_code: {
            required: "Please enter pin cord no",
            digits: "Please enter only numbers",
            maxlength: "Please enter maximum 13 characters.",
        },
        aadhar_no: {
            required: "Please enter aadhar card no",
            digits: "Please enter only numbers",
            maxlength: "Please enter maximum 13 characters.",
        },
        gender: {
            required: "Please enter gender",
        },
        dob: {
            required: "Please enter date of birth",
        },
        profile_photo: {
            required: "Please upload profile photo",
        },
        document: {
            required: "Please upload document photo",
        },
    }
});
$("#degree").rules("add", {required:true});
$("#certificates").rules("add", {required:true});


validator = $('#doctor_details_update').validate({
    ignore: [],
    errorElement: 'span',
    errorClass: 'validation-error',
    rules: {
        name: {
            required: true,
            maxlength: 100,
            not_empty:true,
        },
        specialist: {
            required: true,
            maxlength: 100,
        },
        email: {
            email: true,
            required: true,
            maxlength: 100,
            not_empty:true,
        },
        mobile_no: {
            required: true,
            digits: true,
            maxlength: 13,
            not_empty:true,
        },
        address: {
            required: true,
            maxlength: 500,
            not_empty:true,
        },
        state: {
            required: true,
            not_empty:true,
        },
        city: {
            required: true,
            not_empty:true,
        },
        pin_code: {
            required: true,
            digits: true,
            maxlength: 13,
            not_empty:true,
        },
        aadhar_no: {
            required: true,
            digits: true,
            maxlength: 13,
            not_empty:true,
        },
        dob: {
            required: true,
            not_empty:true,
        },
    },
    submitHandler: function (form) {
        $(form).find(':input[type=submit]').prop('disabled', true)
        form.submit();
    },
    messages: {
        name: {
            required: "Please enter doctor name",
            maxlength: "Please enter maximum 100 characters.",
        },
        specialist: {
            required: "Please enter specialist.",
            maxlength: "Please enter maximum 100 characters.",
        },
        email: {
            required: "Please enter email id",
            email: "Please enter valid email address",
            maxlength: "Please enter maximum 100 characters.",
        },
        mobile_no: {
            required: "Please enter mobile no",
            digits: "Please enter only numbers",
            maxlength: "Please enter maximum 13 characters.",
        },
        state: {
            required: "Please select state",
        },
        city: {
            required: "Please enter city",
        },
        address: {
            required: "Please enter hospital address",
            maxlength: "Please enter maximum 500 characters.",
        },
        pin_code: {
            required: "Please enter pin cord no",
            digits: "Please enter only numbers",
            maxlength: "Please enter maximum 13 characters.",
        },
        aadhar_no: {
            required: "Please enter aadhar card no",
            digits: "Please enter only numbers",
            maxlength: "Please enter maximum 13 characters.",
        },
        dob: {
            required: "Please enter date of birth",
        },
    }
});

validator = $('#add_user').validate({
    ignore: [],
    errorElement: 'span',
    errorClass: 'validation-error',
    rules: {
        name: {
            required: true,
            maxlength: 100,
            not_empty:true,
        },
        email: {
            email: true,
            required: true,
            maxlength: 100,
            not_empty:true,
        },
        mobile_no: {
            required: true,
            digits: true,
            maxlength: 13,
            not_empty:true,
        },
        address: {
            required: true,
            maxlength: 500,
            not_empty:true,
        },
        state: {
            required: true,
            not_empty:true,
        },
        city: {
            required: true,
            not_empty:true,
        },
        pin_code: {
            required: true,
            digits: true,
            maxlength: 13,
            not_empty:true,
        },
        aadhar_no: {
            required: true,
            digits: true,
            maxlength: 13,
            not_empty:true,
        },
        gender: {
            required: true,
            not_empty:true,
        },
        dob: {
            required: true,
            not_empty:true,
        },
        profile_photo: {
            required: true,
            not_empty:true,
        },
        document: {
            required: true,
            not_empty:true,
        },
    },
    submitHandler: function (form) {
        $(form).find(':input[type=submit]').prop('disabled', true)
        form.submit();
    },
    messages: {
        name: {
            required: "Please enter user name",
            maxlength: "Please enter maximum 100 characters.",
        },
        email: {
            required: "Please enter email id",
            email: "Please enter valid email address",
            maxlength: "Please enter maximum 100 characters.",
        },
        mobile_no: {
            required: "Please enter mobile no",
            digits: "Please enter only numbers",
            maxlength: "Please enter maximum 13 characters.",
        },
        state: {
            required: "Please select state",
        },
        city: {
            required: "Please enter city",
        },
        address: {
            required: "Please enter user address",
            maxlength: "Please enter maximum 500 characters.",
        },
        pin_code: {
            required: "Please enter pin cord no",
            digits: "Please enter only numbers",
            maxlength: "Please enter maximum 13 characters.",
        },
        aadhar_no: {
            required: "Please enter aadhar card no",
            digits: "Please enter only numbers",
            maxlength: "Please enter maximum 13 characters.",
        },
        gender: {
            required: "Please enter gender",
        },
        dob: {
            required: "Please enter date of birth",
        },
        profile_photo: {
            required: "Please upload profile photo",
        },
        document: {
            required: "Please upload document photo",
        },
    }
});

validator = $('#user_details_update').validate({
    ignore: [],
    errorElement: 'span',
    errorClass: 'validation-error',
    rules: {
        name: {
            required: true,
            maxlength: 100,
            not_empty:true,
        },
        email: {
            email: true,
            required: true,
            maxlength: 100,
            not_empty:true,
        },
        mobile_no: {
            required: true,
            digits: true,
            maxlength: 13,
            not_empty:true,
        },
        address: {
            required: true,
            maxlength: 500,
            not_empty:true,
        },
        state: {
            required: true,
            not_empty:true,
        },
        city: {
            required: true,
            not_empty:true,
        },
        pin_code: {
            required: true,
            digits: true,
            maxlength: 13,
            not_empty:true,
        },
        aadhar_no: {
            required: true,
            digits: true,
            maxlength: 13,
            not_empty:true,
        },
        dob: {
            required: true,
            not_empty:true,
        },
    },
    submitHandler: function (form) {
        $(form).find(':input[type=submit]').prop('disabled', true)
        form.submit();
    },
    messages: {
        name: {
            required: "Please enter user name",
            maxlength: "Please enter maximum 100 characters.",
        },
        email: {
            required: "Please enter email id",
            email: "Please enter valid email address",
            maxlength: "Please enter maximum 100 characters.",
        },
        mobile_no: {
            required: "Please enter mobile no",
            digits: "Please enter only numbers",
            maxlength: "Please enter maximum 13 characters.",
        },
        state: {
            required: "Please select state",
        },
        city: {
            required: "Please enter city",
        },
        address: {
            required: "Please enter user address",
            maxlength: "Please enter maximum 500 characters.",
        },
        pin_code: {
            required: "Please enter pin cord no",
            digits: "Please enter only numbers",
            maxlength: "Please enter maximum 13 characters.",
        },
        aadhar_no: {
            required: "Please enter aadhar card no",
            digits: "Please enter only numbers",
            maxlength: "Please enter maximum 13 characters.",
        },
        dob: {
            required: "Please enter date of birth",
        },
    }
});


validator = $('#add_patient').validate({
    ignore: [],
    errorElement: 'span',
    errorClass: 'validation-error',
    rules: {
        name: {
            required: true,
            maxlength: 100,
            not_empty:true,
        },
        email: {
            email: true,
            required: true,
            maxlength: 100,
            not_empty:true,
        },
        mobile_no: {
            required: true,
            digits: true,
            maxlength: 13,
            not_empty:true,
        },
        address: {
            required: true,
            maxlength: 500,
            not_empty:true,
        },
        state: {
            required: true,
            not_empty:true,
        },
        city: {
            required: true,
            not_empty:true,
        },
        pin_code: {
            required: true,
            digits: true,
            maxlength: 13,
            not_empty:true,
        },
        aadhar_no: {
            required: true,
            digits: true,
            maxlength: 13,
            not_empty:true,
        },
        gender: {
            required: true,
            not_empty:true,
        },
        dob: {
            required: true,
            not_empty:true,
        },
    },
    submitHandler: function (form) {
        $(form).find(':input[type=submit]').prop('disabled', true)
        form.submit();
    },
    messages: {
        name: {
            required: "Please enter patient name",
            maxlength: "Please enter maximum 100 characters.",
        },
        email: {
            required: "Please enter email id",
            email: "Please enter valid email address",
            maxlength: "Please enter maximum 100 characters.",
        },
        mobile_no: {
            required: "Please enter mobile no",
            digits: "Please enter only numbers",
            maxlength: "Please enter maximum 13 characters.",
        },
        state: {
            required: "Please select state",
        },
        city: {
            required: "Please enter city",
        },
        address: {
            required: "Please enter patient address",
            maxlength: "Please enter maximum 500 characters.",
        },
        pin_code: {
            required: "Please enter pin cord no",
            digits: "Please enter only numbers",
            maxlength: "Please enter maximum 13 characters.",
        },
        aadhar_no: {
            required: "Please enter aadhar card no",
            digits: "Please enter only numbers",
            maxlength: "Please enter maximum 13 characters.",
        },
        gender: {
            required: "Please enter gender",
        },
        dob: {
            required: "Please enter date of birth",
        },
    }
});

validator = $('#patient_details_update').validate({
    ignore: [],
    errorElement: 'span',
    errorClass: 'validation-error',
    rules: {
        name: {
            required: true,
            maxlength: 100,
            not_empty:true,
        },
        email: {
            email: true,
            required: true,
            maxlength: 100,
            not_empty:true,
        },
        mobile_no: {
            required: true,
            digits: true,
            maxlength: 13,
            not_empty:true,
        },
        address: {
            required: true,
            maxlength: 500,
            not_empty:true,
        },
        state: {
            required: true,
            not_empty:true,
        },
        city: {
            required: true,
            not_empty:true,
        },
        pin_code: {
            required: true,
            digits: true,
            maxlength: 13,
            not_empty:true,
        },
        aadhar_no: {
            required: true,
            digits: true,
            maxlength: 13,
            not_empty:true,
        },
        dob: {
            required: true,
            not_empty:true,
        },
    },
    submitHandler: function (form) {
        $(form).find(':input[type=submit]').prop('disabled', true)
        form.submit();
    },
    messages: {
        name: {
            required: "Please enter patient name",
            maxlength: "Please enter maximum 100 characters.",
        },
        email: {
            required: "Please enter email id",
            email: "Please enter valid email address",
            maxlength: "Please enter maximum 100 characters.",
        },
        mobile_no: {
            required: "Please enter mobile no",
            digits: "Please enter only numbers",
            maxlength: "Please enter maximum 13 characters.",
        },
        state: {
            required: "Please select state",
        },
        city: {
            required: "Please enter city",
        },
        address: {
            required: "Please enter patient address",
            maxlength: "Please enter maximum 500 characters.",
        },
        pin_code: {
            required: "Please enter pin cord no",
            digits: "Please enter only numbers",
            maxlength: "Please enter maximum 13 characters.",
        },
        aadhar_no: {
            required: "Please enter aadhar card no",
            digits: "Please enter only numbers",
            maxlength: "Please enter maximum 13 characters.",
        },
        dob: {
            required: "Please enter date of birth",
        },
    }
});


validator = $('#add_report').validate({
    ignore: [],
    errorElement: 'span',
    errorClass: 'validation-error',
    rules: {
        consultant_doctor: {
            required: true,
            not_empty:true,
        },
        treatment_name: {
            required: true,
            maxlength: 100,
            not_empty:true,
        },
        insurance: {
            required: true,
            not_empty:true,
        },
        type: {
            required: true,
            not_empty:true,
        },
        routine_checkup: {
            required: true,
            not_empty:true,
        },
        consultant_date: {
            required: true,
            not_empty:true,
        },
        file: {
            required: true,
            not_empty:true,
        },
    },
    submitHandler: function (form) {
        $(form).find(':input[type=submit]').prop('disabled', true)
        form.submit();
    },
    messages: {
        consultant_doctor: {
            required: "Please select consultant doctor",
        },
        treatment_name: {
            required: "Please enter treatment name",
            maxlength: "Please enter maximum 100 characters.",
        },
        type: {
            required: "Please select type",
        },
        routine_checkup: {
            required: "Please select routine checkup",
        },
        insurance: {
            required: "Please select insurance",
        },
        consultant_date: {
            required: "Please enter consultant date",
        },
        file: {
            required: "Please upload file (report)",
        },
    }
});


// validator = $('#download').validate({
//     ignore: [],
//     errorElement: 'span',
//     errorClass: 'validation-error',
//     rules: {
//         option: {
//             required: true,
//             not_empty:true,
//         },
//         start_date: {
//             required: true,
//             not_empty:true,
//         },
//         end_date: {
//             required: true,
//             not_empty:true,
//         },
//     },
//     submitHandler: function (form) {
//         $(form).find(':input[type=submit]').prop('disabled', true)
//         form.submit();
//     },
//
// });

// validator = $('#list_download').validate({
//     ignore: [],
//     errorElement: 'span',
//     errorClass: 'validation-error',
//     rules: {
//         option: {
//             required: true,
//             not_empty:true,
//         },
//         start_date: {
//             required: true,
//             not_empty:true,
//         },
//         end_date: {
//             required: true,
//             not_empty:true,
//         },
//     },
//     messages: {
//         option: {
//             required: "Please select any option",
//         },
//         start_date: {
//             required: "Please enter date range",
//         },
//         end_date: {
//             required: "Please enter tye",
//         },
//     },
//     submitHandler: function(form) {
//         //
//     }
//
// });

