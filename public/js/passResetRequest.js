function send(event, btn) {
    
    $.post('/api/auth/requestPasswordChange/', {
        email: $('#emailReset').val()
    })
    .done(function(data){
        $('#resetError').hide();
        $('#send').show();
        $(btn).prop("disabled",true);
        
    })
    .fail(function(xhr, status, error) {   
        $('#resetErrorMsg').html(xhr.responseJSON);
        $('#resetError').show();
    })
}

function resetErrorFade(event){
    $('#resetError').hide();
    event.preventDefault();
}