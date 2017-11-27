<?php

namespace App\Http\Controllers\Admin\Ads;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Ads\Ad;

class TrashController extends Controller
{
    public function index()
    {
        $trashs = Ad::with('category')->onlyTrashed()->paginate(env('pageSize'));
//        return $trashs;
        return view('admin.ads.trash.index', compact('trashs'));
    }

    public function reduction(Request $request)
    {
        Ad::withTrashed()->where('id', $request->id)->restore();
    }

    public function reduction_all(Request $request)
    {
        $id = $request->id;
//        return $id;
        Ad::withTrashed()->whereIn('id', $id)->restore();
    }

    public function delete(Request $request)
    {
        Ad::withTrashed()->where('id', $request->id)->forceDelete();
    }

    public function delete_all(Request $request)
    {
        $id = $request->id;
        Ad::withTrashed()->whereIn('id', $id)->forceDelete();
    }
}
