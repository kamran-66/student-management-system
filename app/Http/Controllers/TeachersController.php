<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rules;
use App\Models\Teacher;
use App\Models\User;
use App\Models\Academic;
use App\Models\Course;
use App\Models\Section;
use App\Services\Teacher\TeacherService;




class TeachersController extends Controller
{

 
    /**
     * Display a listing of the resource.
     */
    public function index(TeacherService $service)
    {

        $sections = Section::all();
        $courses = Course::all();
  
    $teachers = $service->getAllTeachers();
    return view('teachers.dashboard', compact('teachers','sections','courses'));
      
        
    }



      public function TeacherDashboard()
    {
        $sections = Section::all();
             $courses = Course::all();
            $teacher = auth()->user();
            return view('teachers.teacherdashboard', compact('teacher','courses','sections'));
      
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $sections = Section::all();
        // $teachers = User::where('role', 'teacher')->get();
        return view('teachers.add', compact('sections'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, TeacherService $teacherService)
    {
         $request->validate([
            'image' => 'nullable|mimes:jpg,jpeg,png|max:2048',
            'name' => ['required','unique:users', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Password::defaults()],
            'section_id' => ['required','integer','exists:sections,id'],

        ]);

          $teacherService->store(
        $validated,
        $request->file('image')
    );

        //     $teacher = User::create([
        //         'name' => $request->name,
        //         'email' => $request->email,
        //         'role' => 'teacher',
        //         'password' => Hash::make($request->password),
        //         'section_id' =>$request->section_id,
        //     ]);

        //     if ($request->hasFile('image')) {
        

        //     $file = $request->file('image');
        //     $filename = time() . '-' . $file->getClientOriginalName();

        //     // Save inside /public/users
        //     $file->move(public_path('users'), $filename);

        //     $teacher->image = $filename;
        //     $teacher->save();
        // }
         return redirect('/teachers/dashboard')->with('success', 'Teacher added successfully!');

    }
    

    /**
     * Display the specified resource.
     */
public function show(string $id)
{
    
    $teacher = User::with('section')->where('role','teacher')->findOrFail($id);
    return view('teachers.show', compact('teacher'));
}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $sections = Section::all();
       
        $teacher = User::findorfail($id);
       return response()->json($teacher);
        //  return view('teachers.edit', compact('teacher','sections','teachers'));
    }



     //* New teacherEdit//

           public function teacherEdit(string $id)
    {

        $sections = Section::all();
        $courses = Course::all();
        
        // $teacher = User::with('courses')->findOrFail($id);
        $teacher = User::findorfail($id);
        
          return response()->json([
        'teacher' => $teacher,
        'selectedSections' => $teacher->sections->pluck('id')
    ]);

    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id,TeacherService $teacherService)
    {

        $teacher = User::findorfail($id);
        $validated = $request->validate([

            'image' => 'nullable|mimes:jpg,jpeg,png|max:2048',
            'name' => ['required','string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'section_id' => ['required','integer','exists:sections,id'],

        ]);

          $teacherService->update(
        $teacher,
        $validated,
        $request->file('image'),
        [$request->section_id]
    );

    return response()->json([
        'success' => true,
        'message' => 'Data updated successfully'
    ], 200);

    //      if ($request->hasFile('image')) {

    //     // Delete old image
    //     if ($teacher->image && file_exists(public_path('users/' . $teacher->image))) {
    //         unlink(public_path('users/' . $teacher->image));
    //     }

    //     // Upload new image to public/users
    //     $file = $request->file('image');
    //     $filename = time() . '-' . $file->getClientOriginalName();
    //     $file->move(public_path('users'), $filename);

    //     $validated['image'] = $filename;
    // }

    //      $teacher->update($validated);
    //      return redirect()->route('teachers.teacherdashboard',$teacher->id)->with('success','Teacher succesfully updated');
    }



             //New Update

            public function teacherUpdate(Request $request, $id)
        {
            try {
                if( !$request->has('teacher_id') ){
                    throw new \Exception('Teacher id missing');
                }

                $teacher_id = $request->integer('teacher_id');
                
                $teacher = User::find($teacher_id);
                $teacher->name = $request->name;
                $teacher->email = $request->email;
                $teacher->teacher_id->sync($request->section_id ?? []);
                $teacher->save();
                
                $sectionIds = array_filter($request->section_id);
                $teacher->sections()->attach($sectionIds);

            } catch (\Exception $e) {
                throw new \Exception('some error occurred ' .  $e->getMessage());
            }

            session()->flash('success', 'Data updated successfully');
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
  
    $teacher = User::findOrFail($id);
    $teacher->delete();

    return redirect()->route('teachers.dashboard')->with('success', 'Teacher deleted successfully.');
}

    }

