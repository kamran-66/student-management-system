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

class AcademicController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $batches = Academic::with('category')->get();

        return view('year.dashboard', compact('batches'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
         $courses = Course::all();
        $categories = Category::all();

        //  $classes = Academic::with('courses')->get();
        return view('year.add', compact('courses','categories'));
        // return view('year.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required','string','max:255'],
            'category_id' => ['required','string','max:255'],
           
        ]);

        
        $classes = Academic::create([
           'name'=> $request->name,    
        ]);
        return redirect()->route('year.dashboard')->with('success','Academic Year succesfully updated');
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
         $courses = Course::all();
        $categories = Category::all();


        $classes = Academic::findorfail($id);
        return view('year.edit', compact('classes','courses','categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
         $classes = Academic::findorfail($id);

        $validated = $request->validate([
          'name'  => ['required','string','max:255'],
          'category_id'  => ['required','string','max:255'],
          
        //   'course_id' => ['required','integer','exists:courses,id'],
        ]);

        $classes->update($validated);
         return redirect()->route('year.dashboard')->with('success','Academic Year succesfully updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
       $classes = Academic::findorfail($id);
        $classes->delete();
         return redirect()->route('year.dashboard')->with('success','Academic Year succesfully updated');

    }
}
