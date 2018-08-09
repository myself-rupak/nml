<?php

namespace App\Http\Controllers\AdminDashboard;

use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Product;
use App\ProductTypes;
use App\ProductSpecification;
use App\ProductWiseSpecification;
use App\ProductImageGallery;
use \Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

class ProductController extends Controller
{
    public function __construct()
    {
    	$this->middleware('auth');
    }

    public function index()
    {
    	$products = Product::select('*')
    				->orderBy('featured_product', 'asc')->get();
    	$page_name = 'Product';
    	return view('admin_dashboard.product.product_list', [
    		'page_name'	=> $page_name, 
    		'title' 	=> 'Product', 
    		'products' 	=> $products
    	]);
    }

    public function add_product()
    {
    	$productTypes = ProductTypes::all();
    	$page_name = 'Add Product';
    	return view('admin_dashboard.product.add_product', [
    		'page_name' => $page_name, 
    		'title' => 'Add Product',
    		'productTypes' => $productTypes
    	]);
    }

    public function save_product(Request $request)
    {
    	$validatedData = $request->validate([
	        'title' => 'required|unique:product,title|max:100',
	        'url' => 'required|unique:product,url|max:100',
	        'product_type' => 'required|integer',
	        'banner_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
	        'overview' => 'required',
	        'overview_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
	        'home_page_description' => 'required',
	        'home_thumb_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
	        'product_list_page_description' => 'required',
	        'list_thumb_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
	    ]);

		if ($request->hasFile('banner_image')) {
	        $image = $request->file('banner_image');
	        $file_name = pathinfo(Input::file('banner_image')->getClientOriginalName(), PATHINFO_FILENAME);
    		$file_ext = pathinfo(Input::file('banner_image')->getClientOriginalName(), PATHINFO_EXTENSION);

    		$banner_image_name = $file_name.'_banner.'.$file_ext;
	        $destinationPath = public_path('/uploads/product/banner');
	        $imagePath = $destinationPath. "/".  $banner_image_name;
	        $image->move($destinationPath, $banner_image_name);
	    }

	    if ($request->hasFile('overview_image')) {
	        $image = $request->file('overview_image');
	        $file_name = pathinfo(Input::file('overview_image')->getClientOriginalName(), PATHINFO_FILENAME);
    		$file_ext = pathinfo(Input::file('overview_image')->getClientOriginalName(), PATHINFO_EXTENSION);

    		$overview_image_name = $file_name.'_overview.'.$file_ext;
	        $destinationPath = public_path('/uploads/product/overview');
	        $imagePath = $destinationPath. "/".  $overview_image_name;
	        $image->move($destinationPath, $overview_image_name);
	    }

	    if ($request->hasFile('home_thumb_image')) {
	        $image = $request->file('home_thumb_image');
	        $file_name = pathinfo(Input::file('home_thumb_image')->getClientOriginalName(), PATHINFO_FILENAME);
    		$file_ext = pathinfo(Input::file('home_thumb_image')->getClientOriginalName(), PATHINFO_EXTENSION);

    		$home_thumb_image_name = $file_name.'_home_thumb.'.$file_ext;
	        $destinationPath = public_path('/uploads/product/home_thumb_image');
	        $imagePath = $destinationPath. "/".  $home_thumb_image_name;
	        $image->move($destinationPath, $home_thumb_image_name);
	    }

	    if ($request->hasFile('list_thumb_image')) {
	        $image = $request->file('list_thumb_image');
	        $file_name = pathinfo(Input::file('list_thumb_image')->getClientOriginalName(), PATHINFO_FILENAME);
    		$file_ext = pathinfo(Input::file('list_thumb_image')->getClientOriginalName(), PATHINFO_EXTENSION);

    		$list_thumb_image_name = $file_name.'_list_thumb.'.$file_ext;
	        $destinationPath = public_path('/uploads/product/list_thumb_image');
	        $imagePath = $destinationPath. "/".  $list_thumb_image_name;
	        $image->move($destinationPath, $list_thumb_image_name);
	    }

	    $product = new Product([
	    	'product_condition' => $request->product_condition,
    		'title' => $request->title,
    		'url' => $request->url,
    		'is_active' => $request->is_active,
    		'featured_product' => $request->featured_product,
    		'background_image' => '0',
    		'banner_image' => $banner_image_name,
    		'overview' => $request->overview,
    		'overview_image' => $overview_image_name,
    		'home_page_description' => $request->home_page_description,
    		'home_thumb_image' => $home_thumb_image_name,
    		'product_list_page_description' => $request->product_list_page_description,
    		'list_thumb_image' => $list_thumb_image_name,
    		'created_by' => Auth::id(),
    		'created_at' => Carbon::now()
    	]);
    	$product_type = ProductTypes::find($request->product_type);
    	$product_type->products()->save($product);
    	return redirect('product_item')->with('success', 'Product added successfully!');
    }

