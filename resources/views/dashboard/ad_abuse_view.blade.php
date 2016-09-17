@extends('layouts.app')

@section('content')

<div class="main-container">
    <div class="container">
        <div class="row">
            @include('dashboard.profile_sidebar')
            <div class="col-sm-9 page-content">
                <div class="inner-box">
                    <h2 class="title-2"><i class="glyphicon glyphicon-thumbs-down"></i> View All Ad Abuses Report </h2>
                    <div class="table-responsive">
                    <table id="addManageTable" class="table table-striped table-bordered" data-filter="#filter" data-filter-text-only="true">
                        <thead>
                            <tr>
                                <th> Email: </th>
                                <th> Reason: </th>
                                <th> Date: </th>
                                <th data-sort-ignore="true"> Message: </th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($productAbuseAll->count())
                            @foreach($productAbuseAll as $productAbuse)
                            <tr>
                                <td style="width:14%"> {{$productAbuse->email}} </td>
                                <td style="width:10%"> {{$productAbuse->abuseReason->name}} </td>
                                <td style="width:16%"> {{$productAbuse->created_at->diffForHumans()}} </td>
                                <td style="width:60%"> {{$productAbuse->message}} </td>
                            </tr>
                            @endforeach
                            @else
                            <tr><td colspan="4" class="text-center">
                                Sorry, No Records Found
                            </td></tr>
                            @endif
                        </tbody>
                    </table>
                    <div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@section('custom_js')
@endsection
</div>

@endsection
