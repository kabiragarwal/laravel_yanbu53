<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use Gate;
use App\City;
use App\User;
use App\State;
use App\Country;
use App\Product;
use App\Message;
use App\Category;
use App\Favourite;
use App\Subcategory;
use App\ProductAbuse;
use App\SaveAllSearche;
use Illuminate\Http\Request;
use App\Http\Requests\ProfileUpdateRequest;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class UsersController extends Controller {

    public function __construct() {
        $this->middleware('auth');

        parent::__construct();
    }

    protected $baseDir = 'upload/users';

    public function profile() {
        $countryList = Country::pluck('name', 'id');
        $stateList = State::pluck('name', 'id');
        $cityList = City::pluck('name', 'id');

        return view('dashboard.profile', compact('countryList', 'stateList', 'cityList'));
    }

    public function logout() {
        Auth::logout();
        flash()->success('Your are log out.');
        return redirect('/signin');
    }

    public function post_profile(ProfileUpdateRequest $request) {
        $user = User::find($this->user->id);
        if ($request->file('image')) {
            ($user->image) ? \File::delete('upload/users/' . $user->image) : '';

            $imageName = $this->profilePhotoUpload($request->file('image'));
            $user->update(array('image' => $imageName));
        }
		$user->newsletter = ($request->input('newsletter'))?$request->input('newsletter'):0;
		$user->suggestions = ($request->input('suggestions'))?$request->input('suggestions'):0;
        $user->hide_phone = ($request->input('hide_phone'))?$request->input('hide_phone'):0;
        $user = $user->update($request->input());
        flash()->success('Your profile details are successfully updated.');
        return redirect('/profile');
    }

    public function profilePhotoUpload(UploadedFile $file) {
        $imageName = sprintf("%s-%s.%s", time(), str_random(3), $file->getClientOriginalExtension());
        $file->move($this->baseDir, $imageName);
        //User::find($this->user->id)->update(array('image'=>"1470483950.jpg"));
        return $imageName;
    }

    public function password_update(){
		//$user = new User;
		// if(Auth::check() && ($user->isAdmin($this->user->id) == 'Yes')){
		// 	return 'done';
		// }
        return view('dashboard.password_update');
    }

	public function post_password_update(Request $request){
        $this->validate($request, ['password'=>'required|confirmed']);
		$user = User::find($this->user->id);
		$user->password = $request->input('password');
		$user->save();
		flash()->success('Your password are successfully updated.');
        return redirect('/profile');
		//dd($request->all());
    }

    public function favourite(Request $request){
        if($request->input('type')==1){
            //add
            Favourite::create($request->all());
            $message = 'This product is saved in your account';
        }else{
            //delete
            Favourite::where('product_id', $request->input('product_id'))
                        ->where('user_id', $this->user->id)
                        ->delete();
            $message = 'This product is deleted from your account';
        }
        return $message;
    }

    public function saveAllSearches(Request $request){
        $data = json_encode($request->except(['_token']));
        $user = User::find($this->user->id);
        $product = $user->saveAllSearches()->create(['search'=>$data]);
        return $data;
    }

    public function myads(){

        $productData = Product::where('user_id', $this->user->id)->active()->with('FirstImage')->latest()->paginate(5);
        return view('dashboard.myads', compact('productData'));
    }

    public function post_myads(Request $request){
        //pr($request->all());
        if($request->has('delete')){
            $productResponse = $this->productDelete($request->input('delete'));
            flash()->success('Success! Ad is deleted');
        }else if($request->has('delete-all') && $request->has('id') && count($request->has('id'))>0){
            foreach($request->input('id') as $id){
                $productResponse = $this->productDelete($id);
                flash()->success("Success! All Ads are deleted");
            }
        }else if($request->has('search_text') && $request->input('search_text')!=''){
            $search_term = $request->input('search_text');
            $productData = Product::where('user_id', $this->user->id)
                                    ->where('title', 'LIKE', '%'.$search_term.'%')
                                    ->orWhere('description', 'LIKE', '%'.$search_term.'%')
                                    ->with('FirstImage')->latest()->paginate(5);
            return view('dashboard.myads', compact('productData'));
        }
        return redirect()->back();
    }

    public function productDelete($id){
        $product = Product::find($id);
        if (Gate::denies('own-product', $product)) {
            flash()->error('Error! this ad is not belonges to you');
        }else{
            return Product::destroy($id);
        }
    }

    public function favAds(){
        $favProduct = Favourite::whereUserId($this->user->id)->with('product.FirstImage')->latest()->paginate(5);
        //pr($favProduct); exit;
        return view('dashboard.favourite-ads', compact('favProduct'));
    }

    public function post_favAds(Request $request){
        if($request->has('delete')){
            Favourite::destroy($request->input('delete'));
            flash()->success('Success! Ad is removed from favourites');
        }else if($request->has('delete-all') && $request->has('id') && count($request->has('id'))>0){
            foreach($request->input('id') as $id){
                Favourite::destroy($id);
            }
            flash()->success("Success! All Ads are removed from favourites");
        }else if($request->has('search_text') && $request->input('search_text')!=''){
            $search_term = $request->input('search_text');
            $favProduct = Favourite::whereHas('product', function($query) use($search_term) {
                                $query->where('title', 'LIKE', '%'.$search_term.'%')
                                ->orWhere('description', 'LIKE', '%'.$search_term.'%');
                            })->with('product.FirstImage')->latest()->paginate(5);
            return view('dashboard.favourite-ads', compact('favProduct'));
        }
        return redirect()->back();
    }

    public function archived_ads(){
        $archivedProduct = Product::whereStatus(4)->paginate(5);
        //pr($archivedProduct); exit;
        return view('dashboard.archived_ads', compact('archivedProduct'));
    }

    public function post_archived_ads(Request $request){
        if($request->has('repost')){
            Product::whereId($request->input('repost'))->update(['status'=>1]);
            flash()->success("Success! All Ads are repost, and now shown to the users");
        }else if($request->has('delete')){
            Product::destroy($request->input('delete'));
            flash()->success('Success! Ad is deleted');
        }else if($request->has('delete-all') && $request->has('id') && count($request->has('id'))>0){
            foreach($request->input('id') as $id){
                Product::destroy($id);
            }
            flash()->success("Success! All Ads are deleted");
        }else if($request->has('search_text') && $request->input('search_text')!=''){
            $search_term = $request->input('search_text');
            $archivedProduct = Product::whereStatus(4)
                                        ->where('title', 'LIKE', '%'.$search_term.'%')
                                        ->orWhere('description', 'LIKE', '%'.$search_term.'%')
                                        ->with('FirstImage')->latest()->paginate(5);
            return view('dashboard.archived_ads', compact('archivedProduct'));
        }
        return redirect()->back();
    }

    public function pendingApprovalAds(){
        $pendingProduct = Product::whereUserId($this->user->id)->whereStatus(3)->paginate(5);
        //pr($archivedProduct); exit;
        return view('dashboard.pending-approval-ads', compact('pendingProduct'));
    }

    public function postPendingApprovalAds(Request $request){
        if($request->has('confirm')){
            Product::whereId($request->input('repost'))->update(['status'=>1]);
            flash()->success("Success! All Ads are confirmed, and now shown to the users");
        }else if($request->has('delete')){
            Product::destroy($request->input('delete'));
            flash()->success('Success! Ad is deleted');
        }else if($request->has('delete-all') && $request->has('id') && count($request->has('id'))>0){
            foreach($request->input('id') as $id){
                Product::destroy($id);
            }
            flash()->success("Success! All Ads are deleted");
        }else if($request->has('search_text') && $request->input('search_text')!=''){
            $search_term = $request->input('search_text');
            $pendingProduct = Product::whereStatus(3)
                                        ->where('title', 'LIKE', '%'.$search_term.'%')
                                        ->orWhere('description', 'LIKE', '%'.$search_term.'%')
                                        ->with('FirstImage')->latest()->paginate(5);
            return view('dashboard.pending-approval-ads', compact('pendingProduct'));
        }
        return redirect()->back();
    }

    public function saved_search(){
        $savedSearch = SaveAllSearche::whereUserId($this->user->id)->paginate(5);
        $cityList = City::pluck('name', 'id')->toArray();
        $categoryList = Category::pluck('name', 'id')->toArray();
        $subcategoryList = Subcategory::pluck('name', 'id')->toArray();
        return view('dashboard.saved_search', compact('savedSearch','cityList','categoryList','subcategoryList'));
    }

    public function postSavedSearch(Request $request){
        if($request->has('delete')){
            SaveAllSearche::destroy($request->input('delete'));
            flash()->success('Success! saved search is removed from profile');
        }else if($request->has('delete-all') && $request->has('id') && count($request->has('id'))>0){
            foreach($request->input('id') as $id){
                SaveAllSearche::destroy($id);
            }
            flash()->success("Success! All saved search are removed from profile");
        }else if($request->has('search_text') && $request->input('search_text')!=''){
            $cityList = City::pluck('name', 'id')->toArray();
            $categoryList = Category::pluck('name', 'id')->toArray();
            $subcategoryList = Subcategory::pluck('name', 'id')->toArray();

            $search_term = $request->input('search_text');
            $savedSearch = SaveAllSearche::whereUserId($this->user->id)
                                    ->where('search', 'LIKE', '%'.$search_term.'%')
                                    ->latest()->paginate(5);
            return view('dashboard.saved_search', compact('savedSearch','cityList','categoryList','subcategoryList'));
        }
        return redirect()->back();
    }

    public function accountClose(Request $request){
        return view('dashboard.account_close');
    }

    public function postAccountClose(Request $request){
        if($request->has('close') && $request->input('close')==1){
            $userId = $this->user->id;
            Auth::logout();
            User::destroy($userId);
            flash()->success('Success! Your account has been successfully deleted');
            return redirect('/signup');
        }else{
            flash()->success('Thanks! Your account has not been deleted');
            return redirect()->back();
        }
    }

    public function messages(){
         $userId = $this->user->id;

         $messageData = DB::table('products')
            ->join('messages', 'messages.product_id', '=', 'products.id')
            ->where('products.user_id', 2)
            ->select([DB::RAW('DISTINCT(messages.product_id)'), 'messages.name'])
            ->paginate(10);

         $messageData = Message::whereHas('product', function($query) use($userId) {
                                 $query->where('user_id', $userId);
                             })->select([DB::RAW('DISTINCT(messages.product_id)')])->get();
                             //, 'messages.email', 'messages.phone', 'messages.message', 'messages.message_status', 'messages.created_at'
                             //->with('product','product.FirstImage')->paginate(5);
                             //DB::RAW('DISTINCT(messages.product_id)', 'messages.name')
        //  $user =User::find(2);
        //  $messageData = $user->messages->toSql();
        // foreach($messageData as $message){
        //         //dump($message);
        //         echo $message->product_id; echo '<br/>';
        //         echo $message->product->title; echo '<br/>';
        //         echo $message->product->FirstImage->thumbnail_image; echo '<br/>';echo '<br/>';
        //         //dump($message);
        // }
        //die;
        // $posts = Product::has('message')->get();
         // dd($messageData);
        // $messageData = Message::whereHas('product', function($query) use($userId) {
        //                         $query->where('user_id', $userId);
        //                     })->paginate(5);
        // //->groupBy('products.product_id')->with('product.FirstImage')->latest()->toSql
        // dump($messageData); exit;
        //->groupBy('product_id')->with('product.FirstImage')->latest()->paginate(5)
        //$messageData = Message::whereUserId($this->user->id)->groupBy('product_id')->latest()->paginate(5);
        //dd($messageData);
        return view('dashboard.messages', compact('messageData'));
    }

    public function postMessages(Request $request){
        if($request->has('delete')){
            Message::whereProductId($request->input('delete'))->delete();
            flash()->success('Success! message is removed from profile');
        }else if($request->has('delete-all') && $request->has('id') && count($request->has('id'))>0){
            foreach($request->input('id') as $id){
                Message::whereProductId($request->input('delete'))->delete();
            }
            flash()->success("Success! All messages are removed from profile");
        }else if($request->has('search_text') && $request->input('search_text')!=''){

            $search_term = $request->input('search_text');
            $productAbuseData = v::whereHas('product', function($query) use($search_term) {
                                   $query->where('user_id', $this->user->id)
                                           ->where('title', 'LIKE', '%'.$search_term.'%')
                                           ->orWhere('description', 'LIKE', '%'.$search_term.'%');
                               })->groupBy('product_id')->with('product.FirstImage')->latest()->paginate(5);
            return view('dashboard.messages', compact('messageData'));
        }
        return redirect()->back();
    }

    public function message_thread($id){
        $messageData = Message::whereProductId($id)->oldest()->get();
        Message::whereProductId($id)->update(['message_status'=>1]);
        return view('dashboard.message_thread', compact('messageData'));
    }

    public function ad_abuses(){
        $productAbuse = ProductAbuse::all();
        $userId = $this->user->id;
        $productAbuseData = ProductAbuse::whereHas('product', function($query) use($userId) {
                                $query->where('user_id', $userId);
                            })->select([DB::RAW('DISTINCT(product_abuses.product_id)')])->with('product.FirstImage')->get();
        return view('dashboard.ad_abuses', compact('productAbuseData'));
    }

    public function postAdAbuses(Request $request){
        if($request->has('delete')){
            ProductAbuse::whereProductId($request->input('delete'))->delete();
            flash()->success('Success! This product abuses reports are removed from account');
        }else if($request->has('delete-all') && $request->has('id') && count($request->has('id'))>0){
            foreach($request->input('id') as $id){
                ProductAbuse::destroy($id);
            }
            flash()->success("Success! All product abuses reports are removed from account");
        }else if($request->has('search_text') && $request->input('search_text')!=''){
            $search_term = $request->input('search_text');
             $productAbuseData = ProductAbuse::whereHas('product', function($query) use($search_term) {
                                    $query->where('user_id', $this->user->id)
                                            ->where('title', 'LIKE', '%'.$search_term.'%')
                                            ->orWhere('description', 'LIKE', '%'.$search_term.'%');
                                })->groupBy('product_id')->with('product.FirstImage')->latest()->paginate(5);
            return view('dashboard.ad_abuses', compact('productAbuseData'));
        }
        return redirect()->back();
    }

    public function ad_abuses_view($productid){
        $product = Product::find($productid);
        if (Gate::denies('own-product', $product)) {
            flash()->error('Error! this ad is not belonges to you');
            return redirect('ad-abuses');
        }else{
            $productAbuseAll = ProductAbuse::whereProductId($productid)->with('abuseReason')->latest()->get();
            return view('dashboard.ad_abuse_view', compact('productAbuseAll'));
        }
    }
}
