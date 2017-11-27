<?php

namespace App\Http\Controllers\Admin\Shop;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Shop\Product;
use App\Models\Shop\ProductGallery;
use App\Models\Shop\Brand;
use App\Models\Shop\Category;

class ProductController extends Controller
{
    function __construct()
    {
        view()->share([
            'categories' => Category::all_categories(),
            'brands' => Brand::orderBY('sort_order')->get(),
            'filter_categories' => Category::filter_categories(),
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $where = function ($query) use ($request) {
            if ($request->has('name') and $request->name != '') {
                $search = "%" . $request->name . "%";
                $query->where('name', 'like', $search);
            }
            if ($request->has('category_id') and $request->category_id != '-1') {
                $category_id = $request->category_id;
                $product_ids = \DB::table('category_product')->where('category_id', $category_id)->pluck('product_id');
                $query->whereIn('id', $product_ids);
            }
            if ($request->has('brand_id') and $request->brand_id != '-1') {
                $query->where('brand_id', $request->brand_id);
            }
            if ($request->has('is_shelves') and $request->is_shelves != '-1') {
                $query->where('is_shelves', $request->is_shelves);
            }
            if ($request->has('create_at') and $request->create_at != '') {
                $time = explode("~", $request->input('create_at'));
                $start_time = $time[0] . ' 00:00:00';
                $end_time = $time[1] . ' 23:59:59';
                $query->whereBetween('create_at', [$start_time, $end_time]);
            }
        };
        $products = Product::with('categories')->with('brand')->where($where)->paginate(env('pageSize'));
//        return $products;
        return view('admin.shop.product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.shop.product.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:products|max:255',
            'stock' => 'required|int',
            'price' => 'required|numeric',
        ]);
//        return $request->all();
        $product = Product::create($request->all());
        //相册插入相册表
        if ($request->has('imgs')) {
            foreach ($request->imgs as $img) {
                $product->product_galleries()->create(['img' => $img]);
            }
        }
        //商品所属栏目
        $product->categories()->sync($request->category_id);
        return redirect(route('shop.product.index'))->with('success', '新增成功');
    }


    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::with('product_galleries', 'brand', 'categories')->find($id);
        $p_category = $product->categories->pluck('id');
        return view('admin.shop.product.edit', compact('product', 'p_category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
            'stock' => 'required|int',
            'price' => 'required|numeric',
        ]);
        $product = Product::find($id);
        $product->categories()->sync($request->category_id);
        $product->update($request->all());
        if ($request->has('imgs')) {
            foreach ($request->imgs as $img) {
                $product->product_galleries()->create(['img' => $img]);
            }
        }
        return redirect(route('shop.product.index'))->with('success', '更新成功');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Product::destroy($id);
        return back()->with('success', '删除成功');
    }

    public function delete(Request $request)
    {
        Product::destroy($request->id);
    }


    public function destroy_gallery(Request $request)
    {
//        return $request->id;
        ProductGallery::destroy($request->id);
    }

    public function change_attr(Request $request)
    {
        $product = Product::find($request->id);
        $attr = $request->attr;
        $product->$attr = !$product->$attr;
        $product->save();
    }

    public function stock(Request $request)
    {
        $product = Product::find($request->id);
//        return $product;
        $product->stock = $request->stock;
        $product->save();
    }
}
