$.validator.addMethod(
    "not_empty",
    function (value, element) {
        return this.optional(element) || /\S/.test(value);
    },
    "No space required."
);
$.validator.addMethod("alphanum", function (value, element) {
    return this.optional(element) || /^[a-zA-Z0-9À-ÿ]+$/.test(value);
});
$.validator.addMethod(
    "alpha_numeric",
    function (value, element) {
        return this.optional(element) || /^[a-zA-Z0-9À-ÿ\s]+$/.test(value);
    },
    "This field may only contain letters, numbers and space."
);

jQuery.validator.addMethod("greaterStart", function (value, element, params) {
    return this.optional(element) || new Date(value) >= new Date($(params).val());
},'Must be greater than start year.');

$.validator.addMethod("endDate", function(value, element) {
    var startDate = $('.startDate').val();
    return Date.parse(startDate) <= Date.parse(value) || value == "";
}, "* End date must be after start date");

jQuery.validator.addMethod("greaterThan",
    function(value, element, params) {

        if (!/Invalid|NaN/.test(new Date(value))) {
            return new Date(value) > new Date($(params).val());
        }

        return isNaN(value) && isNaN($(params).val())
            || (Number(value) > Number($(params).val()));
    },'Must be greater than {0}.');