    public function edit_product( Product $product )
    {
    	$productTypes = ProductTypes::all();
    	return view('admin_dashboard.product.edit_product', [
    		'page_name'	=> 'Edit '.$product->title, 
    		'title' 	=> 'Edit '.$product->title, 
    		'productTypes' => $productTypes,
    		'product' => $product,
    	]);
    }

    public function update_product( Request $request, Product $product )
    {
    	$validatedData = $request->validate([
	        'title' => 'required|max:100',
	        'url' => 'required|max:100',
	        'product_type' => 'required|integer',
	        'overview' => 'required',
	        'home_page_description' => 'required',
	        'product_list_page_description' => 'required',
	    ]);

	    $banner_image_name = $request->old_banner_image;
	    $overview_image_name = $request->old_overview_image;
	    $home_thumb_image_name = $request->old_home_thumb_image;
	    $list_thumb_image_name = $request->old_list_thumb_image;

	    if ($request->hasFile('banner_image')) {
    		$image_path = public_path("uploads/product/banner/".$request->old_banner_image);
			if(file_exists($image_path)) {
			    unlink($image_path);
			}

	        $image = $request->file('banner_image');
	        $file_name = pathinfo(Input::file('banner_image')->getClientOriginalName(), PATHINFO_FILENAME);
    		$file_ext = pathinfo(Input::file('banner_image')->getClientOriginalName(), PATHINFO_EXTENSION);

    		$banner_image_name = $file_name.'_banner_'.$product->id.'.'.$file_ext;
	        $destinationPath = public_path('/uploads/product/banner');
	        $imagePath = $destinationPath. "/".  $banner_image_name;
	        $image->move($destinationPath, $banner_image_name);
	    }

	    if ($request->hasFile('overview_image')) {
    		$image_path = public_path("uploads/product/overview/".$request->old_overview_image);
			if(file_exists($image_path)) {
			    //Storage::delete($image_path);
			    unlink($image_path);
			}

	        $image = $request->file('overview_image');
	        $file_name = pathinfo(Input::file('overview_image')->getClientOriginalName(), PATHINFO_FILENAME);
    		$file_ext = pathinfo(Input::file('overview_image')->getClientOriginalName(), PATHINFO_EXTENSION);

    		$overview_image_name = $file_name.'_overview_'.$product->id.'.'.$file_ext;
	        $destinationPath = public_path('/uploads/product/overview');
	        $imagePath = $destinationPath. "/".  $overview_image_name;
	        $image->move($destinationPath, $overview_image_name);
	    }

	    if ($request->hasFile('home_thumb_image')) {
	    	$image_path = public_path("uploads/product/home_thumb_image/".$request->old_home_thumb_image);
			if(file_exists($image_path)) {
			    //Storage::delete($image_path);
			    unlink($image_path);
			}

	        $image = $request->file('home_thumb_image');
	        $file_name = pathinfo(Input::file('home_thumb_image')->getClientOriginalName(), PATHINFO_FILENAME);
    		$file_ext = pathinfo(Input::file('home_thumb_image')->getClientOriginalName(), PATHINFO_EXTENSION);

    		$home_thumb_image_name = $file_name.'_home_thumb_'.$product->id.'.'.$file_ext;
	        $destinationPath = public_path('/uploads/product/home_thumb_image');
	        $imagePath = $destinationPath. "/".  $home_thumb_image_name;
	        $image->move($destinationPath, $home_thumb_image_name);
	    }

	    if ($request->hasFile('list_thumb_image')) {
	    	$image_path = public_path("uploads/product/list_thumb_image/".$request->old_list_thumb_image);
			if(file_exists($image_path)) {
			    //Storage::delete($image_path);
			    unlink($image_path);
			}

	        $image = $request->file('list_thumb_image');
	        $file_name = pathinfo(Input::file('list_thumb_image')->getClientOriginalName(), PATHINFO_FILENAME);
    		$file_ext = pathinfo(Input::file('list_thumb_image')->getClientOriginalName(), PATHINFO_EXTENSION);

    		$list_thumb_image_name = $file_name.'_list_thumb_'.$product->id.'.'.$file_ext;
	        $destinationPath = public_path('/uploads/product/list_thumb_image');
	        $imagePath = $destinationPath. "/".  $list_thumb_image_name;
	        $image->move($destinationPath, $list_thumb_image_name);
	    }

	    $product->background_image = $product->background_image;
	    $product->product_condition = $request->product_condition;
	    $product->product_types_id = $request->product_type;
    	$product->title = $request->title;
    	$product->url = $request->url;
    	$product->is_active = $request->is_active;
    	$product->featured_product = $request->featured_product;
    	$product->banner_image = $banner_image_name;
    	$product->overview = $request->overview;
    	$product->overview_image = $overview_image_name;
    	$product->home_page_description = $request->home_page_description;
    	$product->home_thumb_image = $home_thumb_image_name;
    	$product->product_list_page_description = $request->product_list_page_description;
    	$product->list_thumb_image = $list_thumb_image_name;
    	$product->updated_by = Auth::id();
    	$product->updated_at = Carbon::now();
    	
    	$product->update();
    	return redirect('product_item')->with('success', 'Product updated successfully!');
    }

