<?php
function elegance_widgets_init() {
	// Header Widget
	// Location: right after the navigation
	register_sidebar(array(
		'name'					=> 'Header',
		'id' 						=> 'header-sidebar',
		'description'   => __( 'Located at the top of pages.'),
		'before_widget' => '<div id="%1$s" class="widget-header">',
		'after_widget' => '</div>',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
	));
	// Home Content Area
	// Location: at the left of the content
	register_sidebar(array(
		'name'					=> 'Home Content Area',
		'id' 						=> 'home-content-area',
		'description'   => __( 'Located at the left of the content.'),
		'before_widget' => '<div id="%1$s" class="widget-content %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<div class="header-title"><h3>',
		'after_title' => '</h3></div>',
	));
        // Home Sidebar
	// Location: at the right of the content
	register_sidebar(array(
		'name'					=> 'Home Sidebar',
		'id' 						=> 'home-sidebar',
		'description'   => __( 'Located at the right of the content.'),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
	));
	// Sidebar Widget
	// Location: the sidebar
	register_sidebar(array(
		'name'					=> 'Sidebar',
		'id' 						=> 'main-sidebar',
		'description'   => __( 'Located at the right side of pages.'),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
	));
}
/** Register sidebars by running elegance_widgets_init() on the widgets_init hook. */
add_action( 'widgets_init', 'elegance_widgets_init' );
?>