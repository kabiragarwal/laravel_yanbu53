<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name','slug','icon'];

    public function subCategory(){
        return $this->hasMany('App\Subcategory');
    }

    public function product(){
       return $this->hasManyThrough('App\Product', 'App\Subcategory')->active();
    }

    public function catGroupedList() {
        $category = Category::with('subcategory')->get()->toArray();
        foreach ($category as $cat) {
            $subcategoryArr = $catSub = '';
            foreach ($cat['subcategory'] as $catSub) {
                $subcategoryArr[$catSub['id']] = $catSub['name'];
            }
            $catFinal[$cat['name']] = $subcategoryArr;
        }
        return $catFinal;
    }

    public function getAllCategory(){
        return $this->pluck('name','id');
    }
}
