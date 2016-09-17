@if($errors->count()>0)
    @foreach($errors->all() as $error)
        <li>{{$error}}</li>
    @endforeach
@endif
