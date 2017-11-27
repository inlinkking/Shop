<?php

namespace App\Http\Controllers\Admin\Location;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MapController extends Controller
{
    function __construct()
    {
        view()->share([
            '_location' => 'am-in',
            '_map' => 'am-active'
        ]);
    }

    public function index()
    {
        return view('admin.location.map.index');
    }
}
