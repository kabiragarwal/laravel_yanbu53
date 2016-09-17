<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use Gate;
use App\User;
use App\City;
use App\Status;
use App\Coupon;
use App\Product;
use App\Category;
use App\Favourite;
use App\Subcategory;
use App\ProductAbuse;
use App\ProductImage;
use App\ProductFilter;
use App\PremiumAdCategory;
use App\ProductReportReason;
use Illuminate\Http\Request;
use App\Http\Requests\CreateAdRequest;
use App\Http\Requests\UpdateAdRequest;
use App\Http\Requests\ProductAbuseRequest;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class ProductsController extends Controller {

    public function __construct() {
        $this->middleware('auth', ['except' => ['show_ad','filter','adVisitIncrement','productAbuse']]);

        parent::__construct();
    }

    public function create_ad() {
        $category = new Category;
        $categoryData = $category->catGroupedList();
        return view('products.add', compact('categoryData'));
    }

    public function edit_ad(Product $product) {
        if (Gate::denies('own-product', $product)) {
            return redirect('home');
        }

        $category = new Category;
        $categoryData = $category->catGroupedList();
        $status = Status::pluck('status','id');
        return view('products.edit', compact('categoryData','product','status'));
    }

    public function show_ad(Product $product) {
        $class1 ='hide'; $class2 = 'show';
        if($this->signedIn && $product->id){
            $savedAd = Favourite::where('product_id',$product->id)
                                    ->where('user_id',$this->user->id)
                                    ->exists();
            if($savedAd){
                $class1 = 'show';
                $class2 = 'hide';
            }
        }
        $reportlist = $this->productReportReasonList();
        return view('products.show', compact('product','reportlist','class1','class2'));
    }

    public function post_create_ad(CreateAdRequest $request) {
        $user = User::find($this->user->id);
        $product = $user->product()->create($request->input());
        foreach($request->file('picture') as $picture){
             $imageData = '';
             $imageData = $this->makePhoto($picture);
             $product->images()->create($imageData);
        }
        flash()->success('Congratulations! Your ad will be available soon.');
        return redirect("/ad/premium/{$product->id}");
    }

    public function post_update_ad(UpdateAdRequest $request) {
         //pr($request->all()); exit;
        $product = Product::find($request->input('id'));
        //pr($product);
        $product->price_negotiable = ($request->input('price_negotiable'))?$request->input('price_negotiable'):0;
        $product->update($request->input());
        if($request->hasFile('picture')){
            foreach($request->file('picture') as $picture){
                //pr($picture);
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
        flash()->success('Success! Your ad has been updated.');
        return redirect("ad/edit/".$request->input('id'));
    }

    public function makePhoto(UploadedFile $file){
        $productImage = new ProductImage;
        return $productImage->saveProductImage($file);
    }

    public function premium_ad(Product $product){
        if (Gate::denies('own-product', $product)) {
            return redirect('home');
        }

        if( Gate::denies('add-premium', $product)){
            return redirect('ad/view/'.$product->id);
            //flash()->info('&#10004; Thanks! You already have a premium access');
        }

        $premiumAdCategory = PremiumAdCategory::all();
        return view('products.premium_ad', compact('product','premiumAdCategory'));
    }

    public function permiumAdConfrim(Request $request){
        //pr($request->all()); die;
        $this->validate($request, [
                         	'payment_method' => 'required',
                            'premiumadcategory_id' => 'required',
                            'product_id' => 'required',
                        ]);

        $productId = $this->premiumAdSavedInDb($request);
        flash()->success('Congratulations! Your ad upgraded to premium ad category.');
        return redirect('ad/view/'.$productId);
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
        $product->premiumadcategory_id = $premiumAdCategory->id;
        $product->save();
        $premiumAdCategory->product()->attach($product, $additionalData);
        return $product->id;
    }

    public function coupon_code_apply(Request $request){
        $couponCode = Coupon::where('code', $request->input('code'))->first();
        if($couponCode){
            return response($couponCode->discount, 200);
        }else{
            return response('Sorry, this coupon code does not exists',422);
        }
    }

    public function productReportReasonList(){
        $reportlist = ProductReportReason::pluck('name','id');
        return $reportlist;
    }

    public function productAbuse(ProductAbuseRequest $request){
        $ProductAbuse = ProductAbuse::create($request->all());
        return 'Thanks, Your feedback has been saved.';
    }

    public function sendMessageToProductOwner(Request $request){

    }

    public function test(){
        // $product = Product::whereUserId(4)->whereHas('premium_ad', function($query){
        //         $query->oldest('premiumadcategory_id');
        // })->with('premium_ad')->get()->toArray();

        //$product = Product::whereUserId(4)->with('premium_ad')->get()->toArray();
        // \DB::listen(function($sql) {
        //     var_dump($sql);
        // });

        \DB::listen(function ($event) {
            dump($event->sql);
            dump($event->bindings);
        });

        // $product = Product::select(DB::raw('products.*'))->whereUserId(4)
        //             ->leftJoin('premiumadcategory_product', 'products.id', '=', 'premiumadcategory_product.product_id')
        //             ->orderBy('premiumadcategory_product.premiumadcategory_id', 'desc')
        //             ->get()->toArray();

        //$product = Product::whereUserId(4)->with('premium_ad')->get()->toArray();

        $product = Product::whereUserId(4)->with(['premium_ad' => function ($query) {
            $query->orderBy('pivot_premiumadcategory_id', 'DESC');
        }])->get()->toArray();

        // $user->load(['cars' => function($query){
        //     $query->select('cars.*')->join('colours', 'cars.colour_id', '=', 'colours.id')->orderBy('colours.colour', 'asc');
        // }]);


        pr($product); exit;
    }

    public function test_new(Product $product){
        $category = new Category;
        $categoryData = $category->catGroupedList();
        return view('products.test-new', compact('categoryData'));
    }

    public function filter(Request $request=null){
        $products = new Product;
        $searchParameter = array();

        //location filtering
        if($request->has('city_id')){
            $city_id = $request->input('city_id');
            $products =$products->whereHas('user', function($query) use($city_id) {
                $query->where('city_id', $city_id);
            });
            $searchParameter['Location'] = $this->cityName($city_id);
        }else if($request->has('city')){
            $name = $request->input('city');
            $products =$products->whereHas('user', function($query) use($name) {
                $query->whereHas('city', function ($query) use ($name){
                   $query->where('slug', $name);
                });
            });
            $searchParameter['Location'] = $name;
        }else if($request->has('popular-location')){
            $name = $request->input('popular-location');
            $products =$products->whereHas('user', function($query) use($name) {
                $query->whereHas('city', function ($query) use ($name){
                   $query->where('slug', $name);
                });
            });
            $searchParameter['Location'] = $name;
        }

        //category code
        if($request->has('category_id')){
            $category_id = $request->input('category_id');
            $products = $products->whereHas('subcategory', function($query) use($category_id) {
                    $query->where('category_id', $category_id);
            });
            $searchParameter['Category'] = $this->categoryName($category_id);
        }else if($request->has('category')){
            $name = $request->input('category');
            $products = $products->whereHas('subcategory', function($query) use($name) {
                $query->whereHas('category', function ($query) use ($name){
                   $query->where('slug', $name);
                });
            });
            $searchParameter['Category'] = $name;
        }else if($request->has('popular-categories')){
            $name = $request->input('popular-categories');
            $products = $products->whereHas('subcategory', function($query) use($name) {
                $query->whereHas('category', function ($query) use ($name){
                   $query->where('slug', $name);
                });
            });
            $searchParameter['Popular Categories'] = $name;
        }

        //search term code
        if($request->has('search_term')){
            $search_term = $request->input('search_term');
            $products = $products->where('title', 'LIKE', '%'.$search_term.'%')
                            ->orWhere('description', 'LIKE', '%'.$search_term.'%');

            $searchParameter['Search Term'] = $search_term;
        }else if($request->has('key-word')){
            $search_term = $request->input('key-word');
            $products = $products->where('title', 'LIKE', '%'.$search_term.'%')
                            ->orWhere('description', 'LIKE', '%'.$search_term.'%');

            $searchParameter['Popular Makes'] = $search_term;
        }

        if($request->has('featured')){
            $search_term = $request->input('featured');
            $products = $products->where('slug', $search_term);
            $searchParameter['Featured'] = $search_term;
        }

        //min price filtering
        if($request->has('min_price')){
            $minPrice = (int)trim($request->input('min_price'));
            $products = $products->where('price', '>=', $minPrice);
            $searchParameter['Price Range'] = $minPrice;
        }

        //max price filtering
        if($request->has('max_price')){
            $maxPrice = (int)trim($request->input('max_price'));
            $products = $products->where('price', '<=', $maxPrice);
            $searchParameter['Price Range'] .= ' - '.$maxPrice;
        }

        //sub category filtering
        if($request->has('subcategory_id')){
            $subcategory_id = $request->input('subcategory_id');
            $products = $products->where('subcategory_id', $subcategory_id);
            $searchParameter['Subcategory'] = $this->subCategoryName($subcategory_id);
        }else if($request->has('subcategory')){
            $name = $request->input('subcategory');
            $products = $products->whereHas('subcategory', function($query) use($name) {
                   $query->where('slug', $name);
            });
            $searchParameter['Subcategory'] = $name;
        }


        //seller type filtering
        if($request->has('seller_type')){
            if($request->input('seller_type')!='all'){
                $seller = $request->input('seller_type');
                $products = $products->where('type', $seller);
                $searchParameter['Seller Type'] = $seller;
            }else{
                $searchParameter['Seller Type'] = 'All';
            }
        }

        // all ads from a user
        if($request->has('user')){
            $userId = $request->input('user');
            $products = $products->whereUserId($userId);
            $searchParameter['User'] = $userId;
        }

        //sorting
        if($request->has('sort')){
            $sortType = $request->input('sort');
            if($sortType=='price_asc'){
                $products = $products->oldest('price');
            }else{
                $products = $products->latest('price');
            }
        }

        //get the records
         //$productsQry = $products->toSql();
         //$productArr = $products->get();
         //dump($productArr);
        //echo $productsQry;
        //die;
        //$productLists = Product::all();
        $productLists = Product::active();
        $privateType = Product::active()->private();

        //echo $productpluck->buisness();
        //$producttemp = new Product;
        //echo $producttemp->privateAds(); echo '<br/>';
        //exit;

        $productArr = $products->latest('premiumadcategory_id')->active()->paginate(10);

        $categoryLists = Category::oldest('name')->get();
        $cities = City::oldest('name')->get();
        $category = new Category;
        $categoryData = $category->catGroupedList();
        $cityList = City::pluck('name', 'id');
        $requestData = $request->all();
        return view('products.list', compact(
            'productLists', 'productArr', 'categoryLists', 'categoryData',
            'cities', 'cityList', 'requestData', 'searchParameter','privateType'
        ));
    }

    protected function cityName($id){
        $city = City::find($id);
        return $city->name;
    }

    protected function categoryName($id){
        $category = Category::find($id);
        return $category->name;
    }

    protected function subCategoryName($id){
        $subcategory = Subcategory::find($id);
        return $subcategory->name;
    }

    public function adVisitIncrement(Request $request){
        $increment = Product::where('id',$request->input('id'))->increment('visitors');
        return 'done';
    }
}
