$( document ).ready(function() {
    $('head').append('<link rel="stylesheet" href="../css/cStyle.css">');
    id =  $('#postId').val();
    link = 'http://localhost:8000/api/post/' + id;
    console.log(link)
    $.get(link)
    .done(function(data){
        console.log(data);
        $('#title').html(data['title']);
        $('#body').html(bbToHTML(data['body']));
        tags = $('#tags');
        $.each(data['tags'], function(i, item) {

            tag = ' <button style="font-size: 0.8em; padding: 0.3em;" type="button" onclick="goToTag({tagId})" class="btn btn-outline-info">{Name}</button>';
            tag = tag.replace('{Name}', item['name']).replace('{tagId}', item['id']);
            tags.append(tag);
        });

    })
    .fail(function(xhr, status, error) {   
    });
   
});

function goToTag(tagId){
    window.location.href = '/tag/' + tagId;
    event.preventDefault();
}


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