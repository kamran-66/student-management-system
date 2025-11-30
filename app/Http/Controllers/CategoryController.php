<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use App\Models\Category;
use App\Models\Course;
use App\Models\Teacher;

class CategoryController extends Controller
{


  
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $courses = Course::all();
        $categories = Category::all();
        return view('category.dashboard', compact('categories','courses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
       return view('category.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required','unique:categories','string','min:3']
        ]);

        // $category = new Category();
        // $category->name = $request->name;
        // $category->save();
        
        $category = Category::create([
            'name' => $request->name
        ]);

        $category->save();
        return redirect()->route('category.dashboard')->with('success', 'Category added successfully!');
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
       $category = Category::findorfail($id);
        return view('category.edit',compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        
        
        $category = Category::findorfail($id);
        
        // $category->name = $request->name;
        // $category->save();
        
        
        $validated = $request->validate([
            'name' => ['required', 'string','min:3']
        ]);
      
        $category->update($validated);

        return redirect()->route('category.dashboard')->with('success','Category succesfully updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
         $category = Category::findorfail($id);
         $category->delete();
        return redirect()->route('category.dashboard')->with('success','Category succesfully deleted');

    }
}
