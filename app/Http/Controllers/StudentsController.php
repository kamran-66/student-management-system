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
use App\Services\Student\StudentService;





class StudentsController extends Controller
{

   
    /**
     * Display a listing of the resource.
     */
    public function index(StudentService $service)
    {
            $sections = Section::all();  
            // $batches = Academic::all();
            
            // $students = User::where('role','student')->paginate(8);

           
                $students = $service->getAllStudents();
                return view('students.dashboard', compact('students','sections'));

            // return view('students.dashboard', compact('students','sections'));
      
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
        $courses = Course::all();
       $teachers = User::where('role', 'teacher')->get();
       $sections = Section::all();
        return view('students.add', compact('teachers','sections','courses'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, StudentService $studentService)
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


        $studentService->store(
        $validated,
        $request->file('image')
    );



    // $student = User::create([
    //     'name' => $request->name,
    //     'email' => $request->email,
    //     'password' => Hash::make($request->password),
    //     'role' => 'student',
    //     // 'registration_no' => $request->registration_no,
    //     'section_id' => $request->section_id,
    //     // 'course_id' => $request->course_id,
    // ]);

        //Upload image (if exists)
        
    // if ($request->hasFile('image')) {
 
    //     $file = $request->file('image');
    //     $filename = time() . '-' . $file->getClientOriginalName();

    //     // Save inside /public/users
    //     $file->move(public_path('users'), $filename);

    //     $studentService->image = $filename;
    //     $studentService->save();
    // }
    
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
//         if (auth()->user()->role !== 'admin' && auth()->id() !== $student->id) {
//         abort(403, 'Unauthorized');
//  }
        $sections = Section::all();
        $courses = Course::all();
        
        $student = User::with('courses')->findOrFail($id);
        
        return response()->json($student);
        

        //  return view('students.edit', compact('student','sections','courses'));
    }








    /**
     * Update the specified resource in storage.
     */
// public function update(Request $request, $id,StudentService $studentService)
// {
//     $student = User::findOrFail($id);

//     $student->name = $request->name;
//     $student->email = $request->email;
//     $student->section_id = $request->section_id;
//     // $student->course_id = $request->course_id;

//     if ($request->hasFile('image')) {

//         $filename = time() . '.' . $request->image->extension();
//         $request->image->move(public_path('users'), $filename);

//         $student->image = $filename;
//     }

//     $student->save();
//     $student->courses()->sync($request->course_ids ?? []);

//      session()->flash('success', 'Data updated successfully');
//      return response()->json([
//     'success' => true,
//     'message' => 'Data updated successfully'
// ], 200);

// }



public function update(
    Request $request,
    $id,
    StudentService $studentService
) {
    $student = User::findOrFail($id);

    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email,' . $student->id,
        'section_id' => 'required|exists:sections,id',
        'image' => 'nullable|mimes:jpg,jpeg,png|max:4096',
    ]);

    $studentService->update(
        $student,
        $validated,
        $request->file('image'),
        $request->course_ids ?? []
    );

    return response()->json([
        'success' => true,
        'message' => 'Data updated successfully'
    ], 200);
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






                //Second Student-Courses Pivot Methods



        public function studentEdit(string $id)
    {

        $sections = Section::all();
        $courses = Course::all();
        
        $student = User::with('courses')->findOrFail($id);
        
          return response()->json([
        'student' => $student,
        'selectedCourses' => $student->courses->pluck('id')
    ]);
        

        //  return view('students.edit', compact('student','sections','courses'));
    
    }

                     //New Update

            public function studentUpdate(Request $request, $id)
        {
            try {
                if( !$request->has('student_id') ){
                    throw new \Exception('Student id missing');
                }

                $student_id = $request->integer('student_id');
                
                $student = User::find($student_id);
                $student->name = $request->name;
                $student->email = $request->email;
                $student->courses()->sync($request->course_ids ?? []);
                $student->save();
                
                $courseIds = array_filter($request->courses);
                $student->courses()->attach($courseIds);

            } catch (\Exception $e) {
                throw new \Exception('some error occurred ' .  $e->getMessage());
            }

            session()->flash('success', 'Data updated successfully');
            return response()->json([
            'success' => true,
            'message' => 'Data updated successfully'
        ], 200);
            
     }


        public function view()
    {
        
         $sections = Section::all();
         $courses = Course::all();
            $student = auth()->user();
            return view('students.studentdashboard', compact('student','courses','sections'));
      
    }


    //Course-Student
    
    public function dashboard()
    {
        $courses = Course::all();
        $students = User::with('courses')->where('role','student')->paginate(5);
        return view('students.student-course', compact('students','courses'));
      
    }



    public function studentDelete(string $id)
    {
        $student = User::findorfail($id);
        $student->delete();

        return redirect()->route('students.stcourse')->with('success','Student succesfully deleted');
    }




 public function studentView(string $id)
{

       $courses = Course::all();
    
    $student = User::with(['section.course', 'section.academicYear'])
                ->where('role', 'student')
                ->findOrFail($id);

    return view('students.st-view', compact('student','courses'));
}



}

    // dd($student);
    // return response()->json(['success' => true]);

    // $student->email = $request->email;
    // $student->section_id = $request->section_id;

    // if ($request->hasFile('image')) {

    //     $filename = time() . '.' . $request->image->extension();
    //     $request->image->move(public_path('users'), $filename);

    //     $student->image = $filename;
    // }


    // if( $request->has('courses') && is_array($request->input('courses')) ){
    //     $coursesArray = array_filter(array_map(intval, $request->input('courses')));

    //     $student->courses()->attach($coursesArray);
    // }
