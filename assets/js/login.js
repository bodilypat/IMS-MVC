$(document).ready(function() {
    /* list to register button */
    $('#register').on('click', function() {
        register();
    });

    /* lister to reset password button */
    $('#resetPassword').on('click', function() {
        resetPassword();
    });

    /* listen to login button */
    $('#login').on('click', function() {
        login();
    });
});
/* function to register a new user */
function register() {
    var registFullName = $('#registFullName').val();
    var registUsername = $('#registUsername').val();
    var registPass = $('#registPassword').val();
    var registCfPass = $('#registConfirmPassword').val();

    $.ajax({
        url: 'admin/login/register.php';
        method: 'POST',
        data: {  /* data sent to the server */
            registFullName:registFullName,
            registUsername:registUsername,
            registPass:registPass,
            registCfPass:registCfPass,
        }, 
        success: function(data) { /* success callback */
            $('#registMessage').html(data);
        },
        error: function(xhr, status, error) { // Error callback in case of AJAX failure
            console.log("Request failed:" + error);
            $('#registMessage').html('An error occurred. Please try again later.');
        }
    });
}

/* function to reset password */
function resetPassword() {
    var resetUsername = $('#resetUsername').val();
    var resetPassword = $('#resetPasswrod').val();
    var confirmPassword = $('#confirmPassword').val();

    /* Client - side validation for passwords */
    if(resetPassword === '' || confirmPassword === '') {
        $('#resetPasswordMessage').html('Please fill in both password fields.');
        return; /* stop the function if validation fails */
    }

    if(resetPassword !== confirmPassword) {
        $('#resetPasswordMessage').html('Please fill in both password fields.');
        return; /* Stop the function if validation fails */
    }
    
    $.ajax({
        url: 'admin/login/resetPassword.php',
        method: 'POST',
        data: {
            resetUsername:resetUsername,
            resetPassword:resetPassword,
            confirmPassword:confirmPassword,
        },
        success: function(data) {
            $('#resetPasswordMessage').html(data);
        },
        error: function(xhr, status, error) {
            console.log('request failed:' + error);
            $('#resetPassordMessage').html('An error occcurred. Plase try-again later.');
        }
    });
}

/* function login a user */
function login() {
    var loginUsername = $('#loginUsername').val();
    var loginPassword = $('#loginPassword').val();

    $.ajax({
        url: 'admin/login/checkLogin.php',
        method: 'POST',
        data : {
            loginUsername:loginUsername,
            loginPassword:loginPassword,
        },
        success: function(data) {
            $('#loginMessage').html(data);
            if (data.indexOf('Redirecting') >= 0) {
                window.location = 'index.php';
            }
        },
        error: function(xhr, status, error) {
            console.log('request failed: ' + error);
            $('#loginMessage').html("An error occurred. Please try again later.");
        }
    });
}