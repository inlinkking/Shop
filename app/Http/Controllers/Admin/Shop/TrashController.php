<?php

namespace App\Http\Controllers\Admin\Shop;

use App\Models\Shop\ProductGallery;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Shop\Product;


class TrashController extends Controller
{

    public function index()
    {
        $trashs = Product::onlyTrashed()->paginate(env('pageSize'));
        return view('admin.shop.trash.index', compact('trashs'));
    }

    public function del_all(Request $request)
    {
//        return $request->id;
        Product::withTrashed()->where('id', $request->id)->restore();
    }

    public function del_bin(Request $request)
    {
        $id = $request->id;
        Product::withTrashed()->whereIn('id', $id)->restore();
    }

    public function delete(Request $request)
    {
        Product::withTrashed()->where('id', $request->id)->forceDelete();
        \DB::table('category_product')->where('product_id', $request->id)->delete();
        ProductGallery::where('product_id', $request->id)->delete();
    }

    public function delete_all(Request $request)
    {
        $id=$request->id;
        Product::withTrashed()->whereIn('id',$id)->forceDelete();
        \DB::table('category_product')->whereIn('product_id',$id)->delete();
        ProductGallery::whereIn('product_id',$id)->delete();
    }
}
