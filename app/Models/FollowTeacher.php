<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Teacher;
use App\Models\User;
use App\Models\Course;

class FollowTeacher extends Model
{
    use HasFactory;


        public function teacher_details()
    {
    	return $this->belongsTo(Teacher::class,'teacher_id','user_id');
    }

      public function teacher()
    {
    	return $this->belongsTo(User::class,'teacher_id','id');
    }

      public function user()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }

}