    public function product_specifications( Product $product )
    {
    	return view('admin_dashboard.product.product_specifications', [
    		'page_name'	=> $product->title.' specification', 
    		'title' 	=> $product->title.' specification', 
    		'specifications' => ProductSpecification::all(),
    		'product' => $product,
    	]);
    }

    public function save_product_wise_specification(Request $request, Product $product)
    {

    	ProductWiseSpecification::where('product_id', $product->id)->delete();
    	$specifications = ProductSpecification::all();
    	$data = [];
    	foreach ($specifications as $specification) {
    		$term = 'specification_content_'.$specification->id;
    		if($request->$term != ''){
	    		$data[] = new ProductWiseSpecification([
	    			'product_specification_id' => $specification->id,
	    			'specification_detail' => $request->$term,
	    			'created_at' => Carbon::now(),
	    			'created_by' => Auth::id(),
	    		]);
    		}
    	}
    	if(!empty($data)){
    		$product->productWiseSpecifications()->saveMany($data);
    	}
    	//$product_type = ProductTypes::find($request->product_type);
    	return redirect('product_wise_specifications/'.$product->id)
    			->with('success', 'Specifications for '.$product->title.' added successfully!');
    }

    public function image_gallery(Product $product)
    {
    	$page_name = 'Product image gallery';
    	return view('admin_dashboard.product.product_image_gallery', [
    		'page_name' => $page_name, 
    		'title' => 'Product image gallery',
    		'product' => $product
    	]);
    }

    public function save_product_gallery_image(Product $product, Request $request)
    {
    	if($request->hasFile('background_image')){
    		$background_image_name = $request->old_background_image;
    		$image_path = public_path("uploads/product/background_image/".$request->old_background_image);
			if(file_exists($image_path)) {
			    //Storage::delete($image_path);
			    //unlink($image_path);
			}
    		$file_name = pathinfo(Input::file('background_image')->getClientOriginalName(), PATHINFO_FILENAME);
    		$file_ext = pathinfo(Input::file('background_image')->getClientOriginalName(), PATHINFO_EXTENSION);

    		$image = $request->file('background_image');
	        $background_image_name = $file_name.'_background_image_'.$product->id.'.'.$file_ext;
	        $destinationPath = public_path('/uploads/product/background_image');
	        $imagePath = $destinationPath. "/".  $background_image_name;
	        $image->move($destinationPath, $background_image_name);

	        $product->background_image = $background_image_name;
	    	$product->updated_by = Auth::id();
	    	$product->updated_at = Carbon::now();
	    	
	    	$product->update();
    	}
    	
    	if ($request->hasFile('image_1')) {
    		$file_name = pathinfo(Input::file('image_1')->getClientOriginalName(), PATHINFO_FILENAME);
    		$file_ext = pathinfo(Input::file('image_1')->getClientOriginalName(), PATHINFO_EXTENSION);

	        $image = $request->file('image_1');
	        $image_1 = $file_name.'_image_1_'.$product->id.'.'.$file_ext;
	        $destinationPath = public_path('/uploads/product/product_image_gallery');
	        $imagePath = $destinationPath. "/".  $image_1;
	        $image->move($destinationPath, $image_1);

	        $data = new ProductImageGallery([
	    		'is_active' => '1',
	    		'image' => $image_1,
	    		'created_by' => Auth::id(),
	    		'created_at' => Carbon::now()
	    	]);

	    	$product->productGalleryImages()->save($data);
	    }

	    if ($request->hasFile('image_2')) {
	        $file_name = pathinfo(Input::file('image_2')->getClientOriginalName(), PATHINFO_FILENAME);
    		$file_ext = pathinfo(Input::file('image_2')->getClientOriginalName(), PATHINFO_EXTENSION);

	        $image = $request->file('image_2');
	        $image_2 = $file_name.'_image_2_'.$product->id.'.'.$file_ext;
	        $destinationPath = public_path('/uploads/product/product_image_gallery');
	        $imagePath = $destinationPath. "/".  $image_2;
	        $image->move($destinationPath, $image_2);

	        $data = new ProductImageGallery([
	    		'is_active' => '1',
	    		'image' => $image_2,
	    		'created_by' => Auth::id(),
	    		'created_at' => Carbon::now()
	    	]);

	    	$product->productGalleryImages()->save($data);
	    }

	    if ($request->hasFile('image_3')) {
	        $file_name = pathinfo(Input::file('image_3')->getClientOriginalName(), PATHINFO_FILENAME);
    		$file_ext = pathinfo(Input::file('image_3')->getClientOriginalName(), PATHINFO_EXTENSION);

	        $image = $request->file('image_3');
	        $image_3 = $file_name.'_image_3_'.$product->id.'.'.$file_ext;
	        $destinationPath = public_path('/uploads/product/product_image_gallery');
	        $imagePath = $destinationPath. "/".  $image_3;
	        $image->move($destinationPath, $image_3);

	        $data = new ProductImageGallery([
	    		'is_active' => '1',
	    		'image' => $image_3,
	    		'created_by' => Auth::id(),
	    		'created_at' => Carbon::now()
	    	]);

	    	$product->productGalleryImages()->save($data);
	    }

	    if ($request->hasFile('image_4')) {
	        $file_name = pathinfo(Input::file('image_4')->getClientOriginalName(), PATHINFO_FILENAME);
    		$file_ext = pathinfo(Input::file('image_4')->getClientOriginalName(), PATHINFO_EXTENSION);

	        $image = $request->file('image_4');
	        $image_4 = $file_name.'_image_4_'.$product->id.'.'.$file_ext;
	        $destinationPath = public_path('/uploads/product/product_image_gallery');
	        $imagePath = $destinationPath. "/".  $image_4;
	        $image->move($destinationPath, $image_4);

	        $data = new ProductImageGallery([
	    		'is_active' => '1',
	    		'image' => $image_4,
	    		'created_by' => Auth::id(),
	    		'created_at' => Carbon::now()
	    	]);

	    	$product->productGalleryImages()->save($data);
	    }
	    if ($request->hasFile('image_1') || $request->hasFile('image_2') || $request->hasFile('image_3') || $request->hasFile('image_4')) {
    		return redirect('product_wise_image_gallery/'.$product->id)
    			->with('success', 'Images for '.$product->title.' gallery added successfully!');
    	}
    	else{
    		return redirect('product_wise_image_gallery/'.$product->id)
    			->with('success', 'No images was selected for upload.');
    	}
    }

