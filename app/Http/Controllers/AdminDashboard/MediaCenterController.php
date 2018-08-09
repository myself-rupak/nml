<?php

namespace App\Http\Controllers\AdminDashboard;

use Auth;
use App\MediaCenter;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use \Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Input;

class MediaCenterController extends Controller
{
	public function __construct()
    {
    	$this->middleware('auth');
    }

    public function index()
    {
    	$medias = MediaCenter::select('*')
    				->orderBy('is_active', 'asc')->get();
    	$page_name = 'Media Center';
    	return view('admin_dashboard.media_center.media_list', [
    		'page_name'	=> $page_name, 
    		'title' 	=> 'Media Center', 
    		'medias' 	=> $medias
    	]);
    }

    public function add_media()
    {
    	$page_name = 'Add media';
    	return view('admin_dashboard.media_center.add_media', [
    		'page_name' => $page_name, 
    		'title' => 'Add media',
    	]);
    }

    public function save_media(Request $request)
    {
    	$validatedData = $request->validate([
	        'title' => 'required',
	        'content' => 'required',
	        'image_1' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
	        'image_2' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
	        'image_3' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
	        'image_4' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
	    ]);

	    if ($request->hasFile('image_1')) {
	        $image = $request->file('image_1');
	        $file_name = pathinfo(Input::file('image_1')->getClientOriginalName(), PATHINFO_FILENAME);
    		$file_ext = pathinfo(Input::file('image_1')->getClientOriginalName(), PATHINFO_EXTENSION);

    		$image1_name = $file_name.'.'.$file_ext;
	        $destinationPath = public_path('/uploads/media');
	        $imagePath = $destinationPath. "/".  $image1_name;
	        $image->move($destinationPath, $image1_name);
	    }

	    if ($request->hasFile('image_2')) {
	        $image = $request->file('image_2');
	        $file_name = pathinfo(Input::file('image_2')->getClientOriginalName(), PATHINFO_FILENAME);
    		$file_ext = pathinfo(Input::file('image_2')->getClientOriginalName(), PATHINFO_EXTENSION);

    		$image2_name = $file_name.'.'.$file_ext;
	        $destinationPath = public_path('/uploads/media');
	        $imagePath = $destinationPath. "/".  $image2_name;
	        $image->move($destinationPath, $image2_name);
	    }

	    if ($request->hasFile('image_3')) {
	        $image = $request->file('image_3');
	        $file_name = pathinfo(Input::file('image_3')->getClientOriginalName(), PATHINFO_FILENAME);
    		$file_ext = pathinfo(Input::file('image_3')->getClientOriginalName(), PATHINFO_EXTENSION);

    		$image3_name = $file_name.'.'.$file_ext;
	        $destinationPath = public_path('/uploads/media');
	        $imagePath = $destinationPath. "/".  $image3_name;
	        $image->move($destinationPath, $image3_name);
	    }

	    if ($request->hasFile('image_4')) {
	        $image = $request->file('image_4');
	        $file_name = pathinfo(Input::file('image_4')->getClientOriginalName(), PATHINFO_FILENAME);
    		$file_ext = pathinfo(Input::file('image_4')->getClientOriginalName(), PATHINFO_EXTENSION);

    		$image4_name = $file_name.'.'.$file_ext;
	        $destinationPath = public_path('/uploads/media');
	        $imagePath = $destinationPath. "/".  $image4_name;
	        $image->move($destinationPath, $image4_name);
	    }

	    $media = new MediaCenter([
    		'title' => $request->title,
    		'is_active' => $request->is_active,
    		'content' => $request->content,
    		'image_1' => $image1_name,
    		'image_2' => $image2_name,
    		'image_3' => $image3_name,
    		'image_4' => $image4_name,
    		'created_by' => Auth::id(),
    		'created_at' => Carbon::now()
    	]);
    	$media->save();
    	return redirect('media_center')->with('success', 'New media added successfully!');
    }

    public function status_update( MediaCenter $media )
    {
    	$media->is_active = ($media->is_active == '1')?'0':'1';
    	$media->updated_by = Auth::id();
    	$media->updated_at = Carbon::now();
    	
    	$media->update();
    	return redirect('media_center')->with('success', 'Status of '.$media->title.' updated successfully!');
    }

