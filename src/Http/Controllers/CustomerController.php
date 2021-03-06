<?php

namespace Emeka\Http\Controllers;

use Twig_Environment;
use Emeka\Http\Services\PlanService;
use Emeka\Http\Services\MailService;
use Emeka\Http\Services\WorkoutService;
use Emeka\Http\Services\ValidationService;
use Emeka\Http\Services\Contracts\CustomerServiceInterface;

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
	 * MailService Service
	 * @var mailService
	 */
	protected $mailService;

	/**
	 * RecipeService Service
	 * @var RecipeService
	 */
	protected $customerService;

	/**
	 * WorkoutService Service
	 * @var $workoutService
	 */
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
		MailService $mailService,
		PlanService $planService,
		WorkoutService $workoutService,
		Twig_Environment $twig,
		ValidationService $validationService,
		CustomerServiceInterface $customerService
	)
	{
		$this->twig = $twig;
		$this->mailService = $mailService;
		$this->planService = $planService;
		$this->workoutService = $workoutService;
		$this->customerService = $customerService;
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
		$request_data = input()->all(['plan_id']);

		$request_data['id'] = $id;

		// // validate deleteCustomer 
		$validation = $this->validationService->customerAddplanValidation($request_data);

		// // check if validation fails
		if ($validation->fails()) {
		    $errors = $validation->errors();
		    return response()->httpCode(400)->json([
		    	"status" => 400,
		    	"data" => $errors->firstOfAll() 
		    ]);
		}

		$plan = $this->planService->findBy('id', input()->all(['plan_id']))->get();
		$customer = $this->customerService->findBy('id', $id)->get();
		
		// check ifCustomer  exist in the database
		if ($customer->count() < 1 || $plan->count() < 1) {
			return response()->httpCode(400)->json([
				"message" => "cant find record",
				"status" => 400,
			]);
		}	

		$plan_action = $customer->first()->plans()->toggle($plan->first()->id);
		$customer->first()->plans;


		if($plan_action['attached']){
			$this->mailService->send
			(
				$customer->first()->email, 
				$customer->first()->first_name . " " . $customer->first()->last_name, 
				"Plan Added", 
				"Plan <strong>" .  $plan->first()->name . "</strong> has been added to your account"
			);
		}

		if($plan_action['detached']){
			$this->mailService->send
			(
				$customer->first()->email, 
				$customer->first()->first_name . " " . $customer->first()->last_name, 
				"Plan Removed", 
				"Plan <strong>" .  $plan->first()->name . "</strong> has been removed from your account"
			);
		}

		return response()->httpCode(200)->json([
			"data" => $customer,
			"status" => 200
		]);
	}
}