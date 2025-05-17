<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Boots_Hard
 */

 $page_container_class = get_theme_mod( 'bh_page_container_class', 'container' );
 $fixed_navbar         = get_theme_mod( 'bh_fixed_navbar', false );

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<div id="page" class="site">
	<?php
	$header_classes = 'site-header mb-4';
	if ( $fixed_navbar ) {
		$header_classes .= ' fixed-top';
	}
	?>
	<header id="masthead" class="<?php echo esc_attr( $header_classes ); ?>">
		<nav class="navbar navbar-expand-lg navbar-light bg-light">
			<div class="<?php echo esc_attr( $page_container_class ); ?>">
				<div class="site-branding navbar-brand">
					<?php
					the_custom_logo();
					if ( display_header_text() ) :
						?>
						<p class="site-title mb-0"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
						<?php
						$boots_hard_description = get_bloginfo( 'description', 'display' );
						if ( $boots_hard_description || is_customize_preview() ) :
							?>
							<p class="site-description mb-0"><?php echo $boots_hard_description; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></p>
						<?php endif; ?>
					<?php endif; ?>
				</div><!-- .site-branding -->

				<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="<?php esc_attr_e( 'Toggle navigation', 'boots-hard' ); ?>">
					<span class="navbar-toggler-icon"></span>
				</button>

				<div class="collapse navbar-collapse" id="navbarNav">
			<?php
			wp_nav_menu( array(
				'theme_location' => 'primary',
				'container'      => false, // No container needed, Navwalker handles ul
				'menu_class'     => 'navbar-nav ms-auto', // ms-auto aligns right
				'walker'         => new Boots_Hard_Bootstrap_Navwalker(),
				'fallback_cb'    => 'Boots_Hard_Bootstrap_Navwalker::fallback', // Fallback if menu is not set
			) );
			?>
				</div><!-- .collapse -->
			</div><!-- .container -->
		</nav><!-- .navbar -->
	</header>
	
	<div id="content" class="site-content <?php echo esc_attr( $page_container_class ); ?>">
