<?php /* Template Name: Opstillede undersider */ ?>
<?php get_header(); ?>

<div id="subpages">

	<?php
		$subpages = get_pages( array( 'child_of' => $post->ID, 'sort_column' => 'menu_order' ) );
	
		foreach( $subpages as $page ) {
			?>
			<a href="<?php echo get_page_link( $page->ID ); ?>" class="grid4 float-left margin-right margin-bottom rounded subpage"><?php echo $page->post_title; ?></a>
			<?php
		}	
	?>

</div>

<div class="margin-top clear">
	<?php the_post(); the_content(); ?>
</div>

<?php get_footer(); ?>

