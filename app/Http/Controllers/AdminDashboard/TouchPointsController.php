<?php

namespace App\Http\Controllers\AdminDashboard;


use Auth;
use App\District;
use App\Thana;
use App\TouchPoint;
use \App\Http\Requests\DistrictName;
use \App\Http\Requests\ThanaName;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use \Carbon\Carbon;
use Session;

class TouchPointsController extends Controller
{
    public function __construct()
    {
    	$this->middleware('auth');
    }

    public function index(Request $request)
    {
        $touch_point_types = $request->touch_point_types;
    	$touch_points = TouchPoint::all();	
    	$page_name = 'Touch points';
    	return view('admin_dashboard.touch_points.touch_points.points_list', [
    		'page_name'	=> $page_name, 
    		'title' 	=> 'Touch points', 
    		'touch_points' => $touch_points,
            'touch_point_types' => $touch_point_types,
    	]);
    }

    public function districts()
    {
    	$districts = District::select('id', 'name')->get();
    	$page_name = 'District';
    	return view('admin_dashboard.touch_points.districts.districts', [
    		'page_name'	=> $page_name, 
    		'title' 	=> 'District', 
    		'districts' => $districts
    	]);
    }

    public function add_districts()
    {
    	$page_name = 'Add District';
    	return view('admin_dashboard.touch_points.districts.add_districts', [
    		'page_name' => $page_name, 
    		'title' => 'Add District'
    	]);
    }

    public function save_district( DistrictName $request )
    {
	    foreach($request->name as $name){
    		$data[] = [
    			'name' => $name,
    			'created_at' => Carbon::now(),
    			'created_by' => Auth::id(),
    		];
    	}
    	District::insert($data);
    	Session::flash('success', 'District(s) name added successfully!');
    }

    public function edit_district( District $district )
    {
    	$page_name = 'Edit '.$district->name;
    	return view('admin_dashboard.touch_points.districts.edit_district', [
    		'page_name' => $page_name, 
    		'title' => 'Edit '.$district->name,
    		'district' => $district
    	]);
    }

    public function update_district( Request $request, District $district )
    {
    	$validatedData = $request->validate([
	        'name' => 'required|unique:district,name|max:100',
	    ],
	    [
            'name.unique' => 'Duplicate district name tried to be inserted',
        ]);

    	$district->name = $request->name;
    	$district->updated_by = Auth::id();
    	$district->updated_at = Carbon::now();
    	
    	$district->update();
    	return redirect('districts')->with('success', 'District name updated successfully!');
    }

    public function delete_district( District $district )
    {
    	$district_name = $district->name;
    	$district->delete();
        return redirect('districts')->with('success', ''.$district_name.' deleted successfully!');
    }

    public function district_thana_list( District $district )
    {
    	$page_name = $district->name.' Thana list';
    	return view('admin_dashboard.touch_points.districts.thanas_list', [
    		'page_name'	=> $page_name, 
    		'title' 	=> $district->name.' Thana list', 
    		'district' => $district
    	]);
    }

    public function thanas()
    {
    	$thanas = Thana::select('id', 'name', 'district_id')->get();
    	$page_name = 'Thana';
    	return view('admin_dashboard.touch_points.thanas.thanas', [
    		'page_name'	=> $page_name, 
    		'title' 	=> 'Thana', 
    		'thanas' => $thanas
    	]);
    }

    public function add_thanas()
    {
    	$districts = District::select('id', 'name')->get();
    	$page_name = 'Thana';
    	return view('admin_dashboard.touch_points.thanas.add_thanas', [
    		'page_name'	=> $page_name, 
    		'title' 	=> 'Thana', 
    		'districts' => $districts
    	]);
    }

    public function save_thana( ThanaName $request )
    {
	    foreach($request->name as $name){
    		$data[] = [
    			'district_id' => $request->district_id,
    			'name' => $name,
    			'created_at' => Carbon::now(),
    			'created_by' => Auth::id(),
    		];
    	}
    	Thana::insert($data);
    	Session::flash('success', 'Thanas(s) name added successfully!');
    }

    public function edit_thana( Thana $thana )
    {
    	$districts = District::select('id', 'name')->get();
    	$page_name = 'Edit '.$thana->name;
    	return view('admin_dashboard.touch_points.thanas.edit_thana', [
    		'page_name' => $page_name, 
    		'title' => 'Edit '.$thana->name,
    		'districts' => $districts,
    		'thana' => $thana,
    	]);
    }

