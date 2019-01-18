$( document ).ready(function() {

	$("#editor").wysibb();
});

function post(event) {
	
       
};

function upload(event) {
    $.post("http://localhost:8000/api/post", {
        title: $('#title').val(),
		body: $('#editor').bbcode(),
		category_id: 1
    })
    .done(function(data){
       console.log(data);
    })
    .fail(function(xhr, status, error) {   
       
    });
    event.preventDefault();
};