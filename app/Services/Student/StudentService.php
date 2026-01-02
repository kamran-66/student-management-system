<?php

namespace App\Services\Student;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class StudentService
{

    
    public function getAllStudents() {
        return User::where('role','student')->latest()->paginate(8);
    }
   
    // STORE STUDENT
  
    public function store(array $data, $image = null)
    {
        // password hash
        $data['password'] = Hash::make($data['password']);
        $data['role'] = 'student';

        // image upload
        if ($image) {
            $filename = time() . '-' . $image->getClientOriginalName();
            $image->move(public_path('users'), $filename);
            $data['image'] = $filename;
        }

        return User::create($data);
    }

   
    // UPDATE STUDENT
    // =========================
    public function update(User $student, array $data, $image = null, array $courseIds = [])
    {
        // image update
        if ($image) {
            $filename = time() . '-' . $image->getClientOriginalName();
            $image->move(public_path('users'), $filename);
            $data['image'] = $filename;
        }

        $student->update($data);

        // sync courses
        $student->courses()->sync($courseIds);

        return $student;
    }
}
