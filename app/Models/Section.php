<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{

    protected $guarded = [];

    public function academicYear()
    {
        return $this->belongsTo(Academic::class,'academic_year_id');
    }


    
    public function teacher()
{
    return $this->hasOne(User::class); 
}


//    public function students()
//    {
//     return $this->hasMany(User::class);
//    }

//    public function teacher()
//    {
//     return $this->hasOne(User::class);
//    }

   public function course()
    {
        return $this->belongsTo(Course::class,'course_id');
    }

   public function category()
    {
        return $this->belongsTo(Category::class);
    }

   
}
