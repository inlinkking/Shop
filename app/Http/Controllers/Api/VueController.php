<?php

namespace App\Http\Controllers\Api;

use App\Models\Ads\Ad;
use App\Models\Shop\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class VueController extends Controller
{
    public function ad()
    {
        $data = Ad::all();
        return $data;
    }
}