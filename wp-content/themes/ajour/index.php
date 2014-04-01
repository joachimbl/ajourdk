<?php get_header(); ?>

<div class="grid8 blogposts float-left margin-right">
	<?php while ( have_posts() ) : the_post(); ?>
		<div class="post margin-bottom">
			<?php if ( has_post_thumbnail() ) : ?>
				<div class="thumbnail rounded margin-bottom" style="background-image:url(<?php post_thumbnail_url(); ?>);">&nbsp;</div>
			<?php else : ?>
				<div class="thumbnail blank rounded margin-bottom">&nbsp;</div>
			<?php endif; ?>
			<h2><?php the_title(); ?></h2>
			<?php
				$excerpt = false;
				$excerpt = $post->post_excerpt;
				
				if($excerpt){
					echo "<div class=\"excerpt\">";
					the_excerpt();
					echo "</div>";
					echo "<div class=\"content\">";
					the_content();
					echo "</div>";
				}
				else{
					$excerpt = cut_text(get_the_content(), 160, ". ", ".");
					$excerpt_length = strlen($excerpt);
					$content = substr(get_the_content(), $excerpt_length);
					
					echo "<div class=\"excerpt\">";
					echo wpautop(stripout($excerpt));
					echo "</div>";
					echo "<div class=\"content\">";
					echo wpautop($content);
					echo "</div>";
				}
			?>
			<a class="morelink light-button grid1" href="<?php the_permalink(); ?>">Mere</a>
			
		</div>
	<?php endwhile; ?>
	
	<?php 
		$link = get_next_posts_link();
		if(extract_url_from_html($link)){
			echo "<div class=\"text-center\">";
			echo "<a href=\"" . extract_url_from_html($link) . "\" class=\"light-button round\">+</a>";
			echo "</div>";
		}
	?>
</div>

<div class="grid4 float-left widgets notmobile">
	<?php dynamic_sidebar('Nyheder'); ?>
</div>

<?php get_footer(); ?>