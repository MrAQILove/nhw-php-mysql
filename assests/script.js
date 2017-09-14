/*
Author: Pradeep Khodke
URL: http://www.codingcage.com/
*/

$('document').ready(function()
{ 
	/* validation */
	$("#login-form").validate({
		rules:
		{
			password: {
				required: true,
			},
			email: {
				required: true,
				email: true
            },
		},
       
		messages:
		{
			password:{
				required: "Please enter your Password"
            },
            email: "Please enter your Email Address",
		},
		
		submitHandler: submitForm	
       });  
	   /* validation */
	   
	   /* login submit */
	   function submitForm()
	   {		
			var data = $("#login-form").serialize();
				
			$.ajax({
				
				type : 'POST',
				url  : 'login_process.php',
				data : data,
				beforeSend: function()
				{	
					$("#error").fadeOut();
					$("#btn-login").html('<span class="glyphicon glyphicon-transfer"></span> &nbsp; sending ...');
				},
				success :  function(response)
				{						
					if(response=="ok")
					{
						$("#btn-login").html('<img src="images/btn-ajax-loader.gif" /> &nbsp; Signing In ...');
						setTimeout(' window.location.href = "home.php"; ',4000);
					}
					
					else
					{
						$("#error").fadeIn(1000, function() {						
							$("#error").html('<div class="alert alert-danger"> <span class="glyphicon glyphicon-info-sign"></span> &nbsp; '+response+' !</div>');
							$("#btn-login").html('<span class="glyphicon glyphicon-log-in"></span> &nbsp; Log Me In !');
						});
					}
				}
			});
			
			return false;
		}
	   /* login submit */

	$("#btn-signup").click(function(){
		window.location.href = "register.php";
	});
});

// autocomplet : this function will be executed every time we change the text
function autocomplet() 
{
	var min_length = 0; // min caracters to display the autocomplete
	var keyword = $('#state_id').val();
	
	if (keyword.length >= min_length) 
	{
		$.ajax({
			url: 'ajax-search.php',
			type: 'POST',
			data: {keyword:keyword},
			success:function(data){
				$('#state_list_id').show();
				$('#state_list_id').html(data);
			}
		});
	} 
	
	else {
		$('#state_list_id').hide();
	}
}
 
// set_item : this function will be executed when we select an item
function set_item(item) 
{
	// change input value
	$('#state_id').val(item);
	// hide proposition list
	$('#state_list_id').hide();
}