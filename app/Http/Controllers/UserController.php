<?php

namespace App\Http\Controllers;

use App\Models\Divisi;
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
        //add user view
        $divisiData = Divisi::all();
        $userData = User::all();

        return view('users', compact(['userData', 'divisiData']));
    }

    public function addStore(Request $request){
        $validated = $request->validate([
            'nama' => "required|max:255",
            'email' => "required|email:dns|unique:users",
            'password' => "required|min:6|max:255",
            'divisi_id' => 'required',
            'role' => 'nullable'
        ]);
        $validated['password'] = Hash::make($validated['password']);

        User::create($validated);

        return back()->with('addSuccess', 'Add User Success!');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //sign up view
        $divisiData = Divisi::orderBy('nama_divisi')->get();
        return view('sign_up', compact('divisiData'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //add to db
        $validated = $request->validate([
            'nama' => "required|max:255",
            'email' => "required|email:dns|unique:users",
            'password' => "required|min:6|max:255",
            'divisi_id' => 'required'
        ]);
        $validated['password'] = Hash::make($validated['password']);

        User::create($validated);

        return redirect()->route('login')->with('regSuccess', 'Registration Success!');
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
        $validated = $request->validate([
            'nama' => "required|max:255",
            'email' => "required|email:dns",
            'password' => "required|min:6|max:255",
            'divisi_id' => 'required',
            'role' => 'required'
        ]);
        $validated['password'] = Hash::make($validated['password']);

        User::where('id', $id)->update($validated);

        return back()->with('editSuccess', "Edit user success!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::destroy($id);

        return redirect()->route('userView');
    }
}
