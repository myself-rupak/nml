<?php

namespace App\Http\Controllers\AdminDashboard;

use \App\Http\Requests\ProductSpecificationTitle;
use Auth;
use Illuminate\Http\Request;
use \Carbon\Carbon;
use App\Http\Controllers\Controller;
use Session;
use App\ProductSpecification;

class ProductSpecificationController extends Controller
{
    public function __construct()
    {
    	$this->middleware('auth');
    }

    public function index()
    {
    	$product_specifications = ProductSpecification::select('id', 'title')->get();
    	$page_name = 'Product specification';
    	return view('admin_dashboard.product_specification.product_specification', [
    		'page_name' 			=> $page_name, 
    		'title' 				=> 'Product specification', 
    		'product_specifications' 	=> $product_specifications
    	]);
    }

    public function add_product_specification()
    {
    	$page_name = 'Add product specification';
    	return view('admin_dashboard.product_specification.add_product_specification', [
    		'page_name' => $page_name, 
    		'title' => 'Add product specification'
    	]);
    }

    public function save_product_specification( ProductSpecificationTitle $request )
    {
    	foreach($request->title as $title){
    		$data[] = [
    			'title' => $title,
    			'created_at' => Carbon::now(),
    			'created_by' => Auth::id(),
    		];
    	}
    	ProductSpecification::insert($data);
    	Session::flash('success', 'Product specification(s) added successfully!');
    }

    public function delete_product_specification(ProductSpecification $product_specification)
    {
    	$product_specification->delete();
    	return redirect('product_specification')->with('success', 'Product specification deleted successfully!');
    }

    public function edit_product_specification(ProductSpecification $product_specification)
    {
    	$page_name = 'Edit product specification';
    	return view('admin_dashboard.product_specification.edit_product_specification', [
    		'page_name' => $page_name, 
    		'title' => 'Edit product specification',
    		'product_specification' => $product_specification
    	]);
    }

    public function update_product_specification(Request $request, $product_specification)
    {
    	$validatedData = $request->validate([
	        'title' => 'required|unique:product_specification,title|max:100',
	    ],
	    [
            'title.unique' => 'Duplicate product specification title tried to be inserted',
        ]);

	    $product_specification = ProductSpecification::find($product_specification);

    	$product_specification->title = $request->title;
    	$product_specification->updated_by = Auth::id();
    	$product_specification->updated_at = Carbon::now();
    	
    	$product_specification->update();
    	return redirect('product_specification')->with('success', 'Product specification title updated successfully!');
    }
}
