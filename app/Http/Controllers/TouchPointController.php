<?php

namespace App\Http\Controllers;

use App\ProductTypes;
use App\TouchPoint;
use Illuminate\Http\Request;
use FarhanWazir\GoogleMaps\GMaps;

class TouchPointController extends Controller
{
    public function __construct()
    {
    	
    }

    public function index(Request $request, $point_type)
    {
    	$touch_point_types = $request->touch_point_types;

    	if ($point_type == 'sales_office')
    		$touch_points = TouchPoint::select('*')->where('point_type', '1')->get();
    	else if ($point_type == 'service_center')
    		$touch_points = TouchPoint::select('*')->where('point_type', '2')->get();
    	else if ($point_type == 'authorized_service_center')
    		$touch_points = TouchPoint::select('*')->where('point_type', '3')->get();
    	else if ($point_type == 'parts_outlet')
    		$touch_points = TouchPoint::select('*')->where('point_type', '4')->get();
    	else
    		$touch_points = TouchPoint::all();

    	$product_categories = ProductTypes::select('id', 'title', 'image', 'hover_image', 'menu_image', 'url')->where('is_active', '1')->orderBy('order', 'asc')->get();

    	$config = array();
        $config['map_height'] = "600px";
        $config['zoom'] = '10';
        $config['center'] = '23.777875, 90.406174';
        $config['places'] = 'TR4058128UE';
		$config['placesAutocompleteInputID'] = 'myPlaceTextBox';
		$config['placesAutocompleteBoundsMap'] = TRUE; // set results biased towards the maps viewport
		$config['placesAutocompleteOnChange'] = 'alert(\'You selected a place\');';

        $gmap = new GMaps();
        $gmap->initialize($config);

        $marker = array();
        $marker['draggable'] = true;

        foreach ($touch_points as $touch_point) {
        	$marker['position'] = $touch_point->latitude.', '.$touch_point->longitude;
	        $marker['infowindow_content'] = $touch_point->name.'<br>'.$touch_point->address.'<br>'.$touch_point->thana->name.', '.$touch_point->district->name.'<br>Contact: '.$touch_point->contact_person.', '.$touch_point->contact_phone;

            if ($touch_point->point_type == '1')
                $marker['icon'] = URL('/uploads/touch_point/sales_office.png');
            else if ($touch_point->point_type == '2')
                $marker['icon'] = URL('/uploads/touch_point/service_center.png');
            else if ($touch_point->point_type == '3')
                $marker['icon'] = URL('/uploads/touch_point/authorized_sc.png');
            else if ($touch_point->point_type == '4')
                $marker['icon'] = URL('/uploads/touch_point/parts_outlet.png');
            else
            
	        $gmap->add_marker($marker);
        }
        
     
        $map = $gmap->create_map();
        return view('touch_point.touch_point',[
        	'product_categories' => $product_categories,
            'title' => $point_type,
            'map' => $map,
        ]);
    }
}
