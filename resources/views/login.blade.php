<form method="POST" action="/login">
    @method('POST')
    @csrf
    <h2>Login acccount</h2>
   
    
    <p><input type="email" placeholder="eMail" name="email"></p>
    <p><input type="password" placeholder="Password" name="password"></p>   
    <p><input type="submit" value="Login"></p>
    @include('errors')
    @isset($mail)
    <p><a href="./resend/{{ $mail }}">Resend</a> verification mail to {{ $mail }}</p>
    @endisset
</form>  