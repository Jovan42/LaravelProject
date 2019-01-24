
function register(event){
    $.post("http://localhost:8000/api/auth/register",
    {
        username: $('#regUsername').val(),
        email: $('#regEmail').val(),
        password: $('#regPassword').val(),
        password: $('#regPasswordConfirmation').val(),
    })
    .done(function(msg){
       
        window.location.href = '/home';
    })
    .fail(function(xhr, status, error) {   
        $('#regErrorMsg').html(xhr.responseText);
        $('#regError').show();
    });
    event.preventDefault();
}


function regErrorFade(event){
    $('#regError').hide();
    event.preventDefault();
}
