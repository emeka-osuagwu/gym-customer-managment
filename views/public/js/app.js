// alert('fvmndfjh')

var item, 

sex,
email,
address,
last_name,
first_name,

plan_name,
plan_type,
plan_description,

monday_workout,
tuesday_workout,
wednesday_workout,
thursday_workout,
friday_workout,
saturday_workout,
sunday_workout,

assign_plan_selector,

customer_stat_counter;

$(document).ready(function() {
	customer_stat_counter = $("#customer_stat_counter");

	sex = document.getElementById('sex')
	email = document.getElementById('email')
	address = document.getElementById('location')
	last_name = document.getElementById('last_name')
	first_name = document.getElementById('first_name')
	
	plan_name = document.getElementById('plan_name')
	plan_type = document.getElementById('plan_type')
	plan_description = document.getElementById('plan_description')
	
	monday_workout = document.getElementById('monday_workout')
	tuesday_workout = document.getElementById('tuesday_workout')
	wednesday_workout = document.getElementById('wednesday_workout')
	thursday_workout = document.getElementById('thursday_workout')
	friday_workout = document.getElementById('friday_workout')
	saturday_workout = document.getElementById('saturday_workout')
	sunday_workout = document.getElementById('sunday_workout')
	
	assign_plan_selector = document.getElementById('assign_plan_selector')
})

/*
# createUser Function
*/
function createUser()
{
	var
	url = "/api/customer",
	method = "POST",
	functionName = arguments.callee.name;

	if 
	(
		!email.value || email.value == null ||
		!address.value || address.value == null ||
		!last_name.value || last_name.value == null ||
		!first_name.value || first_name.value == null ||
		!sex.value || sex.value == null
	)
	{
		swal("Oops", "All field are required", "error");
	}
	else if(email.value.match(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/) == null) 
	{
		swal("Oops", "Email is not a valid email", "error");
	}
	else {

	  	var data =
	    {
	        url: url,
	        method: method,
	        parameter:
	        {
	          	email: email.value,
	          	last_name: last_name.value,
	          	first_name: first_name.value,
	          	location: address.value,
	          	sex: sex.value
	        }
	    }

		ajaxCall(data, functionName)

	}
}

/*
# createUser Function
*/
function deleteUser(event, user_id)
{
  	var data =
    {
        url: "/api/customer/" + user_id,
        method: "DELETE",
        parameter:
        {
        }
    }

	ajaxCall(data, arguments.callee.name)
	
	$(event.target).parent().closest('tr').remove()
}

/*
# createUser Function
*/
function deletePlan(event, plan_id)
{
  	var data =
    {
        url: "/api/plan/" + plan_id,
        method: "DELETE",
        parameter:
        {
        }
    }

	ajaxCall(data, arguments.callee.name)
	
	$(event.target).parent().closest('tr').remove()
}

/*
# updateUser Function
*/
function updateUser(customer_id)
{
	var
	url = "/api/customer/" + customer_id,
	method = "POST",
	functionName = arguments.callee.name;

	if 
	(
		!email.value || email.value == null ||
		!address.value || address.value == null ||
		!last_name.value || last_name.value == null ||
		!first_name.value || first_name.value == null ||
		!sex.value || sex.value == null
	)
	{
		swal("Oops", "All field are required", "error");
	}
	else if(email.value.match(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/) == null) 
	{
		swal("Oops", "Email is not a valid email", "error");
	}
	else {

	  	var data =
	    {
	        url: url,
	        method: method,
	        parameter:
	        {
	          	email: email.value,
	          	last_name: last_name.value,
	          	first_name: first_name.value,
	          	location: address.value,
				sex: sex.value
				  
	        }
	    }

		ajaxCall(data, functionName)
	}
}

