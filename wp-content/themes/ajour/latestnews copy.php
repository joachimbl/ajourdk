<?php define("QUICK_CACHE_ALLOWED", false);  ?>
<?php
	require_once( "../../../wp-config.php" );

	$args = array(
    'numberposts' => 1,
    'offset' => 0,
    'category' => 0,
    'orderby' => 'post_date',
    'order' => 'DESC',
    'include' => '',
    'exclude' => '',
    'meta_key' => '',
    'meta_value' => '',
    'post_type' => 'post',
    'post_status' => 'publish',
    'suppress_filters' => true );
    
	$recent_posts = wp_get_recent_posts($args);
	
	foreach( $recent_posts as $post ){
		
		$permalink = get_permalink($post["ID"]);
		$title = $post["post_title"];
		$excerpt = $post['post_excerpt'];
		$content = $post['post_content'];
	}
	
	if(strlen($excerpt) < 30){
		$excerpt = $content;
	}
	
	(strlen($title) > 20 ? $std_length = 45 : $std_length = 70);
	
	
	
	echo '<h2 class="latestnews"><a href="' . $permalink . '">' . $title .'</a></h2>';
	echo '<p class="latestnews">' . cut_text($excerpt, $std_length, ' ', ' […]') . '</p>';
?>