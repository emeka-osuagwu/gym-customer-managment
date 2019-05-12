<?php

namespace Emeka\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class UserPlan extends Model
{

	protected $table = "plan_user";

    protected $fillable = [ 
    	'user_id',
    	'plan_id',
    ];
}