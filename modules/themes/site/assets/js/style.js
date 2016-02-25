$(document).ready(function(){
	$('#last_posts article:even').addClass('even');
	$('#last_posts article:odd').addClass('odd');
	
	$('#popular article:odd').addClass('pull-right');
	$('#person_events article:odd').addClass('pull-right');
	
	$('#person_reviews div.reviews_list div.row div.review:even').addClass('even');
	
	$('#person_reviews div.reviews_list div.row').each(function(){
		var _he1 = $('div.review:even',this).height();
		var _he2 = $('div.review:odd',this).height();
		
		var _max = Math.max(_he1, _he2);
		$('div.review',this).height(_max)
	});
	
	$('#thinks div.reviews_list div.row div.review:even').addClass('even');
	
	$('#thinks div.reviews_list div.row').each(function(){
        //var _he1 = $('div.review:even',this).height();
        //var _he2 = $('div.review:odd',this).height();
        //
        //var _max = Math.max(_he1, _he2);
        //$('div.review',this).height(_max)
	});
	
	$('#rel_events article:odd').addClass('pull-right');
	
	$('#all_reviews div.reviews_list div.row div.review:even').addClass('even');
	
	$('#all_reviews div.reviews_list div.row').each(function(){
		var _he1 = $('div.review:even',this).height();
		var _he2 = $('div.review:odd',this).height();
		
		var _max = Math.max(_he1, _he2);
		$('div.review',this).height(_max)
	});
	
	$('#recommend article:odd, #all_events article:odd').addClass('pull-right');
});//end