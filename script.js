jQuery(document).ready(function($){
    $("#rp_new_field_one").keyup(function(){
		  txt = $(this).val();
		  	 
		  data = {
			  			action : "get_keyword",
						rp_nonce: rp_vars.rp_nonce,
						suggest: txt,
						num: "one"
				};
		  $.post(ajaxurl,data,function(response){
		 	$(".rp_post_result_one").show();
			$(".rp_post_result_one").html(response);
				 
		  });
	 });

    $("#rp_new_field_two").keyup(function(){
		  txt = $(this).val();	 
		  data = {
			  			action : "get_keyword",
						rp_nonce: rp_vars.rp_nonce,
						suggest: txt,
						num: "two"
				};
		  $.post(ajaxurl,data,function(response){
		 	$(".rp_post_result_two").show();
			$(".rp_post_result_two").html(response);
		  });
	 });

    $("#rp_new_field_three").keyup(function(){
		  txt = $(this).val();	 
		  data = {
			  			action : "get_keyword",
						rp_nonce: rp_vars.rp_nonce,
						suggest: txt,
						num: "three"
				};
		  $.post(ajaxurl,data,function(response){
		 	$(".rp_post_result_three").show();
			$(".rp_post_result_three").html(response);
		  });
	 });
	 
});
	 
	 function pushvalueone(lnk, title){
		var post_link_one = document.getElementById("post_link_one");
		post_link_one.value = lnk;
		
		var rp_new_field_one = document.getElementById("rp_new_field_one");
		rp_new_field_one.value = title;
		
		document.getElementById("rp_post_result_one").style.display = 'none';
		
	 }
	 
	 function pushvaluetwo(lnk, title){
		var post_link_two = document.getElementById("post_link_two");
		post_link_two.value = lnk;
		
		var rp_new_field_two = document.getElementById("rp_new_field_two");
		rp_new_field_two.value = title;
		
		document.getElementById("rp_post_result_two").style.display = 'none';
		
	 }
	 	 
	 function pushvaluethree(lnk, title){
		var post_link_three = document.getElementById("post_link_three");
		post_link_three.value = lnk;
		
		var rp_new_field_three = document.getElementById("rp_new_field_three");
		rp_new_field_three.value = title;
		
		document.getElementById("rp_post_result_three").style.display = 'none';
		
	 }