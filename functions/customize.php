<?php
/* WYSIWYG defaults */

/** change tinymce's paste-as-text functionality */
function paste_as_text($mceInit, $editor_id)
{
	//turn on paste_as_text by default
	//NB this has no effect on the browser's right-click context menu's paste!
	$mceInit["paste_as_text"] = true;
	return $mceInit;
}
add_filter("tiny_mce_before_init", "paste_as_text", 1, 2);

/** Set the Attachment Display Settings, This function is attached to the 'after_setup_theme' action hook. */
function default_attachment_display_setting()
{
	update_option("image_default_align", "left");
	update_option("image_default_link_type", "none");
	update_option("image_default_size", "large");
}
add_action("after_setup_theme", "default_attachment_display_setting");

// CUSTOM MENUS
function custom_menus()
{
	register_nav_menus(
		[
			"primary-menu" => __("Primary Menu"),
			"secondary-menu" => __("Secondary Menu"),
			"footer-menu" => __("Footer Menu"),
		]
	);
}
add_action("init", "custom_menus");


// Add the custom columns to the Services post type:
// add_filter( 'manage_cpt_services_posts_columns', 'set_custom_edit_cpt_services_columns' );
// function set_custom_edit_cpt_services_columns($columns) {
//     $columns['featured'] = __( 'Featured', 'your_text_domain' );
//     return $columns;
// }

// Add the data to the custom columns for the book post type:
// add_action( 'manage_cpt_services_posts_custom_column' , 'custom_cpt_services_column', 10, 2 );
// function custom_cpt_services_column( $column, $post_id ) {
// 	$column_field = 'make_this_service_featured';
//     switch ( $column ) {
// 		case 'featured' : 
// 			$post_meta = get_field($column_field,$post_id);
// 			if ($post_meta) {
// 				echo "Yes";
// 			}else {
// 				echo "No";
// 			}
// 		break;

//     }
// }


// Get Formidable Forms in a ACF filed
// function acf_load_color_field_choices( $field ) {
// 	global $wpdb;
// 	$forms = $wpdb->get_results('SELECT * FROM wp_frm_forms WHERE status="published"');
// 	$ids = array();
// 	$values = array();
// 	$i=0;
// 	if ( $forms != NULL ) {
// 		foreach($forms as $form){
// 			$ids[$i] = $form->id;
// 			$values[$i] = $form->name;
// 			$i++;
// 		}
// 		$form_assoc = array_combine($ids, $values);
// 		if( is_array($form_assoc) ){
// 			foreach( $form_assoc as $key=>$match ){
// 					$field["choices"][ $key ] = $match;
// 			}
// 		}
// 		// return the field
// 		return $field;
// 	} else {
// 		return false;
// 	}

// }

// Enter the fild key below
// add_filter("acf/load_field/key=field_5ce6e312e7c38", "acf_load_color_field_choices");



// create an ID from a user entered string and removing any unwanted symbols
function create_id($string)
{
	$new_id = preg_replace('/[^a-zA-Z]/', '', $string);
	$new_id = strtolower(str_replace(" ", "", $new_id));
	return $new_id;
}

function post_back_link()
{
	if (wp_get_referer()) {
		$prev_url = $_SERVER['HTTP_REFERER'];
		return "<a href='" . $prev_url . "' class='back-link'><svg xmlns='http://www.w3.org/2000/svg' xmlns:xlink='http://www.w3.org/1999/xlink' aria-hidden='true' focusable='false' style='-ms-transform: rotate(360deg); -webkit-transform: rotate(360deg); transform: rotate(360deg);' preserveAspectRatio='xMidYMid meet' viewBox='0 0 512 512'><path d='M216.4 163.7c5.1 5 5.1 13.3.1 18.4L155.8 243h231.3c7.1 0 12.9 5.8 12.9 13s-5.8 13-12.9 13H155.8l60.8 60.9c5 5.1 4.9 13.3-.1 18.4-5.1 5-13.2 5-18.3-.1l-82.4-83c-1.1-1.2-2-2.5-2.7-4.1-.7-1.6-1-3.3-1-5 0-3.4 1.3-6.6 3.7-9.1l82.4-83c4.9-5.2 13.1-5.3 18.2-.3z'></path><rect x='0' y='0' width='512' height='512' fill='rgba(0, 0, 0, 0)'></rect></svg></a>";
	}
}
function theme_prefix_customize_register($wp_customize)
{
	// Add support for custom colors

	$wp_customize->add_setting('text_color', array(
		'default' => '#262626', // Default text color
		'sanitize_callback' => 'sanitize_hex_color',
	));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'text_color', array(
		'label' => __('Text Color', 'theme_prefix'),
		'section' => 'colors',
	)));
	$wp_customize->add_setting('primary_color', array(
		'default' => '#4CE0D7', // Default primary color
		'sanitize_callback' => 'sanitize_hex_color',
	));

	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'primary_color', array(
		'label' => __('Primary Color', 'theme_prefix'),
		'section' => 'colors',
	)));
	$wp_customize->add_setting('secondary_color', array(
		'default' => '#BCBCBC', // Default text color
		'sanitize_callback' => 'sanitize_hex_color',
	));

	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'secondary_color', array(
		'label' => __('Secondary Color', 'theme_prefix'),
		'section' => 'colors',
	)));
	$wp_customize->add_setting('secondary_light_color', array(
		'default' => '#F2F2F2', // Default text color
		'sanitize_callback' => 'sanitize_hex_color',
	));

	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'secondary_light_color', array(
		'label' => __('Secondary Light Color', 'theme_prefix'),
		'section' => 'colors',
	)));
	$wp_customize->add_section('theme_social_links', array(
		'title' => __('Social Links', 'tumo'),
		'priority' => 30,
	));

	$social_links = array(
		'facebook' => __('Facebook', 'tumo'),
		'linkedin' => __('Linkedin', 'tumo'),
		'instagram' => __('Instagram', 'tumo'),
		// Add more social links as needed
	);

	// Loop through social links to add settings and controls
	foreach ($social_links as $key => $label) {
		// Setting for URL
		$wp_customize->add_setting($key . '_url', array(
			'default' => '',
			'sanitize_callback' => 'esc_url_raw',
		));

		// Control for URL
		$wp_customize->add_control($key . '_url', array(
			'label' => $label . ' ' . __('URL', 'tumo'),
			'section' => 'theme_social_links',
			'type' => 'text',
		));

		// Setting for Icon (Font Awesome class)
		$wp_customize->add_setting($key . '_icon', array(
			'default' => 'fab fa-' . strtolower($key), // Default icon class (Font Awesome)
			'sanitize_callback' => 'sanitize_text_field',
		));

		// Control for Icon (Font Awesome class)
		$wp_customize->add_control($key . '_icon', array(
			'label' => $label . ' ' . __('Icon', 'tumo'),
			'section' => 'theme_social_links',
			'type' => 'text',
		));
	}
}
add_action('customize_register', 'theme_prefix_customize_register');

