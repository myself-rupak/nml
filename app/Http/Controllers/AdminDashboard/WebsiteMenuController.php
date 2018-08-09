<?php

namespace App\Http\Controllers\AdminDashboard;

use Auth;
use App\WebsiteMenu;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use \Carbon\Carbon;

class WebsiteMenuController extends Controller
{
    //
    public function __construct(){
    	$this->middleware('auth');
    }

    public function index()
    {

    }

    public function parent_menu()
    {
    	$parent_menus = WebsiteMenu::where('is_parent', '1')->select('id', 'menu_name', 'is_active', 'order', 'image', 'url')->orderBy('order', 'asc')->get();
    	$page_name = 'Parent menu';
    	return view('admin_dashboard.parent_menu.parent_menu', [
    		'page_name' => $page_name, 
    		'title' => 'Parent menu', 
    		'parent_menus' => $parent_menus
    	]);
    }
/*
|--------------------------------------------------------------------------
| ( ADD Parent Menu )
|--------------------------------------------------------------------------
*/
    public function add_parent_menu()
    {
    	$page_name = 'Add Parent menu';
    	return view('admin_dashboard.parent_menu.add_parent_menu', [
    		'page_name' => $page_name, 
    		'title' => 'Add Parent menu'
    	]);
    }
/*
|--------------------------------------------------------------------------
| ( SAVE Parent Menu )
|--------------------------------------------------------------------------
*/
    public function save_parent_menu( Request $request )
    {
    	$validatedData = $request->validate([
	        'menu_name' => 'required|unique:website_menu,menu_name|max:255',
	        'url' => 'required|max:255',
	        'order' => 'required|unique:website_menu,order|integer',
	    ]);

    	$parent_menu = new WebsiteMenu([
    		'menu_name' => $request->menu_name,
    		'url' => $request->url,
    		'order' => $request->order,
    		'is_active' => $request->is_active,
    		'image' => '',
    		'is_parent' => '1',
    		'created_by' => Auth::id(),
    		'created_at' => Carbon::now()
    	]);
    	$parent_menu->save();
    	return redirect('parent_menu');
    }
/*
|--------------------------------------------------------------------------
| ( EDIT Parent Menu )
|--------------------------------------------------------------------------
*/
    public function edit_parent_menu(WebsiteMenu $menu_id)
    {
    	$page_name = 'Edit Parent menu';
    	return view('admin_dashboard.parent_menu.edit_parent_menu', [
    		'page_name' => $page_name, 
    		'title' => 'Edit Parent menu',
    		'menu' => $menu_id
    	]);
    }
/*
|--------------------------------------------------------------------------
| ( UPDATE Parent Menu )
|--------------------------------------------------------------------------
*/
    public function update_parent_menu( Request $request, $menu_id)
    {
    	$menu = WebsiteMenu::find($menu_id);

    	$menu->menu_name = $request->menu_name;
    	$menu->order = $request->order;
    	$menu->is_active = $request->is_active;
    	$menu->updated_by = Auth::id();
    	$menu->updated_at = Carbon::now();
    	
    	$menu->update();
    	return redirect('parent_menu');
    }
/*
|--------------------------------------------------------------------------
| ( DELETE Parent Menu )
|--------------------------------------------------------------------------
*/
    public function delete_parent_menu(WebsiteMenu $menu_id)
    {
        $menu_id->delete();
        return redirect('parent_menu');
    }
}
