<?php
/**
 * Boots Hard Theme: Section Renderer
 *
 * Función para mostrar las secciones gestionadas en la página de inicio
 * u otras plantillas, según la configuración del Personalizador.
 *
 * @package Boots_Hard
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Muestra las secciones gestionadas por el Personalizador.
 *
 * Esta función recupera los datos de las secciones (orden, visibilidad, JSON)
 * guardados en el theme_mod 'boots_hard_managed_sections_data'.
 * Luego, itera sobre estas secciones y, si están marcadas como visibles,
 * incluye la plantilla de la sección correspondiente pasándole los datos del JSON.
 *
 * Se espera que las plantillas de sección (ej. template-parts/sections/mi-seccion.php)
 * estén preparadas para recibir y utilizar un array de datos `$section_data_from_json`.
 */
function boots_hard_display_managed_sections() {
    $managed_sections_json = get_theme_mod( 'boots_hard_managed_sections_data' );

    if ( empty( $managed_sections_json ) ) {
        // Si no hay datos guardados, podríamos mostrar un mensaje o nada.
        // O cargar secciones por defecto si esa fuera la lógica deseada.
        // Por ahora, no mostramos nada si no está configurado.
        if ( current_user_can( 'edit_theme_options' ) && is_customize_preview() ) {
            echo '<p style="text-align:center; padding: 2rem; background-color: #f0f0f0;">';
            echo esc_html__( 'No hay secciones configuradas o visibles. Configúralas en el Personalizador > Gestión de Secciones de Inicio.', 'boots-hard' );
            echo '</p>';
        }
        return;
    }

    $managed_sections = json_decode( $managed_sections_json, true );

    if ( ! is_array( $managed_sections ) || empty( $managed_sections ) ) {
        // Datos inválidos o vacíos después de decodificar.
        return;
    }

    // Contenedor principal para las secciones, útil para el JS de previsualización.
    echo '<div id="boots-hard-managed-sections-wrapper">';

    foreach ( $managed_sections as $section_config ) {
        if ( ! empty( $section_config['slug'] ) && ! empty( $section_config['visible'] ) && $section_config['visible'] ) {
            $section_slug = sanitize_key( $section_config['slug'] );
            $section_data_from_json = array();

            if ( ! empty( $section_config['json_content'] ) ) {
                $decoded_json = json_decode( $section_config['json_content'], true );
                if ( json_last_error() === JSON_ERROR_NONE && is_array( $decoded_json ) ) {
                    $section_data_from_json = $decoded_json;
                }
            }

            // Pasamos los datos del JSON a la plantilla de la sección.
            // La plantilla de sección deberá usar estos datos.
            set_query_var( 'section_data_from_json', $section_data_from_json ); // Para que esté disponible en get_template_part
            get_template_part( 'template-parts/sections/' . $section_slug, null, array('section_data_from_json' => $section_data_from_json) ); // WordPress 5.5+ puede pasar args directamente
            set_query_var( 'section_data_from_json', null ); // Limpiar para la siguiente iteración
        }
    }
    echo '</div>'; // Cierre de #boots-hard-managed-sections-wrapper
}
?>