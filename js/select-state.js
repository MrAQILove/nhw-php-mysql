$(document).ready(function()
{	
	$(document).on('submit', '#search-form', function()
	{
		var data = $(this).serialize();
		
		$.ajax({
			type : 'POST',
			url  : 'search-result.php',
			data : data,
			success :  function(data)
			{						
				$("#search-form").fadeOut(500).show(function()
				{
					$("#container-body").fadeIn(500).show(function() {
						$("#container-body").html(data);
					});
				});
			},
			error: function(jqXHR, textStatus, errorMessage) {
				console.log(errorMessage); // Optional
			}
		});
			
		return false;
	});
});
