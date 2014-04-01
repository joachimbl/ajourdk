<?php include_once("my-functions.php");

	if($_SERVER['HTTP_HOST'] == 'm.ajour.dk'){
		header('Location: http://ajour.dk' . $_SERVER['REQUEST_URI']);
	}

	add_theme_support( 'post-thumbnails', array( 'post' ) );
	set_post_thumbnail_size( 610, 150, true );
	
	add_editor_style('editor-style.css');
	
	function new_excerpt_length(){
		return 160;
	}
	add_filter('excerpt_length', 'new_excerpt_length');
	
	// Fjern title fra wp_page_menu
	function my_nav_notitle( $menu ){
		return $menu = preg_replace('/ title=\"(.*?)\"/', '', $menu );
	}
	add_filter( 'wp_page_menu', 'my_nav_notitle' );
	
	// Tilføj hovedmenu
	/*
	function register_menus() {
		register_nav_menus(array('main-menu' => __( 'Hovedmenu' )));
	}
	add_action( 'init', 'register_menus' );
	*/
	
	register_nav_menu( 'main-menu', __( 'Hovedmenu' ) );
	
	
	// Registrer sidebars
	if(function_exists('register_sidebar')){
		register_sidebar(array(
			'name' 				=> 'Footer (1 af 4)',
			'before_widget'		=> '',
			'after_widget'		=> '',
			'before_title'		=> '<h2>',
			'after_title'		=> '</h2>',
		));
		
		register_sidebar(array(
			'name' 				=> 'Footer (2 af 4)',
			'before_widget'		=> '',
			'after_widget'		=> '',
			'before_title'		=> '<h2>',
			'after_title'		=> '</h2>',
		));
		
		register_sidebar(array(
			'name' 				=> 'Footer (3 af 4)',
			'before_widget'		=> '',
			'after_widget'		=> '',
			'before_title'		=> '<h2>',
			'after_title'		=> '</h2>',
		));
		
		register_sidebar(array(
			'name' 				=> 'Footer (4 af 4)',
			'before_widget'		=> '',
			'after_widget'		=> '',
			'before_title'		=> '<h2>',
			'after_title'		=> '</h2>',
		));
		
		register_sidebar(array(
			'name' 				=> 'Nyheder',
			'before_widget'		=> '<div class="whitebox">',
			'after_widget'		=> '</div>',
			'before_title'		=> '<h2>',
			'after_title'		=> '</h2>',
		));
	}
	
	// Echo undersider
	function child_pages(){
		global $post;
		if($post->post_parent){
			$children = wp_list_pages('title_li=&child_of=' . $post->post_parent . '&echo=0');
		}
		else{
			$children = wp_list_pages('title_li=&child_of=' . $post->ID . '&echo=0');
		}
		
		if ($children) {
			echo "<h2>" . get_the_title($post->post_parent) . "</h2>";
			echo "<ul>" . $children . "</ul>";
		}	
	}
	
	// Udskriv meta-beskrivelse
	function meta_description(){
		global $post;
		
		function output($description){
			echo "<meta name=\"description\" content=\"" . stripout($description) . "\" />";
		}
		
		if(get_post_meta($post->ID, 'beskrivelse', true)){
			output(get_post_meta($post->ID, 'beskrivelse', true));
		}
		elseif(get_the_excerpt()){
			output(get_the_excerpt());
		}
	}
	
	// Definer sidetitel
	function page_title(){
		global $post;
		
		echo "<title>";
		
		if(get_post_meta($post->ID, 'titel', true)){
			echo stripout(get_post_meta($post->ID, 'titel', true));
		}
		elseif( is_home() || is_front_page() ){
			bloginfo( 'name' );
		}
		else{
			wp_title( '|', true, 'right' );
			bloginfo( 'name' );
		}
		
		echo "</title>";
	}
	
	
	// Individuel CSS
	function css(){
		global $post;
		
		if(get_post_meta($post->ID, 'css', true)){
			echo '<style media="screen and (min-width: 960px)" type="text/css">';
			echo get_post_meta($post->ID, 'css', true);
			echo '</style>';
			
			echo '<!--[if lt IE 9]>';
			echo '<style media="screen" type="text/css">';
			echo get_post_meta($post->ID, 'css', true);
			echo '</style>';
			echo '<![endif]-->';
		}
	}
	
	// Individuel JS
	function js(){
		global $post;
		
		if(get_post_meta($post->ID, 'js', true)){
			echo '<script type="text/javascript">';
			echo get_post_meta($post->ID, 'js', true);
			echo '</script>';
		}
	}
	
	// URL til post's thumbnail
	function post_thumbnail_url(){
		global $post;
		$domsxe = simplexml_load_string(get_the_post_thumbnail($post->ID, 'thumbnail'));
		$thumbnailsrc = $domsxe->attributes()->src;
		echo $thumbnailsrc;
	}
	
	// Gør get_permalink relativ
	function root_relative_permalinks($input) {
		return preg_replace('!http(s)?://' . $_SERVER['SERVER_NAME'] . '/!', '/', $input);
	}
	
	add_filter( 'the_permalink', 'root_relative_permalinks' );
	add_filter( 'page_link', 'root_relative_permalinks' );

	
	// Breadcrumbs
	function breadcrumbs() {
	 
		$delimiter = '&raquo;';
		$home = 'Hjem';
		$before = '<span class="current">'; // tag before the current crumb
		$after = '</span>'; // tag after the current crumb
		$container_start = '<div id="breadcrumbs">';
		$container_end = '</div>';
	 
		if ( !is_home() && !is_front_page() || is_paged() ) {
	 
			echo $container_start;
	 
			global $post;
			$homeLink = get_bloginfo('url');
			echo '<a href="' . $homeLink . '">' . $home . '</a> ' . $delimiter . ' ';
	 
			if ( is_category() ) {
				global $wp_query;
				$cat_obj = $wp_query->get_queried_object();
				$thisCat = $cat_obj->term_id;
				$thisCat = get_category($thisCat);
				$parentCat = get_category($thisCat->parent);
				if ($thisCat->parent != 0) echo(get_category_parents($parentCat, TRUE, ' ' . $delimiter . ' '));
				echo $before . 'Archive by category "' . single_cat_title('', false) . '"' . $after;
	 
			} elseif ( is_day() ) {
				echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
				echo '<a href="' . get_month_link(get_the_time('Y'),get_the_time('m')) . '">' . get_the_time('F') . '</a> ' . $delimiter . ' ';
				echo $before . get_the_time('d') . $after;
	 
			} elseif ( is_month() ) {
				echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
				echo $before . get_the_time('F') . $after;
	 
			} elseif ( is_year() ) {
				echo $before . get_the_time('Y') . $after;
	 
			} elseif ( is_single() && !is_attachment() ) {
				if ( get_post_type() != 'post' ) {
					$post_type = get_post_type_object(get_post_type());
					$slug = $post_type->rewrite;
					echo '<a href="' . $homeLink . '/' . $slug['slug'] . '/">' . $post_type->labels->singular_name . '</a> ' . $delimiter . ' ';
					echo $before . get_the_title() . $after;
				} else {
					$cat = get_the_category(); $cat = $cat[0];
					echo get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
					echo $before . get_the_title() . $after;
				}
	 
			} elseif ( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() ) {
				$post_type = get_post_type_object(get_post_type());
				echo $before . $post_type->labels->singular_name . $after;
	 
			} elseif ( is_attachment() ) {
				$parent = get_post($post->post_parent);
				$cat = get_the_category($parent->ID); $cat = $cat[0];
				echo get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
				echo '<a href="' . get_permalink($parent) . '">' . $parent->post_title . '</a> ' . $delimiter . ' ';
				echo $before . get_the_title() . $after;
	 
			} elseif ( is_page() && !$post->post_parent ) {
				echo $before . get_the_title() . $after;
	 
			} elseif ( is_page() && $post->post_parent ) {
				$parent_id	= $post->post_parent;
				$breadcrumbs = array();
				while ($parent_id) {
					$page = get_page($parent_id);
					$breadcrumbs[] = '<a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a>';
					$parent_id	= $page->post_parent;
				}
				$breadcrumbs = array_reverse($breadcrumbs);
				foreach ($breadcrumbs as $crumb) echo $crumb . ' ' . $delimiter . ' ';
				echo $before . get_the_title() . $after;
	 
			} elseif ( is_search() ) {
				echo $before . 'Search results for "' . get_search_query() . '"' . $after;
	 
			} elseif ( is_tag() ) {
				echo $before . 'Posts tagged "' . single_tag_title('', false) . '"' . $after;
	 
			} elseif ( is_author() ) {
				 global $author;
				$userdata = get_userdata($author);
				echo $before . 'Articles posted by ' . $userdata->display_name . $after;
	 
			} elseif ( is_404() ) {
				echo $before . 'Error 404' . $after;
			}
	 
			if ( get_query_var('paged') ) {
				if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ' (';
				echo __('Page') . ' ' . get_query_var('paged');
				if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ')';
			}
	 
			echo $container_end;
	 
		}
	}
	
	// Admin interface
	
	// admin options menu
	add_action('admin_menu', 'my_admin_menu');
	function my_admin_menu() {
		add_options_page(
			'Ajour indstillinger', 		// title on page
			'Ajour', 						// title in menu
			'manage_options', 			// rights required
			'my_page', 						// url
			'my_admin_page'				// callback function
		);
	}
	
	// admin options page
	function my_admin_page() {
		?>
		<div class="wrap">
		<h2>Ajour indstillinger</h2>
		<form action="options.php" method="post">
		<?php settings_fields('my_options'); ?>
		<?php do_settings_sections('my_page'); ?>
		<p class="submit"><input class="button-primary" name="submit" type="submit" value="<?php esc_attr_e('Save Changes'); ?>" /></p>
		</form>
		</div>
		<?php
	}
	
	// Init
	add_action('admin_init', 'my_admin_init');
	function my_admin_init(){
		
		register_setting(
			'my_options',					// group name = settings_fields()
			'my_option'						// option name
		);
		
		// add section
		add_settings_section(
			'my_section', 					// unique id
			'Basis indstillinger', 		// Section title
			'my_section_text', 			// callback function
			'my_page'						// url
		);
		function my_section_text() {
			echo '<p>Indstillinger specifikt til Ajour\'s tema.</p>'; 
		}
		
		/* Input types
		function textarea() {
			$options = get_option( 'my_option' );
			echo "<textarea name='my_option[text_area]' style='width:600px; height: 120px;' type='textarea'>{$options['text_area']}</textarea>";
		}
		function input() {
			$options = get_option('my_option');
			echo "<input name='my_option[text_string]' style='width:300px;' type='text' value='{$options['text_string']}' />";
		}
		function checkbox() {
			$options = get_option('my_option');
			if($options['chkbox1']) { $checked = ' checked="checked" '; }
			echo "<input ".$checked." name='my_option[chkbox1]' type='checkbox' />";
		}
		*/
				
		// fields
		add_settings_field(
			'analytics',					// id
			'Google Analytics kode',	// setting title
			'textarea_analytics',		// display callback
			'my_page',						// settings page
			'my_section'					// settings section
		);
		function textarea_analytics() {
			$options = get_option( 'my_option' );
			echo "<textarea name='my_option[analytics]' style='width:600px; height: 120px;' type='textarea'>{$options['analytics']}</textarea>";
		}

		// add section
		add_settings_section(
			'my_support_section', 		// unique id
			'Support-side', 				// Section title
			'my_support_section_text', // callback function
			'my_page'						// url
		);
		function my_support_section_text() {
			//echo '<p>Indstillinger til Support-siden.</p>'; 
		}
		
		// fields
		
		add_settings_field(
			'financemail',					// id
			'Finans Support Mail',		// setting title
			'input_financemail',			// display callback
			'my_page',						// settings page
			'my_support_section'			// settings section
		);
		function input_financemail() {
			$options = get_option('my_option');
			echo "<input name='my_option[financemail]' style='width:300px;' type='text' value='{$options['financemail']}' />";
		}
		
		add_settings_field(
			'techmail',						// id
			'Teknisk Support Mail',		// setting title
			'input_techmail',				// display callback
			'my_page',						// settings page
			'my_support_section'			// settings section
		);
		function input_techmail() {
			$options = get_option('my_option');
			echo "<input name='my_option[techmail]' style='width:300px;' type='text' value='{$options['techmail']}' />";
		}
		
		add_settings_field(
			'msg_to_customer',			// id
			'Kvittering p&aring; mail',// setting title
			'textarea_msg_to_customer',// display callback
			'my_page',						// settings page
			'my_support_section'			// settings section
		);
		
		function textarea_msg_to_customer() {
			$options = get_option( 'my_option' );
			echo "<span style='color:gray;'>Hej (kundens navn)</span><br/><textarea name='my_option[msg_to_customer]' style='width:600px; height: 100px;' type='textarea'>{$options['msg_to_customer']}</textarea><br/><span style='color:gray;'>Fortsat go' dag!<br/>Med venlig hilsen<br/>Ajour</span>";
		}
		
		add_settings_field(
			'sms_to_customer',			// id
			'Kvittering p&aring; SMS',	// setting title
			'textarea_sms_to_customer',// display callback
			'my_page',						// settings page
			'my_support_section'			// settings section
		);
		
		function textarea_sms_to_customer() {
			$options = get_option( 'my_option' );
			echo "<span style='color:gray;'>Hej (kundens navn),</span><br/><textarea name='my_option[sms_to_customer]' style='width:600px; height: 50px;' type='textarea'>{$options['sms_to_customer']}</textarea><br/><span style='color:gray;'>Fortsat go' dag!<br/>- Ajour</span>";
		}
		
		// add section
		add_settings_section(
			'my_demo_section', 			// unique id
			'Bestil demonstration-side',// Section title
			'my_demo_section_text', 	// callback function
			'my_page'						// url
		);
		function my_demo_section_text() {
			//echo '<p>Indstillinger til Support-siden.</p>'; 
		}
		
		add_settings_field(
			'demomail',						// id
			'Demo Mail',					// setting title
			'input_demomail',				// display callback
			'my_page',						// settings page
			'my_demo_section'				// settings section
		);
		function input_demomail() {
			$options = get_option('my_option');
			echo "<input name='my_option[demomail]' style='width:300px;' type='text' value='{$options['demomail']}' />";
		}
		
		add_settings_field(
			'msg_preset',						// id
			'Bestillingstekst',				// setting title
			'textarea_msg_preset',			// display callback
			'my_page',							// settings page
			'my_demo_section'					// settings section
		);
		function textarea_msg_preset() {
			$options = get_option( 'my_option' );
			echo "<textarea name='my_option[msg_preset]' style='width:600px; height: 100px;' type='textarea'>{$options['msg_preset']}</textarea>";
		}
		
		add_settings_field(
			'msg_to_democustomer',			// id
			'Kvittering p&aring; mail',	// setting title
			'textarea_msg_to_democustomer',// display callback
			'my_page',							// settings page
			'my_demo_section'					// settings section
		);
		function textarea_msg_to_democustomer() {
			$options = get_option( 'my_option' );
			echo "<span style='color:gray;'>Hej (kundens navn)</span><br/><textarea name='my_option[msg_to_democustomer]' style='width:600px; height: 100px;' type='textarea'>{$options['msg_to_democustomer']}</textarea><br/><span style='color:gray;'>Fortsat go' dag!<br/>Med venlig hilsen<br/>Ajour</span>";
		}
		
		add_settings_field(
			'sms_to_democustomer',			// id
			'Kvittering p&aring; SMS',		// setting title
			'textarea_sms_to_democustomer',// display callback
			'my_page',							// settings page
			'my_demo_section'					// settings section
		);
		
		function textarea_sms_to_democustomer() {
			$options = get_option( 'my_option' );
			echo "<span style='color:gray;'>Hej (kundens navn),</span><br/><textarea name='my_option[sms_to_democustomer]' style='width:600px; height: 50px;' type='textarea'>{$options['sms_to_democustomer']}</textarea><br/><span style='color:gray;'>Fortsat go' dag!<br/>- Ajour</span>";
		}
	
	}
	
	function get_field($name){
		$options = get_option( 'my_option' );
		return $options[$name];
	}
	
	
		
		
		
		
		
		
		
		
		
		
		
		