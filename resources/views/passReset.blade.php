<form method="POST" action="/resetPass">
    @method('POST')
    @csrf
    <h2>Enter email of account</h2>
    <p><input type="email" placeholder="eMail" name="email"></p>
    <p><input type="submit" value="Login"></p>
    @include('errors')
</form>  