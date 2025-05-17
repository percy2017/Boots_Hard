<?php
/**
 * Boots Hard Theme Customizer
 *
 * @package Boots_Hard
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 * Adds theme customization options.
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function boots_hard_customize_register( $wp_customize ) {

    // Panel: Estilos del Tema
    $wp_customize->add_panel( 'boots_hard_styles_panel', array(
        'title'       => __( 'Estilos del Tema', 'boots-hard' ),
        'description' => __( 'Personaliza los colores, tipografía y tamaños de tu tema Boots Hard.', 'boots-hard' ),
        'priority'    => 30, // Ajusta la prioridad para la posición en el personalizador
    ) );

    // --- Sección: Colores ---
    $wp_customize->add_section( 'boots_hard_colors_section', array(
        'title'    => __( 'Colores', 'boots-hard' ),
        'panel'    => 'boots_hard_styles_panel',
        'priority' => 10,
    ) );

    // Ajuste: Color Primario
    $wp_customize->add_setting( 'bh_primary_color', array(
        'default'           => '#0d6efd',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'postMessage',
    ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'bh_primary_color', array(
        'label'    => __( 'Color Primario', 'boots-hard' ),
        'section'  => 'boots_hard_colors_section',
        'settings' => 'bh_primary_color',
    ) ) );

    // Ajuste: Color Secundario
    $wp_customize->add_setting( 'bh_secondary_color', array(
        'default'           => '#6c757d',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'postMessage',
    ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'bh_secondary_color', array(
        'label'    => __( 'Color Secundario', 'boots-hard' ),
        'section'  => 'boots_hard_colors_section',
        'settings' => 'bh_secondary_color',
    ) ) );

    // Ajuste: Color del Texto del Cuerpo
    $wp_customize->add_setting( 'bh_body_text_color', array(
        'default'           => '#212529',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'postMessage',
    ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'bh_body_text_color', array(
        'label'    => __( 'Color del Texto (Cuerpo)', 'boots-hard' ),
        'section'  => 'boots_hard_colors_section',
        'settings' => 'bh_body_text_color',
    ) ) );

    // Ajuste: Color de Fondo del Cuerpo
    $wp_customize->add_setting( 'bh_body_bg_color', array(
        'default'           => '#ffffff',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'postMessage',
    ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'bh_body_bg_color', array(
        'label'    => __( 'Color de Fondo (Cuerpo)', 'boots-hard' ),
        'section'  => 'boots_hard_colors_section',
        'settings' => 'bh_body_bg_color',
    ) ) );

    // Ajuste: Color Success
    $wp_customize->add_setting( 'bh_success_color', array(
        'default'           => '#198754',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'postMessage',
    ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'bh_success_color', array(
        'label'    => __( 'Color Success', 'boots-hard' ),
        'section'  => 'boots_hard_colors_section',
        'settings' => 'bh_success_color',
    ) ) );

    // Ajuste: Color Danger
    $wp_customize->add_setting( 'bh_danger_color', array(
        'default'           => '#dc3545',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'postMessage',
    ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'bh_danger_color', array(
        'label'    => __( 'Color Danger', 'boots-hard' ),
        'section'  => 'boots_hard_colors_section',
        'settings' => 'bh_danger_color',
    ) ) );

    // Ajuste: Color Warning
    $wp_customize->add_setting( 'bh_warning_color', array(
        'default'           => '#ffc107',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'postMessage',
    ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'bh_warning_color', array(
        'label'    => __( 'Color Warning', 'boots-hard' ),
        'section'  => 'boots_hard_colors_section',
        'settings' => 'bh_warning_color',
    ) ) );

    // Ajuste: Color Info
    $wp_customize->add_setting( 'bh_info_color', array(
        'default'           => '#0dcaf0',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'postMessage',
    ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'bh_info_color', array(
        'label'    => __( 'Color Info', 'boots-hard' ),
        'section'  => 'boots_hard_colors_section',
        'settings' => 'bh_info_color',
    ) ) );

    // Ajuste: Color Light
    $wp_customize->add_setting( 'bh_light_color', array(
        'default'           => '#f8f9fa',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'postMessage',
    ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'bh_light_color', array(
        'label'    => __( 'Color Light', 'boots-hard' ),
        'section'  => 'boots_hard_colors_section',
        'settings' => 'bh_light_color',
    ) ) );

    // Ajuste: Color Dark
    $wp_customize->add_setting( 'bh_dark_color', array(
        'default'           => '#212529',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'postMessage',
    ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'bh_dark_color', array(
        'label'    => __( 'Color Dark', 'boots-hard' ),
        'section'  => 'boots_hard_colors_section',
        'settings' => 'bh_dark_color',
    ) ) );

    // --- Sección: Diseño y Ancho ---
    $wp_customize->add_section( 'boots_hard_layout_section', array(
        'title'    => __( 'Diseño y Ancho', 'boots-hard' ),
        'panel'    => 'boots_hard_styles_panel',
        'priority' => 25, // Antes de Tipografía, después de Colores
    ) );

    $container_choices = array(
        'container'       => __( 'Ancho Fijo (container)', 'boots-hard' ),
        'container-fluid' => __( 'Ancho Completo (container-fluid)', 'boots-hard' ),
    );

    // Ajuste: Ancho del Contenido Principal de la Página
    $wp_customize->add_setting( 'bh_page_container_class', array(
        'default'           => 'container',
        'sanitize_callback' => 'boots_hard_sanitize_container_class',
        'transport'         => 'postMessage',
    ) );
    $wp_customize->add_control( 'bh_page_container_class', array(
        'label'    => __( 'Ancho del Contenido Principal (Página)', 'boots-hard' ),
        'section'  => 'boots_hard_layout_section',
        'type'     => 'select',
        'choices'  => $container_choices,
        'settings' => 'bh_page_container_class',
        'description' => __( 'Afecta al contenedor principal de páginas y entradas.', 'boots-hard'),
    ) );

    // Ajuste: Ancho Interno de las Secciones
    $wp_customize->add_setting( 'bh_section_inner_container_class', array(
        'default'           => 'container',
        'sanitize_callback' => 'boots_hard_sanitize_container_class',
        'transport'         => 'postMessage',
    ) );
    $wp_customize->add_control( 'bh_section_inner_container_class', array(
        'label'    => __( 'Ancho Interno de Secciones', 'boots-hard' ),
        'section'  => 'boots_hard_layout_section',
        'type'     => 'select',
        'choices'  => $container_choices,
        'settings' => 'bh_section_inner_container_class',
        'description' => __( 'Afecta al contenedor interno de las secciones de la página de inicio.', 'boots-hard'),
    ) );

    // Ajuste: Menú de Navegación Fijo
    $wp_customize->add_setting( 'bh_fixed_navbar', array(
        'default'           => false,
        'sanitize_callback' => 'wp_validate_boolean',
        'transport'         => 'postMessage',
    ) );
    $wp_customize->add_control( 'bh_fixed_navbar', array(
        'label'       => __( 'Menú de Navegación Fijo (Sticky)', 'boots-hard' ),
        'section'     => 'boots_hard_layout_section', // Agregado a la sección de Diseño y Ancho
        'type'        => 'checkbox',
        'settings'    => 'bh_fixed_navbar',
        'description' => __( 'Fija el menú principal en la parte superior de la página al hacer scroll.', 'boots-hard'),
    ) );

    // --- Sección: Tipografía ---
    $wp_customize->add_section( 'boots_hard_typography_section', array(
        'title'    => __( 'Tipografía', 'boots-hard' ),
        'panel'    => 'boots_hard_styles_panel',
        'priority' => 30, // Después de Diseño y Ancho
    ) );

    $font_choices = array(
		'System Stack' => 'system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", "Liberation Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji"',
		'Arial, Helvetica, sans-serif' => 'Arial, Helvetica, sans-serif',
		'Verdana, Geneva, sans-serif' => 'Verdana, Geneva, sans-serif',
		'Tahoma, Geneva, sans-serif' => 'Tahoma, Geneva, sans-serif',
		'"Trebuchet MS", Helvetica, sans-serif' => '"Trebuchet MS", Helvetica, sans-serif',
		'Georgia, serif' => 'Georgia, serif',
		'"Times New Roman", Times, serif' => '"Times New Roman", Times, serif',
	);

    // Ajuste: Familia de Fuente del Cuerpo
    $wp_customize->add_setting( 'bh_body_font_family', array(
        'default'           => 'System Stack',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ) );
    $wp_customize->add_control( 'bh_body_font_family', array(
        'label'    => __( 'Familia de Fuente (Cuerpo)', 'boots-hard' ),
        'section'  => 'boots_hard_typography_section',
        'type'     => 'select',
        'choices'  => $font_choices,
    ) );

    // Ajuste: Familia de Fuente de Encabezados
    $wp_customize->add_setting( 'bh_heading_font_family', array(
        'default'           => 'System Stack',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ) );
    $wp_customize->add_control( 'bh_heading_font_family', array(
        'label'    => __( 'Familia de Fuente (Encabezados)', 'boots-hard' ),
        'section'  => 'boots_hard_typography_section',
        'type'     => 'select',
        'choices'  => $font_choices,
    ) );

    // --- Sección: Tamaños de Fuente ---
    $wp_customize->add_section( 'boots_hard_sizes_section', array(
        'title'    => __( 'Tamaños de Fuente', 'boots-hard' ),
        'panel'    => 'boots_hard_styles_panel',
        'priority' => 35, // Después de Tipografía
    ) );

    // Ajuste: Tamaño de Fuente del Cuerpo
    $wp_customize->add_setting( 'bh_body_font_size', array(
        'default'           => '16',
        'sanitize_callback' => 'absint',
        'transport'         => 'postMessage',
    ) );
    $wp_customize->add_control( 'bh_body_font_size', array(
        'label'       => __( 'Tamaño de Fuente (Cuerpo, en px)', 'boots-hard' ),
        'section'     => 'boots_hard_sizes_section',
        'type'        => 'number',
        'input_attrs' => array(
            'min'  => 10,
            'max'  => 30,
            'step' => 1,
        ),
    ) );

    // Ajuste: Tamaño de Fuente de Encabezados (ej. H1)
    $wp_customize->add_setting( 'bh_h1_font_size', array(
        'default'           => '32',
        'sanitize_callback' => 'absint',
        'transport'         => 'postMessage',
    ) );
    $wp_customize->add_control( 'bh_h1_font_size', array(
        'label'       => __( 'Tamaño de Fuente (H1, en px)', 'boots-hard' ),
        'section'     => 'boots_hard_sizes_section',
        'type'        => 'number',
        'input_attrs' => array(
            'min'  => 20,
            'max'  => 72,
            'step' => 1,
        ),
    ) );
    
    // --- Sección: Espaciado entre Secciones ---
    $wp_customize->add_section( 'boots_hard_spacing_section', array(
        'title'    => __( 'Espaciado entre Secciones', 'boots-hard' ),
        'panel'    => 'boots_hard_styles_panel',
        'priority' => 40, // Después de Tamaños de Fuente
    ) );

    $spacing_choices = array(
        'py-0' => __( 'Ninguno (py-0)', 'boots-hard' ),
        'py-1' => __( 'Muy Pequeño (py-1)', 'boots-hard' ),
        'py-2' => __( 'Pequeño (py-2)', 'boots-hard' ),
        'py-3' => __( 'Mediano (py-3)', 'boots-hard' ),
        'py-4' => __( 'Grande (py-4)', 'boots-hard' ),
        'py-5' => __( 'Muy Grande (py-5)', 'boots-hard' ),
    );

    $wp_customize->add_setting( 'bh_section_spacing_class', array(
        'default'           => 'py-3',
        'sanitize_callback' => 'boots_hard_sanitize_spacing_class',
        'transport'         => 'postMessage',
    ) );

    $wp_customize->add_control( 'bh_section_spacing_class', array(
        'label'    => __( 'Espaciado Vertical de Secciones', 'boots-hard' ),
        'section'  => 'boots_hard_spacing_section',
        'type'     => 'select',
        'choices'  => $spacing_choices,
        'settings' => 'bh_section_spacing_class',
    ) );

    // --- Sección: Resetear Estilos ---
    $wp_customize->add_section( 'boots_hard_reset_section', array(
        'title'       => __( 'Resetear Estilos', 'boots-hard' ),
        'panel'       => 'boots_hard_styles_panel',
        'priority'    => 999,
        'description' => __( 'Haz clic en el botón para restaurar todos los estilos de este panel a sus valores por defecto. Necesitarás guardar los cambios para que el reseteo persista.', 'boots-hard' ),
    ) );

    // Control: Botón de Resetear
    if ( class_exists( 'WP_Customize_Control' ) ) {
        class Boots_Hard_Reset_Control extends WP_Customize_Control {
            public $type = 'boots_hard_reset_button';

            public function render_content() {
                ?>
                <p>
                    <button type="button" id="boots-hard-reset-styles-button" class="button button-secondary">
                        <?php esc_html_e( 'Resetear Todos los Estilos del Tema', 'boots-hard' ); ?>
                    </button>
                </p>
                <?php
            }
        }
    }

    $wp_customize->add_setting( 'bh_reset_styles_button_dummy_setting', array(
        'sanitize_callback' => 'wp_filter_nohtml_kses',
        'transport' => 'postMessage',
    ));

    $wp_customize->add_control( new Boots_Hard_Reset_Control( $wp_customize, 'bh_reset_styles_button', array(
        'section'  => 'boots_hard_reset_section',
        'settings' => 'bh_reset_styles_button_dummy_setting',
    ) ) );

}
add_action( 'customize_register', 'boots_hard_customize_register' );

/**
 * Sanitize callback for spacing class selection.
 */
