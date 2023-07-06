<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Teacher;
use Illuminate\Database\Eloquent\SoftDeletes;

class RequestClass extends Model
{
    use HasFactory,SoftDeletes;

    

}
