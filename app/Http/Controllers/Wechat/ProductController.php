<?php

namespace App\Http\Controllers\Wechat;

use App\Models\Shop\Cart;
use App\Models\Shop\Category;
use App\Models\Shop\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    public function category()
    {
        view()->share([
            '_category' => 'on',
        ]);
        $categories = Category::all_categories();
        return view('wechat.product.category', compact('categories'));
    }

    public function search()
    {
        $product = Product::where('is_recommend', true)->orderBY('is_top', 'desc')->get();
        return view('wechat.product.search', compact('product'));
    }

    public function show($id)
    {
        $shows = Product::find($id);
//        return $shows;
        $recommends = Product::where('is_recommend', true)->where('id', '<>', $id)->orderBY('is_top', 'desc')->get();
        $cart =Cart::count_cart();

//        return $cart;
        return view('wechat.product.show', compact('shows', 'recommends', 'cart'));
    }

    public function index(Request $request)
    {
        $where = function ($query) use ($request) {
            if ($request->has('category_id') and $request->category_id != '') {
                $category_id = $request->category_id;
                $product_ids = \DB::table('category_product')->where('category_id', $category_id)->pluck('product_id');
                $query->whereIn('id', $product_ids);
            }

            if ($request->has('searchword')) {
                if ($request->has('searchword') and $request->searchword != '') {
                    $search = "%" . $request->searchword . "%";
                    $query->where('name', 'like', $search);
                }
            }
        };
        $products = Product::where($where)->orderBY('is_top', 'desc')->get();
        return view('wechat.product.index', compact('products'));
    }
}
