<?php

namespace Emeka\Http\Models;

use Emeka\Http\Models\User;
use Emeka\Http\Models\PlanUser;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class Plan extends Model
{

	protected $table = "plans";

    protected $fillable = [
    	'name',
    	'type',
		'description',

		'monday',
		'tuesday',
		'wednesday',
		'thursday',
		'friday',
		'saturday',
		'sunday',
	];

	public function users()
	{
		return $this->belongsToMany(User::class, 'plan_user', 'user_id', 'plan_id');
	}
}