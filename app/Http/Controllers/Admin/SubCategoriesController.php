<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Category;
use App\Subcategory;

class SubCategoriesController extends Controller
{
    public function __construct(){
		$this->middleware('admin');

		parent::__construct();
	}

    public function index(){
        $categories = Subcategory::with('category')->latest()->get();

        return view('admins.subcategory.index', compact('categories'));
    }

    public function create() {
        $categoryList = $this->categoryList();
        return view('admins.subcategory.create', compact('categories','categoryList'));
    }

    public function store(Request $request) {
        $this->validate($request, ['category_id' => 'required', 'name' => 'required', 'slug' => 'required']);
        $subcategory = Subcategory::create($request->all());
        flash()->success("Success! Subcategory data has been created.");
        return redirect('admin/subcategory/edit/'.$subcategory->id);
    }

    public function edit(Subcategory $subcategory) {
        $categoryList = $this->categoryList();
        return view('admins.subcategory.edit', compact('subcategory','categoryList'));
    }

    public function update(Request $request) {
        $this->validate($request, ['category_id' => 'required', 'name' => 'required', 'slug' => 'required']);
        $subcategory = Subcategory::find($request->input('id'));
        $subcategory->update($request->input());

        flash()->success("Success! Subcategory data has been updated.");
        return redirect()->back();
    }

    public function view(Subcategory $subcategory) {
        return view('admins.subcategory.view', compact('subcategory'));
    }

    public function destroy(Subcategory $subcategory){
        Subcategory::destroy($subcategory->id);
        flash()->success("Success! Subcategory is deleted.");
        return redirect()->back();
    }

    public function categoryList(){
        $category = new Category;
        $category = $category->getAllCategory();
        return $category;
    }
}
