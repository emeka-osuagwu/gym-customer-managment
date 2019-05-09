<?php

namespace Emeka\Http\Controllers;

use Twig_Environment;
use Emeka\Http\Services\ValidationService;
use Emeka\Http\Services\Contracts\CustomerServiceInterface;
use Emeka\Http\Services\PlanService;

/**
 * Class CustomerController
 * @package Emeka\Http\Controllers
 */
class PlanController
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
		ValidationService $validationService,
		CustomerServiceInterface $customerService
	)
	{
		$this->twig = $twig;
		$this->planService = $planService;
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

		return $this->twig->render('index.twig', [
		    'customers' => $customers,
		    'plans' => $plans
		]);
	}

	public function showCustomers()
	{
		return $customer = $this->customerService->getAll();
		
		return $this->twig->render('customers.twig', [
		    'customers' => $customers
		]);
    }
    
    public function apiGetPlans()
    {
        return response()->httpCode(200)->json([
			"data" => $this->planService->getAll(),
			"status" => 200
		]);
    }

    public function apiCreatePlan()
    {
		// validate deleteCustomer 
		$validation = $this->validationService->createPlanValidation(input()->all());

		// check if validation fails
		if ($validation->fails()) {
		    $errors = $validation->errors();
		    return response()->httpCode(400)->json([
		    	"status" => 400,
		    	"data" => $errors->firstOfAll() 
		    ]);
		}

        // check if Plan  exist in the database
		$find_plan_by_name = $this->planService->findBy('name', input()->all(['name']))->get()->count();

		// return error is exist
		if ($find_plan_by_name) {
			return response()->httpCode(200)->json([
				"message" => "Plan already exit",
				"status" => 400,
			]);
		}	

		return response()->httpCode(200)->json([
			"data" => $this->planService->createPlan(input()->all()),
			"status" => 200
		]);
    }

    public function apiPlanAddWorkout($id)
    {
        // validate deleteCustomer 
		$validation = $this->validationService->getPlanValidation(['id' => $id]);

		// check if validation fails
		if ($validation->fails()) {
		    $errors = $validation->errors();
		    return response()->httpCode(400)->json([
		    	"status" => 400,
		    	"data" => $errors->firstOfAll() 
		    ]);
		}

        $request = input()->all(['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday']);

        // validate deleteCustomer 
		$validation = $this->validationService->addPlanWorkoutValidation(array_merge(input()->all()));

		// check if validation fails
		if ($validation->fails()) {
		    $errors = $validation->errors();
		    return response()->httpCode(400)->json([
		    	"status" => 400,
		    	"data" => $errors->firstOfAll() 
		    ]);
        }

        $plan = $this->planService->findBy('id', $id)->first();

        // check if plan exist in the database
		if ($plan->count() < 1) {
			return response()->httpCode(400)->json([
				"message" => "cant find record",
				"status" => 400,
			]);
        }	
        
        foreach($request as $key => $value){
            if (isset($request[$key]) && $request[$key] != '') {
                $plan[$key] = $request[$key];
            }
        }

        $plan->save();

		return response()->httpCode(200)->json([
			"data" => $plan,
			"status" => 200
		]);
    }

    /**
	 * handle update plans request
	 * @return json|null
	 * @param int $id
	 */
	public function apiUpdatePlans($id)
	{
		$request = input()->all();

		$request_data = [];

		// check ifCustomer  exist in the database
		if ($this->planService->findBy('id', $id)->count() < 1) {
			return response()->httpCode(400)->json([
				"message" => "cant find record",
				"status" => 400,
			]);
		}	

		if (isset($request['name']) && isset($request['name']) != '') {
			$request_data['name'] = $request['name'];
		}

		if (isset($request['description']) && isset($request['description']) != '') {
			$request_data['description'] = $request['description'];
		}

		if (isset($request['type']) && isset($request['type']) != '') {
			$request_data['type'] = $request['type'];
		}

		$request_data['id'] = $id;

		$validation = $this->validationService->updatePlanValidation($request_data);

		if ($validation->fails()) {
		    $errors = $validation->errors();
		    return response()->httpCode(400)->json([
		    	"status" => 400,
		    	"data" => $errors->firstOfAll() 
		    ]);
        }
        
		return response()->httpCode(200)->json([
			"data" => $this->planService->updatePlan($request_data),
			"status" => 200
		]);
    }
    
    /**
	 * handle deletePlan request
	 * @param int id
	 * @return json|null
	 */
	public function apiDeletePlan($id)
	{	
		// validate deleteCustomer 
		$validation = $this->validationService->getPlanValidation(['id' => $id]);

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

		$this->planService->findBy('id', $id)->delete();
		
		return response()->httpCode(200)->json([
			"message" => "record deleted",
			"status" => 200
		]);
	}
}