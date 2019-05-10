// alert('fvmndfjh')

var item, 

sex,
email,
address,
last_name,
first_name,

customer_stat_counter;

$(document).ready(function() {
	customer_stat_counter = $("#customer_stat_counter");

	sex = document.getElementById('sex')
	email = document.getElementById('email')
	address = document.getElementById('location')
	last_name = document.getElementById('last_name')
	first_name = document.getElementById('first_name')
})

/*
# Delete Episode Function
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
# Delete Episode Function
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
