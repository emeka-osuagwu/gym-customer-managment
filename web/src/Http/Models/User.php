<?php

namespace Emeka\Http\Models;

use Emeka\Http\Models\Plan;
use Emeka\Http\Models\PlanUser;
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
		// return $this->belongsToMany(Plan::class)->withPivot([
		// 	'user_id',
		// 	'plan_id'
		// ]);

		// return $this->belongsToMany(Plan::class, 'plan_users');
		
		return $this->belongsToMany(Plan::class)->using(PlanUser::class);
	}
}