function boots_hard_sanitize_spacing_class( $input ) {
    $valid_classes = array( 'py-0', 'py-1', 'py-2', 'py-3', 'py-4', 'py-5' );
    if ( in_array( $input, $valid_classes, true ) ) {
        return $input;
    }
    return 'py-3';
}

/**
 * Sanitize callback for container class selection.
 */
function boots_hard_sanitize_container_class( $input ) {
    $valid_classes = array( 'container', 'container-fluid' );
    if ( in_array( $input, $valid_classes, true ) ) {
        return $input;
    }
    return 'container';
}


/**
 * Helper function to get contrasting text color.
 */
function boots_hard_get_contrasting_text_color( $hex_color ) {
    $hex_color = ltrim( $hex_color, '#' );
    if ( strlen( $hex_color ) === 3 ) {
        $hex_color = $hex_color[0] . $hex_color[0] . $hex_color[1] . $hex_color[1] . $hex_color[2] . $hex_color[2];
    }
    if ( strlen( $hex_color ) !== 6 ) {
        return '#000000';
    }
    $r = hexdec( substr( $hex_color, 0, 2 ) );
    $g = hexdec( substr( $hex_color, 2, 2 ) );
    $b = hexdec( substr( $hex_color, 4, 2 ) );
    $luminance = ( ( $r * 299 ) + ( $g * 587 ) + ( $b * 114 ) ) / 1000;
    return $luminance >= 128 ? '#000000' : '#ffffff';
}

