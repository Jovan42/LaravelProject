<html>
  
    @include('template.head')

  <script src="../js/passReset.js"></script>

</head>
   <body>
    @include('template.nav')
  
    <div style="margin: 2% 10%!important;">
    <input class="form-control" id="emailReset" type="email"  placeholder="eMail">
    <button type="button" class="btn btn-warning" onclick="send(event,this)" style="margin-top:1%; min-width: 5%;">Send</button>
    
    <div class="alert alert-warning alert-dismissible show" role="alert" id="resetError" style="display: none; margin-top: 5%;">
        <p id="resetErrorMsg"></p>
        <button type="button" class="close" onclick="resetErrorFade(event)">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="alert alert-success" role="alert" id="send" style="display: none; margin-top: 5%;">
        <h4 class="alert-heading">Mail send</h4>
        <p>To restart password click on link send to your mail.</p>
      </div>
    </div>
   
  </body>
</html> 