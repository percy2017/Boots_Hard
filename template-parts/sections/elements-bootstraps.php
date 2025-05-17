<?php
/**
 * Template part for displaying a showcase of Bootstrap elements
 * to test Customizer settings.
 *
 * @package Boots_Hard
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
$section_spacing_class          = get_theme_mod( 'bh_section_spacing_class', 'py-3' );
$section_inner_container_class = get_theme_mod( 'bh_section_inner_container_class', 'container' );
?>

<section id="customizer-showcase-section" class="bh-theme-section <?php echo esc_attr( $section_spacing_class ); ?>">
	<div class="<?php echo esc_attr( $section_inner_container_class ); ?>">
		<div class="row mb-4">
			<div class="col-12 text-center">
				<h2><?php esc_html_e( 'Escaparate del Personalizador', 'boots-hard' ); ?></h2>
				<p class="lead"><?php esc_html_e( 'Esta sección muestra cómo se aplican los ajustes del Personalizador a los elementos de Bootstrap.', 'boots-hard' ); ?></p>
			</div>
		</div>

		<!-- Tipografía y Tamaños -->
		<div class="row mb-5">
			<div class="col-md-12">
				<h3><?php esc_html_e( 'Tipografía y Tamaños de Texto', 'boots-hard' ); ?></h3>
				<hr>
				<h1><?php esc_html_e( 'Encabezado H1', 'boots-hard' ); ?></h1>
				<h2><?php esc_html_e( 'Encabezado H2', 'boots-hard' ); ?></h2>
				<h3><?php esc_html_e( 'Encabezado H3', 'boots-hard' ); ?></h3>
				<h4><?php esc_html_e( 'Encabezado H4', 'boots-hard' ); ?></h4>
				<h5><?php esc_html_e( 'Encabezado H5', 'boots-hard' ); ?></h5>
				<h6><?php esc_html_e( 'Encabezado H6', 'boots-hard' ); ?></h6>
				<p><?php esc_html_e( 'Este es un párrafo de texto estándar que utiliza la fuente y el tamaño base del cuerpo. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'boots-hard' ); ?></p>
				<p class="lead"><?php esc_html_e( 'Este es un párrafo "lead", que es un poco más grande.', 'boots-hard' ); ?></p>
				<p><small><?php esc_html_e( 'Este es un texto pequeño (small).', 'boots-hard' ); ?></small></p>
				<p><a href="#"><?php esc_html_e( 'Esto es un enlace de ejemplo.', 'boots-hard' ); ?></a></p>
			</div>
		</div>

		<!-- Colores: Botones -->
		<div class="row mb-5">
			<div class="col-md-12">
				<h3><?php esc_html_e( 'Colores: Botones', 'boots-hard' ); ?></h3>
				<hr>
				<p>
					<button type="button" class="btn btn-primary"><?php esc_html_e( 'Primary', 'boots-hard' ); ?></button>
					<button type="button" class="btn btn-secondary"><?php esc_html_e( 'Secondary', 'boots-hard' ); ?></button>
					<button type="button" class="btn btn-success"><?php esc_html_e( 'Success', 'boots-hard' ); ?></button>
					<button type="button" class="btn btn-danger"><?php esc_html_e( 'Danger', 'boots-hard' ); ?></button>
					<button type="button" class="btn btn-warning"><?php esc_html_e( 'Warning', 'boots-hard' ); ?></button>
					<button type="button" class="btn btn-info"><?php esc_html_e( 'Info', 'boots-hard' ); ?></button>
					<button type="button" class="btn btn-light"><?php esc_html_e( 'Light', 'boots-hard' ); ?></button>
					<button type="button" class="btn btn-dark"><?php esc_html_e( 'Dark', 'boots-hard' ); ?></button>
					<button type="button" class="btn btn-link"><?php esc_html_e( 'Link', 'boots-hard' ); ?></button>
				</p>
				<p>
					<button type="button" class="btn btn-outline-primary"><?php esc_html_e( 'Outline Primary', 'boots-hard' ); ?></button>
					<button type="button" class="btn btn-outline-secondary"><?php esc_html_e( 'Outline Secondary', 'boots-hard' ); ?></button>
					<button type="button" class="btn btn-outline-success"><?php esc_html_e( 'Outline Success', 'boots-hard' ); ?></button>
					<button type="button" class="btn btn-outline-danger"><?php esc_html_e( 'Outline Danger', 'boots-hard' ); ?></button>
					<button type="button" class="btn btn-outline-warning"><?php esc_html_e( 'Outline Warning', 'boots-hard' ); ?></button>
					<button type="button" class="btn btn-outline-info"><?php esc_html_e( 'Outline Info', 'boots-hard' ); ?></button>
					<button type="button" class="btn btn-outline-light text-dark"><?php esc_html_e( 'Outline Light', 'boots-hard' ); ?></button> <!-- text-dark para visibilidad si el fondo es claro -->
					<button type="button" class="btn btn-outline-dark"><?php esc_html_e( 'Outline Dark', 'boots-hard' ); ?></button>
				</p>
			</div>
		</div>

		<!-- Colores: Alertas -->
		<div class="row mb-5">
			<div class="col-md-12">
				<h3><?php esc_html_e( 'Colores: Alertas', 'boots-hard' ); ?></h3>
				<hr>
				<div class="alert alert-primary" role="alert"><?php esc_html_e( 'Una alerta simple de tipo primary—¡compruébalo!', 'boots-hard' ); ?></div>
				<div class="alert alert-secondary" role="alert"><?php esc_html_e( 'Una alerta simple de tipo secondary—¡compruébalo!', 'boots-hard' ); ?></div>
				<div class="alert alert-success" role="alert"><?php esc_html_e( 'Una alerta simple de tipo success—¡compruébalo!', 'boots-hard' ); ?></div>
				<div class="alert alert-danger" role="alert"><?php esc_html_e( 'Una alerta simple de tipo danger—¡compruébalo!', 'boots-hard' ); ?></div>
				<div class="alert alert-warning" role="alert"><?php esc_html_e( 'Una alerta simple de tipo warning—¡compruébalo!', 'boots-hard' ); ?></div>
				<div class="alert alert-info" role="alert"><?php esc_html_e( 'Una alerta simple de tipo info—¡compruébalo!', 'boots-hard' ); ?></div>
				<div class="alert alert-light" role="alert"><?php esc_html_e( 'Una alerta simple de tipo light—¡compruébalo!', 'boots-hard' ); ?></div>
				<div class="alert alert-dark" role="alert"><?php esc_html_e( 'Una alerta simple de tipo dark—¡compruébalo!', 'boots-hard' ); ?></div>
			</div>
		</div>

		<!-- Colores: Fondos y Texto -->
		<div class="row mb-5">
			<div class="col-md-12">
				<h3><?php esc_html_e( 'Colores: Fondos y Texto', 'boots-hard' ); ?></h3>
				<hr>
			</div>
			<div class="col-md-4 mb-3">
				<div class="p-3 mb-2 bg-primary text-white"><?php esc_html_e( '.bg-primary .text-white', 'boots-hard' ); ?></div>
				<div class="p-3 mb-2 bg-primary-subtle text-primary-emphasis"><?php esc_html_e( '.bg-primary-subtle .text-primary-emphasis', 'boots-hard' ); ?></div>
			</div>
			<div class="col-md-4 mb-3">
				<div class="p-3 mb-2 bg-secondary text-white"><?php esc_html_e( '.bg-secondary .text-white', 'boots-hard' ); ?></div>
				<div class="p-3 mb-2 bg-secondary-subtle text-secondary-emphasis"><?php esc_html_e( '.bg-secondary-subtle .text-secondary-emphasis', 'boots-hard' ); ?></div>
			</div>
			<div class="col-md-4 mb-3">
				<div class="p-3 mb-2 bg-success text-white"><?php esc_html_e( '.bg-success .text-white', 'boots-hard' ); ?></div>
				<div class="p-3 mb-2 bg-success-subtle text-success-emphasis"><?php esc_html_e( '.bg-success-subtle .text-success-emphasis', 'boots-hard' ); ?></div>
			</div>
			<div class="col-md-4 mb-3">
				<div class="p-3 mb-2 bg-danger text-white"><?php esc_html_e( '.bg-danger .text-white', 'boots-hard' ); ?></div>
				<div class="p-3 mb-2 bg-danger-subtle text-danger-emphasis"><?php esc_html_e( '.bg-danger-subtle .text-danger-emphasis', 'boots-hard' ); ?></div>
			</div>
			<div class="col-md-4 mb-3">
				<div class="p-3 mb-2 bg-warning text-dark"><?php esc_html_e( '.bg-warning .text-dark', 'boots-hard' ); ?></div>
				<div class="p-3 mb-2 bg-warning-subtle text-warning-emphasis"><?php esc_html_e( '.bg-warning-subtle .text-warning-emphasis', 'boots-hard' ); ?></div>
			</div>
			<div class="col-md-4 mb-3">
				<div class="p-3 mb-2 bg-info text-dark"><?php esc_html_e( '.bg-info .text-dark', 'boots-hard' ); ?></div>
				<div class="p-3 mb-2 bg-info-subtle text-info-emphasis"><?php esc_html_e( '.bg-info-subtle .text-info-emphasis', 'boots-hard' ); ?></div>
			</div>
			<div class="col-md-4 mb-3">
				<div class="p-3 mb-2 bg-light text-dark"><?php esc_html_e( '.bg-light .text-dark', 'boots-hard' ); ?></div>
				<div class="p-3 mb-2 bg-light-subtle text-light-emphasis"><?php esc_html_e( '.bg-light-subtle .text-light-emphasis', 'boots-hard' ); ?></div>
			</div>
			<div class="col-md-4 mb-3">
				<div class="p-3 mb-2 bg-dark text-white"><?php esc_html_e( '.bg-dark .text-white', 'boots-hard' ); ?></div>
				<div class="p-3 mb-2 bg-dark-subtle text-dark-emphasis"><?php esc_html_e( '.bg-dark-subtle .text-dark-emphasis', 'boots-hard' ); ?></div>
			</div>
			<div class="col-md-4 mb-3">
				<div class="p-3 mb-2 bg-body-secondary text-body-emphasis"><?php esc_html_e( '.bg-body-secondary .text-body-emphasis (usa --bs-body-color y --bs-body-bg)', 'boots-hard' ); ?></div>
				<div class="p-3 mb-2 bg-body-tertiary text-body-emphasis"><?php esc_html_e( '.bg-body-tertiary', 'boots-hard' ); ?></div>
			</div>
		</div>

		<!-- Otros Elementos -->
		<div class="row">
			<div class="col-md-12">
				<h3><?php esc_html_e( 'Otros Elementos', 'boots-hard' ); ?></h3>
				<hr>
				<span class="badge text-bg-primary"><?php esc_html_e( 'Primary Badge', 'boots-hard' ); ?></span>
				<span class="badge text-bg-secondary"><?php esc_html_e( 'Secondary Badge', 'boots-hard' ); ?></span>
				<span class="badge text-bg-success"><?php esc_html_e( 'Success Badge', 'boots-hard' ); ?></span>
				<br><br>
				<div class="progress mb-3" role="progressbar" aria-label="Primary example" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
					<div class="progress-bar bg-primary" style="width: 25%">25%</div>
				</div>
				<div class="progress" role="progressbar" aria-label="Success example" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100">
					<div class="progress-bar bg-success w-75" >75%</div>
				</div>
			</div>
		</div>

	</div><!-- /.container -->
</section>