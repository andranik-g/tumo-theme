<?php // Reboot!
add_action('after_setup_theme', 'reboot');

function reboot() {
  // launching operation cleanup
  add_action('init', 'head_cleanup');

  // A better title
  add_filter('wp_title', 'rw_title', 10, 3);

  // remove WP version from RSS
  add_filter('the_generator', 'remove_rss_version');

  // remove pesky injected css for recent comments widget
  add_filter('wp_head', 'remove_wp_widget_recent_comments_style', 1);

  // clean up comment styles in the head
  add_action('wp_head', 'remove_recent_comments_style', 1);

  // clean up gallery output in wp
  add_filter('gallery_style', 'remove_gallery_style');

  // cleaning up random code around images
  add_filter('the_content', 'filter_ptags_on_images');

  // cleaning up excerpt
  add_filter('excerpt_more', 'excerpt_more');
}

/*********************************
WP_HEAD Cleanup
**********************************/

function head_cleanup() {
  // Remove title
  remove_action('wp_head', '_wp_render_title_tag', 1);

  // category feeds
  remove_action('wp_head', 'feed_links_extra', 3);

  // post and comment feeds
  remove_action('wp_head', 'feed_links', 2);

  // EditURI link
  remove_action('wp_head', 'rsd_link');

  // windows live writer
  remove_action('wp_head', 'wlwmanifest_link');

  // previous link
  remove_action('wp_head', 'parent_post_rel_link', 10, 0);

  // start link
  remove_action('wp_head', 'start_post_rel_link', 10, 0);

  // links for adjacent posts
  remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);

  // WP version
  remove_action('wp_head', 'wp_generator');

  // remove WP version from css
  add_filter('style_loader_src', 'remove_wp_ver_css_js', 9999);

  // remove WP version from scripts
  add_filter('script_loader_src', 'remove_wp_ver_css_js', 9999);
}

/* end template head cleanup */


/*********************************
Remove WP versions
**********************************/
//Remove WP version from RSS
function remove_rss_version() {
  return ''; // it's as if it is not even there
}

// remove WP version from scripts
function remove_wp_ver_css_js($src) {
  if (strpos($src, 'ver=')) {
    $src=remove_query_arg('ver', $src);
  }

  return $src;
}


/*********************************
Remove injected CSS
**********************************/
// remove injected CSS for recent comments widget
function remove_wp_widget_recent_comments_style() {
  if (has_filter('wp_head', 'wp_widget_recent_comments_style')) {
    remove_filter('wp_head', 'wp_widget_recent_comments_style');
  }
}


// remove injected CSS from recent comments widget
function remove_recent_comments_style() {
  global $wp_widget_factory;

  if (isset($wp_widget_factory->widgets['WP_Widget_Recent_Comments'])) {
    remove_action('wp_head', array($wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style'));
  }
}

// remove injected CSS from gallery
function remove_gallery_style($css) {
  return preg_replace("!<style type='text/css'>(.*?)</style>!s", '', $css);
}


/*********************************
Remove P tags  from images
**********************************/
// Remove the p from around imgs (http://css-tricks.com/snippets/wordpress/remove-paragraph-tags-from-around-images/)
add_filter('the_content', 'filter_ptags_on_images');

function filter_ptags_on_images($content) {
  return preg_replace('/<p>\s*(<a .*>)?\s*(<img .* \/>)\s*(<\/a>)?\s*<\/p>/iU', '\1\2\3', $content);
}

/*********************************
Edit excerpt
**********************************/
// This removes the annoying […] to a Read More link
function excerpt_more($more) {
  global $post;

  // edit here if you like
  return '...';
}


/****************************************
Remove WP extras & denqueueing
****************************************/

//Remove emojis
add_action('init', 'disable_wp_emojicons');

function disable_wp_emojicons() {

  // all actions related to emojis
  remove_action('admin_print_styles', 'print_emoji_styles');
  remove_action('wp_head', 'print_emoji_detection_script', 7);
  remove_action('admin_print_scripts', 'print_emoji_detection_script');
  remove_action('wp_print_styles', 'print_emoji_styles');
  remove_filter('wp_mail', 'wp_staticize_emoji_for_email');
  remove_filter('the_content_feed', 'wp_staticize_emoji');
  remove_filter('comment_text_rss', 'wp_staticize_emoji');

  // filter to remove TinyMCE emojis
  add_filter('tiny_mce_plugins', 'disable_emojicons_tinymce');
}

function disable_emojicons_tinymce($plugins) {
  if (is_array($plugins)) {
    return array_diff($plugins, array('wpemoji'));
  }

  else {
    return array();
  }
}


/****************************************
Improve the title
****************************************/
// http://www.deluxeblogtips.com/2012/03/better-title-meta-tag.html
function rw_title($title, $sep, $seplocation) {
  global $page,
  $paged;

  // Don't affect in feeds.
  if (is_feed()) {
    return $title;
  }

  // Add the blog's name
  if ('right'==$seplocation) {
    $title .=get_bloginfo('name');
  }

  else {
    $title=get_bloginfo('name') . $title;
  }

  // Add the blog description for the home/front page.
  $site_description=get_bloginfo('description', 'display');

  if ($site_description && (is_home() || is_front_page())) {
    $title .=" {$sep} {$site_description}";
  }

  // Add a page number if necessary:
  if ($paged >=2 || $page >=2) {
    $title .=" {$sep} ". sprintf(__('Page %s', 'dbt'), max($paged, $page));
  }

  return $title;
}

// end better title