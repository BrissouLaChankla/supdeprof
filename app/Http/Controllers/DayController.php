<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Day;
use App\Models\Course;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Validator;

class DayController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $coursesNoDays = Course::whereNull('day_id')->get();

        $days = Day::All();


        return view('admin.days.show')->with([
            "coursesNoDays" => $coursesNoDays,
            "days" => $days
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("admin.days.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:App\Models\Day,name|max:255'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        } else {

            $slug = $this->generateUniqueSlug($request->name);

            $request->merge(['slug' => $slug, 'teacher_id' =>  Auth::id()]);

            $day = Day::create($request->all());



            $day->save();

            session()->flash('success', 'La journée a bien été crée !');
            return redirect()->route('days.index');
        }
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


    // Custom 
    private function generateUniqueSlug($name)
    {
        $slug = Str::slug($name); // Generate a basic slug

        $originalSlug = $slug;
        $counter = 2;

        while (Course::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $counter;
            $counter++;
        }

        return $slug;
    }

    public function setTodayDay(Request $request)
    {

        $others = Day::where('class_year', $request->class_year)->get();

        // Vire tous les cours du jour de la classe en question
        foreach ($others as $other) {
            $other->update(['is_today' => 0]);
        }


        $day = Day::find($request->id);
        $day->is_today = 1;
        $day->save();

        return response()->json($day);
    }

    public function unsetTodayDay(Request $request)
    {
        $day = Day::find($request->id);
        $day->is_today = 0;
        $day->save();

        return back();
    }

    public function removeDay(Request $request)
    {
        $courses = Course::where('day_id', $request->day_id)->get();
        foreach ($courses as $course) {
            $course->update(['day_id' => null]);
        }

        $day = Day::find($request->day_id);
        $day->delete();
        return response()->json("gg");

    }
}
