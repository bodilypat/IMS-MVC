$(document).ready(function() {
    /* Listen to register button */
    $('#register').on('click', function() {
        register();
    });

    /* Listen to reset password button */
    $('#resetPassword').on('click', function() {
        resetPassword();
    });

    /* Listen to login button */
    $('#login').on('click', function() {
        login();
    });
});

/* function to register a new user */
function register() {
    var registFullName = $('#registFullName').val();
    var registUsername = $('#registUserName').val();
    var registPassword = $('#registPassword').val();
    var registCfpassword = $('#registCfpassword').val();

    $.ajax({
        url : 'admin/login/register.php',
        method: 'POST',
        data: {
            registFullName:registFullName,
            registUsername:registUsername,
            registPassword:registPassword,
            registCfpassword:registCfpassword,
        },
        success: function(data) {
            $('registMessage').html(data);
        }
    });
}

/* Function to reset password */
function resetPassword() {
    var resetUsername = $('#resetUsername').val();
    var resetPassword = $('#resetPassword').val();
    var resetCfpassword = $('#resetCfpassword').val();

    $.ajax({
        url: 'model/login/resetPassword.php',
        method: 'POST',
        data: {
            resetUsername:resetUsername,
            resetPassword:resetPassword,
            resetCfpassword:resetCfpassword,
        },
        success: function(data) {
            $('#resetPasswordMessage').html(data);
        }
    });
}

/* Function to login a user */
function login() {
    var loginUsername = $('#loginUsername').val();
    var loginPassword = $('#loginPassword').val();

    $.ajax({
        url: 'model/login/checkLogin.php',
        method: 'POST',
        data: {
            loginUsername:loginUsername,
            loginPassword:loginPassword,
        },
        success: function(data) {
            $('#loginMessage').html(data);
            if(data.indexOf('redirecting') >= 0) {
                window.location = 'index.php'
            }
        }
    });
}