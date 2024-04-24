$(document).ready(function(){

    $('#register').on('click',function(){
        register();
    });

    $('#resetPassword').on('click', function(){
        resetPassword();
    });

    $('login').on('click', function(){
        login();
    });
});

function register(){
    var fullname = $('#fullname').val();
    var username = $('#username').val();
    var password = $('$password').val();
    var confirmPassword = $('confirmPassword').val();
    $.ajax({
        url: 'model/login/register.php',
        method: 'POST',
        data: {
            fullName:fullname,
            username:username,
            password:password,
            confirmPassword:confirmPassword,
        },
        success: function(data){
            $('#registerMessage').html(data);
        }
    });
}

//function to reset password
function resetPassword(){
    var username = $('#username').val();
    var password = $('#password').val();
    var confirmPasswrod = $('#confirmPassword').val();

    $.ajax({
        url: 'model/login/resetPassword.php',
        method: 'POST',
        data: {
            username:username,
            password:password,
            confirmPassword:confirmPassword,
        },
        success: function(data){
            $('#resetPasswordMessage').html(data);
        }
    });
}