    public function edit_media( MediaCenter $media )
    {
    	$page_name = 'Edit '.$media->title;
    	return view('admin_dashboard.media_center.edit_media', [
    		'page_name' => $page_name, 
    		'title' => 'Edit '.$media->title,
    		'media' => $media,
    	]);
    }

    public function update_media( Request $request, MediaCenter $media )
    {
    	$validatedData = $request->validate([
	        'title' => 'required|max:255',
	        'content' => 'required',
	    ]);

    	$image_1_name = $request->old_image_1;
	    $image_2_name = $request->old_image_2;
	    $image_3_name = $request->old_image_3;
	    $image_4_name = $request->old_image_4;

	    if ($request->hasFile('image_1')) {
    		$image_path = public_path("uploads/media/".$request->old_image_1);
			if(file_exists($image_path)) {
			    //Storage::delete($image_path);
			    unlink($image_path);
			}

	        $image = $request->file('image_1');
	        $file_name = pathinfo(Input::file('image_1')->getClientOriginalName(), PATHINFO_FILENAME);
    		$file_ext = pathinfo(Input::file('image_1')->getClientOriginalName(), PATHINFO_EXTENSION);

    		$image_1_name = $file_name.'.'.$file_ext;
	        $destinationPath = public_path('/uploads/media');
	        $imagePath = $destinationPath. "/".  $image_1_name;
	        $image->move($destinationPath, $image_1_name);
	    }

    	if ($request->hasFile('image_2')) {
    		$image_path = public_path("uploads/media/".$request->old_image_2);
			if(file_exists($image_path)) {
			    //Storage::delete($image_path);
			    unlink($image_path);
			}

	        $image = $request->file('image_2');
	        $file_name = pathinfo(Input::file('image_2')->getClientOriginalName(), PATHINFO_FILENAME);
    		$file_ext = pathinfo(Input::file('image_2')->getClientOriginalName(), PATHINFO_EXTENSION);

    		$image_2_name = $file_name.'.'.$file_ext;
	        $destinationPath = public_path('/uploads/media');
	        $imagePath = $destinationPath. "/".  $image_2_name;
	        $image->move($destinationPath, $image_2_name);
	    }

	    if ($request->hasFile('image_3')) {
    		$image_path = public_path("uploads/media/".$request->old_image_3);
			if(file_exists($image_path)) {
			    //Storage::delete($image_path);
			    unlink($image_path);
			}

	        $image = $request->file('image_3');
	        $file_name = pathinfo(Input::file('image_3')->getClientOriginalName(), PATHINFO_FILENAME);
    		$file_ext = pathinfo(Input::file('image_3')->getClientOriginalName(), PATHINFO_EXTENSION);

    		$image_3_name = $file_name.'.'.$file_ext;
	        $destinationPath = public_path('/uploads/media');
	        $imagePath = $destinationPath. "/".  $image_3_name;
	        $image->move($destinationPath, $image_3_name);
	    }

	    if ($request->hasFile('image_4')) {
    		$image_path = public_path("uploads/media/".$request->old_image_4);
			if(file_exists($image_path)) {
			    //Storage::delete($image_path);
			    unlink($image_path);
			}

	        $image = $request->file('image_4');
	        $file_name = pathinfo(Input::file('image_4')->getClientOriginalName(), PATHINFO_FILENAME);
    		$file_ext = pathinfo(Input::file('image_4')->getClientOriginalName(), PATHINFO_EXTENSION);

    		$image_4_name = $file_name.'.'.$file_ext;
	        $destinationPath = public_path('/uploads/media');
	        $imagePath = $destinationPath. "/".  $image_4_name;
	        $image->move($destinationPath, $image_4_name);
	    }

    	$media->title = $request->title;
    	$media->content = $request->content;
    	$media->is_active = $request->is_active;
    	$media->image_1 = $image_1_name;
    	$media->image_2 = $image_2_name;
    	$media->image_3 = $image_3_name;
    	$media->image_4 = $image_4_name;
    	$media->updated_by = Auth::id();
    	$media->updated_at = Carbon::now();
    	
    	$media->update();
    	return redirect('media_center')->with('success', ''.$media->title.' updated successfully!');
    }
}
