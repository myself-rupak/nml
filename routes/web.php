<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
Route::get('/products/{type}', 'ProductsListController@index');
Route::get('/product/{product}', 'ProductController@index');
Route::get('/touch_point/type/{point_type}', 'TouchPointController@index')->middleware('touch_point_types');


/*
|--------------------------------------------------------------------------
| Admin Dashboard Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for admin dashboard of your application.
|
*/

Route::get('/admin_dashboard', 'AdminDashboard\AdminDashboardController@index');

/*
|--------------------------------------------------------------------------
| Admin Dashboard Routes ( Parent Menu)
|--------------------------------------------------------------------------
*/
Route::get('/parent_menu', 'AdminDashboard\WebsiteMenuController@parent_menu');
Route::get('/add_parent_menu', 'AdminDashboard\WebsiteMenuController@add_parent_menu');
Route::post('/save_parent_menu', 'AdminDashboard\WebsiteMenuController@save_parent_menu');
Route::get('/edit_parent_menu/{menu_id}', 'AdminDashboard\WebsiteMenuController@edit_parent_menu');
Route::patch('/update_parent_menu/{menu_id}','AdminDashboard\WebsiteMenuController@update_parent_menu');
Route::delete('/delete_parent_menu/{menu_id}','AdminDashboard\WebsiteMenuController@delete_parent_menu');

/*
|--------------------------------------------------------------------------
| Admin Dashboard Routes ( Product Category )
|--------------------------------------------------------------------------
*/
Route::get('/product_category', 'AdminDashboard\ProductCategoryController@index');
Route::get('/add_product_category', 'AdminDashboard\ProductCategoryController@add_product_category');
Route::post('/save_product_category', 'AdminDashboard\ProductCategoryController@save_product_category');
Route::get('/edit_product_category/{product_category_id}', 'AdminDashboard\ProductCategoryController@edit_product_category');
Route::patch('/update_product_category/{product_category_id}','AdminDashboard\ProductCategoryController@update_product_category');
Route::delete('/delete_product_category/{product_category_id}','AdminDashboard\ProductCategoryController@delete_product_category');

/*
|--------------------------------------------------------------------------
| Admin Dashboard Routes ( Hero Slider )
|--------------------------------------------------------------------------
*/
Route::get('/hero_slider', 'AdminDashboard\HeroSliderController@index');
Route::get('/add_hero_slider', 'AdminDashboard\HeroSliderController@add_hero_slider');
Route::post('/save_hero_slider', 'AdminDashboard\HeroSliderController@save_hero_slider');
Route::get('/edit_hero_slider/{hero_slider_id}', 'AdminDashboard\HeroSliderController@edit_hero_slider');
Route::patch('/update_hero_slider/{hero_slider_id}','AdminDashboard\HeroSliderController@update_hero_slider');
Route::delete('/delete_hero_slider/{hero_slider_id}','AdminDashboard\HeroSliderController@delete_hero_slider');


/*
|--------------------------------------------------------------------------
| Admin Dashboard Routes ( Product specification )
|--------------------------------------------------------------------------
*/
Route::get('/product_specification', 'AdminDashboard\ProductSpecificationController@index');
Route::get('/add_product_specification', 'AdminDashboard\ProductSpecificationController@add_product_specification');
Route::post('/save_product_specification', 'AdminDashboard\ProductSpecificationController@save_product_specification');
Route::get('/edit_product_specification/{product_specification}', 'AdminDashboard\ProductSpecificationController@edit_product_specification');
Route::patch('/update_product_specification/{product_specification}','AdminDashboard\ProductSpecificationController@update_product_specification');

Route::delete('/delete_product_specification/{product_specification}','AdminDashboard\ProductSpecificationController@delete_product_specification');


