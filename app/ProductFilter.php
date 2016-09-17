<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class ProductFilter{

    protected $request;
    protected $builder;
    protected $query;


    public function process(Request $request){
        //return $request->all();
        if($request->input('type')=='sort'){
            //return $request->input('value');
            if($request->input('value')=='price'){
                $this->price($request->input('order'));
                return $this;
            }
            // $value = $request->input('value');
            // $order = $request->input('order');
        }
        //$this->builder = $builder;
        //$this->queryBuilder($request, $query);

        //foreach($this->request->all() as $name => $value){
            // if(method_exists($this, $name)){
            //     call_user_func_array([$this, $name], array_filter([$value]));
            // }
        //}
    }

    public function price($order='desc'){
        //$this->builder->orderBy('price', $order);
        $this->query = $order;
    }

    public function category($category = 'Electronics'){
        $this->builder->where('category', $category);
    }

    public function location($city='jaipur'){
        return $this->builder->where('city', $city);
    }

    public function term($title='jaipur'){
        return $this->builder->where('title', $title);
    }
}
