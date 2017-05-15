@if (count($errors) > 0)
<div class="container">
    <div class="row">
        <div class="alert alert-danger">
            <strong>Whoops! Something went wrong!</strong>
            <br><br>
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
@endif

@if(Session::has('message'))
<div class="container">
    <div class="row">
        <div class="alert alert-info">
            <p>{{ Session::get('message') }}</p>
        </div>
    </div>
</div>
@endif
@if(Session::has('error'))
<div class="container">
    <div class="row">
        <div class="alert alert-danger">
            <p>{{ Session::get('error') }}</p>
        </div>
    </div>
</div>
@endif