{!! Form::model(new App\Product, array('url' => url("/filter"), 'method' => 'post', 'class' => '')) !!}
    <div class="col-sm-3">
        {!! Form::text('search_term', null, array('class' => 'form-control keyword','placeholder' => 'e.g. Mobile Sale' )) !!}

    </div>
    <div class="col-sm-3">
        {!! Form::select('subcategory_id', $categoryData, null, ['placeholder' => '--Select a Category--', 'class' => 'form-control selecter']); !!}

    </div>
    <div class="col-sm-3">
        {!! Form::select('city_id', $cityList, null, ['placeholder' => '--All Locations--', 'class' => 'form-control selecter']); !!}

    </div>
    <div class="col-sm-3">
        {!! Form::button('<i class="fa fa-search"></i>', ['class'=>'btn btn-primary btn-block', 'type'=>"submit"]) !!}
        <!-- <button class="btn btn-block btn-primary  "> <i class="fa fa-search"></i> </button> -->
    </div>
{!! Form::close() !!}
