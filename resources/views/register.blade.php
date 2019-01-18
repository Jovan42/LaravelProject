<div class="container" >
    <form>
      <div class="form-group">
        <label for="exampleInputEmail1">Email address</label>
        <input type="email" class="form-control" id="email" placeholder="Email">
      </div>
      <div class="form-group">
        <label for="exampleInputPassword1">Password</label>
        <input type="password" class="form-control" id="password" placeholder="Password">
      </div>
      <button class="btn btn-default btn-outline-primary" onclick="login(event)">Login</button>
      <button type="button" class="btn btn-outline-secondary"onclick="showReg(event)">Register form</button>
    </form>
     </div>


     <div class="container c-bg-primary" style="display: none;" id="reg">
        <form>
          <div class="form-group">
            <label for="exampleInputEmail1">Email address</label>
            <input type="email" class="form-control" id="regEmail" placeholder="Email">
          </div>
          <div class="form-group">
                <label for="exampleInputEmail1">Username</label>
                <input type="username" class="form-control" id="regUsername" placeholder="Username">
              </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <input type="password" class="form-control" id="regPassword" placeholder="Password">
          </div>
          <div class="form-group">
                <label for="exampleInputPassword1">Password Confirmation</label>
                <input type="password" class="form-control" id="regPassword_confirmation" placeholder="Password Confirmation">
              </div>
          <button class="btn  btn-outline-primary c-bg-sec" onclick="register(event)">Register</button>
        </form>
         </div>