    public function update_thana(Request $request, Thana $thana)
    {
    	$thana_name = $thana->name;
    	$validatedData = $request->validate([
	        'name' => 'required',
	        'district_id' => 'required',
	    ]);

	    $thana->name = $request->name;
	    $thana->district_id = $request->district_id;
    	$thana->updated_by = Auth::id();
    	$thana->updated_at = Carbon::now();
    	
    	$thana->update();
    	return redirect('thanas')->with('success', ''.$thana_name.' updated successfully!');
    }

    public function delete_thana( Thana $thana )
    {
    	$thana_name = $thana->name;
    	$thana->delete();
        return redirect('thanas')->with('success', ''.$thana_name.' deleted successfully!');
    }

    public function thana_touch_point(Request $request, Thana $thana)
    {
    	$touch_point_types = $request->touch_point_types;

    	$page_name = $thana->name.' touch points';
    	return view('admin_dashboard.touch_points.touch_points.thana_touch_point', [
    		'page_name'	=> $page_name, 
    		'title' 	=> $thana->name.' touch points', 
    		'touch_point_types' => $touch_point_types,
    		'thana' => $thana,
    	]);
    }

    public function save_touch_point(Request $request, Thana $thana)
    {
    	$validatedData = $request->validate([
	        'name' => 'required|max:255',
	        'address' => 'required|max:255',
	        'contact_person' => 'required|max:255',
	        'contact_phone' => 'required|min:11|max:11',
	        'point_type' => 'required',
	        'latitude' => 'required|max:9|regex:/^\d*(\.\d{6})?$/',
	        'longitude' => 'required|max:9|regex:/^\d*(\.\d{6})?$/',
	    ]);

	    $touchPoint = new TouchPoint([
	    	'district_id' => $thana->district->id,
    		'thana_id' => $thana->id,
	    	'name' => $request->name,
    		'address' => $request->address,
    		'contact_person' => $request->contact_person,
    		'contact_phone' => $request->contact_phone,
    		'email' => $request->email,
    		'point_type' => $request->point_type,
    		'latitude' => $request->latitude,
    		'longitude' => $request->longitude,
    		'created_by' => Auth::id(),
    		'created_at' => Carbon::now()
    	]);
    	
    	$touchPoint->save();
    	return redirect('thana_touch_point/'.$thana->id)->with('success', $request->name.' touch point added successfully!');
    }

    public function edit_thana_touch_point(Request $request, TouchPoint $touch_point)
    {
    	$touch_point_types = $request->touch_point_types;

    	$page_name = $touch_point->name.' touch points';
    	return view('admin_dashboard.touch_points.touch_points.edit_thana_touch_point', [
    		'page_name'	=> $page_name, 
    		'title' 	=> $touch_point->name.' touch points', 
    		'touch_point_types' => $touch_point_types,
    		'touch_point' => $touch_point,
    	]);
    }

    public function update_touch_point(Request $request, TouchPoint $touch_point)
    {
    	$validatedData = $request->validate([
	        'name' => 'required|max:255',
	        'address' => 'required|max:255',
	        'contact_person' => 'required|max:255',
	        'contact_phone' => 'required|min:11|max:11',
	        'point_type' => 'required',
	        'latitude' => 'required|max:9|regex:/^\d*(\.\d{6})?$/',
	        'longitude' => 'required|max:9|regex:/^\d*(\.\d{6})?$/',
	    ]);

    	$touch_point->name = $request->name;
    	$touch_point->address = $request->address;
    	$touch_point->contact_person = $request->contact_person;
    	$touch_point->contact_phone = $request->contact_phone;
    	$touch_point->email = $request->email;
    	$touch_point->point_type = $request->point_type;
    	$touch_point->latitude = $request->latitude;
    	$touch_point->longitude = $request->longitude;
    	$touch_point->updated_by = Auth::id();
    	$touch_point->updated_at = Carbon::now();

    	$touch_point->update();
    	return redirect('thana_touch_point/'.$touch_point->thana->id)->with('success', $touch_point->name.' updated successfully!');
    }

    public function update_touch_point_status(TouchPoint $touch_point)
    {
    	$touch_point->is_active = !$touch_point->is_active;
    	$touch_point->updated_by = Auth::id();
    	$touch_point->updated_at = Carbon::now();

    	$touch_point->update();
    	return redirect('thana_touch_point/'.$touch_point->thana->id)->with('success', 'Status of '.$touch_point->name.' updated successfully!');
    }

    public function delete_touch_point(TouchPoint $touch_point)
    {
    	$touch_point_name = $touch_point->name;
    	$thana_id = $touch_point->thana->id;
    	$touch_point->delete();
    	return redirect('thana_touch_point/'.$thana_id)->with('success', 'Status of '.$touch_point_name.' deleted successfully!');
    }
}
