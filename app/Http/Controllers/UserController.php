<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\File;

class UserController extends Controller
{
    public function profile(Request $request)
    {
        $request->validate([
            'avatar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        
        $avatar = $request->file('avatar')->store('avatars/' . Auth::user()->id);

        $user = Auth::user();
        $user->avatar = $avatar;
        $user->save();
        return back()
            ->with('success','Perfil actualizado.');
    }
    public function files(Request $request)
    {
        
        // $path = public_path().'/uploads/';
        // $files = $request->file('file');
        // foreach($files as $file){
            
        //     $fileName = str_random(40) . $file->getClientOriginalName();
        //     $file->move($path, $fileName);
            

        // }
        foreach ($request->file as $files) {
            $files_success = $files->store('uploads/');

            $filesave = new File;
            $filesave->user_id = Auth::user()->id;
            $filesave->filename = $files_success;
            $filesave->save();
            
        }
        return response()->json(['status' => 'Success', 'name' => $files_success]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
