<?php

namespace App\Http\Controllers\AdminDashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminDashboardController extends Controller
{
    //
    public function __construct(){
    	$this->middleware('auth');
    }

    public function index()
    {
    	$page_name = 'Dashboard';
    	return view('home', ['page_name' => $page_name, 'title' => 'Dashboard']);
    }
}
