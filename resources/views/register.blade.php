<form method="POST" action="/register">
    @method('POST')
    @csrf
    <h2>Register acccount</h2>
   
    <p><input type="text" placeholder="Name" name="username"></p>
    <p><input type="email" placeholder="eMail" name="email"></p>
    <p><input type="password" placeholder="Password" name="password"></p>
    <p><input type="password" placeholder="Password" name="password_confirmation"></p>
   
    <p><input type="submit" value="Register"></p>
    @include('errors')
</form>  