function get_theme_social_links()
{
	$social_links = array(
		'facebook' => array(
			'url' => get_theme_mod('facebook_url', ''),
			'icon' => get_theme_mod('facebook_icon', 'fab fa-facebook-f'),
		),
		'linkedin' => array(
			'url' => get_theme_mod('linkedin_url', ''),
			'icon' => get_theme_mod('linkedin_icon', 'fab fa-linkedin-in'),
		),
		'instagram' => array(
			'url' => get_theme_mod('instagram_url', ''),
			'icon' => get_theme_mod('instagram_icon', 'fab fa-instagram'),
		),
		// Add more social links as needed
	);

	return $social_links;
}
function calculate_reading_time($post_id)
{
	// Get post object
	$post = get_post($post_id);

	// Get post content
	$content = $post->post_content;

	// Calculate word count
	$word_count = str_word_count(strip_tags($content));

	// Average reading speed (words per minute)
	$words_per_minute = 200; // Adjust this value as needed

	// Calculate reading time in minutes
	$reading_time_minutes = ceil($word_count / $words_per_minute);

	// Estimated reading time formatted
	$reading_time = sprintf(_n('%d min read', '%d min read', $reading_time_minutes, 'tumo'), $reading_time_minutes);

	return $reading_time;
}
add_filter('get_the_archive_title', function ($title) {
	if (is_category()) {
		$title = single_cat_title('', false); // Get the category name without "Category: "
	} elseif (is_tag()) {
		$title = single_tag_title('', false); // Get the tag name without "Tag: "
	} elseif (is_tax()) {
		$title = single_term_title('', false); // Get the custom taxonomy term name without "Taxonomy: "
	} elseif (is_author()) {
		$title = '<span class="vcard">' . get_the_author() . '</span>'; // Get the author name for author archives
	} elseif (is_post_type_archive()) {
		$title = post_type_archive_title('', false); // Get the custom post type archive title
	} elseif (is_year()) {
		$title = get_the_date('Y'); // Get the year for yearly archives
	} elseif (is_month()) {
		$title = get_the_date('F Y'); // Get the month and year for monthly archives
	} elseif (is_day()) {
		$title = get_the_date('F j, Y'); // Get the day, month, and year for daily archives
	}

	return $title;
});
function custom_pagination($query = null, $args = array())
{
	global $wp_query;

	// Backup main query object and reset current query with custom query
	$backup_query = $wp_query;
	$wp_query = $query;

	$defaults = array(
		'prev_text'          => __('&laquo;', 'tumo'),
		'next_text'          => __('&raquo;', 'tumo'),
		'before_page_number' => '<span class="meta-nav screen-reader-text">' . __('Page', 'tumo') . ' </span>',
		'show_end'           => true, // Whether to show first and last page links
		'range'              => 3,    // How many pages to show before and after the current page
		'mid_size'           => 1,    // How many numbers to either side of current page, plus current page link
		'echo'               => true, // Whether to display the output or return it
	);

	$args = wp_parse_args($args, $defaults);
	$args = apply_filters('custom_pagination_args', $args);

	$paginate_links = paginate_links(array(
		'total'     => $query->max_num_pages,
		'current'   => max(1, get_query_var('paged')),
		'prev_text' => $args['prev_text'],
		'next_text' => $args['next_text'],
		'type'      => 'array',
	));

	if ($paginate_links) {
		$pagination = '<nav class="pagination">';
		foreach ($paginate_links as $link) {
			$pagination .= '<span >' . $link . '</span>';
		}
		$pagination .= '</nav>';

		if ($args['echo']) {
			echo $pagination;
		} else {
			return $pagination;
		}
	}

	// Restore original query object
	$wp_query = $backup_query;
}

function theme_register_footer_social_sidebar()
{
	register_sidebar(array(
		'name'          => __('Footer Social Sidebar', 'textdomain'),
		'id'            => 'footer-social-sidebar',
		'description'   => __('Add social icons for footer here.', 'textdomain'),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	));
}
add_action('widgets_init', 'theme_register_footer_social_sidebar');
