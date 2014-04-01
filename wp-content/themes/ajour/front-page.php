<?php define("QUICK_CACHE_ALLOWED", false);  ?>

<?php get_header(); ?>

<style>
	body{
		background-image: url(/wp-content/themes/ajour/images/new-heights-pattern.jpg);
	}
	#header{
		margin: 0;
	}
	#banner-holder{
		height: 510px;
		box-sizing: border-box;
		margin-bottom: 50px;
	}
	
	#banner{
		left: 0;
		top: 70px;
		height: 510px;
		position: absolute;
		width: 100%;
		box-sizing: border-box;
		background: url(/wp-content/themes/ajour/images/new-heights-banner.jpg) no-repeat bottom center;
		margin-bottom: 50px;
		z-index: 0;
	}
	
	#banner-width{
		width: 890px;
		margin: auto;
	}
	
	#video-cta{
		display: block;
		margin-top: 100px;
		background: url(/wp-content/themes/ajour/images/helt-ny-hoejde.png) no-repeat top left;
		width: 478px;
		line-height: 92px;
		padding: 0;
		float: right;
		text-indent: -9999px;
	}
	#video-cta:hover{
		box-shadow: none;
		background-position: bottom left;
	}
	
	#form-cta{
		float: right;
		clear: both;
		margin-top: 170px;
	}
	
	#form-cta h2{
		text-indent: -9999px;
		box-sizing: border-box;
		line-height: 25px;
		background: url(/wp-content/themes/ajour/images/form-cta.png) no-repeat top left;
	}
	
	#form-cta input[type="text"]{
		width: 223px;
		height: 45px;
		box-sizing: border-box;
		padding: 5px 15px;
		background: url(/wp-content/themes/ajour/images/form-cta.png) no-repeat bottom left;
		outline: none;
		border: none;
		color: #fff;
		text-transform: uppercase;
		font-size: 15px;
		margin: 0 12px 0 0;
	}
	
	#form-cta input[type="submit"]{
		width: 47px;
		height: 45px;
		box-sizing: border-box;
		background: url(/wp-content/themes/ajour/images/form-cta.png) no-repeat bottom right;
		border: 0;
		padding: 16px;
		cursor: pointer;
	}
	
	::-webkit-input-placeholder {
	   color: #fff;
	   text-transform: capitalize;
	   font-size: 15px;
	}
	
	::-moz-placeholder {
	   color: #fff;  
	}
	
	:-ms-input-placeholder {  
	   color: #fff;  
	}
	
	
	.sub-menu{
		z-index: 2;
	}
	
	/*
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
	*/
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

@media only screen and (max-width: 960px) { 
	body{
		background-image: none;
	}
	
	#banner,
	#banner-holder{
		display: none;
	}
}
	
</style>

<div id="banner-holder">&nbsp;</div>

<div id="banner">
	<div id="banner-width">
		<a id="video-cta" title="Kassesystem - Webshop - E-conomic" href="http://ajour.dk/wp-content/uploads/2012/08/Webshopintegration.mp4">POINT OF SALE - I en helt ny højde</a>
		<form id="form-cta" method="post" action="/demo">
			<h2>F&aring; mere information</h2>
			<input type="text" name="cf_mail" placeholder="E-mail ..." value="" />
			<input type="submit" value="" />
		</form>
	</div>	
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

<div class="only-mobile hidden">
	<?php the_post(); the_content(); ?>
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