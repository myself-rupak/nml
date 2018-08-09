<?php

namespace App\Http\Controllers\AdminDashboard;

use Auth;
use App\HeroSlider;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use \Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class HeroSliderController extends Controller
{
    public function __construct()
    {
    	$this->middleware('auth');
    }

    public function index()
    {
    	$sliders = HeroSlider::select('id', 'slider_image', 'mobile_slider_image', 'template', 'description', 'mobile_description','is_active')->get();
    	$page_name = 'Hero slider';
    	return view('admin_dashboard.hero_slider.hero_slider', [
    		'page_name'	=> $page_name, 
    		'title' 	=> 'Hero slider', 
    		'sliders' 	=> $sliders
    	]);
    }
/*
|--------------------------------------------------------------------------
| ( ADD Hero Slider )
|--------------------------------------------------------------------------
*/
    public function add_hero_slider()
    {
    	$page_name = 'Add hero slider';
    	return view('admin_dashboard.hero_slider.add_hero_slider', [
    		'page_name' => $page_name, 
    		'title' => 'Add hero slider'
    	]);
    }

    public function save_hero_slider(Request $request)
    {
    	$validatedData = $request->validate([
	        'template' => 'required',
	        'slider_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'mobile_slider_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:500',
	    ]);
    	if ($request->hasFile('slider_image')) {
	        $image = $request->file('slider_image');
	        $name = $image->getClientOriginalName();
	        $destinationPath = public_path('/uploads/hero_slider');
	        $imagePath = $destinationPath. "/".  $name;
	        $image->move($destinationPath, $name);
	    }

        if ($request->hasFile('slider_image')) {
            $image = $request->file('mobile_slider_image');
            $mobile_slider_name = $image->getClientOriginalName();
            $destinationPath = public_path('/uploads/hero_slider/mobile');
            $imagePath = $destinationPath. "/".  $mobile_slider_name;
            $image->move($destinationPath, $mobile_slider_name);
        }

	    $hero_slider = new HeroSlider([
    		'template' => $request->template,
    		'is_active' => $request->is_active,
    		'slider_image' => $name,
            'mobile_slider_image' => $mobile_slider_name,
    		'description' => $request->description,
            'mobile_description' => $request->mobile_description,
    		'created_by' => Auth::id(),
    		'created_at' => Carbon::now()
    	]);
    	$hero_slider->save();
    	return redirect('hero_slider')->with('success', 'One hero slider added successfully!');
    }
/*
|--------------------------------------------------------------------------
| ( EDIT Product Category )
|--------------------------------------------------------------------------
*/
	public function edit_hero_slider(HeroSlider $hero_slider_id)
	{
		$page_name = 'Edit hero slider';
		return view('admin_dashboard.hero_slider.edit_hero_slider', [
			'page_name' => $page_name, 
			'title' => 'Edit hero slider',
			'slider' => $hero_slider_id
		]);
	}
/*
|--------------------------------------------------------------------------
| ( UPDATE Hero Slider )
|--------------------------------------------------------------------------
*/
	public function update_hero_slider( Request $request, $hero_slider_id )
	{
		$validatedData = $request->validate([
	        'template' => 'required',
	    ]);

	    $name = $request->old_slider_image;
	    if ($request->hasFile('slider_image')) {
    		$image_path = public_path("/uploads/hero_slider/".$request->old_slider_image);
			if(file_exists($image_path)) {
			    //Storage::delete($image_path);
                unlink($image_path);
			}

	        $image = $request->file('slider_image');
	        $name = $image->getClientOriginalName();
	        $destinationPath = public_path('/uploads/hero_slider');
	        $imagePath = $destinationPath. "/".  $name;
	        $image->move($destinationPath, $name);
	    }

        $mobile_slider_image_name = $request->old_mobile_slider_image;
        if ($request->hasFile('mobile_slider_image')) {
            $image_path = public_path("/uploads/hero_slider/mobile/".$request->old_mobile_slider_image);
            if(file_exists($image_path)) {
                //Storage::delete($image_path);
                unlink($image_path);
            }

            $image = $request->file('mobile_slider_image');
            $mobile_slider_image_name = $image->getClientOriginalName();
            $destinationPath = public_path('/uploads/hero_slider/mobile');
            $imagePath = $destinationPath. "/".  $mobile_slider_image_name;
            $image->move($destinationPath, $mobile_slider_image_name);
        }

	    $slider = HeroSlider::find($hero_slider_id);

    	$slider->template = $request->template;
    	$slider->is_active = $request->is_active;
    	$slider->slider_image = $name;
        $slider->mobile_slider_image = $mobile_slider_image_name;
    	$slider->description = $request->description;
        $slider->mobile_description = $request->mobile_description;
    	$slider->updated_by = Auth::id();
    	$slider->updated_at = Carbon::now();
    	
    	$slider->update();
    	return redirect('hero_slider')->with('success', 'Hero slider updated successfully!');
	}

/*
|--------------------------------------------------------------------------
| ( DELETE Product Category )
|--------------------------------------------------------------------------
*/

    public function delete_hero_slider(HeroSlider $hero_slider_id)
    {
    	$image_path = public_path("/uploads/hero_slider/".$hero_slider_id->slider_image);
		if(file_exists($image_path)) {
		    //Storage::delete($image_path);
            unlink($image_path);
		}

        $image_path = public_path("/uploads/hero_slider/mobile/".$hero_slider_id->mobile_slider_image);
        if(file_exists($image_path)) {
            //Storage::delete($image_path);
            unlink($image_path);
        }

		$hero_slider_id->delete();
        return redirect('hero_slider')->with('success', 'Hero slider deleted successfully!');
    }	
}
