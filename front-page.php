<?php
/**
 * The template for displaying the front page.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Boots_Hard
 */

get_header(); ?>

	<main id="primary" class="site-main">
		<?php
			// Llama a la función que renderiza las secciones gestionadas
			if ( function_exists( 'boots_hard_display_managed_sections' ) ) {
				boots_hard_display_managed_sections();
			}
		?>
	</main>

<?php get_footer();