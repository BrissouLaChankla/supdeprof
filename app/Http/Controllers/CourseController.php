<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Chapter;
use App\Models\Course;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;


class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.courses.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        if ($request->has('chapter')) {
            $chapter = Chapter::find($request->input('chapter'));

            if ($chapter) {
                return view('admin.courses.create')->with([
                    "chapter_id" => $chapter->id
                ]);
            } else {
                return back()->withErrors(['error' => 'Ce chapitre n\'existe pas !']);
                // return redirect()->to('/home')->withErrors(['error' => 'Ce chapitre n\'existe pas !']);
            }
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            "title" => "required|unique:App\Models\Course,title|max:255",
        ]);

        $slug = $this->generateUniqueSlug($request->title);
        $request->merge(['slug' => $slug, 'teacher_id' =>  Auth::id()]);
        
        $course = Course::create($request->all());
        $course->save();
        return redirect()->route('chapters.index');
    }

    private function generateUniqueSlug($title)
    {
        $slug = Str::slug($title); // Generate a basic slug

        $originalSlug = $slug;
        $counter = 2;

        while (Course::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $counter;
            $counter++;
        }

        return $slug;
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
    public function edit(string $slug)
    {
        dd($slug);
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
