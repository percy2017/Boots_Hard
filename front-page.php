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
			get_template_part( 'template-parts/sections/elements-bootstraps' );
			get_template_part( 'template-parts/sections/feature-custom-cards' );
			get_template_part( 'template-parts/sections/featurettes' );
		?>
	</main>

<?php get_footer();