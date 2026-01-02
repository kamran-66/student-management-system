<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * Mass assignable attributes
     */
    protected $guarded = [];

    /**
     * Hidden attributes for serialization
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Attribute casting
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

   
    // RELATIONSHIPS
 

    // Student belongs to a section

    public function section()
    {
        return $this->belongsTo(Section::class);
    }



    public function courses()
    {
        return $this->belongsToMany(Course::class, 'course_student', 'student_id', 'course_id');
    }



    // Access academic year via section
    public function academicYear()
    {
        return $this->section ? $this->section->academicYear() : null;
    }


}





  //  Students -> Courses

//    public function courses()
// {
//     return $this->belongsToMany(Course::class, 'course_student', 'student_id', 'course_id')
//                 ->withTimestamps();
// }


    // Access courses via section
//    public function courses()
//     {
//         return $this->hasManyThrough(
//             Course::class,       // final model
//             Section::class,      // intermediate
//             'teacher_id',        // FK on sections table pointing to user
//             'academic_year_id',  // FK on courses table pointing to academic
//             'id',                // local key on users table
//             'academic_year_id'   // local key on sections table
//         );

//     }

