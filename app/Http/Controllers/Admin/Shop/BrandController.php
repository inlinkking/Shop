<?php

namespace App\Http\Controllers\Admin\Shop;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Shop\Brand;
use Cache;

class BrandController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $where = function ($query) use ($request) {
            if ($request->has('keyword') and $request->keyword != '') {
                $value = "%" . $request->keyword . "%";
                $query->where('name', 'like', $value);
            }
        };

        $brands = Brand::where($where)->orderBY('sort_order', 'desc')->paginate(env('pageSize'));
//        return $brands;
        return view('admin.shop.brand.index', compact('brands'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.shop.brand.create');
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
            'name' => 'required|unique:brands|max:255',
            'url' => 'required|url',
            'sort_order' => 'required|integer|max:99',
        ]);
        Brand::create($request->all());
        return redirect(route('shop.brand.index'))->with('success', '新增成功');
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
        $brands = Brand::find($id);
        return view('admin.shop.brand.edit', compact('brands'));
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
            'url' => 'required|url',
            'sort_order' => 'required|integer|max:99',
        ]);
        $brands = Brand::find($id);
        $brands->update($request->all());
        return redirect(route('shop.brand.index'))->with('success', '更新成功');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Brand::destroy($id);
        return redirect(route('shop.brand.index'))->with('success', '删除成功');
    }

    public function sort_order(Request $request)
    {
        $brand = Brand::find($request->id);
        $brand->sort_order = $request->sort_order;
        $brand->save();
    }

    public function change_attr(Request $request)
    {
        $brand = Brand::find($request->id);
        $attr = $request->attr;
        $brand->$attr = !$brand->$attr;
        $brand->save();
    }
}
