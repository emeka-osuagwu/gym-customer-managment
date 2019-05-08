<?php

namespace Emeka\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    protected $fillable = [
    	'name',
    	'type',
    	'image',
    	'description',
    ];
}