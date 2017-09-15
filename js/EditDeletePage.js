// 9lessons programming blog
// Srinivas Tamada http://9lessons.info
$(document).ready(function()
{
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
					//alert(renderView);
				},
				error: function (jqXHR, textStatus, errorThrown){
					alert('Error!  Status = ' + xhr.status); 
				}
			});
			
			return false;
		}
	});
	
	$(".edit_tr").live('click',function()
	{
		var ID=$(this).attr('id');

		$("#one_"+ID).hide();
		$("#two_"+ID).hide();
		$("#three_"+ID).hide();
		$("#four_"+ID).hide();
		$("#five_"+ID).hide();
		$("#six_"+ID).hide();
		$("#seven_"+ID).hide();
		$("#eight_"+ID).hide();
		$("#nine_"+ID).hide();
		$("#ten_"+ID).hide();
		$("#eleven_"+ID).hide();
		$("#twelve_"+ID).hide();
		$("#thirteen_"+ID).hide();

		$("#one_input_"+ID).show();
		$("#two_input_"+ID).show();
		$("#three_input_"+ID).show();
		$("#four_input_"+ID).show();
		$("#five_input_"+ID).show();
		$("#six_input_"+ID).show();
		$("#seven_input_"+ID).show();
		$("#eight_input_"+ID).show();
		$("#nine_input_"+ID).show();
		$("#ten_input_"+ID).show();
		$("#eleven_input_"+ID).show();
		$("#twelve_input_"+ID).show();
		$("#thirteen_input_"+ID).show();
		
		}).live('change',function(e)
		{
			var ID				= $(this).attr('id');
			var one_val			= $("#one_input_"+ID).val();
			var two_val			= $("#two_input_"+ID).val();
			var three_val		= $("#three_input_"+ID).val();
			var four_val		= $("#four_input_"+ID).val();
			var five_val		= $("#five_input_"+ID).val();
			var six_val			= $("#six_input_"+ID).val();
			var seven_val		= $("#seven_input_"+ID).val();
			var eight_val		= $("#eight_input_"+ID).val();
			var nine_val		= $("#nine_input_"+ID).val();
			var ten_val			= $("#ten_input_"+ID).val();
			var eleven_val		= $("#eleven_input_"+ID).val();
			var twelve_val		= $("#twelve_input_"+ID).val();
			var thirteen_val	= $("#thirteen_input_"+ID).val();
			var dataString = 'id='+ ID +'&Firstname='+one_val+'&Other_Name='+two_val+'&Address='+three_val+'&Suburb='+four_val+'&StateID='+five_val+'&Postcode='+six_val+'&Email='+seven_val+'&Phone='+eight_val+'&DesignationID='+nine_val+'&RegDiv_ID='+ten_val+'&NHWArea='+eleven_val+'&DXAddress='+twelve_val+'&Copies='+thirteen_val;
			
			if(one_val.length > 0 && two_val.length > 0 && three_val.length > 0 && four_val.length > 0 && five_val.length > 0 && six_val.length > 0 && seven_val.length > 0 && eight_val.length > 0 && nine_val.length > 0 && ten_val.length > 0 && eleven_val.length > 0 && twelve_val.length > 0 && thirteen_val.length > 0)
			{
				$.ajax({
					type: "POST",
					url: "live-edit-ajax.php",
					data: dataString,
					cache: false,
					success: function(e)
					{
						$("#one_"+ID).html(one_val);
						$("#two_"+ID).html(two_val);
						$("#three_"+ID).html(three_val);
						$("#four_"+ID).html(four_val);
						$("#five_"+ID).html(five_val);
						$("#six_"+ID).html(six_val);
						$("#seven_"+ID).html(seven_val);
						$("#eight_"+ID).html(eight_val);
						$("#nine_"+ID).html(eight_val);
						$("#ten_"+ID).html(eight_val);
						$("#eleven_"+ID).html(eight_val);
						$("#twelve_"+ID).html(eight_val);
						$("#thirteen_"+ID).html(eight_val);

						e.stopImmediatePropagation();
					}
				});
			}
			
			else {
				alert('Enter something.');
			}
		});

	// Edit input box click action
	$(".editbox").live("mouseup",function(e) {
		e.stopImmediatePropagation();
		});

		// Outside click action
		$(document).mouseup(function()
		{
			$(".editbox").hide();
			$(".text").show();
		});
			
			
		//Pagination			
		function loading_show(){
			$('#loading').html("<img src='images/loading.gif'/>").fadeIn('fast');
		}
		
		function loading_hide(){
			$('#loading').fadeOut('fast');
		}                
		
		function loadData(page)
		{
			loading_show();                    
			$.ajax
			({
				type: "POST",
				url: "load-data.php",
				data: "page="+page,
				success: function(msg)
				{
					$("#container-body").ajaxComplete(function(event, request, settings)
					{
						loading_hide();
						$("#container-body").html(msg);
					});
				}
			});
		}
		
		loadData(1);  // For first time page load default results
		
		$('#container-body .pagination li.active').live('click',function()
		{
			var page = $(this).attr('p');
			loadData(page);
		});           
		
		$('#go_btn').live('click',function()
		{
			var page = parseInt($('.goto').val());
			var no_of_pages = parseInt($('.total').attr('a'));
			
			if(page != 0 && page <= no_of_pages) {
				loadData(page);
			}
			
			else 
			{
				alert('Enter a PAGE between 1 and '+ no_of_pages);
				$('.goto').val("").focus();
				return false;
			}
		});
	});