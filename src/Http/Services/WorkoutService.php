<?php

namespace Emeka\Http\Services;

use Emeka\Http\Models\Workout;
use Emeka\Http\Services\Contracts\CustomerServiceInterface;

class WorkoutService
{
	/**
	 * fetch and return all recipe from database
	 * @return json|null
	 */
	public function getAll()
	{
		return Workout::all();
	}

	/**
	 * fetch recipe by dynamic {field} and {value} from the database
	 * @param string $field
	 * @param string | int $value
	 * @return json|null
	 */
	public function findBy($field, $value)
	{
		return Workout::where($field, $value);
	}
}
