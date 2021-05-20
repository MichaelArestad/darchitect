<?php
/**
 * Customize API: Darchitect_Customize_Notice_Control class
 *
 * @package WordPress
 * @subpackage Darchitect
 * @since Darchitect 1.0
 */

/**
 * Customize Notice Control class.
 *
 * @since Darchitect 1.0
 *
 * @see WP_Customize_Control
 */
class Darchitect_Customize_Notice_Control extends WP_Customize_Control {
	/**
	 * The control type.
	 *
	 * @since Darchitect 1.0
	 *
	 * @var string
	 */
	public $type = 'darchitect-notice';

	/**
	 * Renders the control content.
	 *
	 * This simply prints the notice we need.
	 *
	 * @access public
	 *
	 * @since Darchitect 1.0
	 *
	 * @return void
	 */
	public function render_content() {
		?>
		<div class="notice notice-warning">
			<p><?php esc_html_e( 'To access the Dark Mode settings, select a light background color.', 'darchitect' ); ?></p>
			<p><a href="<?php echo esc_url( __( 'https://wordpress.org/support/article/twenty-twenty-one/#dark-mode-support', 'darchitect' ) ); ?>">
				<?php esc_html_e( 'Learn more about Dark Mode.', 'darchitect' ); ?>
			</a></p>
		</div>
		<?php
	}
}
