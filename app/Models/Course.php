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


}
