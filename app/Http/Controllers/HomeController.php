<?php

namespace App\Http\Controllers;

use App\ProductTypes;
use App\HeroSlider;
use App\Product;
use App\MediaCenter;
use App\UpcomingVehiclesNews;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $product_categories = ProductTypes::select('id', 'title', 'image', 'hover_image', 'menu_image', 'url')->where('is_active', '1')->orderBy('order', 'asc')->get();
        $sliders = HeroSlider::select('id', 'slider_image', 'mobile_slider_image', 'template', 'description', 'mobile_description')->where('is_active', '1')->get();

        $three_random_products = DB::table('product')
                                    ->select(
                                        'product.id', 
                                        'product.home_thumb_image', 
                                        'product.home_page_description', 
                                        'product.title as product_title',
                                        'product.url', 
                                        'product_types.title as product_types_title',
                                        'product_types.id as product_types_id')
                                    ->leftJoin('product_types', 'product.product_types_id', '=', 'product_types.id')
                                    ->where('product.featured_product', '1')
                                    ->where('product.product_condition', '1')
                                    ->groupBy('product_types_id')
                                    ->inRandomOrder()
                                    ->limit(3)
                                    ->get();

        $media_center = MediaCenter::where('is_active', '1')->first();
        $vehicle_news = UpcomingVehiclesNews::where('is_active', '1')->first();

        $three_upcoming_products = DB::table('product')
                                    ->select(
                                        'product.id', 
                                        'product.home_thumb_image', 
                                        'product.home_page_description', 
                                        'product.title as product_title',
                                        'product.url', 
                                        'product_types.title as product_types_title',
                                        'product_types.id as product_types_id')
                                    ->leftJoin('product_types', 'product.product_types_id', '=', 'product_types.id')
                                    ->where('product.featured_product', '1')
                                    ->where('product.product_condition', '0')
                                    ->groupBy('product_types_id')
                                    ->inRandomOrder()
                                    ->limit(3)
                                    ->get();
        return view('home.home',[
            'title' => 'Welcome to Nitol Motors Limited',
            'product_categories' => $product_categories,
            'sliders' => $sliders,
            'random_products' => $three_random_products,
            'media_center' => $media_center,
            'vehicle_news' => $vehicle_news,
            'three_upcoming_products' => $three_upcoming_products,
        ]);
    }
}
