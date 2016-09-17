<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Image;

class ProductImage extends Model {

    protected $baseDir = 'upload/products';
    protected $fillable = ['product_id', 'image', 'thumbnail_image'];

//    public static function named($name){
//        return (new static)->move($name);
//    }

    public function product() {
        return $this->belongsTo('App\Product')->active();
    }

    public function saveProductImage(UploadedFile $file) {
        //return $file->getClientOriginalName();
        $randomeImageName = sprintf('%s-%s', time(), str_random(3));
        $image = sprintf('%s.%s', $randomeImageName, $file->getClientOriginalExtension());
        $thumbnail_image = sprintf('%s-tn.%s', $randomeImageName, $file->getClientOriginalExtension());
        $file->move($this->baseDir, $image);

        Image::make($this->baseDir . '/' . $image)
                ->fit(200)
                ->save($this->baseDir . '/' . $thumbnail_image);

        return compact('image', 'thumbnail_image');
    }

}
