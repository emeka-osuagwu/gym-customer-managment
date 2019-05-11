<?php

namespace Emeka\Http\Services;

use Emeka\Http\Models\User;
use Emeka\Http\Models\PlanUser;
use Emeka\Http\Services\Contracts\CustomerServiceInterface;

class CustomerService implements CustomerServiceInterface
{
	/**
	 * fetch and return all customer from database
	 * @return json|null
	 */
	public function getAll()
	{
		return User::with('plans')->get();
	}

	/**
	 * fetch customer by dynamic {field} and {value} from the database
	 * @param string $field
	 * @param string | int $value
	 * @return json|null
	 */
	public function findBy($field, $value)
	{
		return User::with('plans')->where($field, $value);
	}

	/**
	 * insert new customer into the database
	 * @param array $data
	 * @return json|null
	 */
	public function createCustomer($data)
	{
		return User::create($data);
	}

	/**
	 * update recipe record in the database
	 * @param array data
	 * @return json|null
	 */
	public function updateCustomer($data)
	{
		User::where('id', $data['id'])->update($data);
		return $this->findBy('id', $data['id'])->get();
	}

	public function addPlan($user_id, $plan_id)
	{
		$find_user_plan = PlanUser::where(['user_id' => $user_id, 'plan_id' => $plan_id])->get();
		
		if(!$find_user_plan->count()){
			return PlanUser::create([
				'user_id' => $user_id,
				'plan_id' => $plan_id
			]);
		}
		else{
			return $find_user_plan;
		}
	}
}
