<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Teacher;
use App\Models\User;
use App\Models\Course;
use App\Models\VideoClass;
use Illuminate\Database\Eloquent\SoftDeletes;

class StudentCourse extends Model
{
    use HasFactory,SoftDeletes;

      public function teacher_details()
    {
    	return $this->belongsTo(Teacher::class,'teacher_id','user_id');
    }

      public function teacher()
    {
    	return $this->belongsTo(User::class,'teacher_id','id');
    }

      public function course()
    {
    	return $this->belongsTo(Course::class,'course_id','id');
    }

      public function video_class()
    {
      return $this->belongsTo(VideoClass::class,'course_id','course_id');
    }


      public function user()
    {
      return $this->belongsTo(User::class,'user_id','id');
    }
}