/*
# updateUser Function
*/
function updatePlan(plan_id)
{
	if 
	(
		!plan_name.value || plan_name.value == null ||
		!plan_description.value || plan_description.value == null ||
		!plan_type.value || plan_type.value == null
	)
	{
		swal("Oops", "All field are required", "error");
	}
	else {

	  	var data =
	    {
	        url: "/api/plan/" + plan_id,
	        method: "POST",
	        parameter:
	        {
	          	name: plan_name.value,
	          	type: plan_type.value,
	          	description: plan_description.value,
	        }
	    }

		ajaxCall(data, arguments.callee.name)
	}
}

/*
# updateUser Function
*/
function updatePlanWorkout(plan_id)
{
	if 
	(
		!monday_workout.value || monday_workout.value == null ||
		!tuesday_workout.value || tuesday_workout.value == null ||
		!wednesday_workout.value || wednesday_workout.value == null ||
		!thursday_workout.value || thursday_workout.value == null ||
		!friday_workout.value || friday_workout.value == null ||
		!saturday_workout.value || saturday_workout.value == null ||
		!sunday_workout.value || sunday_workout.value == null
	)
	{
		swal("Oops", "All field are required", "error");
	}
	else {

	  	var data =
	    {
	        url: "/api/plan/" + plan_id + "/workout",
	        method: "POST",
	        parameter:
	        {
	          	monday: monday_workout.value,
	          	tuesday: tuesday_workout.value,
	          	wednesday: wednesday_workout.value,
	          	thursday: thursday_workout.value,
	          	friday: friday_workout.value,
	          	saturday: saturday_workout.value,
	          	sunday: sunday_workout.value,
	        }
	    }

		ajaxCall(data, arguments.callee.name)
	}
}

/*
# updateUser Function
*/
function createPlan()
{
	if 
	(
		!plan_name.value || plan_name.value == null ||
		!plan_description.value || plan_description.value == null ||
		!plan_type.value || plan_type.value == null
	)
	{
		swal("Oops", "All field are required", "error");
	}
	else {

	  	var data =
	    {
	        url: "/api/plan",
	        method: "POST",
	        parameter:
	        {
	        	name: plan_name.value,
	        	type: plan_type.value,
	        	description: plan_description.value,
	          	monday: monday_workout.value,
	          	tuesday: tuesday_workout.value,
	          	wednesday: wednesday_workout.value,
	          	thursday: thursday_workout.value,
	          	friday: friday_workout.value,
	          	saturday: saturday_workout.value,
	          	sunday: sunday_workout.value,
	        }
	    }

		ajaxCall(data, arguments.callee.name)
	}
}

/*
# assignPlan
*/
function assignPlan(event, customer_id)
{
	if(assign_plan_selector.value == ""){
		swal("Oops", "You need to select a plan first", "error");
	}
	else{
		var data =
		{
			url: "/api/customer/" + customer_id + '/plan',
			method: "POST",
			parameter:
			{
				plan_id: assign_plan_selector.value,
			}
		}
	
		ajaxCall(data, arguments.callee.name)
	}
}


/*
# assignPlan
*/
function removePlan(event, customer_id, plan_id)
{
	var data =
	{
		url: "/api/customer/" + customer_id + '/plan',
		method: "POST",
		parameter:
		{
			plan_id
		}
	}
	
	ajaxCall(data, arguments.callee.name)

	$(event.target).parent().closest('tr').remove()
}

/*
# Ajax
*/
function ajaxCall ( data, functionName)
{
	$.ajax({
		url: data.url,
		type: data.method,
		data: data.parameter,
		success: function(response)
		{
			ajaxLogic (response, functionName)
		},
		error: function ()
		{
			alert('Are you sure you doing this the right way?');
		},
	});
}

