<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use App\Models\Course;
use App\Models\Category;
use App\Models\Academic;
use App\Models\Section;


class CourseController extends Controller
{

  
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $courses = Course::with('academicYear')->get();
        // dd($courses->last());
        return view('courses.dashboard', [
            'courses' => $courses
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
         $categories = Category::all();
         $classes = Academic::all();
        return view('courses.add', compact('categories','classes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required','string','max:255'],
            'category_id' => ['required'],
            'academic_year_id' => ['required'],
            
        ]);

        // dd($validated);
        $course = Course::create([
           'name'=> $request->name,
           'category_id'=> (int) $request->category_id,
           'academic_year_id'=> (int) $request->academic_year_id,
          
        ]);


        return redirect()->route('courses.dashboard')->with('success','Course succesfully added');
        
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
        $categories = Category::all();
         $classes = Academic::all();
        $course = Course::findorfail($id);
        return view('courses.edit', compact('course', 'categories','classes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $course = Course::findorfail($id);
        $request->validate([
            'name' => ['required','string','max:255'],
            'category_id' => ['required'],
            'academic_year_id' => ['required'],
            
        ]);

        $course->name = $request->name;
        $course->category_id = $request->category_id;
        $course->academic_year_id = $request->academic_year_id;
       

        $course->save();

        return redirect()->route('courses.dashboard')->with('success','Course succesfully updated');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $course = Course::findorfail($id);
        $course->delete();
        return redirect()->route('courses.dashboard')->with('success','Course succesfully deleted');
    }
}
