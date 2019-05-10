<?php

namespace Emeka\Http\Models;

use Emeka\Http\Models\UserPlan;
use Emeka\Http\Models\Plan;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $fillable = [
    	'sex',
    	'email', 
    	'location', 
    	'last_name', 
  		'first_name',
	];

	public function plans()
	{
		return $this->belongsToMany(Plan::class);
	}
}