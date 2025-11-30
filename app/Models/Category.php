<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
   protected $guarded = [];
   
   public function courses()
   {
       return $this->hasMany(Course::class);
   }


   public function academicYear()
{
       return $this->hasMany(Academic::class,'category_id');
}

   public function section()
{
       return $this->hasMany(Section::class,'category_id');
}

}
