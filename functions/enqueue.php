<?php
function enqueue_assets()
{

	wp_enqueue_style("google-font", "//fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap", [], "", "all");
	wp_enqueue_style("bootstrap-style", "//cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css", [], "", "all");
	wp_style_add_data('bootstrap-style', array('integrity', 'crossorigin'), array('sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH', 'anonymous'));

	wp_enqueue_style("font-awesome-5", "//cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css", [], "", "all");
	wp_style_add_data('font-awesome-5', array('integrity', 'crossorigin'), array('sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU', 'anonymous'));
	wp_enqueue_style("stylecss", get_stylesheet_uri());

	wp_enqueue_script("jquery");





	//wp_enqueue_script("jquery-js", "//code.jquery.com/jquery-3.3.1.slim.min.js", "", "", true);
	//wp_script_add_data( 'jquery-js', array( 'integrity', 'crossorigin' ) , array( 'sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo', 'anonymous' ) );
	wp_enqueue_script("bootstrap-5", "//cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js", "", "", true);
	wp_script_add_data('bootstrap-5', array('integrity', 'crossorigin'), array('sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz', 'anonymous'));

	wp_enqueue_script("functions", get_template_directory_uri() . "/js/functions.js", "", "", true);

	wp_localize_script(
		"functions",
		"wp_var",
		[
			"ajax_url" => admin_url("admin-ajax.php"),
		]
	);
}
add_action("wp_enqueue_scripts", "enqueue_assets");