/**
 * Genera y añade el CSS personalizado al head.
 */
function boots_hard_customize_css() {
    ?>
    <style type="text/css" id="boots-hard-customizer-styles">
        <?php
        // --- Colores ---
        $primary_color = get_theme_mod( 'bh_primary_color', '#0d6efd' );
        $primary_text_color = boots_hard_get_contrasting_text_color( $primary_color );
        if ( $primary_color !== '#0d6efd' ) : ?>
            a, .text-primary { color: <?php echo esc_attr( $primary_color ); ?>; }
            .btn-primary {
                background-color: <?php echo esc_attr( $primary_color ); ?>;
                border-color: <?php echo esc_attr( $primary_color ); ?>;
                color: <?php echo esc_attr( $primary_text_color ); ?>;
            }
            .btn-primary:hover { filter: brightness(90%); }
            .btn-outline-primary {
                color: <?php echo esc_attr( $primary_color ); ?>;
                border-color: <?php echo esc_attr( $primary_color ); ?>;
            }
            .btn-outline-primary:hover {
                background-color: <?php echo esc_attr( $primary_color ); ?>;
                color: <?php echo esc_attr( $primary_text_color ); ?>;
            }
            .alert-primary {
                background-color: <?php echo esc_attr( $primary_color ); ?>;
                border-color: <?php echo esc_attr( $primary_color ); ?>;
                color: <?php echo esc_attr( $primary_text_color ); ?>;
            }
            .bg-primary { background-color: <?php echo esc_attr( $primary_color ); ?> !important; }
            .text-bg-primary { background-color: <?php echo esc_attr( $primary_color ); ?> !important; color: <?php echo esc_attr( $primary_text_color ); ?> !important; }
            .progress-bar.bg-primary { background-color: <?php echo esc_attr( $primary_color ); ?> !important; color: <?php echo esc_attr( $primary_text_color ); ?>; }
        <?php endif; ?>

        <?php
        $secondary_color = get_theme_mod( 'bh_secondary_color', '#6c757d' );
        $secondary_text_color = boots_hard_get_contrasting_text_color( $secondary_color );
        if ( $secondary_color !== '#6c757d' ) : ?>
            .text-secondary { color: <?php echo esc_attr( $secondary_color ); ?>; }
            .btn-secondary {
                background-color: <?php echo esc_attr( $secondary_color ); ?>;
                border-color: <?php echo esc_attr( $secondary_color ); ?>;
                color: <?php echo esc_attr( $secondary_text_color ); ?>;
            }
            .btn-secondary:hover { filter: brightness(90%); }
            .btn-outline-secondary { color: <?php echo esc_attr( $secondary_color ); ?>; border-color: <?php echo esc_attr( $secondary_color ); ?>; }
            .btn-outline-secondary:hover { background-color: <?php echo esc_attr( $secondary_color ); ?>; color: <?php echo esc_attr( $secondary_text_color ); ?>; }
            .alert-secondary { background-color: <?php echo esc_attr( $secondary_color ); ?>; border-color: <?php echo esc_attr( $secondary_color ); ?>; color: <?php echo esc_attr( $secondary_text_color ); ?>; }
            .bg-secondary { background-color: <?php echo esc_attr( $secondary_color ); ?> !important; }
            .text-bg-secondary { background-color: <?php echo esc_attr( $secondary_color ); ?> !important; color: <?php echo esc_attr( $secondary_text_color ); ?> !important; }
        <?php endif; ?>

        <?php
        $body_text_color = get_theme_mod( 'bh_body_text_color', '#212529' );
        if ( $body_text_color !== '#212529' ) : ?>
            body, p { color: <?php echo esc_attr( $body_text_color ); ?>; }
        <?php endif; ?>

        <?php
        $body_bg_color = get_theme_mod( 'bh_body_bg_color', '#ffffff' );
        if ( $body_bg_color !== '#ffffff' ) : ?>
            body { background-color: <?php echo esc_attr( $body_bg_color ); ?>; }
        <?php endif; ?>

        <?php
        $success_color = get_theme_mod( 'bh_success_color', '#198754' );
        $success_text_color = boots_hard_get_contrasting_text_color( $success_color );
        if ( $success_color !== '#198754' ) : ?>
            .text-success { color: <?php echo esc_attr( $success_color ); ?>; }
            .btn-success { background-color: <?php echo esc_attr( $success_color ); ?>; border-color: <?php echo esc_attr( $success_color ); ?>; color: <?php echo esc_attr( $success_text_color ); ?>; }
            .btn-success:hover { filter: brightness(90%); }
            .btn-outline-success { color: <?php echo esc_attr( $success_color ); ?>; border-color: <?php echo esc_attr( $success_color ); ?>; }
            .btn-outline-success:hover { background-color: <?php echo esc_attr( $success_color ); ?>; color: <?php echo esc_attr( $success_text_color ); ?>; }
            .alert-success { background-color: <?php echo esc_attr( $success_color ); ?>; border-color: <?php echo esc_attr( $success_color ); ?>; color: <?php echo esc_attr( $success_text_color ); ?>; }
            .bg-success { background-color: <?php echo esc_attr( $success_color ); ?> !important; }
            .text-bg-success { background-color: <?php echo esc_attr( $success_color ); ?> !important; color: <?php echo esc_attr( $success_text_color ); ?> !important; }
            .progress-bar.bg-success { background-color: <?php echo esc_attr( $success_color ); ?> !important; color: <?php echo esc_attr( $success_text_color ); ?>; }
        <?php endif; ?>

        <?php
        $danger_color = get_theme_mod( 'bh_danger_color', '#dc3545' );
        $danger_text_color = boots_hard_get_contrasting_text_color( $danger_color );
        if ( $danger_color !== '#dc3545' ) : ?>
            .text-danger { color: <?php echo esc_attr( $danger_color ); ?>; }
            .btn-danger { background-color: <?php echo esc_attr( $danger_color ); ?>; border-color: <?php echo esc_attr( $danger_color ); ?>; color: <?php echo esc_attr( $danger_text_color ); ?>; }
            .btn-danger:hover { filter: brightness(90%); }
            .btn-outline-danger { color: <?php echo esc_attr( $danger_color ); ?>; border-color: <?php echo esc_attr( $danger_color ); ?>; }
            .btn-outline-danger:hover { background-color: <?php echo esc_attr( $danger_color ); ?>; color: <?php echo esc_attr( $danger_text_color ); ?>; }
            .alert-danger { background-color: <?php echo esc_attr( $danger_color ); ?>; border-color: <?php echo esc_attr( $danger_color ); ?>; color: <?php echo esc_attr( $danger_text_color ); ?>; }
            .bg-danger { background-color: <?php echo esc_attr( $danger_color ); ?> !important; }
        <?php endif; ?>

        <?php
        $warning_color = get_theme_mod( 'bh_warning_color', '#ffc107' );
        $warning_text_color = boots_hard_get_contrasting_text_color( $warning_color );
        if ( $warning_color !== '#ffc107' ) : ?>
            .text-warning { color: <?php echo esc_attr( $warning_color ); ?>; }
            .btn-warning { background-color: <?php echo esc_attr( $warning_color ); ?>; border-color: <?php echo esc_attr( $warning_color ); ?>; color: <?php echo esc_attr( $warning_text_color ); ?>; }
            .btn-warning:hover { filter: brightness(90%); }
            .btn-outline-warning { color: <?php echo esc_attr( $warning_color ); ?>; border-color: <?php echo esc_attr( $warning_color ); ?>; }
            .btn-outline-warning:hover { background-color: <?php echo esc_attr( $warning_color ); ?>; color: <?php echo esc_attr( $warning_text_color ); ?>; }
            .alert-warning { background-color: <?php echo esc_attr( $warning_color ); ?>; border-color: <?php echo esc_attr( $warning_color ); ?>; color: <?php echo esc_attr( $warning_text_color ); ?>; }
            .bg-warning { background-color: <?php echo esc_attr( $warning_color ); ?> !important; }
        <?php endif; ?>

        <?php
        $info_color = get_theme_mod( 'bh_info_color', '#0dcaf0' );
        $info_text_color = boots_hard_get_contrasting_text_color( $info_color );
        if ( $info_color !== '#0dcaf0' ) : ?>
            .text-info { color: <?php echo esc_attr( $info_color ); ?>; }
            .btn-info { background-color: <?php echo esc_attr( $info_color ); ?>; border-color: <?php echo esc_attr( $info_color ); ?>; color: <?php echo esc_attr( $info_text_color ); ?>; }
            .btn-info:hover { filter: brightness(90%); }
            .btn-outline-info { color: <?php echo esc_attr( $info_color ); ?>; border-color: <?php echo esc_attr( $info_color ); ?>; }
            .btn-outline-info:hover { background-color: <?php echo esc_attr( $info_color ); ?>; color: <?php echo esc_attr( $info_text_color ); ?>; }
            .alert-info { background-color: <?php echo esc_attr( $info_color ); ?>; border-color: <?php echo esc_attr( $info_color ); ?>; color: <?php echo esc_attr( $info_text_color ); ?>; }
            .bg-info { background-color: <?php echo esc_attr( $info_color ); ?> !important; }
        <?php endif; ?>

        <?php
        $light_color = get_theme_mod( 'bh_light_color', '#f8f9fa' );
        $light_text_color = boots_hard_get_contrasting_text_color( $light_color );
        if ( $light_color !== '#f8f9fa' ) : ?>
            .btn-light { background-color: <?php echo esc_attr( $light_color ); ?>; border-color: <?php echo esc_attr( $light_color ); ?>; color: <?php echo esc_attr( $light_text_color ); ?>; }
            .btn-light:hover { filter: brightness(95%); }
            .btn-outline-light { color: <?php echo esc_attr( $light_text_color ); ?>; border-color: <?php echo esc_attr( $light_color ); ?>; }
            .btn-outline-light:hover { background-color: <?php echo esc_attr( $light_color ); ?>; color: <?php echo esc_attr( $light_text_color ); ?>; }
            .alert-light { background-color: <?php echo esc_attr( $light_color ); ?>; border-color: <?php echo esc_attr( $light_color ); ?>; color: <?php echo esc_attr( $light_text_color ); ?>; }
            .bg-light { background-color: <?php echo esc_attr( $light_color ); ?> !important; }
        <?php endif; ?>

        <?php
        $dark_color = get_theme_mod( 'bh_dark_color', '#212529' );
        $dark_text_color = boots_hard_get_contrasting_text_color( $dark_color );
        if ( $dark_color !== '#212529' ) : ?>
            .btn-dark { background-color: <?php echo esc_attr( $dark_color ); ?>; border-color: <?php echo esc_attr( $dark_color ); ?>; color: <?php echo esc_attr( $dark_text_color ); ?>; }
            .btn-dark:hover { filter: brightness(120%); }
            .btn-outline-dark { color: <?php echo esc_attr( $dark_color ); ?>; border-color: <?php echo esc_attr( $dark_color ); ?>; }
            .btn-outline-dark:hover { background-color: <?php echo esc_attr( $dark_color ); ?>; color: <?php echo esc_attr( $dark_text_color ); ?>; }
            .alert-dark { background-color: <?php echo esc_attr( $dark_color ); ?>; border-color: <?php echo esc_attr( $dark_color ); ?>; color: <?php echo esc_attr( $dark_text_color ); ?>; }
            .bg-dark { background-color: <?php echo esc_attr( $dark_color ); ?> !important; }
        <?php endif; ?>

        <?php
        // Tipografía
        $default_font_stack = 'system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", "Liberation Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji"';
        $body_font_family_key = get_theme_mod( 'bh_body_font_family', 'System Stack' );
        global $font_choices; 
        if (empty($font_choices)) { 
            $font_choices = array(
                'System Stack' => $default_font_stack,
                'Arial, Helvetica, sans-serif' => 'Arial, Helvetica, sans-serif',
                'Verdana, Geneva, sans-serif' => 'Verdana, Geneva, sans-serif',
                'Tahoma, Geneva, sans-serif' => 'Tahoma, Geneva, sans-serif',
                '"Trebuchet MS", Helvetica, sans-serif' => '"Trebuchet MS", Helvetica, sans-serif',
                'Georgia, serif' => 'Georgia, serif',
                '"Times New Roman", Times, serif' => '"Times New Roman", Times, serif',
            );
        }
        $body_font_family = isset($font_choices[$body_font_family_key]) ? $font_choices[$body_font_family_key] : $default_font_stack;

        if ( $body_font_family_key !== 'System Stack' ) :
        ?>
            body, p, button, input, select, textarea { font-family: <?php echo esc_attr( $body_font_family ); ?>; }
        <?php endif; ?>

        <?php
        $heading_font_family_key = get_theme_mod( 'bh_heading_font_family', 'System Stack' );
        $heading_font_family = isset($font_choices[$heading_font_family_key]) ? $font_choices[$heading_font_family_key] : $default_font_stack;

        if ( $heading_font_family_key !== 'System Stack' ) :
        ?>
            h1, h2, h3, h4, h5, h6, .h1, .h2, .h3, .h4, .h5, .h6 { font-family: <?php echo esc_attr( $heading_font_family ); ?>; }
        <?php endif; ?>

        <?php
        // Tamaños de Fuente
        $body_font_size = get_theme_mod( 'bh_body_font_size', '16' );
        if ( $body_font_size !== '16' ) : ?>
            body { font-size: <?php echo esc_attr( $body_font_size ); ?>px; }
        <?php endif; ?>

        <?php
        $h1_font_size = get_theme_mod( 'bh_h1_font_size', '32' );
        if ( $h1_font_size !== '32' ) : ?>
            h1, .h1 { font-size: <?php echo esc_attr( $h1_font_size ); ?>px; }
        <?php endif; ?>

    </style>
    <?php
}
add_action( 'wp_head', 'boots_hard_customize_css' );

