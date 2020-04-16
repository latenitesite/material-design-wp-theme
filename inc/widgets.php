<?php
/**
 * Custom widget functions
 *
 * @package MaterialTheme
 */

namespace MaterialTheme\Widgets;

/**
 * Attach hooks
 *
 * @return void
 */
function setup() {
	add_action( 'widgets_init', __NAMESPACE__ . '\replace_default_widgets' );
	
	add_filter( 'widget_archives_args', __NAMESPACE__ . '\build_archive' );
	add_filter( 'wp_list_categories', __NAMESPACE__ . '\add_class_tax_list' );
}

/**
 * Remove default widgets and replace with our versions
 *
 * @return void
 */
function replace_default_widgets() {
	unregister_widget( 'WP_Widget_Archives' );
	unregister_widget( 'WP_Widget_Categories' );

	register_widget( __NAMESPACE__ . '\WP_Widget_Archives' );
	register_widget( __NAMESPACE__ . '\WP_Widget_Categories' );
}

/**
 * Replace container of archive's items
 *
 * @param  array $args Default arguments.
 * @return array Updated arguments
 */
function build_archive( $args ) {
	$new_args = [
		'format' => 'custom',
		'before' => '<li class="mdc-list-item"><span class="mdc-list-item__text">',
		'after'  => '</span></li>',
	];

	$args = wp_parse_args( $new_args, $args );

	return $args;
}

/**
 * Adds material classes to a taxonomy list
 *
 * @param  string $output Generated list markup.
 * @return string Updated list markup
 */
function add_class_tax_list( $output ) {
	$output = str_replace( '<li class="cat-item', '<li class="mdc-list-item cat-item', $output );

	return $output;
}
