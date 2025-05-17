<?php
/**
 * Template part for displaying the custom cards section
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Boots_Hard
 */

// Datos de ejemplo para las tarjetas personalizadas
$custom_cards_data = array(
	array(
		'image_svg_name' => 'placeholder-card-1.svg', // Nombre del archivo SVG en assets/svg/
		'title'          => 'Tarjeta Personalizada Uno',
		'text'           => 'Este es un texto breve que describe el contenido o el propósito de esta tarjeta. Es ideal para resúmenes concisos.',
	),
	array(
		'image_svg_name' => 'placeholder-card-2.svg',
		'title'          => 'Tarjeta Personalizada Dos',
		'text'           => 'Otra descripción para la segunda tarjeta. Mantenlo corto y al grano para una lectura rápida y efectiva.',
	),
	array(
		'image_svg_name' => 'placeholder-card-3.svg',
		'title'          => 'Tarjeta Personalizada Tres',
		'text'           => 'Y finalmente, el texto para la tercera tarjeta. Puedes destacar diferentes aspectos o servicios aquí.',
	),
);

$section_spacing_class          = get_theme_mod( 'bh_section_spacing_class', 'py-3' );
$section_inner_container_class = get_theme_mod( 'bh_section_inner_container_class', 'container' );
?>

<section id="custom-cards" class="bh-theme-section <?php echo esc_attr( $section_spacing_class ); ?>">
	<div class="<?php echo esc_attr( $section_inner_container_class ); ?>">
		<h2 class="pb-2 border-bottom"><?php esc_html_e( 'Tarjetas Personalizadas', 'boots-hard' ); ?></h2>

		<div class="row row-cols-1 row-cols-lg-3 align-items-stretch g-4 py-5">
			<?php foreach ( $custom_cards_data as $card ) : ?>
				<div class="col">
					<div class="card card-cover h-100 overflow-hidden text-bg-dark rounded-4 shadow-lg" style="background-image: url('<?php echo esc_url( get_template_directory_uri() . '/assets/svg/' . $card['image_svg_name'] ); ?>'); background-size: cover; background-position: center;">
						<div class="d-flex flex-column h-100 p-5 pb-3 text-white text-shadow-1">
							<h3 class="pt-5 mt-5 mb-4 display-6 lh-1 fw-bold"><?php echo esc_html( $card['title'] ); ?></h3>
							<ul class="d-flex list-unstyled mt-auto">
								<li class="me-auto">
									<!-- Podrías poner un icono o un logo pequeño aquí si quisieras -->
								</li>
								<li class="d-flex align-items-center">
									<small><?php echo esc_html( $card['text'] ); ?></small>
								</li>
							</ul>
						</div>
					</div>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>