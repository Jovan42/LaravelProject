<html>
  @include('template.head') 
  <script src="../js/post.js"></script>
    </head>
   <body>
  @include('template.nav')
   <input type="hidden" value="{{$id}}" id="postId"> 
   <div class="container" style="min-height: 100%;">
        <h1 class="text-p" id="title"></h1>
        <p id="body"></p>
      </div>
  </body>
  @include('template.footer') 
</html> 