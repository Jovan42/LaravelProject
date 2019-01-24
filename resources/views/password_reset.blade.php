<html>
  
    @include('template.head')

  <script src="../js/passReset.js"></script>

</head>
   <body>
    @include('template.nav')
  
    <form class="text-warning" style="padding: 1%;">
      <div class="form-group">
      <input type="hidden" value="{{$link}}" id="link">
        <label for="exampleInputEmail1">New Password</label>
        <input type="password" class="form-control" id="change_password" placeholder="Password">
      </div>
      <div class="form-group">
        <label for="exampleInputPassword1">Password confirmation</label>
        <input type="password" class="form-control" id="password_confirmation" placeholder="Password confirmation ">
      </div>
      <button class="btn btn-default btn-warning" onclick="changePass(event, this)">Change password</button>

      <div class="alert alert-warning alert-dismissible show" role="alert" id="resetError" style="display: none; margin-top: 5%;">
          <p id="resetErrorMsg"></p>
          <button type="button" class="close" onclick="resetErrorFade(event)">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="alert alert-success" role="alert" id="send" style="display: none; margin-top: 5%;">
            <h4 class="alert-heading">Password successfully changed</h4>
          </div>
    </form>
   
  </body>
</html> 