<?php

namespace App\Http\Controllers;

use App\Events\UserNotification;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return view('layout.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('layout.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated=  $request->validate([
            'name'=>'required',
            'email'=>'email|required',
            'password'=>'required'
        ]);
        $validated['password'] = Hash::make($validated['password']);
        $user = User::create($validated);
        event(new UserNotification('User baru berhasil ditambahkan :'.$user->name));
        return to_route('user.index')->with('success','User Baru berhasild di tambahkan ');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('layout.edit',compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $validated =  $request->validate([
            'name' => 'required',
            'email' => 'email|required',
        ]);
        $user->update($validated);
        event(new UserNotification('User berhasil di update :'.$user->name));
        return to_route('user.index')->with('success','User Berhasil di update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        event(new UserNotification('User dipindahkan ke tong sampah',$user->name));
        return to_route('user.index')->with('success', 'User Berhasil dihapus');
    }
    public function history(){
        $users = User::onlyTrashed()->get();
        return view('layout.trashed',compact('users'));
    }
    public function forceDelete(User $trash_user){
        $trash_user->forceDelete();
        event(new UserNotification('User sudah dihapus dengan Permanen'));
        return to_route('user.trash')->with('success', 'User Berhasil di hapus secara permanen');
    }
}
