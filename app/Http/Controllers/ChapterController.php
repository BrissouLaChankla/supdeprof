<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Chapter;
use Validator;

class ChapterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $chapters = Chapter::all();
        return view("admin.chapters.index", compact('chapters'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("admin.chapters.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:App\Models\Chapter,name|max:255'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        } else {
            $chapter = Chapter::create($request->all());
            $chapter->save();

            session()->flash('success', 'Le chapitre a bien été crée !');
            return redirect()->route('chapters.index');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

        $chapter = Chapter::with('courses:id,title,context,slug,teacher_id,chapter_id')->find($id);
        $courses = $chapter->courses()->paginate(6);

        if ($chapter) {
            return view('admin.chapters.show')->with([
                "chapter" => $chapter,
                "courses" => $courses
            ]);
        } else {
            return back()->withErrors(['error' => 'Ce chapitre n\'existe pas !']);
        }
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
