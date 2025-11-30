<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use App\Models\User;
use App\Models\Admin;
use App\Models\Section;
use App\Models\Course;
use App\Models\Category;
use App\Models\Academic;



class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $users = User::paginate(10);
        return view('admin.dashboard', compact('users'));
    }


     public function view()
    {
        $user = auth()->user();

    // COUNT ANALYTICS
    $student = User::where('role', 'student')->count();
    $teacher = User::where('role', 'teacher')->count();
    $course = Course::count();
    $section = Section::count();
    $academic = Academic::count();
    $category = Category::count();

    return view('admin.admindashboard', compact(
        'user',
        'student',
        'teacher',
        'course',
        'section',
        'academic',
        'category',
    ));
            // return view('admin.admindashboard', compact('user','student'));
      
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
        $users = User::findorfail($id);
    return view('admin.edit', compact('users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $users = User::findorfail($id);
          
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
        ]);

         $users->update($validated);
         return redirect()->route('admin.dashboard')->with('success','user succesfully updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findorfail($id);
        $user->delete();
        return redirect()->route('admin.dashboard')->with('success','user succesfully deleted');
    }

    public function teacher()
    {
        $users = User::where('role', 'teacher')->get();
    return view('teachers.dashboard', compact('users'));
      
    }
    public function student()
    {
        $users = User::where('role', 'student')->get();
    return view('students.dashboard', compact('users'));
       
    }
}
