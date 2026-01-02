<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $guarded = [];
    
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    
    public function academicYear()
    {
        return $this->belongsTo(Academic::class, 'academic_year_id');
    }

    public function sections()
{
    return $this->hasMany(Section::class);
}

// public function students()
// {
//     return $this->belongsToMany(User::class, 'course_student', 'course_id', 'student_id')
//                 ->withTimestamps();
// }

    public function students()
    {
        return $this->belongsToMany(User::class, 'course_student', 'course_id', 'student_id');
    }


}
