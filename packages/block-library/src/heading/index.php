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
	$matches = array();
	$pattern = '/
		^(\s*)                               # Any leading whitespace.
		<(?<tag_name>
			h[1-6]                           # The opening tag...
			(?=\s|>)                         # ...followed by a whitespace or >
		                                     # ?= means a "lookahead"
		)
		(?<before_class>                     # Any attributes prior to "class"
			(?:                              # ?: is a "non-capturing group"
				(?!class=")[^>]				 # Match all characters until ">" except when
											 # the next character sequence is class="
											 # ?! is a "negative lookahead"
			)*
		)
		(?:\s*class="(?<class_name>[^"]+)")? # The class attribute, if any
		(?<after_class>[^>]*?)               # The rest of the tag
		>						             # The closing tag
	/xm';

	preg_match(
		$pattern,
		$content,
		$matches
	);
	if ( empty( $matches ) ) {
		return $content;
	}

	$new_class_name = trim( $matches['class_name'] . ' wp-block-heading' );
	// Construct a new opening tag.
	$new_tag_parts = array(
		$matches['tag_name'],
		$matches['before_class'],
		'class="' . $new_class_name . '"',
		$matches['after_class'],
	);
	$new_tag_parts = array_map( 'trim', $new_tag_parts );
	$new_tag_parts = array_filter( $new_tag_parts );
	$new_tag       = '<' . implode( ' ', $new_tag_parts ) . '>';

	// Replace the old opening tag with the new one.
	return $new_tag . substr( $content, strlen( $matches[0] ) );
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
