@extends('layouts.app')

@section('content')

<div class="main-container">
    <div class="container">
        <div class="row">
            @include('dashboard.profile_sidebar')

            <div class="col-sm-9 page-content">
                <div class="inner-box">
                    <h2 class="title-2"><i class="icon-docs"></i> My Messages </h2>
                    <div class="table-responsive">
                        {{ Form::open(array('url'=>'/messages', 'method'=>'post'))}}
                        <div class="table-action">
                            <label for="checkbox-all">
                                <input type="checkbox"  onclick="checkAll(this)" name="checkbox-all" id="checkbox-all">
                                Select: All |
                                {{ Form::button('Delete <i class="glyphicon glyphicon-remove "></i>', ['type'=>'submit', 'value'=>'1', 'name'=>'delete-all', 'class'=>'btn btn-xs btn-danger']) }}
                                 </label>
                            <div class="table-search pull-right col-xs-7">
                                <div class="form-group">
                                    <label class="col-xs-5 control-label text-right">Search  </label>
                                    <div class="col-xs-7 searchpan">
                                        {{ Form::text('search_text', null, ['class'=>"form-control", 'id'=>"filter", 'onblur'=>'this.form.submit()',]) }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        @include ('flash::message')
                        <table id="addManageTable" class="table table-striped table-bordered add-manage-table table demo" data-filter="#filter" data-filter-text-only="true">
                            <thead>
                                <tr>
                                    <th data-type="numeric" data-sort-initial="true"> </th>
                                    <th data-sort-ignore="true"> Ad Title </th>
                                    <th> Option </th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($messageData->count())
                                    @foreach($messageData as $message)
                                    <tr>
                                        <td style="width:2%" class="add-img-selector"><div class="checkbox">
                                                <label>
                                                    {{ Form::checkbox('id[]', $message->id) }}
                                                </label>
                                            </div></td>
                                        <td style="width:58%" class="ads-details-td"><div>
                                                <p>
                                                    <strong>
                                                        <a href="{{url('ad/view/'.$message->product->id)}}" title="Brend New Nexus 4">{{$message->product->title}}</a> </strong></p>

                                            </div></td>
                                        <td style="width:10%" class="action-td"><div>
                                                <p> <a href="{{url('message/view/'.$message->product->id)}}" class="btn btn-info btn-xs"> <i class="fa fa-mail-forward"></i> View </a></p>
                                                <p> {{ Form::button('<i class=" fa fa-trash"></i> Delete', ['type'=>'submit', 'value'=>$message->product_id, 'name'=>'delete', 'class'=>'btn btn-danger btn-xs']) }}
                                                    </p>
                                            </div></td>
                                    </tr>
                                    @endforeach
                                @else
                                <tr><td colspan="5" class="text-center">
                                    Sorry, No Records Found
                                </td></tr>
                                @endif
                            </tbody>
                        </table>
                        {{ Form::close() }}
                    </div>
                    <div class="pagination-bar text-center">
                        {{-- !! $messageData->links() !! --}}
                    </div>
                </div>
            </div>

        </div>

    </div>
@section('custom_js')
    <script type="text/javascript">
        function checkAll(bx) {
            var chkinput = document.getElementsByTagName('input');
            for (var i = 0; i < chkinput.length; i++) {
                if (chkinput[i].type == 'checkbox') {
                    chkinput[i].checked = bx.checked;
                }
            }
        }
    </script>
@endsection
</div>

@endsection
