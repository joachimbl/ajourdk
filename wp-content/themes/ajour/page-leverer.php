<?php get_header(); ?>
<?php breadcrumbs(); ?>

<div id="productpage">
<div id="productbar" class="rounded">
	<a class="margin-right" href="<?php echo get_permalink(759); ?>"><img src="/wp-content/uploads/2011/03/product_toccare.png" alt="<?php echo get_the_title(759); ?>" /></a><div class="tooltip hidden grid3 notmobile"><h2><?php echo get_the_title(759); ?></h2></div><a class="margin-right" href="<?php echo get_permalink(761); ?>"><img src="/wp-content/uploads/2011/03/product_integrato.png" alt="<?php echo get_the_title(761); ?>" /></a><div class="tooltip hidden grid3 notmobile"><h2><?php echo get_the_title(761); ?></h2></div><a class="margin-right" href="<?php echo get_permalink(765); ?>"><img src="/wp-content/uploads/2011/03/product_ipad.png" alt="<?php echo get_the_title(765); ?>" /></a><div class="tooltip hidden grid3 notmobile"><h2><?php echo get_the_title(765); ?></h2></div><a href="<?php echo get_permalink(763); ?>"><img src="/wp-content/uploads/2011/03/product_ipod.png" alt="<?php echo get_the_title(763); ?>" /></a><div class="tooltip hidden grid3 notmobile"><h2><?php echo get_the_title(763); ?></h2></div>
</div>

<a href="/leverer/tilbehoer" class="grid6 whitebox margin-top float-left">
	<img src="/wp-content/uploads/2011/03/product_tilbehoer.png" alt="Tilbehør" />
	<h2>Tilbeh&oslash;r</h2>
</a>
<a href="/leverer/funktionalitet" class="grid6 whitebox margin-top float-right clear-right">
	<img src="/wp-content/uploads/2011/03/product_funktioner.png" alt="Funktioner" />
	<h2>Funktioner</h2>
</a>
</div>

<div class="clear margin-top float-left">
	<?php the_post(); the_content(); ?>
</div>

<?php get_footer(); ?>