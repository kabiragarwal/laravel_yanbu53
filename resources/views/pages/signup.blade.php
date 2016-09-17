@extends('layouts.app')

@section('content')

<div class="main-container">
    <div class="container">
        <div class="row">
            <div class="col-md-8 page-content">
                <div class="inner-box category-content">
                    <h2 class="title-2"> <i class="icon-user-add"></i> Create your account, Its free </h2>
                    <div class="row">
                        <div class="col-sm-12">
                            @include ('flash::message')
                            <form method="post" action="{{ url('/signup') }}" class="form-horizontal">
                                {{ csrf_field() }}
                                <fieldset>
                                    <div class="form-group ">
                                        <label class="col-md-4 control-label">You are a </label>
                                        <div class="col-md-6">
                                            <div class="radio">
                                                <label>
                                                    <input type="radio" name="user_type" id="optionsRadios1" value="Professional" checked="checked" {{ old('user_type')=='Professional'?"checked='checked'":'' }}  >
                                                           Professional </label>
                                            </div>
                                            <div class="radio">
                                                <label>
                                                    <input type="radio" name="user_type" id="optionsRadios2" value="Individual" {{ old('user_type')=='Individual'?"checked='checked'":'' }}>
                                                           Individual </label>
                                            </div>
                                            @if ($errors->has('user_type'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('user_type') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group  {{ $errors->has('first_name') ? ' has-error' : '' }}">
                                        <label for="name" class="col-md-4 control-label">First Name </label>

                                        <div class="col-md-6">
                                            <input id="name" type="text"  required  class="form-control input-md" name="first_name" value="{{ old('first_name') }}" placeholder="First Name" >

                                            @if ($errors->has('first_name'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('first_name') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>


                                    <div class="form-group  {{ $errors->has('last_name') ? ' has-error' : '' }}">
                                        <label class="col-md-4 control-label">Last Name </label>
                                        <div class="col-md-6">
                                            <input name="last_name" required  placeholder="Last Name"  value="{{ old('last_name') }}" class="form-control input-md" type="text">
                                            @if ($errors->has('last_name'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('last_name') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group  {{ $errors->has('phone') ? ' has-error' : '' }}">
                                        <label class="col-md-4 control-label">Phone Number </label>
                                        <div class="col-md-6">
                                            <input name="phone"  required  placeholder="Phone Number"  value="{{ old('phone') }}" class="form-control input-md" type="text">
                                            @if ($errors->has('phone'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('phone') }}</strong>
                                            </span>
                                            @endif
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox"  name="hide_phone" value="1" {{ old('hide_phone')?"checked='checked'":'' }}>
                                                           <small> Hide the phone number on the published ads.</small> </label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group {{ $errors->has('gender') ? ' has-error' : '' }}">
                                        <label class="col-md-4 control-label">Gender</label>
                                        <div class="col-md-6">
                                            <div class="radio">
                                                <label for="Gender-0">
                                                    <input name="gender" id="Gender-0" value="Male" checked="checked" type="radio" {{ old('gender')=='Male'?"checked='checked'":'' }}>
                                                           Male </label>
                                            </div>
                                            <div class="radio">
                                                <label for="Gender-1">
                                                    <input name="gender" id="Gender-1" value="Female" type="radio" {{ old('gender')=='Female'?"checked='checked'":'' }}>
                                                           Female </label>
                                            </div>
                                            @if ($errors->has('gender'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('gender') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                                        <label for="inputEmail3" class="col-md-4 control-label">Email </label>
                                        <div class="col-md-6">
                                            <input type="text"  required  name="email" class="form-control"  value="{{ old('email') }}" id="inputEmail3" placeholder="Email">
                                            @if ($errors->has('email'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
                                        <label for="inputPassword3" class="col-md-4 control-label">Password </label>
                                        <div class="col-md-6">
                                            <input type="password"  required  name="password" class="form-control" id="inputPassword3"  value="" placeholder="Password">
                                            @if ($errors->has('password'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('password') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group {{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                                        <label for="inputPassword3" class="col-md-4 control-label">Confirm Password </label>
                                        <div class="col-md-6">
                                            <input type="password" required   name="password_confirmation" class="form-control" id="inputPassword3"  value="" placeholder="Password">
                                            @if ($errors->has('password_confirmation'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('password_confirmation') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group{{ $errors->has('terms') ? ' has-error' : '' }}">
                                        <label class="col-md-4 control-label"></label>
                                        <div class="col-md-8">
                                            <div class="termbox mb10">
                                                <label class="checkbox-inline" for="checkboxes-1">
                                                    <input name="terms"  required  id="checkboxes-1" value="1" type="checkbox" {{ old('terms')?"checked='checked'":'' }}>
                                                           I have read and agree to the <a href="{{url('terms-and-conditions')}}">Terms & Conditions</a> </label>
                                                @if ($errors->has('terms'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('terms') }}</strong>
                                                </span>
                                                @endif

                                            </div>
                                            <div style="clear:both"></div>
                                            <input type="submit" class="btn btn-primary" id="inputPassword3" value="Register">

                                        </div>

                                    </div>
                                </fieldset>
                            </form>

                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4 reg-sidebar">
                <div class="reg-sidebar-inner text-center">
                    <div class="promo-text-box"> <i class=" icon-picture fa fa-4x icon-color-1"></i>
                        <h3><strong>Post a Free Classified</strong></h3>
                        <p> Post your free online classified ads with us. Lorem ipsum dolor sit amet, consectetur adipiscing elit. </p>
                    </div>
                    <div class="promo-text-box"> <i class=" icon-pencil-circled fa fa-4x icon-color-2"></i>
                        <h3><strong>Create and Manage Items</strong></h3>
                        <p> Nam sit amet dui vel orci venenatis ullamcorper eget in lacus.
                            Praesent tristique elit pharetra magna efficitur laoreet.</p>
                    </div>
                    <div class="promo-text-box"> <i class="  icon-heart-2 fa fa-4x icon-color-3"></i>
                        <h3><strong>Create your Favorite ads list.</strong></h3>
                        <p> PostNullam quis orci ut ipsum mollis malesuada varius eget metus.
                            Nulla aliquet dui sed quam iaculis, ut finibus massa tincidunt.</p>
                    </div>
                </div>
            </div>
        </div>

    </div>

</div>
@endsection
