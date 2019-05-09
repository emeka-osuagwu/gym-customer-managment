<?php

namespace Emeka\Http\Services;

use Emeka\Http\Models\User;
use Emeka\Http\Services\Contracts\CustomerServiceInterface;

class CustomerService implements CustomerServiceInterface
{
	/**
	 * fetch and return all recipe from database
	 * @return json|null
	 */
	public function getAll()
	{
		return User::with('plans')->get();
	}

	/**
	 * fetch recipe by dynamic {field} and {value} from the database
	 * @param string $field
	 * @param string | int $value
	 * @return json|null
	 */
	public function findBy($field, $value)
	{
		return User::with('plans')->where($field, $value);
	}

	/**
	 * insert new recipe into the database
	 * @param array $data
	 * @return json|null
	 */
	public function createRecipe($data)
	{
		return User::create($data);
	}

	/**
	 * update recipe record in the database
	 * @param array data
	 * @return json|null
	 */
	public function updateRecipe($data)
	{
		User::where('id', $data['id'])->update($data);
		return $this->findBy('id', $data['id'])->get();
	}
}
