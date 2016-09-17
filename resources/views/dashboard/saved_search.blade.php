@extends('layouts.app')

@section('content')

<div class="main-container">
    <div class="container">
        <div class="row">
            @include('dashboard.profile_sidebar')

            <div class="col-sm-9 page-content">
                <div class="inner-box">
                    <h2 class="title-2"><i class="icon-star-circled"></i> Saved search </h2>
                    <div class="table-responsive">
                        {{ Form::open(array('url'=>'/saved-search', 'method'=>'post'))}}
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
                                    <th data-sort-ignore="true"> Search Details </th>
                                    <th data-type="numeric"> Date Created </th>
                                    <th> Option </th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($savedSearch->count())
                                    @foreach($savedSearch as $search)
                                    <tr>
                                        <td style="width:2%" class="add-img-selector"><div class="checkbox">
                                                <label>
                                                    {{ Form::checkbox('id[]', $search->id) }}
                                                </label>
                                            </div></td>

                                        <td style="width:58%" class="ads-details-td"><div>
                                                <p>
                                                        @php
                                                            $queryString = array();
                                                            $searchData = json_decode("$search->search", true)
                                                         @endphp
                                                        @foreach($searchData as $key=>$value)
                                                            @php $queryString[] = ($key.'='.$value)  @endphp
                                                            @if($key =='city_id')
                                                                @php
                                                                    $keyName = 'city';
                                                                    $valueName = $cityList[$value]
                                                                @endphp
                                                            @elseif($key =='category_id')
                                                                @php
                                                                    $keyName = 'category';
                                                                    $valueName = $categoryList[$value]
                                                                @endphp
                                                            @elseif($key =='subcategory_id')
                                                                    @php
                                                                        $keyName = 'subcategory';
                                                                        $valueName = $subcategoryList[$value]
                                                                    @endphp
                                                            @else
                                                                    @php
                                                                        $keyName = $key;
                                                                        $valueName = $value
                                                                    @endphp
                                                            @endif
                                                            <p> <strong> {{$keyName}}: </strong> {{$valueName}}</p>
                                                        @endforeach

                                                    </p>

                                            </div></td>
                                        <td style="width:16%" class="price-td"><div>{{$search->created_at->diffForHumans()}}</div></td>
                                        <td style="width:10%" class="action-td"><div>
                                                <p><a href="{{url('filter?'. implode('&',$queryString))}}" class="btn btn-primary btn-xs"> <i class="fa fa-edit"></i> View </a></p>
                                                <p> {{ Form::button('<i class=" fa fa-trash"></i> Delete', ['type'=>'submit', 'value'=>$search->id, 'name'=>'delete', 'class'=>'btn btn-danger btn-xs']) }}
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
                        {!! $savedSearch->links() !!}
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
