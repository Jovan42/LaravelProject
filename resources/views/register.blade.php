<html>
  @include('template.head') 
  <script src="../js/register.js"></script>

  </head>
   <body>
  @include('template.nav')
  <div class="container" >
    <form class="text-warning" style="padding: 1%;">
      <div class="form-group">
        <label for="exampleInputEmail1">Username</label>
        <input type="text" class="form-control" id="regUsername" placeholder="Username">
      </div>
      <div class="form-group">
        <label for="exampleInputEmail1">Email address</label>
        <input type="email" class="form-control" id="regEmail" placeholder="Email">
      </div>
      <div class="form-group">
        <label for="exampleInputPassword1">Password </label>
        <input type="password" class="form-control" id="regPassword" placeholder="Password">
      </div>
      <div class="form-group">
        <label for="exampleInputPassword1">Password confirmation</label>
        <input type="password" class="form-control" id="regPasswordConfirmation" placeholder="Password confirmation">
      </div>
      <button class="btn btn-default btn-warning" onclick="register(event)">Register</button>
           <div class="alert alert-warning alert-dismissible show" role="alert" id="regError" style="display: none; margin-top: 5%;">
          <p id="regErrorMsg"></p>
          <button type="button" class="close" onclick="regErrorFade(event)">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
    </form>
    </div>   
  </body>
</html> 