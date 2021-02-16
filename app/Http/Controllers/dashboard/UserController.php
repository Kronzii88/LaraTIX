<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, User $users)
    {
        // fitur search

        $nama = $request->input('nama');
        $active = 'Users';
        $users = $users -> when($nama, function($query) use ($nama) {
            return $query -> where('name', 'like', '%'.$nama.'%');
        })
                        ->paginate(10);
        
        //variabel request disini hanya berisi dua array yaitu 'nama' dan 'page' (coba di dd($request))
        $request = $request -> all();
        return view('dashboard/user/list', ['users' => $users, 
                                            'active' => $active,
                                            'request' => $request,
                                            ]);
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
        $user = User::find($id);
        $active = 'Users';
        return view('dashboard/user/form', ['user' => $user,
                                            'active' => $active]);
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
        $user = User::find($id);
        
        $validator = Validator::make($request->all(), [
            'email' => 'required|unique:App\Models\User,email,'.$id,
            'name' => 'required'
        ]);

        if($validator -> fails()) {
            //withInput mengambil dari input terakhir yang di masukkan user
            return redirect('dashboard/user/edit/'.$id) 
                -> withErrors($validator)
                -> withInput();
        } else {
            
            $user -> name = $request->input('name');
            $user -> email = $request->input('email');
            //save database
            $user -> save();
            return redirect('dashboard/users');
        }

            

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $user -> delete();
        return redirect('dashboard/users');
    }
}
