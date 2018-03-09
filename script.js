jQuery(document).ready(function($){
    $("#rlic_tareqanwar_new_field_one").keyup(function(){
		  txt = $(this).val();
      
		  data = {
			  			action : "rlic_tareqanwar_search_posts",
						rlic_tareqanwar_nonce: rlic_tareqanwar_vars.rlic_tareqanwar_nonce,
						suggest: txt,
						num: "one"
				};
		  $.post(ajaxurl,data,function(response){
		 	$(".rlic_tareqanwar_post_result_one").show();
			$(".rlic_tareqanwar_post_result_one").html(response);
				 
		  });
	 });

    $("#rlic_tareqanwar_new_field_two").keyup(function(){
		  txt = $(this).val();	 
		  data = {
			  			action : "rlic_tareqanwar_search_posts",
						rlic_tareqanwar_nonce: rlic_tareqanwar_vars.rlic_tareqanwar_nonce,
						suggest: txt,
						num: "two"
				};
		  $.post(ajaxurl,data,function(response){
		 	$(".rlic_tareqanwar_post_result_two").show();
			$(".rlic_tareqanwar_post_result_two").html(response);
		  });
	 });

    $("#rlic_tareqanwar_new_field_three").keyup(function(){
		  txt = $(this).val();	 
		  data = {
			  			action : "rlic_tareqanwar_search_posts",
						rlic_tareqanwar_nonce: rlic_tareqanwar_vars.rlic_tareqanwar_nonce,
						suggest: txt,
						num: "three"
				};
		  $.post(ajaxurl,data,function(response){
		 	$(".rlic_tareqanwar_post_result_three").show();
			$(".rlic_tareqanwar_post_result_three").html(response);
		  });
	 });
	 
});
	 
	 function rlic_tareqanwar_pushvalueone(lnk, title){
		var rlic_tareqanwar_post_link_one = document.getElementById("rlic_tareqanwar_post_link_one");
		rlic_tareqanwar_post_link_one.value = lnk;
		
		var rlic_tareqanwar_new_field_one = document.getElementById("rlic_tareqanwar_new_field_one");
		rlic_tareqanwar_new_field_one.value = title;
		
		document.getElementById("rlic_tareqanwar_post_result_one").style.display = 'none';
		
	 }
	 
	 function rlic_tareqanwar_pushvaluetwo(lnk, title){
		var rlic_tareqanwar_post_link_two = document.getElementById("rlic_tareqanwar_post_link_two");
		rlic_tareqanwar_post_link_two.value = lnk;
		
		var rlic_tareqanwar_new_field_two = document.getElementById("rlic_tareqanwar_new_field_two");
		rlic_tareqanwar_new_field_two.value = title;
		
		document.getElementById("rlic_tareqanwar_post_result_two").style.display = 'none';
		
	 }
	 	 
	 function rlic_tareqanwar_pushvaluethree(lnk, title){
		var rlic_tareqanwar_post_link_three = document.getElementById("rlic_tareqanwar_post_link_three");
		rlic_tareqanwar_post_link_three.value = lnk;
		
		var rlic_tareqanwar_new_field_three = document.getElementById("rlic_tareqanwar_new_field_three");
		rlic_tareqanwar_new_field_three.value = title;
		
		document.getElementById("rlic_tareqanwar_post_result_three").style.display = 'none';
		
	 }