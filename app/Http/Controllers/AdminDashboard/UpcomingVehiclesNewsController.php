<?php

namespace App\Http\Controllers\AdminDashboard;
use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\UpcomingVehiclesNews;
use \Carbon\Carbon;

class UpcomingVehiclesNewsController extends Controller
{
    public function __construct()
    {
    	$this->middleware('auth');
    }

    public function index()
    {
    	$news = UpcomingVehiclesNews::all();
    	$page_name = 'Upcoming Vehicles News';
    	return view('admin_dashboard.upcoming_vehicles_news.news_list', [
    		'page_name'	=> $page_name, 
    		'title' 	=> 'Upcoming Vehicles News', 
    		'news' 		=> $news
    	]);
    }

    public function add_upcoming()
    {
    	$page_name = 'Add upcoming vehicles news';
    	return view('admin_dashboard.upcoming_vehicles_news.add_upcoming', [
    		'page_name' => $page_name, 
    		'title' => 'Add Product',
    	]);
    }

    public function save_upcoming(Request $request)
    {
    	$validatedData = $request->validate([
	        'content' => 'required',
	    ]);

	    $news = new UpcomingVehiclesNews([
	    	'content' => $request->content,
    		'is_active' => $request->is_active,
    		'created_by' => Auth::id(),
    		'created_at' => Carbon::now()
    	]);
    	$news->save();
    	return redirect('upcoming_vehicles_news')->with('success', 'News added successfully!');
    }

    public function edit_upcoming(UpcomingVehiclesNews $news)
    {
    	$page_name = 'Edit upcoming vehicles news';
		return view('admin_dashboard.upcoming_vehicles_news.edit_upcoming', [
			'page_name' => $page_name, 
			'title' => 'Edit upcoming vehicles news',
			'news' => $news
		]);
    }

    public function update_upcoming(Request $request, UpcomingVehiclesNews $news)
    {
    	$validatedData = $request->validate([
	        'content' => 'required',
	    ]);

	    $news->content = $request->content;
        $news->is_active = $request->is_active;
    	$news->updated_by = Auth::id();
    	$news->updated_at = Carbon::now();
    	
    	$news->update();
    	return redirect('upcoming_vehicles_news')->with('success', 'News updated successfully!');
    }
}
