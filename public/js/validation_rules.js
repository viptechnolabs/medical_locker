var australia_phone_number_regex = /^(?:\+?(61))? ?(?:\((?=.*\)))?(0?[2-57-8])\)? ?(\d\d(?:[- ](?=\d{3})|(?!\d\d[- ]?\d[- ]))\d\d[- ]?\d[- ]?\d{3})$/;

$.validator.addMethod(
    "phone_number_regex",
    function (value, element, regexp) {
        var re = new RegExp(regexp);
        return this.optional(element) || re.test(value);
    },
    "Please enter valid phone number"
);

$.validator.addMethod("checkAge", function (value, element) {
    const dobArray = value.split("/");
    const dob = new Date(parseInt(dobArray[2]), parseInt(dobArray[1]) - 1, parseInt(dobArray[0]));
    const today = new Date();
    const age = Math.floor((today - dob) / (365.25 * 24 * 60 * 60 * 1000));
    return (age >= 18);
}, "Your age is not eligible.");

function validateSelect2(th) {
    const that = $(th);
    if (that.val() !== "") {
        $(th).valid();
    }
}

$.validator.addMethod("lettersonly", function (value, element) {
    return this.optional(element) || /^[A-Za-zÀ-ÿ]+$/i.test(value);
    // return this.optional(element) || /^[A-Za-zÀ-ÿ]+$/i.test(value);
}, "Please enter letters only");

$.validator.addMethod("noSpace", function (value, element) {
    return value.indexOf(" ") < 0 && value != "";
}, "No space required");

$.validator.addMethod("valid_url", function (value, element) {
    return value.match(/^$|[-a-zA-Z0-9@:%._\+~#=]{1,256}\.[a-zA-Z0-9()]{1,6}\b([-a-zA-Z0-9()@:%_\+.~#?&//=]*)?/gi);
}, "Please enter valid url");
