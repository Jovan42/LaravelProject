<form method="POST" action="/resetPass">
    @method('POST')
    @csrf
    <h2>New password</h2>
   
    <p><input type="hidden" name="link" value="{{$link}}"></p>

    <p><input type="password" placeholder="Password" name="password"></p>
    <p><input type="password" placeholder="Password" name="password_confirmation"></p>
   
    <p><input type="submit" value="Change password"></p>
    @include('errors')
</form>  