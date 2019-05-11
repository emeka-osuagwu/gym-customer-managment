<?php

namespace Emeka\Http\Controllers;

use Twig_Environment;
use Emeka\Http\Services\ValidationService;
use Emeka\Http\Services\Contracts\CustomerServiceInterface;
use Emeka\Http\Services\PlanService;
use Emeka\Http\Services\WorkoutService;

/**
 * Class CustomerController
 * @package Emeka\Http\Controllers
 */
class CustomerController
{
	/**
	 * Twig_Environment
	 * @var Twig_Environment
	 */
	private $twig;

	/**
	 * RecipeService Service
	 * @var RecipeService
	 */
	protected $customerService;

	protected $workoutService;

	/**
	 * Validation Service
	 * @var RecipeService
	 */
	protected $validationService;

	/**
	 * Plan Service
	 * @var PlanService
	 */
	protected $planService;

	function __construct
	(
		PlanService $planService,
		Twig_Environment $twig,
		WorkoutService $workoutService,
		ValidationService $validationService,
		CustomerServiceInterface $customerService
	)
	{
		$this->twig = $twig;
		$this->planService = $planService;
		$this->customerService = $customerService;
		$this->workoutService = $workoutService;
		$this->validationService = $validationService;
	}

	/**
	 * handle index request
	 * @return json|null
	 */
	public function index()
	{
		$plans = $this->planService->getAll();
		$customers = $this->customerService->getAll();
		$workouts = $this->workoutService->getAll();

		return $this->twig->render('index.twig', [
		    'customers' => $customers,
		    'plans' => $plans,
		    'workouts' => $workouts
		]);
	}

	public function showCustomers()
	{
		$customers = $this->customerService->getAll();
		
		return $this->twig->render('customers.twig', [
		    'customers' => $customers
		]);
	}

	public function showCustomer($id)
	{
		$plans = $this->planService->getAll();
		$customer = $this->customerService->findBy('id', $id)->get()->first();

		return $this->twig->render('view_customer.twig', [
			'customer' => $customer,
			'plans' => $plans
		]);
	}

	/**
	 * handle createCustomer s request
	 * @return json|null
	 */
	public function create()
	{
		// validate deleteCustomer 
		$validation = $this->validationService->createCustomerValidation(input()->all());

		// check if validation fails
		if ($validation->fails()) {
		    $errors = $validation->errors();
		    return response()->httpCode(400)->json([
		    	"status" => 400,
		    	"data" => $errors->firstOfAll() 
		    ]);
		}

		// check ifCustomer  exist in the database
		$findRecipeByName = $this->customerService->findBy('email', input()->all(['email']))->get()->count();

		// return error is exist
		if ($findRecipeByName) {
			return response()->httpCode(200)->json([
				"message" => "Customer already exit",
				"status" => 400,
			]);
		}	

		return response()->httpCode(200)->json([
			"data" => $this->customerService->createCustomer(input()->all()),
			"status" => 200
		]);
	}

	/**
	 * handle get recipes request
	 * @return json|null
	 */
	public function apiGetCustomers()
	{
		return response()->httpCode(200)->json([
			"data" => $this->customerService->getAll(),
			"status" => 200
		]);
	}

	/**
	 * handle getCustomer  request
	 * @return json|null
	 */
	public function customer($id)
	{
		// validate getCustomer 
		$validation = $this->validationService->getCustomerValidation(['id' => $id]);

		// check if validation fails
		if ($validation->fails()) {
		    $errors = $validation->errors();
		    return response()->httpCode(400)->json([
		    	"status" => 400,
		    	"data" => $errors->firstOfAll() 
		    ]);
		}

		return response()->httpCode(200)->json([
			"data" => $this->customerService->findBy('id', $id)->get(),
			"status" => 200
		]);
	}

	/**
	 * handle deleteCustomer s request
	 * @param int id
	 * @return json|null
	 */
	public function delete($id)
	{	

		// validate deleteCustomer 
		$validation = $this->validationService->getCustomerValidation(['id' => $id]);

		// check if validation fails
		if ($validation->fails()) {
		    $errors = $validation->errors();
		    return response()->httpCode(400)->json([
		    	"status" => 400,
		    	"data" => $errors->firstOfAll() 
		    ]);
		}

		// check if record exist
		if ($this->customerService->findBy('id', $id)->count() < 1) {
			return response()->httpCode(400)->json([
				"message" => "record not round",
				"status" => 400
			]);
		}

		$this->customerService->findBy('id', $id)->delete();
		
		return response()->httpCode(200)->json([
			"message" => "record deleted",
			"status" => 200
		]);
	}

	/**
	 * handle updateCustomer  request
	 * @return json|null
	 * @param int $id
	 */
	public function update($id)
	{
		$request = input()->all(['first_name', 'last_name', 'email', 'sex', 'location']);

		$request['id'] = $id;

		$validation = $this->validationService->updateCustomerValidation($request);

		if ($validation->fails()) {
		    $errors = $validation->errors();
		    return response()->httpCode(400)->json([
		    	"status" => 400,
		    	"data" => $errors->firstOfAll() 
		    ]);
		}

		$customer = $this->customerService->findBy('id', $id);

		// check ifCustomer  exist in the database
		if ($customer->count() < 1) {
			return response()->httpCode(400)->json([
				"message" => "cant find record",
				"status" => 400,
			]);
		}	

		$new_customer = [];

		foreach($request as $key => $value){
            if (isset($request[$key]) && $request[$key] != '') {
                $new_customer[$key] = $request[$key];
            }
		}

		return response()->httpCode(200)->json([
			"data" => $this->customerService->updateCustomer($new_customer),
			"status" => 200
		]);
	}

	/**
	 * handle updateCustomer  request
	 * @return json|null
	 * @param int $id
	 */
	public function apiCustomerAddPlan($id)
	{		
		// validate deleteCustomer 
		$validation = $this->validationService->customerAddplanValidation(['id' => $id, 'plan_id' => (int) input()->all(['plan_id'])]);

		// check if validation fails
		if ($validation->fails()) {
		    $errors = $validation->errors();
		    return response()->httpCode(400)->json([
		    	"status" => 400,
		    	"data" => $errors->firstOfAll() 
		    ]);
		}

		$plan = $this->planService->findBy('id', input()->all(['plan_id']));
		$customer = $this->customerService->findBy('id', $id);
		
		// check ifCustomer  exist in the database
		if ($customer->count() < 1 || $plan->count() < 1) {
			return response()->httpCode(400)->json([
				"message" => "cant find record",
				"status" => 400,
			]);
		}	

		$add_plan = $this->customerService->addPlan($customer->first()->id, $plan->first()->id);

		return response()->httpCode(200)->json([
			"data" => $add_plan,
			"status" => 200
		]);
	}
}