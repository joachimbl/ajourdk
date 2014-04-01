$(document).ready(function() {
	$('#header ul ul a').focus(function() {
		$(this).closest('ul').addClass('focused');
	});
	
	$('#header ul ul a').blur(function() {
		$(this).closest('ul').removeClass('focused'); 
	});
});


// ------------------------- Nyheder --------------------------
$(document).ready(function() {
	$('.blogposts .post .content').hide();
	
	$('.blogposts .post .morelink').click( function() {
		if($(this).text() == 'Mere'){
			$(this).text('Mindre').addClass('active');
		}else{
			$(this).text('Mere').removeClass('active');
		}
		
		$(this).parent().children('.content').slideToggle('slow');
		
		return false;
	});
});

/* ------------------------- Fancybox --------------------------

$(document).ready(function() {
	
	$(".fancybox, .popup").fancybox({
		'speedIn'			:	500, 
		'speedOut'			:	200,
		'hideOnContentClick':true,
		'overlayColor'		:	'#000',
		'padding'			:	0
	});
	
});
*/


// ------------------------- TagCloud --------------------------
function rand(max){
	return Math.random() * max;
}

$(document).ready(function() { 
	$('#tagcloud li').css('fontSize', function(){
		return rand(30)+10 + 'px';
	}); 
});
