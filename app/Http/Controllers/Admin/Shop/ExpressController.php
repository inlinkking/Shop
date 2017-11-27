<?php

namespace App\Http\Controllers\Admin\Shop;

use App\Models\Shop\Express;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ExpressController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $express = Express::orderBY('sort_order','desc')->paginate(env('pageSize'));
        return view('admin.shop.express.index', compact('express'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.shop.express.create');
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
            'name' => 'required|unique:expresses|max:255',
            'code' => 'required|unique:expresses|max:255',
            'url' => 'required|url',
            'shipping_money' => 'required|numeric',
            'shipping_free' => 'required|numeric',
            'sort_order' => 'required|integer|max:99',
        ]);
        Express::create($request->all());
        return redirect(route('shop.express.index'))->with('success', '新增成功');
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
        $express = Express::find($id);
        return view('admin.shop.express.edit', compact('express'));
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
            'code' => 'required|max:255',
            'url' => 'required|url',
            'shipping_money' => 'required|numeric',
            'shipping_free' => 'required|numeric',
            'sort_order' => 'required|integer|max:99',
        ]);
        $express = Express::find($id);
        $express->update($request->all());
        return redirect(route('shop.express.index'))->with('success', '修改成功');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Express::destroy($id);
        return back()->with('success', '删除成功');
    }

    public function change_attr(Request $request)
    {
        $express = Express::find($request->id);
        $attr = $request->attr;
        $express->$attr = !$express->$attr;
        $express->save();
    }

    public function sort_order(Request $request)
    {
        $express = Express::find($request->id);
        $express->sort_order = $request->sort_order;
        $express->save();
    }
}
