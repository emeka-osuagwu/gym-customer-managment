<?php

namespace Emeka\Http\Models;

use Emeka\Http\Models\UserPlan;
use Illuminate\Database\Eloquent\Model;

class Workout extends Model
{
    protected $table = "workout";
    protected $fillable = [
    	'title',
	];
}