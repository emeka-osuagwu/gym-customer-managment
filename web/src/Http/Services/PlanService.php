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
}
