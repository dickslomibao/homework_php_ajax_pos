$(document).ready(function () {

    const name = $('#name');
    const email = $('#email');
    const username = $('#username');
    const password = $('#password');
    const repassword = $('#repass');
    const btn_submit = $('#submit');
    let flag = "";
    let unameFlag = "";
    let valid = [
        false,
        false,
        false,
        false,
        false,
    ];

    name.focus(function () {
        validateName(name.val());
    });
    name.focusout(function () {
        if (!valid[0])
            name.focus();
    });
    name.keyup(function () {
        validateName(name.val());
    });

    username.focus(function () {
        validateUsername(username.val());
    });
    username.focusout(function () {
        if (!valid[2])
            username.focus();
    });
    username.keyup(function () {
        validateUsername(username.val());
    });
    email.focus(function () {
        validateEmail(email.val());
    });
    email.focusout(function () {
        if (!valid[1])
            email.focus();
    });
    email.keyup(function () {
        validateEmail(email.val());
    });
    password.focus(function () {
        validatePassword(password.val());
    });
    password.focusout(function () {
        if (!valid[3])
            password.focus();
    });
    password.keyup(function () {
        validatePassword(password.val());
    });
    repassword.focus(function () {
        validateRepass(repassword.val());
    });
    repassword.keyup(function () {
        validateRepass(repassword.val());
    });

    btn_submit.click(async function () {
        validateName(name.val());
        validateEmail(email.val());
        validateUsername(username.val())
        validatePassword(password.val());
        validateRepass(repassword.val());
        let isValid = valid.includes(false);
        if (!isValid) {
            if (!$('#checkbox').is(':checked')) {
                $('#terms-error').html('Please agree with terms and condition.');
            } else {
                $('#terms-error').html('');
                $('.loader').css('display', 'flex');

                await $.post("../controller/userController.php", $('form').serializeArray().concat({
                    name: "add-user", value: ""
                }),
                    function (data, textStatus, jqXHR) {
                        if (data == '200') {
                            location.href = '../';
                        }
                        console.log(data);
                    },
                );
            }
        }
    });

    function validateName(val) {
        if (val == "") {
            $('#name-error').html('Name is required');
            valid[0] = false;
            return;
        }
        valid[0] = true;
        $('#name-error').html('');

    }
    async function validateEmail(val) {
        if (val == "") {
            $('#email-error').html('Email is required');
            valid[1] = false;
            return;
        }
        let em = /^\w+([-+.'][^\s]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/;
        var emailFormat = em.test(val);
        if(!emailFormat){
            $('#email-error').html('Invalid email');
            valid[1] = false;
            return;
        }
        await $.post("../controller/userController.php", {
            'checkEmail': val,
        },
            function (data, textStatus, jqXHR) {
                flag = data;
            },
        );

        if (flag == "1") {
            valid[1] = false;
            $('#email-error').html('Email is already used');
            return;
        }
        valid[1] = true;
        $('#email-error').html('');
    }
    async function validateUsername(val) {
        if (val == "") {
            $('#username-error').html('Username is required');
            valid[2] = false;
            return;
        }

        await $.post("../controller/userController.php", {
            'checkUsername': val,
        },
            function (data, textStatus, jqXHR) {
                unameFlag = data;
                console.log(data);
            },

        );
        if (unameFlag == '1') {
            valid[2] = false;
            $('#username-error').html('Username is already used');
            return;
        }
        valid[2] = true;
        $('#username-error').html('');
    }
    function validatePassword(val) {
        if (val == "") {
            $('#password-error').html('Password is required');
            valid[3] = false;
            return;
        }
        valid[3] = true;
        $('#password-error').html('');
    }
    function validateRepass(val) {
        if (val == "") {
            $('#repass-error').html('Re-type pass is required');
            valid[4] = false;
            return;
        }
        if (val != password.val()) {
            $('#repass-error').html('Password didn\'t match.');
            valid[4] = false;
            return;
        }
        valid[4] = true;
        $('#repass-error').html('');
    }
});
