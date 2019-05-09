<?php

namespace Emeka\Http\Models;

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
}