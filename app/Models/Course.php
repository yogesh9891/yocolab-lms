<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Teacher;
use App\Models\User;
use App\Models\Category;
use App\Models\VideoClass;
use App\Models\StudentCourse;
use Illuminate\Database\Eloquent\SoftDeletes;

class Course extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = ['slug','date','time','duration'];
    
      public function teacher()
    {
    	return $this->belongsTo(Teacher::class,'user_id','user_id');
    }

      public function user()
    {
    	return $this->belongsTo(User::class,'user_id','id');
    }

      public function category()
    {
        return $this->belongsTo(Category::class,'category_id','id');
    }

    
    
       public function video_class()
    {
        return $this->hasOne(VideoClass::class,'course_id','id');
    }

         public function student()
    {
        return $this->hasMany(StudentCourse::class,'course_id','id');
    }

    // public function getImageAttribute(): string
    // {
    //     return asset('storage/course/'.$this->image);
    // }

}
