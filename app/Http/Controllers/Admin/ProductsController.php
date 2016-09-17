<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests\UpdateAdRequest;
use App\Http\Controllers\Controller;

use Gate;
use App\Coupon;
use App\Status;
use App\Product;
use App\Category;
use App\ProductImage;
use App\PremiumAdCategory;
use App\ProductReportReason;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class ProductsController extends Controller
{
    public function __construct(){
		$this->middleware('admin');

		parent::__construct();
	}

    public function index(){
        $products = Product::with('FirstImage')->latest()->get();
        return view('admins.products.index', compact('products'));
    }

    public function edit(Product $product) {
        $category = new Category;
        $categoryData = $category->catGroupedList();
        $status = Status::pluck('status','id');
        return view('admins.products.edit', compact('categoryData','product','status'));
    }

    public function view(Product $product) {
        $reportlist = ProductReportReason::pluck('name','id');
        return view('admins.products.view', compact('product','reportlist'));
    }

    public function update(UpdateAdRequest $request) {
        $product = Product::find($request->input('id'));
        $product->price_negotiable = ($request->input('price_negotiable'))?$request->input('price_negotiable'):0;
        $product->update($request->input());
        if($request->hasFile('picture')){
            foreach($request->file('picture') as $picture){
                 $imageData = '';
                 $imageData = $this->makePhoto($picture);
                 $product->images()->create($imageData);
            }
        }

        if($request->has('old_image')){
            foreach($request->input('old_image') as $old_image){
                 $productImage = ProductImage::find($old_image);
                \File::delete([
                    'upload/products/'.$productImage->image,   //full image
                    'upload/products/'.$productImage->thumbnail_image,  //thumbnail image
                ]);
                $productImage->delete();
            }
        }
        flash()->success("Success! User's ad has been updated.");
        return redirect("admin/ad/edit/".$request->input('id'));
    }

    public function makePhoto(UploadedFile $file){
        $productImage = new ProductImage;
        return $productImage->saveProductImage($file);
    }

    public function premium_ad(Product $product){
        $premiumAdCategory = PremiumAdCategory::all();
        return view('admins.products.premium', compact('product','premiumAdCategory'));
    }

    public function premium_confirm(Request $request){
        $this->validate($request, [
                         	'payment_method' => 'required',
                            'premiumadcategory_id' => 'required',
                            'product_id' => 'required',
                        ]);

        $productId = $this->premiumAdSavedInDb($request);
        flash()->success("Congratulations! User's ad upgraded to premium ad category.");
        return redirect('admin/ad/edit/'.$productId);
    }

    public function premiumAdSavedInDb(Request $request){
        $product = Product::find(base64_decode($request->input('product_id')));
        $premiumAdCategory = PremiumAdCategory::whereId($request->input('premiumadcategory_id'))->first();
        $totalAmount = $premiumAdCategory->amount;
        $netAmount = $totalAmount;
        $discountAmount = $coupon_id = 0;
        if($request->has('code') && $request->input('couponCodeApply')==1){
            $couponCode = Coupon::whereCode($request->input('code'))->first();
            $coupon_id = $couponCode->id;
            $discountAmount = ($totalAmount * ($couponCode->discount))/100;
            $netAmount = ($totalAmount - $discountAmount);
        }
        $additionalData = array(
            'total_amount'=>$totalAmount,
            'discount_amount'=>$discountAmount,
            'net_amount'=>$netAmount,
            'coupon_id'=>$coupon_id,
            'payment_method'=>$request->input('payment_method')
        );

        $premiumAdCategory->product()->attach($product, $additionalData);
        return $product->id;
    }

    public function destroy(Product $product){
        Product::destroy($product->id);
        flash()->success("Success! User's ad is deleted.");
        return redirect()->back();
    }
}