/**
 * Enqueue Customizer JavaScript for live preview and reset button functionality.
 */
function boots_hard_customize_preview_js() {
    wp_enqueue_script(
        'boots-hard-customizer-preview',
        get_template_directory_uri() . '/assets/js/customizer-preview.js',
        array( 'customize-preview' ), 
        null, 
        true  
    );

    $settings_to_reset = array(
        'bh_primary_color' => array('id' => 'bh_primary_color', 'default' => '#0d6efd'),
        'bh_secondary_color' => array('id' => 'bh_secondary_color', 'default' => '#6c757d'),
        'bh_body_text_color' => array('id' => 'bh_body_text_color', 'default' => '#212529'),
        'bh_body_bg_color' => array('id' => 'bh_body_bg_color', 'default' => '#ffffff'),
        'bh_success_color' => array('id' => 'bh_success_color', 'default' => '#198754'),
        'bh_danger_color' => array('id' => 'bh_danger_color', 'default' => '#dc3545'),
        'bh_warning_color' => array('id' => 'bh_warning_color', 'default' => '#ffc107'),
        'bh_info_color' => array('id' => 'bh_info_color', 'default' => '#0dcaf0'),
        'bh_light_color' => array('id' => 'bh_light_color', 'default' => '#f8f9fa'),
        'bh_dark_color' => array('id' => 'bh_dark_color', 'default' => '#212529'),
        'bh_body_font_family' => array('id' => 'bh_body_font_family', 'default' => 'System Stack'),
        'bh_heading_font_family' => array('id' => 'bh_heading_font_family', 'default' => 'System Stack'),
        'bh_body_font_size' => array('id' => 'bh_body_font_size', 'default' => '16'),
        'bh_h1_font_size' => array('id' => 'bh_h1_font_size', 'default' => '32'),
        'bh_page_container_class' => array('id' => 'bh_page_container_class', 'default' => 'container'),
        'bh_section_inner_container_class' => array('id' => 'bh_section_inner_container_class', 'default' => 'container'),
        'bh_fixed_navbar' => array('id' => 'bh_fixed_navbar', 'default' => false),
        'bh_section_spacing_class' => array('id' => 'bh_section_spacing_class', 'default' => 'py-3'),
    );
    wp_localize_script( 'boots-hard-customizer-preview', 'bootsHardCustomizerReset', array(
        'settings' => $settings_to_reset
    ) );
}
add_action( 'customize_preview_init', 'boots_hard_customize_preview_js' );

/**
 * Enqueue Customizer JavaScript for controls functionality (like reset button).
 */
function boots_hard_customize_controls_js() {
    wp_enqueue_script(
        'boots-hard-customizer-controls',
        get_template_directory_uri() . '/assets/js/customizer-controls.js',
        array( 'customize-controls', 'jquery' ), 
        null, 
        true  
    );
}
add_action( 'customize_controls_enqueue_scripts', 'boots_hard_customize_controls_js' );
?>
