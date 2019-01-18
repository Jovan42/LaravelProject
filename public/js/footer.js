$( document ).ready(function() {
    $.get("http://localhost:8000/api/auth/check")
    .done(function(data){
        postsDiv = $('#posts');
        
        $.each(data, function(i, item) {
            post = '<div onclick="read(event, this)"  data-id="{id}" class="card border-success" style="color: #000!important; border-color: #000!important; max-width: 18rem; min-width: 18rem; margin: 15px;" id="cardTemplate"> '
            +'<h5 class="card-header" id="title" style="border-color: #000;">{Title}</h5>'
            +  '<div class="card-body text-success" style="border-color: #000;  color: #000; ">'
            +    '<p class="card-text"style="border-color: #000;  color: #000; ">{Body}</p>'   
            +'</div></div>'

            post = post.replace('{Title}', item['title']).replace('{Body}', item['body'].substring(0, 200) + '...').replace('{id}', item['id']);
            postsDiv.append($.parseHTML(post));
        });
    })
    .fail(function(xhr, status, error) {   
        $('#errorMsg').html(xhr.responseJSON);
        $('#error').show();
    });
});