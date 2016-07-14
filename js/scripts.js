$(document).ready(function(){
	var home_url = "http://54.254.138.124/logistics/";
	$(".list_city").click(function(){
		var state_id = $(this).attr('id');
		$.ajax({
			url: home_url+"ajax/get_city_list",
			data: {state:state_id},
			success: function(data){
				$("#city_list").html(data);
			}
		});
	});
	$(".customer_rate_list").click(function(){
		var rate_id = $(this).attr('id');
		$.ajax({
			url: home_url+"ajax/get_customer_rate_list",
			data: {rate:rate_id},
			success: function(data){
				$("#city_list").html(data);
			}
		});
	});
	$(".state_dropdown").change(function(){
		var state_id = $(this).val();
		$.ajax({
			url: home_url+"ajax/get_city_select",
			data: {state:state_id},
			success: function(data){
				$("#city").html(data);
			}
		});
	});
	$(".pres_state").change(function(){
		var state_id = $(this).val();
		$.ajax({
			url: home_url+"ajax/get_city_select",
			data: {state:state_id},
			success: function(data){
				$("#pres_city").html(data);
			}
		});
	});
	$(".res_state").change(function(){
		var state_id = $(this).val();
		$.ajax({
			url: home_url+"ajax/get_city_select",
			data: {state:state_id},
			success: function(data){
				$("#res_city").html(data);
			}
		});
	});
	
	$("#get_lr").on("click",function(){
		var from_branch_id = $("#from_branch").val();
		var to_branch_id = $("#to_branch").val();
		$.ajax({
			url: home_url+"ajax/get_lr",
			data: {from:from_branch_id,to:to_branch_id},
			success: function(data){
				//alert(data);
				$("#lr_popup").html(data);
			}
		});
	});
	$(document.body).on('click','.lr_id', function () {
		var tripsheet_id = 0;
		var checkValues = $('input[name="lr_id[]"]:checked').map(function(){
            return $(this).val();
        }).get();
		if("#ts_id"){
			var tripsheet_id = $("#ts_id").val();
		}
		$("#lr").val(checkValues);
		$.ajax({
			url: home_url+"ajax/get_lr_list",
			data: {lr_id:checkValues,trip_id:tripsheet_id},
			success: function(data){
				//alert(data);
				$("#display_lr").html(data);
			}
		});
	});
	
	$(".get_lr").on("click",function(){
		var tripsheet_id = $(this).attr('id');
		//alert(tripsheet_id);
		$.ajax({
			url: home_url+"ajax/get_lr_list",
			data: {trip_id:tripsheet_id},
			success: function(data){
				$("#lr_popup").html(data);
			}
		});
	});
	
	$("#get_trip_sheet").on("click",function(){
		var from_branch_id = $("#from_branch").val();
		var my_branch_id = $("#to_branch").val();
		$.ajax({
			url: home_url+"ajax/tripsheet_list",
			data: {from:from_branch_id,to:my_branch_id},
			success: function(data){
				$("#lr_popup").html(data);
			}
		});
	});
	
	$(document.body).on('click','.ts_id', function () {
		var checkValues = $('input[name="ts_id"]:checked').val();
		$.ajax({
			url: home_url+"ajax/tripsheet_details",
			data: {trip_id:checkValues},
			success: function(data){
				var result = JSON.parse(data);
				$("#ts_date").val(result.trip_date);
				$("#departure").val(result.departure);
				$("#truck").val(result.vehicle);
				$("#driver").val(result.driver);
				$("#mobile").val(result.mobile);
				$("#ts_id").val(checkValues);
				
			}
		});
		
	});
	
	$("#get_arrival_lr").on("click",function(){
		var tripsheet_id = $("#ts_id").val();
		$.ajax({
			url: home_url+"ajax/get_lr",
			data: {trip_id:tripsheet_id},
			success: function(data){
				$("#lr_popup").html(data);
			}
		});
	});
	
	
	$("#get_transit_lr").on("click",function(){
		var from_branch = $("#from_branch").val();
		var to_branch = $("#to_branch").val();
		$.ajax({
			url: home_url+"ajax/get_transit_lr",
			data: {from:from_branch,to:to_branch},
			success: function(data){
				//alert(data);
				$("#lr_popup").html(data);
			}
		});
	});
	
	$(document.body).on('click','.trans_lr_id', function () {
		var tripsheet_id = 0;
		var checkValues = $('input[name="trans_lr_id[]"]:checked').map(function(){
            return $(this).val();
        }).get();
		if("#ts_id"){
			var tripsheet_id = $("#ts_id").val();
		}
		$("#trans_lr").val(checkValues);
		$.ajax({
			url: home_url+"ajax/fetch_lr_details",
			data: {lr_id:checkValues,trip_id:tripsheet_id},
			success: function(data){
				//alert(data);
				$("#display_lr").html(data);
			}
		});
	});
	
	$("#unload_tripsheet").on("change",function(){
		var trip_id = $(this).val();
		$.ajax({
			url: home_url+"ajax/get_tripsheet_lr",
			data: {trip_id:trip_id},
			success: function(data){
				var result = JSON.parse(data);
				$("#ts_date").val(result.trip_date);
				$("#departure").val(result.departure);
				$("#truck").val(result.vehicle);
				$("#driver").val(result.driver);
				$("#mobile").val(result.mobile);
				$("#display_lr").html(result.html);
			}
		});
	});
	
	/*$(document.body).on('click','.lr_id', function () {
		var checkValues = $('input[name="lr_id[]"]:checked').map(function(){
            return $(this).val();
        }).get();
		$("#lr").val(checkValues);
		$.ajax({
			url: home_url+"ajax/get_lr_list",
			data: {lr_id:checkValues},
			success: function(data){
				$("#display_lr").html(data);
			}
		});
	});
	*/
	
});