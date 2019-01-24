function changePass(event, btn) {
    $.post("http://localhost:8000/api/auth/resetPass/" + $('#link').val(), {
        password: $('#change_password').val(),
        password_confirmation: $('#password_confirmation').val(),
    })
    .done(function(data){
        $('#resetError').hide();
        $('#send').show();
        $(btn).prop("disabled",true); 

    })
    .fail(function(xhr, status, error) {   
        console.log(xhr);
        $('#resetErrorMsg').html(xhr.responseText);
        $('#resetError').show();
    });
    event.preventDefault();

}

function errorFade(event){
    $('#resetError').hide();
    event.preventDefault();
}