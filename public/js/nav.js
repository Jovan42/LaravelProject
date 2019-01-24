$( document ).ready(function() {
    loggedIn = '';
    
    
    $.get("http://localhost:8000/api/auth/check")
    .done(function(data){
        $('#dropdownLogin').hide();
        $('#profile').show();

        $('#profileButton').html(data['username']);
        loggedIn = data['username'];

        $.get('http://localhost:8000/api/user/' + loggedIn +'/settings')
        .done(function(data){
            if(data['night_mode'])
                $('head').append('<link rel="stylesheet" href="../css/cStyleDark.css">');
            else
                $('head').append('<link rel="stylesheet" href="../css/cStyle.css">');
    
        })
        .fail(function(xhr, status, error) {   
            $('head').append('<link rel="stylesheet" href="../css/cStyle.css">');
        });

    })
    .fail(function(xhr, status, error) {   
        $('head').append('<link rel="stylesheet" href="../css/cStyle.css">');
    });
});

function logout(event) {
   
    $.post("http://localhost:8000/api/auth/logout")
    .done(function(data){
        window.location.href = '/home';    

    })
    .fail(function(xhr, status, error) {   
       
    });
}

function login(event, div){
    $.post("http://localhost:8000/api/auth/login",
    {
        email: $('#email').val(),
        password: $('#password').val(),
    })
    .done(function(msg){
        console.log(msg);
        window.location.href = '/home';
    })
    .fail(function(xhr, status, error) {   
        $('#errorMsg').html(xhr.responseJSON);
        $('#error').show();
    });
    event.preventDefault();
}

function showReg(event) {
    window.location.href = '/home';
    event.preventDefault();
}


function errorFade(event){
    $('#error').hide();
    event.preventDefault();
}

function forgotPass(event){
    window.location.href = '/request_password_reset';
    event.preventDefault();
}


function showReg(event){
    window.location.href = '/register';
    event.preventDefault();
}

