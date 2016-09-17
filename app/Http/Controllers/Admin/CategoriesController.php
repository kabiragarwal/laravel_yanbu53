<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Category;

class CategoriesController extends Controller
{
    public function __construct(){
		$this->middleware('admin');

		parent::__construct();
	}

    public function index(){
        $categories = Category::latest()->get();
        return view('admins.category.index', compact('categories'));
    }

    public function create() {
        return view('admins.category.create');
    }

    public function store(Request $request) {
        $this->validate($request, ['name' => 'required', 'slug' => 'required', 'icon' => 'required']);
        $category = Category::create($request->all());

        flash()->success("Success! Category data has been created.");
        return redirect('admin/category/edit/'.$category->id);
    }

    public function edit(Category $category) {
        return view('admins.category.edit', compact('category'));
    }

    public function update(Request $request) {
        $this->validate($request, ['name' => 'required', 'slug' => 'required', 'icon' => 'required']);
        $category = Category::find($request->input('id'));
        $category->update($request->input());

        flash()->success("Success! Category data has been updated.");
        return redirect()->back();
    }

    public function view(Category $category) {
        return view('admins.category.view', compact('category'));
    }

    public function destroy(Category $category){
        Category::destroy($category->id);
        flash()->success("Success! Category is deleted.");
        return redirect()->back();
    }
}