    public function update_image_status(Request $request, ProductImageGallery $image)
    {
    	$image->is_active = ($image->is_active == '1')?'0':'1';
    	$image->updated_by = Auth::id();
    	$image->updated_at = Carbon::now();
    	
    	$image->update();
    	return redirect('product_wise_image_gallery/'.$image->product_id)
    			->with('success', 'Status of gallery image updated successfully!');
    }

    public function delete_gallery_image(ProductImageGallery $image, Product $product)
    {
    	$image_path = public_path("uploads/product/product_image_gallery/".$image->image);
    	//$image_path = "uploads/product/product_image_gallery/".$image->image;
		if(file_exists($image_path)) {
		    //Storage::delete($image_path);
		    unlink($image_path);
		}

		$image->delete();
        return redirect('product_wise_image_gallery/'.$product->id)
    			->with('success', 'Image deleted successfully!');
    }

    public function delete_background_image(Product $product)
    {
    	$image_path = public_path("uploads/product/background_image/".$product->background_image);
		if(file_exists($image_path)) {
		    unlink($image_path);
		}

		$product->background_image = '';
    	$product->updated_by = Auth::id();
    	$product->updated_at = Carbon::now();
    	$product->update();

        return redirect('product_wise_image_gallery/'.$product->id)
    			->with('success', 'Background Image deleted successfully!');
    }

    public function delete_product(Product $product)
    {
    	$gallery_images = $product->productGalleryImages;
    	foreach ($gallery_images as $gallery_image) {
    		$image_path = public_path("uploads/product/product_image_gallery/".$gallery_image->image);
			if(file_exists($image_path)) {
			    unlink($image_path);
			}
    	}
    	
    	$image_path = public_path("uploads/product/banner/".$product->banner_image);
		if(file_exists($image_path)) {
		    unlink($image_path);
		}

		$image_path = public_path("uploads/product/overview/".$product->overview_image);
		if(file_exists($image_path)) {
		    //Storage::delete($image_path);
		    unlink($image_path);
		}

		$image_path = public_path("uploads/product/home_thumb_image/".$product->home_thumb_image);
		if(file_exists($image_path)) {
		    //Storage::delete($image_path);
		    unlink($image_path);
		}

		$image_path = public_path("uploads/product/list_thumb_image/".$product->list_thumb_image);
		if(file_exists($image_path)) {
		    //Storage::delete($image_path);
		    unlink($image_path);
		}

		$image_path = public_path("uploads/product/background_image/".$product->background_image);
		if(file_exists($image_path)) {
		    unlink($image_path);
		}

    	$product->delete();
    	return redirect('product_item')->with('success', 'Product deleted successfully!');
    }
}
