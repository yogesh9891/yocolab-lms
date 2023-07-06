<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Teacher;
use App\Models\User;
use App\Models\Course;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = ['user_id','course_id'];

     public function course(){
		
		return $this->belongsTo('App\Models\Course','course_id','id');
	}

	     public function teacher_details()
    {
    	return $this->belongsTo(Teacher::class,'teacher_id','user_id');
    }

      public function teacher()
    {
    	return $this->belongsTo(User::class,'teacher_id','id');
    }

   
}
