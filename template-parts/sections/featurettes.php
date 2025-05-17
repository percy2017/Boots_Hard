<?php
/**
 * Template part for displaying the "Featurettes" section.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Boots_Hard
 */

// Datos por defecto para la sección de featurettes
$default_featurettes_data = array(
	array(
		'title'             => __( 'Primera Featurette Destacada.', 'boots-hard' ),
		'subtitle_muted'    => __( 'Te sorprenderá.', 'boots-hard' ),
		'description'       => __( 'Contenido placeholder genial para la primera featurette. Imagina una prosa emocionante aquí.', 'boots-hard' ),
		'svg_text'          => '500x500',
		'svg_alt'           => __( 'Placeholder: 500x500', 'boots-hard' ),
		'text_order_class'  => '', // Default: texto a la izquierda, imagen a la derecha
		'image_order_class' => '',
	),
	array(
		'title'             => __( 'Oh sí, es así de bueno.', 'boots-hard' ),
		'subtitle_muted'    => __( 'Compruébalo tú mismo.', 'boots-hard' ),
		'description'       => __( '¿Otra featurette? Por supuesto. Más contenido placeholder para darte una idea de cómo funcionaría este diseño con contenido real.', 'boots-hard' ),
		'svg_text'          => '500x500',
		'svg_alt'           => __( 'Placeholder: 500x500', 'boots-hard' ),
		'text_order_class'  => 'order-md-2', // Texto a la derecha
		'image_order_class' => 'order-md-1', // Imagen a la izquierda
	),
	array(
		'title'             => __( 'Y una más, para completar.', 'boots-hard' ),
		'subtitle_muted'    => __( 'Simplemente increíble.', 'boots-hard' ),
		'description'       => __( 'Esta es la última featurette de ejemplo, demostrando la flexibilidad y facilidad de uso de este componente.', 'boots-hard' ),
		'svg_text'          => '500x500',
		'svg_alt'           => __( 'Placeholder: 500x500', 'boots-hard' ),
		'text_order_class'  => '', // Default: texto a la izquierda, imagen a la derecha
		'image_order_class' => '',
	),
);

// En un futuro, podrías cargar estos datos desde el Personalizador de WordPress
// $customizer_data = get_theme_mod( 'featurettes_section_data', array() );
// $featurettes_data = ! empty( $customizer_data ) ? $customizer_data : $default_featurettes_data;
$featurettes_data              = $default_featurettes_data;
$section_spacing_class          = get_theme_mod( 'bh_section_spacing_class', 'py-3' );
$section_inner_container_class = get_theme_mod( 'bh_section_inner_container_class', 'container' );

if ( ! empty( $featurettes_data ) && is_array( $featurettes_data ) ) : ?>
<section id="featurettes-section" class="bh-theme-section <?php echo esc_attr( $section_spacing_class ); ?>">
	<div class="<?php echo esc_attr( $section_inner_container_class ); ?>">

		<?php foreach ( $featurettes_data as $index => $featurette_item ) : ?>
			<?php
			// Asegurarse de que los datos esperados existen y sanitizarlos/escaparlos
			$title             = isset( $featurette_item['title'] ) ? esc_html( $featurette_item['title'] ) : '';
			$subtitle_muted    = isset( $featurette_item['subtitle_muted'] ) ? esc_html( $featurette_item['subtitle_muted'] ) : '';
			$description       = isset( $featurette_item['description'] ) ? esc_html( $featurette_item['description'] ) : '';
			$svg_text          = isset( $featurette_item['svg_text'] ) ? esc_html( $featurette_item['svg_text'] ) : '500x500';
			$svg_alt           = isset( $featurette_item['svg_alt'] ) ? esc_attr( $featurette_item['svg_alt'] ) : 'Placeholder';
			$text_order_class  = isset( $featurette_item['text_order_class'] ) ? sanitize_html_class( $featurette_item['text_order_class'] ) : '';
			$image_order_class = isset( $featurette_item['image_order_class'] ) ? sanitize_html_class( $featurette_item['image_order_class'] ) : '';
			?>

			<hr class="featurette-divider">

			<div class="row featurette">
				<div class="col-md-7 <?php echo $text_order_class; ?>">
					<h2 class="featurette-heading fw-normal lh-1">
						<?php echo $title; ?>
						<?php if ( ! empty( $subtitle_muted ) ) : ?>
							<span class="text-body-secondary"><?php echo $subtitle_muted; ?></span>
						<?php endif; ?>
					</h2>
					<p class="lead"><?php echo $description; ?></p>
				</div>
				<div class="col-md-5 <?php echo $image_order_class; ?>">
					<svg class="bd-placeholder-img bd-placeholder-img-lg featurette-image img-fluid mx-auto" width="500" height="500" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="<?php echo $svg_alt; ?>" preserveAspectRatio="xMidYMid slice" focusable="false">
						<title><?php echo esc_html( $svg_alt ); // O un título más genérico como 'Placeholder' ?></title>
						<rect width="100%" height="100%" fill="var(--bs-secondary-bg)"/>
						<text x="50%" y="50%" fill="var(--bs-secondary-color)" dy=".3em"><?php echo $svg_text; ?></text>
					</svg>
				</div>
			</div>
		<?php endforeach; ?>

		<?php // Si quieres un <hr> final, puedes añadirlo aquí, aunque el ejemplo de Bootstrap no lo tiene después del último. ?>
		<!-- <hr class="featurette-divider"> -->

	</div><!-- /.container -->
</section>
<?php
endif; // Fin de if ! empty( $featurettes_data )
?>