$(document).ready(function()
{
	$("#btn-search").live('click',function()
	{
		var searchby		= $("#searchby").val();
		var page			= $("#page").val();
		var Firstname		= $("#Firstname").val();
		var Address			= $("#Address").val();
		var RegDiv_ID		= $("#RegDiv_ID").val();
		var DesignationID	= $("#DesignationID").val();
		var StateID			= $("#StateID").val();
		
		
		if (searchby == "firstname") {
			var dataString = 'searchby=' + searchby + '&Firstname=' + Firstname + '&page=' + page;
		}

		else if (searchby == "address") {
			var dataString = 'searchby=' + searchby + '&Address=' + Address + '&page=' + page;
		}

		else if (searchby == "regdiv") {
			var dataString = 'searchby=' + searchby + '&RegDiv_ID=' + RegDiv_ID + '&page=' + page;
		}

		else if (searchby == "designation"){
			var dataString = 'searchby=' + searchby + '&DesignationID=' + DesignationID + '&page=' + page;
		}
		
		else {
			var dataString = 'searchby=' + searchby + '&StateID=' + StateID + '&page=' + page;
		}
		
		loading_show();
			
		$.ajax({
			type : 'POST',
			url  : 'search-result.php',
			data : dataString,
			success :  function(data)
			{						
				$("#search-form").fadeOut(500, function()
				{
					loading_hide();
					$("#container-body").html(data);
					$("#search-form").fadeIn(500);

				});
			},
			error: function(jqXHR, textStatus, errorMessage) {
				console.log(errorMessage); // Optional
			}
		});

		return false;
	});

	$('#container-body .pagination li.alive').live('click',function()
	{
		var page = $(this).attr('p');
		loadData(page);
	});           
		
	$('#go_button').live('click',function()
	{
		var page = parseInt($('.jump_to').val());
		var no_of_pages = parseInt($('.total').attr('a'));
			
		if(page != 0 && page <= no_of_pages) {
			loadData(page);
		}
			
		else 
		{
			alert('Please Enter a PAGE between 1 and '+ no_of_pages);
			$('.jump_to').val("").focus();
			return false;
		}
	});

	$(".delete").live('click',function()
	{
		var id = $(this).attr('id');
		var b=$(this).parent().parent();
		var dataString = 'id='+ id;
		
		if(confirm("Sure you want to delete this update? There is NO undo!"))
		{
			$.ajax({
				type: "POST",
				url: "delete-member.php",
				data: dataString,
				cache: false,
				success: function(e)
				{
					b.hide();
					e.stopImmediatePropagation();
				}
			});
			
			return false;
		}
	});

	$(".edit").live('click',function()
	{
		var userid = $(this).data('user-id');
		var renderView = $(this).data('render-view');
		
		if(confirm("Sure you want to update this member?"))
		{
			$.ajax({
				type: "POST",
				url: "edit-member.php",
				data: { userid: userid, setid: true }, // add a flag
				success: function(data, textStatus, jqXHR){
					window.location = renderView;
				},
				error: function (jqXHR, textStatus, errorThrown){
					alert('Error!  Status = ' + xhr.status); 
				}
			});
			
			return false;
		}
	});
});

function loading_show(){
	$('#loading').html("<img src='images/loading.gif'/>").fadeIn('fast');
}
		
function loading_hide(){
	$('#loading').fadeOut('fast');
}

function loadData(page)
{
	var searchby = $("#searchby").val();
	var StateID = $("#StateID").val();
	var dataString = 'searchby=' + searchby + '&StateID=' + StateID + '&page=' + page;
	loading_show();
			
	$.ajax({
		type : 'POST',
		url  : 'search-result.php',
		data: "searchby=" + searchby + "&StateID=" + StateID + "&page=" + page,
		success: function(msg)
		{						
			$("#search-form").fadeOut(500, function()
			{
				loading_hide();
				$("#container-body").html(msg);
				$("#search-form").fadeIn(500);
			});
		},
		error: function(jqXHR, textStatus, errorMessage) {
			console.log(errorMessage); // Optional
		}
	});
}