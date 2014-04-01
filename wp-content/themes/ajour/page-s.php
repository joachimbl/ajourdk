<?php	echo get_field('analytics'); ?>

<script type="text/javascript">
	window.onload=function(){
		window.location = 'http://m.ajour.dk';
	}
</script>

<?php the_post(); the_content(); ?>