<?php

namespace App\Http\Controllers\Admin\System;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\System\Role;
use App\User;

class UserController extends Controller
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
        $users = User::where($where)->where('is_show', 1)->paginate(env('pageSize'));
        return view('admin.system.user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::all();
        return view('admin.system.user.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//        $tel = $request->mobile;
//        if (strlen($tel) == 11) {
//            $n=preg_match_all("/13[123569]{1}\d{8}|188\d{8}/",$tel,$array);
////            dump($array);exit;
//        }else{
//            return back()->with('error','必须使用正确的手机号');
//        }.
//        return $request->all();
        $this->validate($request, [
            'name' => 'required|unique:users|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'mobile' => $request->mobile,
            'real' => $request->real,
            'is_show' => $request->is_show,
        ]);
        $user->roles()->sync($request->role_id);
        return redirect(route('system.user.index'))->with('success', '新增成功');
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
        $user = User::find($id);
        $roles = Role::all();
        $user_roles = $user->roles->pluck('id');
//        return $user_roles;
        return view('admin.system.user.edit', compact('user', 'roles', 'user_roles'));
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
            'email' => 'required|',
            'password' => 'required|min:6',
        ]);
        $user = User::find($id);
//        return $user;
        if ($request->has('password') && $request->password != '') {
            if (!\Hash::check($request->old_password, $user->password)) {
                return back()->with('error', '原始密码错误');
            }
            $user->password = bcrypt($request->password);
        }
        $user->name = $request->name;
        $user->email = $request->email;
        $user->mobile = $request->mobile;
        $user->real = $request->real;
        $user->save();
        $user->roles()->sync($request->role_id);
        return redirect(route('system.user.index'))->with('success', '更新成功');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::destroy($id);
        return back()->with('success', '删除成功');
    }
}
