$( document ).ready(function() {
    $.get('http://localhost:8000/api/tag/' +  $('#tagId').val()  + '/posts')
    .done(function(data){
        postsDiv = $('#posts');
        
        $.each(data, function(i, item) {
            post = '<div onclick="read(event, this)"  data-id="{id}" class="card border-success" style="color: #000!important; border-color: #000!important; max-width: 18rem; min-width: 18rem; margin: 15px;" id="cardTemplate"> '
            +'<h5 class="card-header" id="title" style="border-color: #000;">{Title}</h5>'
            +  '<div class="card-body text-success" style="border-color: #000;  color: #000; ">'
            +    '<p class="card-text"style="border-color: #000; max-height: 6em; line-height: 1em; overflow: hidden; color: #000; ">{Body}</p>'   
            +'</div></div>'

            post = post.replace('{Title}', item['title']).replace('{Body}', item['body']).replace('{id}', item['id']);
            postsDiv.append($.parseHTML(bbToHTML(post)))    ;
        });
    })
    .fail(function(xhr, status, error) {   
        $('#errorMsg').html(xhr.responseJSON);
        $('#error').show();
    });
   
});


function bbToHTML(bb) {
    $format_search =  [
        /\[b\](.*?)\[\/b\]/ig,
        /\[i\](.*?)\[\/i\]/ig,
        /\[u\](.*?)\[\/u\]/ig,
        /\[img\](.*?)\[\/img\]/ig,
    ]; // note: NO comma after the last entry
    
    // The matching array of strings to replace matches with
    $format_replace = [
        '<strong>$1</strong>',
        '<em>$1</em>',
        '<span style="text-decoration: underline;">$1</span>',
        '<img src=$1 >'
    ];
    
    // Perform the actual conversion
    for (var i =0;i<$format_search.length;i++) {
      bb = bb.replace($format_search[i], $format_replace[i]);
    }
    return bb;
}   

function read(event, div) {
    window.location.href = '/post/' + $(div).attr("data-id");
    event.preventDefault();
}