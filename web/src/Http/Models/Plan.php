<?php

namespace Emeka\Http\Models;

use Emeka\Http\Models\User;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
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

	public function customers()
	{
		return $this->belongsTo(User::class);
	}
}