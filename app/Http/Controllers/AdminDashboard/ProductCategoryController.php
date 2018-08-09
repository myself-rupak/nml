<?php

namespace App\Http\Controllers\AdminDashboard;

use Auth;
use App\ProductTypes;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use \Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class ProductCategoryController extends Controller
{
    public function __construct()
    {
    	$this->middleware('auth');
    }

    public function index()
    {
    	$product_categories = ProductTypes::select('id', 'title', 'is_active', 'order', 'banner_image', 'image', 'hover_image', 'menu_image', 'url')->orderBy('order', 'asc')->get();
    	$page_name = 'Product category';
    	return view('admin_dashboard.product_category.product_category', [
    		'page_name' 			=> $page_name, 
    		'title' 				=> 'Product category', 
    		'product_categories' 	=> $product_categories
    	]);
    }
/*
|--------------------------------------------------------------------------
| ( ADD Product Category )
|--------------------------------------------------------------------------
*/
    public function add_product_category()
    {
    	$page_name = 'Add product category';
    	return view('admin_dashboard.product_category.add_product_category', [
    		'page_name' => $page_name, 
    		'title' => 'Add product category'
    	]);
    }
/*
|--------------------------------------------------------------------------
| ( SAVE Product Category )
|--------------------------------------------------------------------------
*/
    public function save_product_category(Request $request)
    {
    	$validatedData = $request->validate([
	        'title' => 'required|unique:product_types,title|max:255',
	        'url' => 'required|max:255',
	        'order' => 'required|unique:product_types,order|integer',
	        'banner_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
	        'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
	        'hover_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
	        'menu_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
	    ]);

    	if ($request->hasFile('banner_image')) {
	        $image = $request->file('banner_image');
	        $banner_image_name = str_slug($request->title).'.'.$image->getClientOriginalExtension();
	        $destinationPath = public_path('/uploads/product_category/banner_image');
	        $imagePath = $destinationPath. "/".  $banner_image_name;
	        $image->move($destinationPath, $banner_image_name);
	    }

    	if ($request->hasFile('image')) {
	        $image = $request->file('image');
	        $name = str_slug($request->title).'.'.$image->getClientOriginalExtension();
	        $destinationPath = public_path('/uploads/product_category/image');
	        $imagePath = $destinationPath. "/".  $name;
	        $image->move($destinationPath, $name);
	    }

	    if ($request->hasFile('hover_image')) {
	        $image = $request->file('hover_image');
	        $hover_image_name = str_slug($request->title).'_hover.'.$image->getClientOriginalExtension();
	        $destinationPath = public_path('/uploads/product_category/hover_image');
	        $imagePath = $destinationPath. "/".  $hover_image_name;
	        $image->move($destinationPath, $hover_image_name);
	    }

	    if ($request->hasFile('menu_image')) {
	        $image = $request->file('menu_image');
	        $menu_image_name = str_slug($request->title).'_menu.'.$image->getClientOriginalExtension();
	        $destinationPath = public_path('/uploads/product_category/menu_image');
	        $imagePath = $destinationPath. "/".  $menu_image_name;
	        $image->move($destinationPath, $menu_image_name);
	    }

	    $product_category = new ProductTypes([
    		'title' => $request->title,
    		'url' => $request->url,
    		'order' => $request->order,
    		'is_active' => $request->is_active,
    		'banner_image' => $banner_image_name,
    		'image' => $name,
    		'hover_image' => $hover_image_name,
    		'menu_image' => $menu_image_name,
    		'created_by' => Auth::id(),
    		'created_at' => Carbon::now()
    	]);
    	$product_category->save();
    	return redirect('product_category')->with('success', 'Category added successfully!');
    }
/*
|--------------------------------------------------------------------------
| ( EDIT Product Category )
|--------------------------------------------------------------------------
*/
    public function edit_product_category(ProductTypes $product_category_id)
    {
    	$page_name = 'Edit product category';
    	return view('admin_dashboard.product_category.edit_product_category', [
    		'page_name' => $page_name, 
    		'title' => 'Edit product category',
    		'product_category' => $product_category_id
    	]);
    }

/*
|--------------------------------------------------------------------------
| ( UPDATE Product Category )
|--------------------------------------------------------------------------
*/
    public function update_product_category( Request $request, $product_category_id )
    {
    	$validatedData = $request->validate([
	        'title' => 'required|max:255',
	        'url' => 'required|max:255',
	        'order' => 'required|integer',
	    ]);

    	$banner_image_name = $request->old_banner_image;
	    $name = $request->old_image;
	    $hover_image_name = $request->old_hover_image;
	    $menu_image_name = $request->old_menu_image;

	    if ($request->hasFile('banner_image')) {
    		$image_path = public_path("uploads/product_category/banner_image/".$request->old_banner_image);
			if(file_exists($image_path)) {
			    //Storage::delete($image_path);
			    unlink($image_path);
			}

	        $image = $request->file('banner_image');
	        $banner_image_name = str_slug($request->title).'.'.$image->getClientOriginalExtension();
	        $destinationPath = public_path('/uploads/product_category/banner_image');
	        $imagePath = $destinationPath. "/".  $banner_image_name;
	        $image->move($destinationPath, $banner_image_name);
	    }

    	if ($request->hasFile('image')) {
    		$image_path = public_path("uploads/product_category/image/".$request->old_image);
			if(file_exists($image_path)) {
			    //Storage::delete($image_path);
			    unlink($image_path);
			}

	        $image = $request->file('image');
	        $name = str_slug($request->title).'.'.$image->getClientOriginalExtension();
	        $destinationPath = public_path('/uploads/product_category/image');
	        $imagePath = $destinationPath. "/".  $name;
	        $image->move($destinationPath, $name);
	    }

	    if ($request->hasFile('hover_image')) {
	    	$image_path = public_path("uploads/product_category/hover_image/".$request->old_hover_image);
			if(file_exists($image_path)) {
			    //Storage::delete($image_path);
			    unlink($image_path);
			}

	        $image = $request->file('hover_image');
	        $hover_image_name = str_slug($request->title).'_hover.'.$image->getClientOriginalExtension();
	        $destinationPath = public_path('/uploads/product_category/hover_image');
	        $imagePath = $destinationPath. "/".  $hover_image_name;
	        $image->move($destinationPath, $hover_image_name);
	    }

	    if ($request->hasFile('menu_image')) {
	    	$image_path = public_path("uploads/product_category/menu_image/".$request->old_menu_image);
			if(file_exists($image_path)) {
			    //Storage::delete($image_path);
			    unlink($image_path);
			}

	        $image = $request->file('menu_image');
	        $menu_image_name = str_slug($request->title).'_menu.'.$image->getClientOriginalExtension();
	        $destinationPath = public_path('/uploads/product_category/menu_image');
	        $imagePath = $destinationPath. "/".  $menu_image_name;
	        $image->move($destinationPath, $menu_image_name);
	    }

    	$product_category = ProductTypes::find($product_category_id);

    	$product_category->title = $request->title;
    	$product_category->order = $request->order;
    	$product_category->is_active = $request->is_active;
    	$product_category->banner_image = $banner_image_name;
    	$product_category->image = $name;
    	$product_category->hover_image = $hover_image_name;
    	$product_category->menu_image = $menu_image_name;
    	$product_category->updated_by = Auth::id();
    	$product_category->updated_at = Carbon::now();
    	
    	$product_category->update();
    	return redirect('product_category')->with('success', 'Category updated successfully!');
    }

/*
|--------------------------------------------------------------------------
| ( DELETE Product Category )
|--------------------------------------------------------------------------
*/

    public function delete_product_category(ProductTypes $product_category_id)
    {
    	$image_path = public_path("uploads/product_category/image/".$product_category_id->image);
		if(file_exists($image_path)) {
		    //Storage::delete($image_path);
		    unlink($image_path);
		}

    	$hover_image_path = public_path("uploads/product_category/hover_image/".$product_category_id->hover_image);
		if(file_exists($hover_image_path)) {
		    //Storage::delete($hover_image_path);
		    unlink($image_path);
		}

    	$menu_image_path = public_path("uploads/product_category/menu_image/".$product_category_id->menu_image);
		if(file_exists($menu_image_path)) {
		    //Storage::delete($menu_image_path);
		    unlink($image_path);
		}
		$product_category_id->delete();
        return redirect('product_category')->with('success', 'Category deleted successfully!');
    }
}
