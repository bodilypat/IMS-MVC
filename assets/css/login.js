$(document).ready(function() {
    /* register button */
    $('#register').on('click', function() {
        register();
    });

    /* reset password button */
    $('resetPassword').on('click', function() {
        resetPassword();
    });

    /* login button */
    $('#login').on('click', function() {
        login();
    });
});

/* Fucntion to register a new user  */
function register() {
    var registerFullName = $('#registFullName').val();
    var registerUsername = $('#registUsername').val();
    var registerPassword = $('#registPassword').val();
    var registerCfpassword = $('#registCfpassword').val();

    $.ajax({
        url: 'model/login/register.png',
        method: 'POST',
        data : {
            registerFullname:registerFullName,
            registerUsername:registerUsername,
            registerPassword:registerPassword,
            registerCfpassword:registerCfpassword,
        },
        success : function(data) {
            $('#registerMessage').html(data);
        }
    });
}

/* function to reset password */
function resetPassword() {
    var resetUsername = $('#resetUsername').val();
    var resetPassword = $('#resetPassword').val();
    var resetCfpassword = $('#resetCfpassword').val();

    $.ajax({
        url: 'model/login/resetPassword.php',
        method: 'POST',
        data : {
            resetUsername:resetUsername,
            resetPassword:resetPassword,
            resetCfpassword:resetCfpassword,
        },
        success: function(data) {
            $('#resetPasswordMessage').html(data);
        }
    });
}

/* function to login a user */
function login() {
    var loginUsername = $('#loginUsername').val();
    var loginPassword = $('#loginPassword').val();

    $.ajax({
        url: 'model/login/checkLogin.php',
        method: 'POST',
        data : {
            loginUsername:loginUsername,
            loginPassword:loginPassword,
        },
        success : function(data) {
            $('#loginMessage').html(data);
            if(data.indexOf('Redirecting') >= 0) {
                window.location = 'index.php';
            }
        }
    });
}