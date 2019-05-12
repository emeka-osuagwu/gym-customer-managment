<?php

namespace Emeka\Http\Models;

use Emeka\Http\Models\Plan;
use Emeka\Http\Models\UserPlan;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;


class User extends Model
{

	protected $table = 'users';

    protected $fillable = [
    	'sex',
    	'email', 
    	'location', 
    	'last_name', 
  		'first_name',
	];

	public function plans()
	{
		return $this->belongsToMany('Emeka\Http\Models\Plan', 'plan_user');
		// return $this->belongsToMany(Plan::class, 'plans', 'user_id', 'plan_id');

		// return $this->belongsToMany('Emeka\Http\Models\Plan', 'user_plan', 'user_id', 'plan_id');

		// return $this->belongsToMany(Plan::class)->withTimestamps();
		
		// return $this->belongsToMany(PlanUser::class);
	}
}