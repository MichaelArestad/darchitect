<?php
/**
 * Block Styles
 *
 * @link https://developer.wordpress.org/reference/functions/register_block_style/
 *
 * @package WordPress
 * @subpackage Darchitect
 * @since Darchitect 1.0
 */

if ( function_exists( 'register_block_style' ) ) {
	/**
	 * Register block styles.
	 *
	 * @since Darchitect 1.0
	 *
	 * @return void
	 */
	function darchitect_register_block_styles() {
		// Columns: Overlap.
		register_block_style(
			'core/columns',
			array(
				'name'  => 'darchitect-columns-overlap',
				'label' => esc_html__( 'Overlap', 'darchitect' ),
			)
		);

		// Cover: Borders.
		register_block_style(
			'core/cover',
			array(
				'name'  => 'darchitect-border',
				'label' => esc_html__( 'Borders', 'darchitect' ),
			)
		);

		// Group: Borders.
		register_block_style(
			'core/group',
			array(
				'name'  => 'darchitect-border',
				'label' => esc_html__( 'Borders', 'darchitect' ),
			)
		);

		// Image: Borders.
		register_block_style(
			'core/image',
			array(
				'name'  => 'darchitect-border',
				'label' => esc_html__( 'Borders', 'darchitect' ),
			)
		);

		// Image: Frame.
		register_block_style(
			'core/image',
			array(
				'name'  => 'darchitect-image-frame',
				'label' => esc_html__( 'Frame', 'darchitect' ),
			)
		);

		// Latest Posts: Dividers.
		register_block_style(
			'core/latest-posts',
			array(
				'name'  => 'darchitect-latest-posts-dividers',
				'label' => esc_html__( 'Dividers', 'darchitect' ),
			)
		);

		// Latest Posts: Borders.
		register_block_style(
			'core/latest-posts',
			array(
				'name'  => 'darchitect-latest-posts-borders',
				'label' => esc_html__( 'Borders', 'darchitect' ),
			)
		);

		// Media & Text: Borders.
		register_block_style(
			'core/media-text',
			array(
				'name'  => 'darchitect-border',
				'label' => esc_html__( 'Borders', 'darchitect' ),
			)
		);

		// Separator: Thick.
		register_block_style(
			'core/separator',
			array(
				'name'  => 'darchitect-separator-thick',
				'label' => esc_html__( 'Thick', 'darchitect' ),
			)
		);

		// Social icons: Dark gray color.
		register_block_style(
			'core/social-links',
			array(
				'name'  => 'darchitect-social-icons-color',
				'label' => esc_html__( 'Dark gray', 'darchitect' ),
			)
		);
	}
	add_action( 'init', 'darchitect_register_block_styles' );
}
