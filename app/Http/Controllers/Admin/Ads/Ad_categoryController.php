<?php

namespace App\Http\Controllers\Admin\Ads;

use App\Models\Ads\Ad_category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class Ad_categoryController extends Controller
{
    function __construct()
    {
        view()->share([
            'ad_category'=>Ad_category::get_categories()
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.ads.ad_category.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.ads.ad_category.create');
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
            'name' => 'required|unique:ad_categories|max:255',
            'sort_order' => 'required|integer|max:99',
        ]);
        Ad_category::create($request->all());
        Ad_Category::clear();
        return redirect(route('ads.ad_category.index'))->with('success', '新增成功');
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
        $ad_category = Ad_category::find($id);
        return view('admin.ads.ad_category.edit', compact('ad_category'));
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
            'sort_order' => 'required|integer|max:99',
        ]);
        $ad_category = Ad_category::find($id);
        $ad_category->update($request->all());
        Ad_Category::clear();
        return redirect(route('ads.ad_category.index'))->with('success', '更新成功');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Ad_category::destroy($id);
        Ad_Category::clear();
        return back()->with('success', '删除成功');
    }

    public function sort_order(Request $request)
    {
        $ad_category = Ad_category::find($request->id);
        $ad_category->sort_order = $request->sort_order;
        $ad_category->save();
        Ad_Category::clear();
    }
}
