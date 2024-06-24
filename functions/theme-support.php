<?php
function blank_widgets_init()
{
	// Area 1, located at the top of the sidebar.
	register_sidebar([
		'name' => 'Sidebar',
		'id' => 'sidebar',
		'before_widget' => '<div id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	]);
}
add_action("widgets_init", "blank_widgets_init");
add_theme_support('custom-logo');
/* Add Thumbnail Support */
add_theme_support("post-thumbnails");
add_image_size("full-slider", 1920, 1080, true); //(width, height, crop)

/* custom read more and excerpt heigh. 
 * usage: echo my_excerpts(20, $post) or echo my_excerpts(20)
 * or use wp_trim_words() @ https://developer.wordpress.org/reference/functions/wp_trim_words/
 */
function custom_excerpt($excerpt_length, $content = false)
{
	global $post;
	$mycontent = $post->post_excerpt;
	$link = $post->guid;

	$mycontent = __($post->post_content);
	$mycontent = strip_shortcodes($mycontent);
	$mycontent = str_replace("]]>", "]]&gt;", $mycontent);
	$mycontent = strip_tags($mycontent);
	$words = explode(" ", $mycontent, $excerpt_length + 1);
	if (count($words) > $excerpt_length) :
		array_pop($words);
		array_push($words, "...");
		$mycontent = implode(" ", $words);
	endif;

	// Make sure to return the content
	return $mycontent;
}
