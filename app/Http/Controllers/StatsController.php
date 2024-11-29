<?php

namespace App\Http\Controllers;

use App\Models\Property;
use Illuminate\Http\Request;

class StatsController extends Controller
{
    public function index()
    {
        // Example logic for the stats page
        $totalProperties = Property::count();
        $averagePrice = Property::avg('price');
        $propertiesWithWifi = Property::where('wifi_available', true)->count();

        // Return the stats view with the calculated data
        return view('stats.stats', compact('totalProperties', 'averagePrice', 'propertiesWithWifi'));
    }
}
