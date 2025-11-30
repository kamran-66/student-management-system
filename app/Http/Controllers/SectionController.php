<?php

namespace App\Http\Controllers;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use App\Models\Section;
use App\Models\Academic;
use App\Models\User;
use App\Models\Course;
use App\Models\Category;

use Illuminate\Http\Request;


class SectionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {   

        $sections = Section::with('academicYear')->get();
        $categories = Category::all();


        // dd($sections->first()->academicYear->category);
        return view('section.dashboard', compact('sections','categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

       $courses = Course::all();
       $batches = Academic::all();
        return view('section.add', compact('batches','courses'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
          $validated = $request->validate([
            'name' => ['required','unique:sections','string','max:255'],
            'academic_year_id' => ['required','string','max:255'],
          
           
        ]);

        
        $sections = Section::create([
           'name'=> $request->name,
           'academic_year_id'=> $request->academic_year_id,
     
    
        ]);
         return redirect()->route('sections.dashboard')->with('success','Section succesfully added');
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
       $batches = Academic::with('category')->get();
        // dd($batches->first);
        $sections = Section::findorfail($id);
        return view('section.edit', compact('sections', 'batches'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

       

        $sections = Section::findorfail($id);

        $validated = $request->validate([
          'name'  => ['required','string', 'max:255'],
            'academic_year_id' => ['required','string','max:255'],
            // 'course_id' => ['required','string','max:255'],

        ]);

        $sections->update($validated);
         return redirect()->route('sections.dashboard')->with('success','Section succesfully updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $sections = Section::findorfail($id);
        $sections->delete();
         return redirect()->route('sections.dashboard')->with('success','Section succesfully updated');

    }
}
