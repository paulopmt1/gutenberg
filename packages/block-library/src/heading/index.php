<?php
/**
 * Server-side rendering of the `core/heading` block.
 *
 * @package WordPress
 */

/**
 * Adds a wp-block-heading class to the heading blocks without storing
 * it in the serialized $content.
 *
 * @param array $attributes Attributes of the block being rendered.
 * @param string $content Content of the block being rendered.
 *
 * @return string The content of the block being rendered.
 */
function block_core_heading_render( $attributes, $content ) {
	$content = preg_replace(
		'/^<h([1-6])(?: class="([^"]*)")?/m',
		'<h$1 class="$2 wp-block-heading"',
		$content
	);

	return $content;
}

/**
 * Registers the `core/heading` block on server.
 */
function register_block_core_heading() {
	register_block_type_from_metadata(
		__DIR__ . '/heading',
		array(
			'render_callback' => 'block_core_heading_render',
		)
	);
}

add_action( 'init', 'register_block_core_heading' );
