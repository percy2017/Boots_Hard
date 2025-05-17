<?php
/**
 * Section Name: Featurettes (Texto e Imagen)
 * Template part for displaying the "Featurettes" section.
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

// Datos por defecto para la sección de featurettes
$defaults = array(
	'section_title' => __( 'Nuestras Características', 'boots-hard' ), // Título opcional para la sección completa
	'featurettes'   => array(
		array(
			'title'             => __( 'Primera Featurette por Defecto.', 'boots-hard' ),
			'subtitle_muted'    => __( 'Subtítulo por defecto.', 'boots-hard' ),
			'description'       => __( 'Descripción por defecto para la primera featurette. Adapta este contenido.', 'boots-hard' ),
			'image_id'          => 0, // ID del adjunto
			'image_alt'         => __( 'Imagen Placeholder 500x500', 'boots-hard' ),
			'text_order_class'  => '',
			'image_order_class' => '',
			'image_url_fallback_for_default' => 'https://via.placeholder.com/500x500.png?text=Placeholder+500x500' // Solo para el default PHP
		),
		array(
			'title'             => __( 'Segunda Featurette por Defecto.', 'boots-hard' ),
			'subtitle_muted'    => __( 'Otro subtítulo.', 'boots-hard' ),
			'description'       => __( 'Más contenido de ejemplo para la segunda featurette. Personaliza según tus necesidades.', 'boots-hard' ),
			'image_id'          => 0,
			'image_alt'         => __( 'Imagen Placeholder 500x500', 'boots-hard' ),
			'text_order_class'  => 'order-md-2',
			'image_order_class' => 'order-md-1',
			'image_url_fallback_for_default' => 'https://via.placeholder.com/500x500.png?text=Placeholder+500x500' // Solo para el default PHP
		),
	)
);

// Fusionar datos del JSON con los por defecto
$section_content = wp_parse_args( $section_data_from_json, $defaults );

// Asegurarse de que 'featurettes' sea un array
if ( ! is_array( $section_content['featurettes'] ) ) {
	$section_content['featurettes'] = $defaults['featurettes'];
}

$section_spacing_class          = get_theme_mod( 'bh_section_spacing_class', 'py-3' );
$section_inner_container_class = get_theme_mod( 'bh_section_inner_container_class', 'container' );

// Slug de esta sección (nombre del archivo sin .php)
$section_slug = basename( __FILE__, '.php' );

if ( ! empty( $section_content['featurettes'] ) ) : ?>
<section id="section-preview-<?php echo esc_attr( $section_slug ); ?>" class="bh-managed-section <?php echo esc_attr( $section_slug ); ?> bh-theme-section <?php echo esc_attr( $section_spacing_class ); ?>">
	<div class="<?php echo esc_attr( $section_inner_container_class ); ?>">

		<?php if ( ! empty( $section_content['section_title'] ) ) : ?>
			<div class="row mb-4">
				<div class="col-12 text-center">
					<h2 class="pb-2 border-bottom bh-preview-title"><?php echo esc_html( $section_content['section_title'] ); ?></h2>
				</div>
			</div>
		<?php endif; ?>

		<div class="bh-preview-featurettes-container"> <?php // Contenedor añadido ?>
			<?php foreach ( $section_content['featurettes'] as $index => $featurette_item_raw ) : ?>
				<?php
				// Fusionar cada featurette con los valores por defecto de una featurette para asegurar que todas las claves existan
				$featurette_item_defaults = isset( $defaults['featurettes'][0] ) ? $defaults['featurettes'][0] : array();
				$featurette_item          = wp_parse_args( $featurette_item_raw, $featurette_item_defaults );

				$title             = esc_html( $featurette_item['title'] );
				$subtitle_muted    = esc_html( $featurette_item['subtitle_muted'] );
				$description       = wp_kses_post( $featurette_item['description'] ); // Permite HTML básico
				$image_alt         = esc_attr( $featurette_item['image_alt'] );
				$image_url         = '';

				if ( ! empty( $featurette_item['image_id'] ) ) {
					$image_attributes = wp_get_attachment_image_src( (int) $featurette_item['image_id'], 'large' ); // O 'full', o un tamaño personalizado
					if ( $image_attributes ) {
						$image_url = $image_attributes[0];
					}
				} elseif ( ! empty( $featurette_item['image_url_fallback_for_default'] ) ) {
					// Usar el fallback solo si no hay image_id y es parte de los defaults del PHP
					$image_url = esc_url( $featurette_item['image_url_fallback_for_default'] );
				}

				$text_order_class  = sanitize_html_class( $featurette_item['text_order_class'] );
				$image_order_class = sanitize_html_class( $featurette_item['image_order_class'] );

				// Añadir un separador antes de cada featurette excepto la primera.
				if ( $index > 0 ) {
					echo '<hr class="featurette-divider">';
				}
				?>

				<div class="row featurette bh-preview-featurette-item" data-featurette-index="<?php echo esc_attr($index); ?>"> <?php // Clase y data-attribute añadidos ?>
					<div class="col-md-7 <?php echo $text_order_class; ?>">
						<h2 class="featurette-heading fw-normal lh-1 bh-preview-featurette-title">
							<?php echo $title; ?>
							<?php if ( ! empty( $subtitle_muted ) ) : ?>
								<span class="text-body-secondary bh-preview-featurette-subtitle"><?php echo $subtitle_muted; ?></span>
							<?php endif; ?>
						</h2>
						<p class="lead bh-preview-featurette-text"><?php echo $description; ?></p>
					</div>
					<div class="col-md-5 <?php echo $image_order_class; ?>">
						<?php if ( ! empty( $image_url ) ) : ?>
							<img class="bd-placeholder-img bd-placeholder-img-lg featurette-image img-fluid mx-auto bh-preview-featurette-image" width="500" height="500" src="<?php echo esc_url( $image_url ); ?>" alt="<?php echo $image_alt; ?>" role="img" style="object-fit: cover;">
						<?php else : // Fallback a un SVG si no hay image_url, aunque el default ya provee una. ?>
							<svg class="bd-placeholder-img bd-placeholder-img-lg featurette-image img-fluid mx-auto" width="500" height="500" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="<?php echo $image_alt; ?>" preserveAspectRatio="xMidYMid slice" focusable="false">
								<title><?php echo esc_html( $image_alt ); ?></title>
								<rect width="100%" height="100%" fill="var(--bs-secondary-bg)"/>
								<text x="50%" y="50%" fill="var(--bs-secondary-color)" dy=".3em">500x500</text>
							</svg>
						<?php endif; ?>
					</div>
				</div>
			<?php endforeach; ?>
		</div> <?php // Cierre de bh-preview-featurettes-container ?>

		<hr class="featurette-divider">

	</div><!-- /.container -->
</section>
<?php
endif; // Fin de if ! empty( $section_content['featurettes'] )
?>