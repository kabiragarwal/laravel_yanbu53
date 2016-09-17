<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Page;

class PagesController extends Controller
{
    public function __construct(){
		$this->middleware('admin');

		parent::__construct();
	}

    public function index(){
        $pages = Page::latest()->get();
        return view('admins.page.index', compact('pages'));
    }

    public function create() {
        return view('admins.page.create');
    }

    public function store(Request $request) {
        $this->validate($request, ['title' => 'required', 'slug' => 'required', 'content' => 'required']);
        $page = Page::create($request->all());

        flash()->success("Success! Page data has been created.");
        return redirect('admin/page/edit/'.$page->id);
    }

    public function edit(Page $page) {
        return view('admins.page.edit', compact('page'));
    }

    public function update(Request $request) {
        $this->validate($request, ['title' => 'required', 'slug' => 'required', 'content' => 'required']);
        $page = Page::find($request->input('id'));
        $page->update($request->input());

        flash()->success("Success! Page data has been updated.");
        return redirect()->back();
    }

    public function view(Page $page) {
        return view('admins.page.view', compact('page'));
    }

    public function destroy(Page $page){
        Page::destroy($page->id);
        flash()->success("Success! Page is deleted.");
        return redirect()->back();
    }
}
