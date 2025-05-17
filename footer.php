<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Boots_Hard
 */
 $page_container_class = get_theme_mod( 'bh_page_container_class', 'container' );

?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer bg-dark text-white text-center py-4">
		<div class="<?php echo esc_attr( $page_container_class ); ?>">
			<div class="site-info">
				<a href="<?php echo esc_url( __( 'https://wordpress.org/', 'boots-hard' ) ); ?>" class="text-white">
					<?php
					/* translators: %s: CMS name, i.e. WordPress. */
					printf( esc_html__( 'Proudly powered by %s', 'boots-hard' ), 'WordPress' );
					?>
				</a>
				<span class="sep"> | </span>
				<?php
					/* translators: 1: Theme name, 2: Theme author. */
					printf( esc_html__( 'Theme: %1$s by %2$s.', 'boots-hard' ), 'Boots Hard', '<a href="https://example.com/" class="text-white">Percy Alvarez</a>' );
				?>
			</div><!-- .site-info -->
		</div><!-- .container -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
