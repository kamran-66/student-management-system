<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Academic extends Model
{
    protected $guarded = [];
    protected $table = 'academic_year';
     
    // public function sections()
    // {
    //     return $this->hasMany(Section::class);
    // }

    // public function courses()
    // {
    //     return $this->hasMany(Course::class);
    // }

    public function category()
    {
       return $this->belongsTo(Category::class,'category_id');
    }

    public function courses()
{
    return $this->hasMany(Course::class, 'academic_year_id');
}

public function sections()
{
    return $this->hasMany(Section::class, 'academic_year_id');
}



}
