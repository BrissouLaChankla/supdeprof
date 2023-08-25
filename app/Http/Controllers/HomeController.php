<?php

namespace App\Http\Controllers;
use App\Models\Day;
use Illuminate\Support\Facades\Auth;


use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $today = Day::where('class_year', Auth::user()->class_year)->where('is_today', 1)->with('courses')->first();
        
        return view('admin.home')->with([
            "today" => $today
        ]);
    }

}
