<div class="mb10">
    {!! Form::file('picture[]', null, array('class' => 'form-control',  'id' => 'picture.1')) !!}
    @if ($errors->has('picture.1'))
        <span class="help-block">
            <strong>{{ $errors->first('picture.1') }}</strong>
        </span>
    @endif
</div>
<div class="mb10">
    {!! Form::file('picture[]', null, array('class' => 'form-control',  'id' => 'picture.2')) !!}
    @if ($errors->has('picture.2'))
        <span class="help-block">
            <strong>{{ $errors->first('picture.2') }}</strong>
        </span>
    @endif
</div>


foreach ($messages->get('email') as $message) {
    //
}

'email' => 'unique:users,email_address,'.$user->id
mimes:jpeg,bmp,png
