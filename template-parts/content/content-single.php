<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Darchitect
 * @since Darchitect 1.0
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<header class="entry-header alignwide">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
		<div class="rt-byline">
			<?php echo do_shortcode('[rt_reading_time postfix="minute" postfix_singular="minute"]'); ?> read by <?php darchitect_posted_by(); ?>
		</div>
		<?php darchitect_post_thumbnail(); ?>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php
		the_content();

		wp_link_pages(
			array(
				'before'   => '<nav class="page-links" aria-label="' . esc_attr__( 'Page', 'darchitect' ) . '">',
				'after'    => '</nav>',
				/* translators: %: Page number. */
				'pagelink' => esc_html__( 'Page %', 'darchitect' ),
			)
		);
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer default-max-width">
		<?php darchitect_entry_meta_footer(); ?>
	</footer><!-- .entry-footer -->

	<?php if ( ! is_singular( 'attachment' ) ) : ?>
		<?php get_template_part( 'template-parts/post/author-bio' ); ?>
	<?php endif; ?>

</article><!-- #post-<?php the_ID(); ?> -->
