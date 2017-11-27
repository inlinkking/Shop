<?php

namespace App\Http\Controllers\Admin\System;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\System\Permission;
use Auth;

class PermissionController extends Controller
{

    function __construct()
    {
        view()->share([
            'permissions' => Permission::all_permission()
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        $permissions = Permission::all_permission();
//        return $permissions;
        return view('admin.system.permission.index', compact('permissions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.system.permission.create');
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
            'name' => 'required',
            'sort_order' => 'required|integer|max:99',
            'label' => 'required|unique:permissions',
        ]);
        Permission::create($request->all());
        Permission::clear();
        return redirect(route('system.permission.index'))->with('success', '新增成功');
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
        $permission = Permission::find($id);
        return view('admin.system.permission.edit', compact('permission'));
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
            'name' => 'required',
            'sort_order' => 'required|integer|max:99',
            'label' => 'required',
        ]);
        $permission = Permission::find($id);
        $permission->update($request->all());
        Permission::clear();
        return redirect(route('system.permission.index'))->with('success', '更新成功');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!Permission::check_children($id)) {
            return back()->with('error', '当前分类下有儿子，不能杀生');
        }
        Permission::destroy($id);
        Permission::clear();
        return back()->with('success', '删除成功');
    }

    public function sort_order(Request $request)
    {
        $permission = Permission::find($request->id);
        $permission->sort_order = $request->sort_order;
        $permission->save();
        Permission::clear();
    }
}
