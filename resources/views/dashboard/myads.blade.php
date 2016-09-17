@extends('layouts.app')

@section('content')

<div class="main-container">
    <div class="container">
        <div class="row">
            @include('dashboard.profile_sidebar')

            <div class="col-sm-9 page-content">
                <div class="inner-box">
                    <h2 class="title-2"><i class="icon-docs"></i> Active Ads </h2>
                    <div class="table-responsive">
                        {{ Form::open(array('url'=>'/myads', 'method'=>'post'))}}
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
                                    <th> Photo </th>
                                    <th data-sort-ignore="true"> Adds Details </th>
                                    <th data-type="numeric"> Price </th>
                                    <th> Option </th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($productData->count())
                                    @foreach($productData as $product)
                                    <tr>
                                        <td style="width:2%" class="add-img-selector"><div class="checkbox">
                                                <label>
                                                    {{ Form::checkbox('id[]', $product->id) }}
                                                </label>
                                            </div></td>
                                        <td style="width:14%" class="add-img-td">
                                            <a href="{{url('ad/view/'.$product->id)}}">
                                                {{ Html::image('upload/products/'.$product->FirstImage->thumbnail_image, 'img', ['class'=>"thumbnail  img-responsive"]) }}
                                            </a>
                                        </td>
                                        <td style="width:58%" class="ads-details-td"><div>
                                                <p>
                                                    <strong>
                                                        <a href="{{url('ad/view/'.$product->id)}}" title="Brend New Nexus 4">{{$product->title}}</a> </strong></p>
                                                <p> <strong> Posted On </strong>:
                                                    {{$product->created_at->diffForHumans()}} </p>
                                                <p> <strong>Visitors </strong>: {{$product->visitors}} </p>
                                            </div></td>
                                        <td style="width:16%" class="price-td"><div><strong> ${{$product->price}}</strong></div></td>
                                        <td style="width:10%" class="action-td"><div>
                                                <p><a href="{{url('ad/edit/'.$product->id)}}" class="btn btn-primary btn-xs"> <i class="fa fa-edit"></i> Edit </a></p>
                                                <p> <a href="{{url('ad/view/'.$product->id)}}" class="btn btn-info btn-xs"> <i class="fa fa-mail-forward"></i> View </a></p>

                                                <p> {{ Form::button('<i class=" fa fa-trash"></i> Delete', ['type'=>'submit', 'value'=>$product->id, 'name'=>'delete', 'class'=>'btn btn-danger btn-xs']) }}
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
                        {!! $productData->links() !!}
                    </div>
                </div>
            </div>

        </div>

    </div>
@section('custom_js')
    <script type="text/javascript">
        // $(function() {
        //     $('#addManageTable').footable().bind('footable_filtering', function(e) {
        //         var selected = $('.filter-status').find(':selected').text();
        //         if (selected && selected.length > 0) {
        //             e.filter += (e.filter && e.filter.length > 0) ? ' ' + selected : selected;
        //             e.clear = !e.filter;
        //         }
        //     });
        //
        //     $('.clear-filter').click(function(e) {
        //         e.preventDefault();
        //         $('.filter-status').val('');
        //         $('table.demo').trigger('footable_clear_filter');
        //     });
        // });

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
