<?php get_header(); ?>

<?php //the_post(); the_content(); ?>

<style>
	body{
		background-image: url(/wp-content/themes/ajour/images/bokeh-back-color.jpg);
	}
	#header{
		margin: 0;
	}
	#banner{
		height: 510px; 
		box-sizing: border-box;
		background: url(/wp-content/themes/ajour/images/onsite/banner-toccare.jpg) no-repeat bottom center;
		margin-bottom: 50px;
	}
	/
	#banner h1,
	#banner h2{
		color: #fff;
		text-shadow:0 15px 30px rgba(0, 29, 44, 1);
	}
	#banner h1{
		font-size: 50px;
		padding: 90px 0 0 0;
	}
	#banner h2{
		font-size: 40px;
	}
	#banner h1 strong{
		font-weight: bold;
	}
	#banner .dark-button{
		margin: 15px 0 0 0;
	}
	.box1{
		min-height:149px;
	}
	.box2{
		min-height:149px;
	}
	.box2 img{
		margin: -2px 40px -70px -19px;
	}
	.box3 h2{
		margin:20px 0 0 20px;
	}
	
	#ipad2{
		margin: 0;
		padding:0;
		line-height:0;
}
	
</style>

<div id="banner">
	<h1>Integration til <strong>webshop</strong> og <span style="font-family: AjourBold, Verdana, Arial, 'Helvetica Neue';">e-conomic</span></h1>
	<a class="dark-button" title="Kassesystem - Webshop - E-conomic" href="http://ajour.dk/wp-content/uploads/2012/08/Webshopintegration.mp4">Se hvordan</a>
	
	</div>
	<div id="latestnews" class="grid4 whitebox box1 float-left margin-right notmobile">
	<h2>Webshop integration</h2>
	&nbsp;
	<h2></h2>
	</div>
	<div class="grid4 whitebox box2 float-left margin-right notmobile">
	<h2><strong><span style="font-family: Ajour, Verdana, Arial, 'Helvetica Neue';">Stilren </span>Detailløsning</strong></h2>
	<img src="/wp-content/uploads/2011/05/sort-toccare.png" alt="Stor skærm" /><a class="light-button round" title="integration til e-conomic og webshop" href="http://ajour.dk/kassesystemer/detail">›</a>
	
	</div>
	<div class="grid4 box3 float-left clear-right notmobile"><a id="ipad2" href="/leverer/ipad"><img class="size-full wp-image-402" src="/wp-content/uploads/2011/05/ipad2.jpg" alt="" width="290" height="255" /></a></div>
	<div class="tooltip hidden grid4 notmobile">
	<h2><strong>Håndholdt</strong> terminal</h2>
	eller blot <strong>overblik på farten</strong>!

</div>

<script>
	$(document).ready(function(){
		$('#ipad2').tooltip({ 
			effect: 'slide',
			offset: [70, 0]
		});
		
		$.ajax({
			url: 'wp-content/themes/ajour/latestnews.php',
			success: function(data){
				$('#latestnews').html(data).cycle({
					speed:		300,
					pause:		true,							
					timeout:	4000
				});
			}
		});			
	});
</script>

<?php get_footer(); ?>