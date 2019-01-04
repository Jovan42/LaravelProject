@if ($errors->any())

<div class="w3-panel w3-red">
    <h6 class="w3-text-light-g">Input Errors:</h6>
    <ul>
        @foreach ($errors->all() as $error)
            <li class="w3-text-light-g">{{$error}}</li>
        @endforeach
    </ul>
</div>
@endif