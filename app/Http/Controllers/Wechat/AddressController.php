<?php

namespace App\Http\Controllers\Wechat;

use App\Models\Shop\Address;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AddressController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $address = Address::where('user_id', session('wechat.user.id'))->get();
        return view('wechat.address.index', compact('address'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('wechat.address.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $pca = explode(" ", $request->pca);
        Address::create([
            'user_id' => session('wechat.user.id'),
            'name' => $request->name,
            'province' => $pca[0],
            'city' => $pca[1],
            'area' => $pca[2],
            'tel' => $request->tel,
            'address' => $request->address,
        ]);
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
        $address = Address::find($id);
        return view('wechat.address.edit', compact('address'));
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
        $pca = explode(' ', $request->pca);
        Address::where('id', $id)->update([
            'name' => $request->name,
            'province' => $pca[0],
            'city' => $pca[1],
            'area' => $pca[2],
            'tel' => $request->tel,
            'address' => $request->address,
        ]);
    }

    public function default_address(Request $request)
    {
        User::where('id', session('wechat.user.id'))->update(['address_id' => $request->address_id]);
        //重新更改session
        $user = session()->get('wechat.user');
        $user['address_id'] = $request->address_id;
        session()->put('wechat.user', $user);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
//        return $id;
        Address::destroy($id);
        return back();
    }

    public function manage()
    {
        $addresses = Address::where('user_id', session('wechat.user.id'))->get();
        return view('wechat.address.manage',compact('addresses'));
    }
}
