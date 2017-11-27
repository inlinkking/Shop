<?php

namespace App\Http\Controllers\Admin\Ads;

use App\Models\Ads\Ad_category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Ads\Ad;

class AdController extends Controller
{
    function __construct()
    {
        view()->share('categories', Ad_category::get_categories());
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $where = function ($query) use ($request) {
            if ($request->has('category_id')) {
                $query->where('category_id', $request->category_id);
            }
        };
        $ads = Ad::with('category')->where($where)->orderBY('sort_order',
            'desc')->paginate(env('pageSize'));
//        return $ads;
        return view('admin.ads.ad.index', compact('ads'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.ads.ad.create');
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
            'title' => 'required|unique:ads|max:255',
            'url' => 'required|url',
            'sort_order' => 'required|integer|max:99',
        ]);
        Ad::create($request->all());
        return redirect(route('ads.ad.index'))->with('success', '添加成功');
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
        $ad = Ad::find($id);
        return view('admin.ads.ad.edit', compact('ad'));
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
            'title' => 'required|max:255',
            'url' => 'required|url',
            'sort_order' => 'required|integer|max:99',
        ]);
        $ad = Ad::find($id);
        $ad->update($request->all());
        return redirect(route('ads.ad.index'))->with('success', '更新成功');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Ad::destroy($id);
        return back()->with('success','删除成功');
    }

    public function sort_order(Request $request)
    {
        $ad = Ad::find($request->id);
        $ad->sort_order = $request->sort_order;
        $ad->save();
    }


    public function delete(Request $request)
    {
        Ad::destroy($request->id);
    }
}
