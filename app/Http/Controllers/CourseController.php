<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Chapter;
use App\Models\Course;
use App\Models\Section;
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

        $this->createSections($request->all(), $course->id);

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
    public function show(string $slug)
    {
        $course = Course::where('slug', $slug)->first();
        return view("admin.courses.show", compact("course"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $course = Course::find($id);
        return view('admin.courses.create', compact("course"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $this->createSections($request->all(), $id);
       
        $course = Course::find($id);
        $course->update($request->all());

        return redirect()->route('chapters.show', ['chapter' => $course->chapter_id]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }



    // Custom

    public function addSection()
    {
        return view("components.course-section");
    }


    public function createSections($data, $id) {
         // Ici on supprime toutes les sections puis on les recrée, ça permet de remettre dans l'ordre facilement si y'a suppression de section etc  
         Section::where('course_id', $id)->delete();

         foreach ($data as $key => $value) {
             // Vérifier si la clé commence par "titlesection_"
             if (strpos($key, 'titlesection_') === 0) {
                 // Récupérer l'index en retirant le préfixe
                 $index = substr($key, strlen('titlesection_'));
 
                 // Utiliser l'index pour obtenir le titre et le contenu correspondants
                 $sectionTitle = $value;
                 $sectionContent = $data['section_' . $index];
 
 
                 Section::create(
                     [
                         'order' => $index,
                         'title' => $sectionTitle,
                         'content' => $sectionContent,
                         'course_id' => $id
                     ]
                 );
             }
         }
    }
}
