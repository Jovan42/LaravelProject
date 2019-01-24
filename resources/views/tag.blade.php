<html>
  @include('template.head') 
  <script src="../js/tag.js"></script>

  </head>
   <body>
  @include('template.nav')
  <div class="container" >
        <span>All post tagged with: </span> <h1 id="title">{{$id->name}}</h1>
  </div>
 
  <input type="hidden" value="{{$id->id}}" id="tagId"> 
    <div style=" margin: 3% " id="posts">
      
    </div>   
  </body>
</html> 