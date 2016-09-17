<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductAbuse extends Model
{
    protected $fillable = ['product_id','product_report_reason_id','email','message'];

    public function product(){
        return $this->belongsTo('App\Product')->active();
    }

    public function abuseReason(){
        return $this->belongsTo('App\ProductReportReason','product_report_reason_id');
    }

}
