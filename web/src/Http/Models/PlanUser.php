<?php

namespace Emeka\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class PlanUser extends Pivot
{
    protected $fillable = [
    	'user_id',
    	'plan_id',
    ];
}