/*
|--------------------------------------------------------------------------
| Admin Dashboard Routes ( Product )
|--------------------------------------------------------------------------
*/
Route::get('/product_item', 'AdminDashboard\ProductController@index');
Route::get('/add_product', 'AdminDashboard\ProductController@add_product');
Route::post('/save_product', 'AdminDashboard\ProductController@save_product');
Route::get('/product_wise_specifications/{product}', 'AdminDashboard\ProductController@product_specifications');
Route::post('/save_product_wise_specification/{product}','AdminDashboard\ProductController@save_product_wise_specification');
Route::get('/product_wise_image_gallery/{product}','AdminDashboard\ProductController@image_gallery');
Route::post('/save_product_gallery_image/{product}', 'AdminDashboard\ProductController@save_product_gallery_image');
Route::patch('/update_product_gallery_image_status/{image}','AdminDashboard\ProductController@update_image_status');
Route::delete('/delete_product_gallery_image/{image}/{product}','AdminDashboard\ProductController@delete_gallery_image');
Route::get('/edit_product/{product}','AdminDashboard\ProductController@edit_product');
Route::patch('/update_product/{product}','AdminDashboard\ProductController@update_product');
Route::delete('/delete_background_image/{product}','AdminDashboard\ProductController@delete_background_image');
Route::delete('/delete_product/{product}','AdminDashboard\ProductController@delete_product');


/*
|--------------------------------------------------------------------------
| Admin Dashboard Routes ( Media center )
|--------------------------------------------------------------------------
*/
Route::get('/media_center', 'AdminDashboard\MediaCenterController@index');
Route::get('/add_media', 'AdminDashboard\MediaCenterController@add_media');
Route::post('/save_media', 'AdminDashboard\MediaCenterController@save_media');
Route::patch('/media_status_update/{media}','AdminDashboard\MediaCenterController@status_update');
Route::get('/edit_media/{media}','AdminDashboard\MediaCenterController@edit_media');
Route::patch('/update_media/{media}','AdminDashboard\MediaCenterController@update_media');

/*
|--------------------------------------------------------------------------
| Admin Dashboard Routes ( Upcoming vehicles )
|--------------------------------------------------------------------------
*/
Route::get('/upcoming_vehicles_news', 'AdminDashboard\UpcomingVehiclesNewsController@index');
Route::get('/add_upcoming', 'AdminDashboard\UpcomingVehiclesNewsController@add_upcoming');
Route::post('/save_upcoming', 'AdminDashboard\UpcomingVehiclesNewsController@save_upcoming');
Route::get('/edit_upcoming_vehicles_news/{news}','AdminDashboard\UpcomingVehiclesNewsController@edit_upcoming');
Route::patch('/update_upcoming/{news}','AdminDashboard\UpcomingVehiclesNewsController@update_upcoming');

/*
|--------------------------------------------------------------------------
| Admin Dashboard Routes ( Touch points )
|--------------------------------------------------------------------------
*/
Route::get('/districts', 'AdminDashboard\TouchPointsController@districts');
Route::get('/add_districts', 'AdminDashboard\TouchPointsController@add_districts');
Route::post('/save_district', 'AdminDashboard\TouchPointsController@save_district');
Route::get('/edit_district/{district}', 'AdminDashboard\TouchPointsController@edit_district');
Route::patch('/update_district/{district}','AdminDashboard\TouchPointsController@update_district');
Route::delete('/delete_district/{district}','AdminDashboard\TouchPointsController@delete_district');
Route::get('/district_thana_list/{district}','AdminDashboard\TouchPointsController@district_thana_list');


Route::get('/thanas', 'AdminDashboard\TouchPointsController@thanas');
Route::get('/add_thanas', 'AdminDashboard\TouchPointsController@add_thanas');
Route::post('/save_thana', 'AdminDashboard\TouchPointsController@save_thana');
Route::get('/edit_thana/{thana}', 'AdminDashboard\TouchPointsController@edit_thana');
Route::patch('/update_thana/{thana}','AdminDashboard\TouchPointsController@update_thana');
Route::delete('/delete_thana/{thana}','AdminDashboard\TouchPointsController@delete_thana');

//use App\Http\Middleware\TouchPointTypes;

Route::get('/touch_point_list', 'AdminDashboard\TouchPointsController@index')->middleware('touch_point_types');
Route::get('/thana_touch_point/{thana}', 'AdminDashboard\TouchPointsController@thana_touch_point')->middleware('touch_point_types');
Route::post('/save_touch_point/{thana}', 'AdminDashboard\TouchPointsController@save_touch_point');
Route::get('/edit_thana_touch_point/{touch_point}','AdminDashboard\TouchPointsController@edit_thana_touch_point')->middleware('touch_point_types');
Route::patch('/update_touch_point/{touch_point}','AdminDashboard\TouchPointsController@update_touch_point');
Route::patch('/update_touch_point_status/{touch_point}','AdminDashboard\TouchPointsController@update_touch_point_status');
Route::delete('/delete_touch_point/{touch_point}','AdminDashboard\TouchPointsController@delete_touch_point');








