<?php

namespace App\Http\Controllers\Admin\Shop;

use App\Models\Shop\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    function __construct()
    {
        view()->share([
            'category_num' => Category::all(),
            'categories' => Category::all_categories(),
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.shop.category.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.shop.category.create');
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
            'name' => 'required|unique:categories|max:255',
            'sort_order' => 'required|integer|max:99',
        ]);
        Category::create($request->all());
        Category::clear();
        return redirect(route('shop.category.index'))->with('success', '新增成功');
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
        $category = Category::find($id);
        return view('admin.shop.category.edit', compact('category'));
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
        $category = Category::find($id);
        $category->update($request->all());
        Category::clear();
        return redirect(route('shop.category.index'))->with('success', '更新成功');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!category::check_children($id)) {
            return back()->with('error', '当前分类下有孩子，不能杀生');
        }
        Category::destroy($id);
        Category::clear();
        return back()->with('success', '删除成功');
    }

    public function change_attr(Request $request)
    {
//        return $request->all();
        $category = Category::find($request->id);
        $attr = $request->attr;
        $category->$attr = !$category->$attr;
        $category->save();
        Category::clear();
    }

    public function sort_order(Request $request)
    {
        $category = Category::find($request->id);
        $category->sort_order = $request->sort_order;
        $category->save();
        Category::clear();
    }
}
