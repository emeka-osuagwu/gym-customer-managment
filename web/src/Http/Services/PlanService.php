<?php

namespace Emeka\Http\Services;

use Emeka\Http\Models\Plan;
use Emeka\Http\Services\Contracts\CustomerServiceInterface;

class PlanService
{
	/**
	 * fetch and return all recipe from database
	 * @return json|null
	 */
	public function getAll()
	{
		return Plan::all();
	}

	/**
	 * fetch recipe by dynamic {field} and {value} from the database
	 * @param string $field
	 * @param string | int $value
	 * @return json|null
	 */
	public function findBy($field, $value)
	{
		return Plan::where($field, $value);
	}

	public function createPlan($data)
	{
		return Plan::create($data);
	}

	/**
	 * update recipe record in the database
	 * @param array data
	 * @return json|null
	 */
	public function updatePlan($data)
	{
		Plan::where('id', $data['id'])->update($data);
		return $this->findBy('id', $data['id'])->get();
	}
}
