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

          
            $batches = Academic::all();
            
            $students = User::where('role','student')->paginate(8);
            return view('students.dashboard', compact('students'));
      
    }

    public function view()
    {
         $courses = Course::all();
            $student = auth()->user();
            return view('students.studentdashboard', compact('student','courses'));
      
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

        'image' => 'nullable|mimes:jpg,jpeg,png|max:4096',
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users',
        'password' => 'required|min:6',
        'registration_no' => 'required|string|unique:users',
        'section_id' => 'required|exists:sections,id',
        // 'course_id' => 'required|exists:courses,id',

    ]);


    $student = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'role' => 'student',
        'registration_no' => $request->registration_no,
        'section_id' => $request->section_id,
        'course_id' => $request->course_id,
    ]);

        //Upload image (if exists)
        
    if ($request->hasFile('image')) {
 
        $file = $request->file('image');
        $filename = time() . '-' . $file->getClientOriginalName();

        // Save inside /public/users
        $file->move(public_path('users'), $filename);

        $student->image = $filename;
        $student->save();
    }
    return redirect()->route('students.dashboard')->with('success', 'Student added successfully!');



    }



    /**
     * Display the specified resource.
     */
 public function show(string $id)
{

       $courses = Course::all();
    
    $student = User::with(['section.course', 'section.academicYear'])
                ->where('role', 'student')
                ->findOrFail($id);

    return view('students.show', compact('student','courses'));
}


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
       $sections = Section::all();
       $courses = Course::all();

        $student = User::findorfail($id);

            if (auth()->user()->role !== 'admin' && auth()->id() !== $student->id) {
        abort(403, 'Unauthorized');
    }

         return view('students.edit', compact('student','sections','courses'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $student = User::findorfail($id);

        if (auth()->user()->role !== 'admin' && auth()->id() !== $student->id) {
        abort(403, 'Unauthorized');
        }

        $validated = $request->validate([
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:4096',
            'name' => ['required', 'string', 'max:255'],
             'email' => 'required', 'email', 'max:255',
            'section_id' => 'required|exists:sections,id',
            // 'course_id' => 'required|exists:courses,id',
            
             ]);

    if ($request->hasFile('image')) {

        // Delete old image
        if ($student->image && file_exists(public_path('users/' . $student->image))) {
            unlink(public_path('users/' . $student->image));
        }

        // Upload new image to public/users
        $file = $request->file('image');
        $filename = time() . '-' . $file->getClientOriginalName();
        $file->move(public_path('users'), $filename);

        $validated['image'] = $filename;
    }

    // Update student
    $student->update($validated);

    return redirect()->route('students.studentdashboard',$student->id)->with('success', 'Student updated successfully!');
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
