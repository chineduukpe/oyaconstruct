@if($errors->any())
    <div class="alert alert-danger">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
        <ul>
            @foreach($errors as $error)
                <p>{{$error}}</p>
            @endforeach
        </ul>
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
        <ul>
            <p>{{session('error')}}</p>
        </ul>
    </div>
@endif

@if(session('success'))
    <div class="alert alert-success">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
        <ul>
            <p>{{session('success')}}</p>
        </ul>
    </div>
@endif


