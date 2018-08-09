<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\ProductTypes;

class ProductController extends Controller
{
    public function __construct()
    {
    	
    }

    public function index($product)
    {
		$product = Product::firstOrNew(['url' => $product]);
		$product_categories = ProductTypes::select('id', 'title', 'image', 'hover_image', 'menu_image', 'url')
								->where('is_active', '1')
								->orderBy('order', 'asc')
								->get();
		return view('product.product',[
            'title' => $product->title,
            'product' => $product,
            'product_categories' => $product_categories,
        ]);
    }
}
