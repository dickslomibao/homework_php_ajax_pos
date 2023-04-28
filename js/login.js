let tokenn = "";
var verifyCallback = function (response) {
    tokenn = response;
};
$(document).ready(function () {


    const username = $('#username');
    const password = $('#password');
    const btn = $('#lgnbtn');

    btn.click(async function (e) {



        if (username.val() == "") {
            $('#username-error').html('Username is required');
            username.focus();
            return;
        }
        $('#username-error').html('');
        if (password.val() == "") {
            $('#password-error').html('Password is required');
            password.focus();
            return;
        }
        if (tokenn == "") {
            $('#error').html('Captcha is required');
            return;
        }
        $('#password-error').html('');
        $('.loader').css('display', 'flex');
        await $.post("controller/userController.php", $('form').serializeArray().concat({
            name: "login", value: tokenn,
        }),
            function (data, textStatus, jqXHR) {
                if (data == "valid") {
                    location.href = "pages/home.php";
                } else if (data == "captcharequired") {
                    $('#error').html('Captcha is required');
                }
                else {
                    $('#error').html('Invalid Credentials. Check your username and password.');
                }
                grecaptcha.reset();
            },

        );
        $('.loader').css('display', 'none');
    });
    $('#password-error').html('');
});