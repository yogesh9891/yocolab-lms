<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Category;

class Teacher extends Model
{
    use HasFactory,SoftDeletes;

     public function user(){
		
		return $this->hasOne('App\Models\User','id','user_id');
	}

	   public function course(){
		
		return $this->hasMany('App\Models\Course','user_id','user_id');
	}


	public function country()
	{
		return $this->hasOne('App\Models\Country','value','country');
	}

    public function category()
    {
        return $this->belongsTo(Category::class,'category_id','id');
    }
}
