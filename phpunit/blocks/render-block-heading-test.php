<?php
/**
 * Navigation block rendering tests.
 *
 * @package WordPress
 * @subpackage Blocks
 */

/**
 * Tests for the Navigation block.
 *
 * @group blocks
 */
class Render_Block_Heading_Test extends WP_UnitTestCase {

	/**
	 * @covers ::gutenberg_block_core_heading_render
	 * @dataProvider add_css_class_test_examples
	 */
	public function test_block_core_heading_render_appends_css_class_to_a_vanilla_element( $input, $expected_result ) {
		$actual   = gutenberg_block_core_heading_render( array(), $input );
		$this->assertEquals( $expected_result, $actual );
	}

	public function add_css_class_test_examples(  ) {
		return array(
			array(
				'<h2>Hello World</h2>',
				'<h2 class="wp-block-heading">Hello World</h2>'
			),
			array(
				'<header>Hello World</header>',
				'<header>Hello World</header>',
			),
			array(
				'<span>Hello World</span>',
				'<span>Hello World</span>'
			),
			array(
				'<h2 class="is-align-right">Hello World</h2>',
				'<h2 class="is-align-right wp-block-heading">Hello World</h2>'
			),
			array(
				'<h2 style="display: block">Hello World</h2>',
				'<h2 style="display: block" class="wp-block-heading">Hello World</h2>'
			),
			array(
				'<h2 class="is-align-right custom classes">Hello World</h2>',
				'<h2 class="is-align-right custom classes wp-block-heading">Hello World</h2>'
			),
			array(
				'<h2 class="is-align-right custom classes"><h2>Hello World</h2></h2>',
				'<h2 class="is-align-right custom classes wp-block-heading"><h2>Hello World</h2></h2>'
			),
			array(
				'<h2 style="display: block" class="is-align-right"><h2>Hello World</h2></h2>',
				'<h2 style="display: block" class="is-align-right wp-block-heading"><h2>Hello World</h2></h2>'
			),
			array(
				'<h2 style="display: block" class="is-align-right" data-class="corner case!"><h2>Hello World</h2></h2>',
				'<h2 style="display: block" class="is-align-right wp-block-heading" data-class="corner case!"><h2>Hello World</h2></h2>'
			),
			array(
				'<h2 data-class="corner case!" style="display: block" class="is-align-right"><h2>Hello World</h2></h2>',
				'<h2 data-class="corner case!" style="display: block" class="is-align-right wp-block-heading"><h2>Hello World</h2></h2>'
			)
		);
	}

}
