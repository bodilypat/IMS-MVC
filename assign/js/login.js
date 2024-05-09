$(document).ready(function(){
    /* register  */
    $('#register').on('click', function(){
        register();
    });

    /* reset password */
    $('#resetPassword').on('click', function(){
        resetPassword();
    });

    /* login */
    $('#login').on('click', function(){
        login();
    });
});

/* register new user */
function register(){
    var rgFullName = $('#rgFullName').val();
    var rgUsername = $('#rgUsername').val();
    var rgPassword = $('#rgPassword').val();
    var rgConfirmPassword = $('#rgConfirmPassword');

    $.ajax = ({
        url: 'model/login/register.php',
        method: 'POST',
        data: {
            rgFullName:rgFullName,
            rgUsername:rgUsername,
            rgPassword:rgPassword,
            rgConfirmPassword:rgConfirmPassword,
        },
        success: function(data){
            $('#registerMessage').html(data);
        }
    });
}

/* reset password */
function resetPassword(){
    var rsUsername = $('#rsUsername').val();
    var rsPassword = $('#rsPassword').val();
    var rsConfirmPassword = $('rsConfirmPassword').val();

    $.ajax({
        url: 'model/login/resetPassword.php',
        method: 'POST',
        data: {
            rsUsername:rsUsername,
            rsPassword:rsPassword,
            rsConfirmPassword:rsConfirmPassword,
        },
        success: function(data){
            $('#resetMessage').html(data);
        }
    });
}