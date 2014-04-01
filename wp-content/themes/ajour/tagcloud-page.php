<?php /* Template Name: Tag Cloud */ ?>
<?php get_header(); ?>

<?php breadcrumbs(); ?>

<div id="tagcloud">
	<?php the_post(); the_content(); ?>
</div>

<?php get_footer(); ?>