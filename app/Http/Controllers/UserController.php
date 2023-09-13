<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // à améliorer en faisant une relation dans le model Role mais c'est un MVP 🤷‍♂️
        $students = Role::where('rights_lvl', 1)->first()->users;
        $teachers = Role::where('rights_lvl', 2)->first()->users;
        $admins = Role::where('rights_lvl', 3)->first()->users;

        return view('admin.users.index')->with([
            "students"=>$students,
            "teachers"=>$teachers,
            "admins"=>$admins,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("admin.users.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
