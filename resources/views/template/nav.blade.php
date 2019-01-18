<nav class="navbar navbar-expand-lg navbar-light c-bg-nav"  style=" width: 100% ">
        <a class="navbar-brand text-warning" href="#">Naziv sajta</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
      <div class="navbar-collapse" id="navbarSupportedContent">
        <form class="form-inline my-2 my-lg-0 ">
          <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-warning   my-2 my-sm-0" type="submit">Search</button>
        </form>
        <div class="dropdown" id="dropdownLogin" style="padding-left: 1%;" >
            <button class="btn btn-outline-warning dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Login
            </button>
            <div class="dropdown-menu c-bg-primary" aria-labelledby="dropdownMenu2" style="min-width: 500">
                <form class="text-warning" style="padding: 1%;">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Email address</label>
                      <input type="email" class="form-control" id="email" placeholder="Email">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">Password</label>
                      <input type="password" class="form-control" id="password" placeholder="Password">
                    </div>
                    <button class="btn btn-default btn-warning" onclick="login(event)">Login</button>
                    <button type="button" class="btn btn-outline-warning"onclick="showReg(event)">Register</button>
                    <button type="button" class="btn  btn-outline-light"onclick="forgotPass(event)">Forgot password</button>


                    <div class="alert alert-warning alert-dismissible show" role="alert" id="error" style="display: none; margin-top: 5%;">
                        <p id="errorMsg"></p>
                        <button type="button" class="close" onclick="errorFade(event)">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                  </form>
            </div>
          </div>

          <div class="dropdown" id="profile"  style="padding-left: 1%; display:none;" >
            <button class="btn btn-outline-warning dropdown-toggle" id="profileButton" style="margin-left: 1%; float: right;" type="button"  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Profile
            </button>
            <div class="dropdown-menu c-bg-primary" aria-labelledby="dropdownMenu2">
              <button class="btn btn-default btn-warning" style="width: 100%;" onclick="gotoProfile()">Go to profile</button>
              <button class="btn btn-default btn-warning" style="width: 100%; margin-top: 10px;" onclick="gotoProfile()">Night mode</button> 
              <button class="btn btn-default btn-warning" style="width: 100%; margin-top: 10px;" onclick="logout()">Log out</button> 

            </div>
          </div> 
      </div>
    </nav>