<?php

namespace Emeka\Http\Services;

use Rakit\Validation\Validator;

class ValidationService
{
	protected $validator;
	
	public function __construct()
	{
		$this->validator = new Validator;
	}

	/**
	 */
	public function getCustomerValidation($data)
	{
		$validation = $this->validator->make($data, [
		    'id' => 'required|numeric',
		]);

		$validation->validate();

		return $validation;
	}

	/**
	 * createCustomerValidation
	 */
	public function createCustomerValidation($data)
	{
		$validation = $this->validator->make($data, [
		    'email' => 'required|email',
		    'first_name' => 'required|alpha_spaces',
		    'last_name' => 'required|alpha_spaces',
		    'sex' => 'required|alpha_spaces',
		    'location' => 'required',
		]);

		$validation->validate();
		return $validation;
	}

	/**
	 * updateCustomerValidation
	 */
	public function updateCustomerValidation($data)
	{
		$validation = $this->validator->make($data, [
		    'id' => 'required|numeric',
		    'email' => 'required_if:email|email',
		    'first_name' => 'required_if:first_name|alpha_spaces',
		    'last_name' => 'required_if:last_name|alpha_spaces',
		    'sex' => 'required_if:sex|alpha_spaces',
		    'location' => 'required_if:location',
		]);

		$validation->validate();

		return $validation;
	}

	/**
	 * createPlanValidation
	 */
	public function createPlanValidation($data)
	{
		$validation = $this->validator->make($data, [
		    'name' => 'required|alpha',
		    'description' => 'required|alpha_spaces',
		    'type' => 'required|alpha',
		]);

		$validation->validate();
		return $validation;
	}

	/**
	 * updateCustomerValidation
	 */
	public function updatePlanValidation($data)
	{
		$validation = $this->validator->make($data, [
		    'id' => 'required|numeric',
		    'name' => 'required_if:name|alpha_spaces',
		    'descriotion' => 'required_if:descriotion|alpha_spaces',
		    'type' => 'required_if:type|alpha',
		]);

		$validation->validate();

		return $validation;
	}

	/**
	 */
	public function getPlanValidation($data)
	{
		$validation = $this->validator->make($data, [
		    'id' => 'required|numeric',
		]);

		$validation->validate();

		return $validation;
	}

	/**
	 * updateCustomerValidation
	 */
	public function addPlanWorkoutValidation($data)
	{
		$validation = $this->validator->make($data, [
		    'monday' => 'required_if:monday|alpha_spaces',
		    'tuesday' => 'required_if:tuesday|alpha_spaces',
		    'wednesday' => 'required_if:wednesday|alpha_spaces',
		    'thursday' => 'required_if:thursday|alpha_spaces',
		    'friday' => 'required_if:friday|alpha_spaces',
		    'saturday' => 'required_if:saturday|alpha_spaces',
		    'sunday' => 'required_if:sunday|alpha_spaces',
		]);

		$validation->validate();

		return $validation;
	}

	/**
	 * updateCustomerValidation
	 */
	public function customerAddplanValidation($data)
	{
		$validation = $this->validator->make($data, [
		    'id' => 'required|numeric',
		    'plan_id' => 'required|numeric',
		]);

		$validation->validate();

		return $validation;
	}
}