function ajaxLogic (response, functionName)
{
	/*
	# Check if Response.status = 401
	*/
	if (response.status === 400)
	{
		switch (functionName)
        {
          case "createUser" : userAlreadyExistsError(); break;
          case "activateEpisode" : activateEpisodeErrorAlert(); break;
        }
	}

	/*
	# Check if Response.status = 200
	*/
	if (response.status === 200)
	{
		switch (functionName)
        {
          case "createUser" : createUserSuccessAlert(response); break;
          case "updateUser" : updateUserSuccessAlert(response); break;
          case "assignPlan" : assignPlanSuccessAlert(response); break;
          case "deleteUser" : deleteUserSuccessAlert(response); break;
          case "deletePlan" : deletePlanSuccessAlert(response); break;
          case "updatePlan" : updatePlanSuccessAlert(response); break;
          case "updatePlanWorkout" : updatePlanSuccessAlert(response); break;
          case "removePlan" : removePlanSuccessAlert(response); break;
          case "createPlan" : createPlanSuccessAlert(response); break;
        }
	}
}


/*
####################################################################
# deleteEpisodeErrorAlert Message
*/

/*
# deleteEpisodeSuccessAlert Message
*/
function createUserSuccessAlert (response)
{	
	customer_stat_counter.html(parseInt(customer_stat_counter.html()) + 1) 

	swal("Record Added!", "New User Created.", "success");

	sex.value = ""
	email.value = ""
	address.value = ""
	last_name.value = ""
	first_name.value = ""
}

function userAlreadyExistsError()
{	
	swal("Oops", "User Already Exists.", "error");
}

function updateUserSuccessAlert()
{	
	swal("Record Updated", "Customer Updated", "success");
}

function createPlanSuccessAlert()
{	
	swal("Record Added", "Plan Updated", "success");
		plan_name.value = ""
		plan_type.value = ""
		plan_description.value = ""
	  	monday.value = ""
	  	tuesday.value = ""
	  	wednesday.value = ""
	  	thursday.value = ""
	  	friday.value = ""
	  	saturday.value = ""
	  	sunday.value = ""
}

function assignPlanSuccessAlert(response)
{	
	var data = response.data;
	var plans = data[0].plans;

	$("#emeka").html("<tr></tr>")

	var temp = `
		<tr>
			<td>${data[0].plans[0].name}</td>
			<td>
				<div class="dropdown">
					<button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						Action
					</button>
					<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
						<a class="dropdown-item" href="/plan/${data[0].plans[0].id}">View / Edit</a>
						<a class="dropdown-item" onclick="removePlan(event, ${data[0].id}, ${data[0].plans[0].id})" style="cursor: pointer">Delete</a>
					</div>
				</div>
			</td>
		</tr>
	`

	for(plan in plans){

		var temp = `
			<tr>
				<td>${plans[plan].name}</td>
				<td>
					<div class="dropdown">
						<button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							Action
						</button>
						<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
							<a class="dropdown-item" href="/plan/${plans[plan].id}">View / Edit</a>
							<a class="dropdown-item" onclick="removePlan(event, ${data[0].id}, ${plans[plan].id})" style="cursor: pointer">Delete</a>
						</div>
					</div>
				</td>
			</tr>
		`

		$("#emeka").children().last().after(temp)
	}
	
	swal("Record Added", "Plan Assigned", "success");
}

function deleteUserSuccessAlert()
{	
	swal("Record Deleted", "Customer Delete", "success");
}

function deletePlanSuccessAlert()
{	
	swal("Record Deleted", "Plan Delete", "success");
}

function updatePlanSuccessAlert()
{	
	swal("Record Updated", "Plan Updated", "success");
}

function removePlanSuccessAlert()
{	
	swal("Record Updated", "Plan Removed", "success");
}

/*
####################################################################
# activateEpisodeErrorAlert() Message
*/
function activateEpisodeErrorAlert ()
{
	swal("Hmmmm", "This episode does not exist ", "error");
}

function activateEpisodeSuccessAlert()
{
	swal("Activated", "Your episode has been Activated.", "success");

	var deleted 	=  $(".selected");
	var new_item 	=  $("#active_section");

	new_item.append(item[0]);

	deleted.show();
}
