<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductReportReason extends Model
{
    protected $table = 'product_report_reason';

    protected $fillable = ['name'];

    public function reason_list(){
        return $this->first();
        //return $this->list('id', 'name');
    }

    public function productAbuse(){
        return $this->hasMany('App\ProductAbuse','product_report_reason_id');
    }
}
