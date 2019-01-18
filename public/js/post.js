$( document ).ready(function() {
    $('head').append('<link rel="stylesheet" href="../css/cStyle.css">');
    id =  $('#postId').val();
    link = 'http://localhost:8000/api/post/' + id;
    console.log(link)
    $.get(link)
    .done(function(data){
        console.log(data['title']);
       
        $('#title').html(data['title']);
        $('#body').html(bbToHTML(data['body']));
       

    })
    .fail(function(xhr, status, error) {   
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