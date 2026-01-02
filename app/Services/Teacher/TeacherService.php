<?php

namespace App\Services\Teacher;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;


class TeacherService
{

    public function getAllTeachers() {
        return User::where('role','teacher')->latest()->paginate(8);
    }
   
    // STORE TEACHER
  
        public function store(array $data, $image = null)
    {
        $data['password'] = Hash::make($data['password']);
        $data['role'] = 'teacher';

        if ($image) {
            $filename = time().'-'.$image->getClientOriginalName();
            $image->move(public_path('users'), $filename);
            $data['image'] = $filename;
        }

        return User::create($data); // section_id auto save
    }

    public function update(User $teacher, array $data, $image = null)
    {
        if ($image) {
            $filename = time().'-'.$image->getClientOriginalName();
            $image->move(public_path('users'), $filename);
            $data['image'] = $filename;
        }

        $teacher->update($data); // section_id update here ✔

        return $teacher;
    }



}