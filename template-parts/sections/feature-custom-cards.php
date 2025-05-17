<?php
/**
 * Section Name: Tarjetas Personalizadas Destacadas
 * Template part for displaying the custom cards section
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Boots_Hard
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

// Datos pasados desde section-renderer.php
$section_data_from_json = isset( $args['section_data_from_json'] ) && is_array( $args['section_data_from_json'] ) ? $args['section_data_from_json'] : array();

// Datos por defecto para esta sección
$defaults = array(
	'section_title' => __( 'Tarjetas Personalizadas', 'boots-hard' ),
	'cards'         => array( // Cada tarjeta ahora espera un image_id
		array(
			'image_id' => 0, // ID del adjunto. 0 o null si no hay imagen.
			'title'    => __( 'Tarjeta Uno por Defecto', 'boots-hard' ),
			'text'     => __( 'Descripción por defecto para la tarjeta uno.', 'boots-hard' ),
			// 'image_url_fallback_for_default' => get_template_directory_uri() . '/assets/svg/placeholder-card-1.svg' // Para defaults PHP
		),
		array(
			'image_id' => 0,
			'title'    => __( 'Tarjeta Dos por Defecto', 'boots-hard' ),
			'text'     => __( 'Descripción por defecto para la tarjeta dos.', 'boots-hard' ),
			// 'image_url_fallback_for_default' => get_template_directory_uri() . '/assets/svg/placeholder-card-2.svg'
		),
		array(
			'image_id' => 0,
			'title'    => __( 'Tarjeta Tres por Defecto', 'boots-hard' ),
			'text'     => __( 'Descripción por defecto para la tarjeta tres.', 'boots-hard' ),
			// 'image_url_fallback_for_default' => get_template_directory_uri() . '/assets/svg/placeholder-card-3.svg'
		),
	)
);

// Fusionar datos del JSON con los por defecto
$section_content = wp_parse_args( $section_data_from_json, $defaults );

// Asegurarse de que 'cards' sea un array
if ( ! is_array( $section_content['cards'] ) ) {
	$section_content['cards'] = $defaults['cards'];
}

$section_spacing_class          = get_theme_mod( 'bh_section_spacing_class', 'py-3' );
$section_inner_container_class = get_theme_mod( 'bh_section_inner_container_class', 'container' );

// Slug de esta sección (nombre del archivo sin .php)
$section_slug = basename( __FILE__, '.php' );
?>

<section id="section-preview-<?php echo esc_attr( $section_slug ); ?>" class="bh-managed-section <?php echo esc_attr( $section_slug ); ?> bh-theme-section <?php echo esc_attr( $section_spacing_class ); ?>">
	<div class="<?php echo esc_attr( $section_inner_container_class ); ?>">
		<h2 class="pb-2 border-bottom bh-preview-title"><?php echo esc_html( $section_content['section_title'] ); ?></h2>

		<?php if ( ! empty( $section_content['cards'] ) ) : ?>
		<div class="row row-cols-1 row-cols-lg-3 align-items-stretch g-4 py-5 bh-preview-cards-container">
			<?php foreach ( $section_content['cards'] as $index => $card_item ) :
				$card_image_url = get_template_directory_uri() . '/assets/svg/placeholder-card-1.svg'; // Fallback general si no hay ID ni fallback específico
				if ( ! empty( $card_item['image_id'] ) ) {
					$image_attributes = wp_get_attachment_image_src( (int) $card_item['image_id'], 'large' ); // O el tamaño que necesites
					if ( $image_attributes ) {
						$card_image_url = $image_attributes[0];
					}
				} elseif ( isset( $card_item['image_url_fallback_for_default'] ) ) { // Usar fallback si está definido en el JSON (para defaults)
                    $card_image_url = esc_url($card_item['image_url_fallback_for_default']);
                }

				$card_title     = ! empty( $card_item['title'] ) ? esc_html( $card_item['title'] ) : '';
				$card_text      = ! empty( $card_item['text'] ) ? esc_html( $card_item['text'] ) : '';
			?>
				<div class="col bh-preview-card-item" data-card-index="<?php echo esc_attr($index); ?>">
					<div class="card card-cover h-100 overflow-hidden text-bg-dark rounded-4 shadow-lg" style="background-image: url('<?php echo $card_image_url; ?>'); background-size: cover; background-position: center;">
						<div class="d-flex flex-column h-100 p-5 pb-3 text-white text-shadow-1">
							<h3 class="pt-5 mt-5 mb-4 display-6 lh-1 fw-bold bh-preview-card-title"><?php echo $card_title; ?></h3>
							<ul class="d-flex list-unstyled mt-auto">
								<li class="me-auto">
									<!-- Podrías poner un icono o un logo pequeño aquí si quisieras -->
								</li>
								<li class="d-flex align-items-center">
									<small class="bh-preview-card-text"><?php echo $card_text; ?></small>
								</li>
							</ul>
						</div>
					</div>
				</div>
			<?php endforeach; ?>
		</div>
		<?php endif; ?>
	</div>
</section>