<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\ProductTypes;

class ProductsListController extends Controller
{
    public function __construct()
    {
    	
    }

    public function index($type)
    {
    	$product_categories = ProductTypes::select('id', 'title', 'image', 'hover_image', 'menu_image', 'url')->where('is_active', '1')->orderBy('order', 'asc')->get();
    	$product_type = ProductTypes::where('url', $type)->first();
		$products = Product::where('product_types_id', $product_type->id)->where('is_active', '1')->get();
		return view('products.products',[
            'title' => $product_type->title,
            'product_type' => $product_type,
            'products' => $products,
            'product_categories' => $product_categories,
        ]);
    }
}
