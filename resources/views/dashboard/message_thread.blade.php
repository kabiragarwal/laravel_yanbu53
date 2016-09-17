@extends('layouts.app')

@section('content')

<div class="main-container">
    <div class="container">
        <div class="row">
            @include('dashboard.profile_sidebar')
            <div class="col-sm-9 page-content">
                <div class="inner-box">
                    <h2 class="title-2"><i class="glyphicon glyphicon-envelope"></i> View Messages </h2>
                    <div class="table-responsive">
                        @include ('flash::message')
                        {{ Form::open(array('url'=>'/account-close', 'method'=>'post'))}}
                    <table id="addManageTable" class="table table-striped table-bordered" data-filter="#filter" data-filter-text-only="true">
                        <thead>
                            <tr>
                                <th> All Messages: </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($messageData as $messages)
                            <tr>
                                <td>
                                    <p class="pull-right"> <strong>Time:</strong>{{$messages->created_at->diffForHumans()}} </p>
                                    <p> <strong>Name:</strong>{{$messages->name}} </p>
                                    <p> <strong>Phone No:</strong>{{$messages->phone}} </p>
                                    <p> <strong>Email:</strong>{{$messages->email}} </p>
                                    <p> <strong>message:</strong>{{$messages->message}} </p>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div>

                    </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
@section('custom_js')
@endsection
</div>

@endsection
