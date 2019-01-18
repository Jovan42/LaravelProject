<html>
  
    @include('template.head') 
    <script src="../js/addPost.js"></script>

    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="../js/jquery.wysibb.js"></script>

  <link rel="stylesheet" href="../css/wbbtheme.css">

  <script>
    $(function() {
    $("#editor").wysibb();
    })
    </script>
</head>
   <body>
    @include('template.nav')
  
    <div style="margin: 2% 10%!important;">
    <input class="form-control mr-sm-2" id="title" placeholder="Title" aria-label="Title">
    <textarea id="editor" style="height:50%!important;" ></textarea> 
    <button type="button" class="btn btn-warning" onclick="upload(event)" style="margin-top:1%; min-width: 5%;">Post</button>
    </div>
  </body>
</html> 