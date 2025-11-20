<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Section;
use App\Models\Teacher;
use App\Models\Academic;
use App\Models\Course;




class StudentsController extends Controller
{

   
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

            //  $users = User::with(['section.course', 'section.academicYear'])
            //      ->where('role', 'student')
            //      ->get();
            
            $students = User::where('role','student')->get();
            return view('students.dashboard', compact('students'));
      
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
       $teachers = User::where('role', 'teacher')->get();
       $sections = Section::all();
        return view('students.add', compact('teachers','sections'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

       $validated = $request->validate([
           'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users',
        'password' => 'required|min:6',
        'registration_no' => 'required|string|unique:users',
        'section_id' => 'required|exists:sections,id',

    ]);


    $student = User::create([
        'name' => $request['name'],
        'email' => $request['email'],
        'password' => Hash::make($request->password),
        'role' => 'student',
        'registration_no' => $request['registration_no'],
        'section_id' => $request->section_id,
    ]);

    return redirect()->route('students.dashboard')->with('success', 'Student added successfully!');



    }



    /**
     * Display the specified resource.
     */
 public function show(string $id)
{

    
    $student = User::with(['section.course', 'section.academicYear'])
                ->where('role', 'student')
                ->findOrFail($id);

    return view('students.show', compact('student'));
}


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
       $sections = Section::all();

        $student = User::findorfail($id);
         return view('students.edit', compact('student','sections'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $student = User::findorfail($id);

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
             'registration_no' => ['required','string','unique:users,registration_no'.$id],
            'section_id' => 'required|exists:sections,id',
            


            
        ]);

         $student->update($validated);
         return redirect()->route('students.dashboard')->with('success','Student succesfully updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $student = User::findorfail($id);
        $student->delete();

        return redirect()->route('students.dashboard')->with('success','Student succesfully deleted');
    }
}
