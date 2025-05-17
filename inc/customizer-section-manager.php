<?php
/**
 * Boots Hard Theme: Customizer Section Manager
 *
 * @package Boots_Hard
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

// Asegurémonos de que BOOTS_HARD_VERSION esté definida.
if ( ! defined( 'BOOTS_HARD_VERSION' ) ) {
    $theme = wp_get_theme();
    define( 'BOOTS_HARD_VERSION', $theme->get( 'Version' ) );
}
    
/**
 * Registra el panel, sección, ajustes y controles para el gestor de secciones.
 *
 * @param WP_Customize_Manager $wp_customize Objeto Customizer.
 */
function boots_hard_customize_register_section_manager( $wp_customize ) {

    /**
     * Obtiene las secciones disponibles desde la carpeta template-parts/sections.
     * Intenta leer un encabezado "Section Name" del archivo para un nombre amigable.
     */
    function boots_hard_get_available_sections() {
        $sections_dir = get_theme_file_path( 'template-parts/sections' );
        $section_files = glob( $sections_dir . '/*.php' );
        $available_sections = array();

        if ( $section_files ) {
            foreach ( $section_files as $file ) {
                $slug = basename( $file, '.php' );
                // Intenta obtener un nombre más amigable desde el encabezado del archivo.
                // Ejemplo de encabezado en el archivo de sección:
                // <?php
                // /**
                //  * Section Name: Mis Tarjetas Personalizadas
                //  */
                $file_data = get_file_data( $file, array( 'SectionName' => 'Section Name' ) ); // WordPress lee 'Section Name' como clave.
                $name = ! empty( $file_data['SectionName'] ) ? $file_data['SectionName'] : ucwords( str_replace( '-', ' ', $slug ) );
                
                $available_sections[ $slug ] = array(
                    'slug' => $slug,
                    'name' => $name,
                    'path' => $file,
                );
            }
        }
        // Ordenar alfabéticamente por nombre para consistencia inicial
        uasort($available_sections, function($a, $b) {
            return strcmp($a['name'], $b['name']);
        });
        return $available_sections;
    }

    $available_sections = boots_hard_get_available_sections();

    // Si no hay secciones en la carpeta, no agregamos el panel.
    if ( empty( $available_sections ) ) {
        return;
    }

    // 1. Panel de Gestión de Secciones
    $wp_customize->add_panel( 'boots_hard_section_manager_panel', array(
        'title'       => __( 'Gestión de Secciones de Inicio', 'boots-hard' ),
        'description' => __( 'Organiza, muestra/oculta y personaliza el contenido de las secciones de tu página de inicio.', 'boots-hard' ),
        'priority'    => 35, // Justo después de "Estilos del Tema" (que podría estar en 30)
    ) );

    // 2. Sección Principal dentro del Panel
    $wp_customize->add_section( 'boots_hard_section_manager_main_section', array(
        'title'    => __( 'Configurar Secciones', 'boots-hard' ),
        'panel'    => 'boots_hard_section_manager_panel',
        'priority' => 10,
    ) );

    /**
     * Genera los datos por defecto para el ajuste 'boots_hard_managed_sections_data'.
     * Incluye todas las secciones detectadas, visibles por defecto y con JSON vacío.
     */
    function boots_hard_get_default_managed_sections_data( $detected_sections ) {
        $defaults = array();
        foreach ( $detected_sections as $slug => $section_data ) {
            $defaults[] = array(
                'slug'         => $slug,
                'name'         => $section_data['name'], // Guardamos el nombre para fácil acceso
                'visible'      => true,
                'json_content' => '{}',
            );
        }
        return $defaults;
    }

    /**
     * Sanitiza los datos del gestor de secciones.
     * Espera un array de objetos/arrays de sección.
     */
    function boots_hard_sanitize_managed_sections_data( $json_string_input ) {
        $sanitized_output_array = array();

        // El input debería ser un string JSON desde el control JS.
        if ( ! is_string( $json_string_input ) ) {
            // Fallback si no es un string (no debería ocurrir).
            return wp_json_encode( boots_hard_get_default_managed_sections_data( boots_hard_get_available_sections() ) );
        }

        $input_array = json_decode( $json_string_input, true );

        if ( ! is_array( $input_array ) ) {
            // Si el JSON decodificado no es un array, devolver un JSON de array vacío o el default.
            return wp_json_encode( boots_hard_get_default_managed_sections_data( boots_hard_get_available_sections() ) );
        }

        if ( is_array( $input_array ) ) { // Esta comprobación es redundante ahora, pero la mantenemos por si acaso.
            foreach ( $input_array as $section_item ) {
                if ( ! is_array( $section_item ) || empty( $section_item['slug'] ) ) {
                    continue;
                }
                $clean_item        = array();
                $clean_item['slug']    = sanitize_key( $section_item['slug'] );
                $clean_item['name']    = isset( $section_item['name'] ) ? sanitize_text_field( $section_item['name'] ) : ucwords( str_replace( '-', ' ', $clean_item['slug'] ) );
                $clean_item['visible'] = isset( $section_item['visible'] ) ? (bool) $section_item['visible'] : false;
                
                $json_content_input = isset( $section_item['json_content'] ) ? stripslashes_deep( $section_item['json_content'] ) : '{}';
                // Intentar decodificar y re-codificar para validar y normalizar el JSON
                $decoded_json = json_decode( $json_content_input );
                if ( json_last_error() === JSON_ERROR_NONE ) {
                    $clean_item['json_content'] = wp_json_encode( $decoded_json ); // Normaliza el JSON
                } else {
                    // Si no es JSON válido, guardar un objeto vacío o intentar sanitizar como texto simple
                    // Por seguridad, un JSON vacío es más seguro si la entrada es muy errónea.
                    $clean_item['json_content'] = '{}';
                    // Alternativa: $clean_item['json_content'] = sanitize_textarea_field( $json_content_input );
                }
                $sanitized_output_array[] = $clean_item;
            }
        }
        return wp_json_encode( $sanitized_output_array ); // Devolver un string JSON
    }

    // 3. Ajuste Principal (Setting)
    // Almacena un array de configuraciones de sección (slug, visibilidad, JSON).
    // El orden en el array determina el orden de visualización.
    $wp_customize->add_setting( 'boots_hard_managed_sections_data', array(
        'default'           => wp_json_encode( boots_hard_get_default_managed_sections_data( $available_sections ) ), // Ahora es un string JSON
        'transport'         => 'postMessage', // Para previsualización en vivo con JS
        'sanitize_callback' => 'boots_hard_sanitize_managed_sections_data',
        'type'              => 'theme_mod',
    ) );

    // 4. Control Personalizado para Gestionar Secciones
    // Necesitaremos una clase PHP que extienda WP_Customize_Control.
    if ( class_exists( 'WP_Customize_Control' ) ) {
        class Boots_Hard_Customize_Section_Manager_Control extends WP_Customize_Control {
            public $type = 'boots_hard_section_manager'; // Identificador único para el tipo de control
            public $available_sections = array();     // Pasaremos las secciones detectadas aquí

            public function __construct( $manager, $id, $args = array() ) {
                parent::__construct( $manager, $id, $args );
                if ( ! empty( $args['available_sections'] ) ) {
                    $this->available_sections = $args['available_sections'];
                }
            }

            public function enqueue() {
                // JS para la interactividad del control (drag & drop, etc.)
                wp_enqueue_script(
                    'boots-hard-customizer-section-manager-controls-js',
                    get_theme_file_uri( 'assets/js/customizer-section-manager-controls.js' ),
                    array( 'jquery', 'jquery-ui-sortable', 'customize-controls' ), // customize-controls para la API JS del personalizador
                    BOOTS_HARD_VERSION,
                    true // Cargar en el footer
                );
                // CSS para el control
                wp_enqueue_style(
                    'boots-hard-customizer-section-manager-controls-css',
                    get_theme_file_uri( 'assets/css/customizer-section-manager-controls.css' ),
                    array(),
                    BOOTS_HARD_VERSION
                );
            }

            // Renderiza el contenido HTML del control.
            // El JS se encargará de la lógica de drag & drop y la actualización del setting.
            public function render_content() {
                // El valor del setting es un string JSON que representa un array de secciones.
                $setting_value = $this->value(); // Puede ser un string JSON o un array PHP
                $sections_in_setting_array = array();

                if ( is_string( $setting_value ) ) {
                    $decoded_array = json_decode( $setting_value, true );
                    // Verificar si la decodificación fue exitosa y resultó en un array
                    if ( json_last_error() === JSON_ERROR_NONE && is_array( $decoded_array ) ) {
                        $sections_in_setting_array = $decoded_array;
                    } else {
                        // Si la decodificación falló o no es un array, usar los valores por defecto
                        $sections_in_setting_array = boots_hard_get_default_managed_sections_data( $this->available_sections );
                    }
                } elseif ( is_array( $setting_value ) ) {
                    // Si $this->value() ya devolvió un array, lo usamos directamente
                    $sections_in_setting_array = $setting_value;
                } else {
                    // Fallback para cualquier otro tipo inesperado o si $this->value() es null, vacío, etc.
                    $sections_in_setting_array = boots_hard_get_default_managed_sections_data( $this->available_sections );
                }

                // Sincronizar: asegurar que todas las secciones de archivo estén en los datos del setting.
                // Y que las secciones en el setting que ya no existen como archivo se marquen o eliminen (JS lo hará mejor).
                $current_data_for_js = array();
                $ordered_sections_from_setting = array();

                // Primero, crear un mapa de las secciones disponibles para fácil acceso
                $available_map = array();
                foreach($this->available_sections as $slug => $data) {
                    $available_map[$slug] = $data;
                }

                // Mantener el orden del setting y actualizar nombres/añadir nuevas
                foreach ($sections_in_setting_array as $item) {
                    $slug = $item['slug'];
                    if (isset($available_map[$slug])) { // Si la sección aún existe
                        $ordered_sections_from_setting[$slug] = array(
                            'slug'         => $slug,
                            'name'         => $available_map[$slug]['name'], // Usar nombre actualizado del archivo
                            'visible'      => isset($item['visible']) ? (bool)$item['visible'] : true,
                            'json_content' => isset($item['json_content']) ? $item['json_content'] : '{}',
                        );
                        unset($available_map[$slug]); // Marcar como procesada
                    }
                }
                // Añadir secciones nuevas (que están en archivos pero no en el setting) al final
                foreach ($available_map as $slug => $new_section_data) {
                     $ordered_sections_from_setting[$slug] = array(
                        'slug'         => $slug,
                        'name'         => $new_section_data['name'],
                        'visible'      => true,
                        'json_content' => '{}',
                    );
                }
                $current_data_for_js = array_values($ordered_sections_from_setting); // Re-indexar para JS

                ?>
                <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
                <?php if ( ! empty( $this->description ) ) : ?>
                    <span class="description customize-control-description"><?php echo esc_html( $this->description ); ?></span>
                <?php endif; ?>

                <div id="boots-hard-section-manager-container-<?php echo esc_attr($this->id); ?>" class="boots-hard-section-manager-container">
                    <ul class="boots-hard-sections-sortable">
                        <?php // El JS poblará esto basado en current_data_for_js y manejará la interactividad ?>
                    </ul>
                    <?php // Este input oculto almacenará el valor JSON del setting y será actualizado por JS ?>
                    <input type="hidden" class="boots-hard-section-manager-collector" <?php $this->link(); ?> value="<?php echo esc_attr( wp_json_encode( $current_data_for_js ) ); ?>" />
                </div>
                <script type="text/template" id="tmpl-bh-section-manager-item-template">
                    <li class="boots-hard-section-item" data-section-slug="{{ data.slug }}">
                        <div class="section-header">
                            <span class="dashicons dashicons-menu handle" title="<?php esc_attr_e( 'Arrastrar para ordenar', 'boots-hard' ); ?>"></span>
                            <strong class="section-name">{{ data.name }}</strong>
                            <div class="section-actions">
                                <button type="button" class="button-link section-toggle-visibility" title="<?php esc_attr_e( 'Alternar visibilidad', 'boots-hard' ); ?>">
                                    <span class="dashicons {{ data.visible ? 'dashicons-visibility' : 'dashicons-hidden' }}"></span>
                                </button>
                                <button type="button" class="button-link section-toggle-options" aria-expanded="false" title="<?php esc_attr_e( 'Mostrar/ocultar opciones', 'boots-hard' ); ?>">
                                    <span class="dashicons dashicons-admin-generic"></span> <?php // Opciones ?>
                                </button>
                            </div>
                        </div>
                        <div class="section-options" style="display: none;">
                            <p class="option-visibility">
                                <label>
                                    <input type="checkbox" class="section-visible-checkbox" {{ data.visible ? 'checked' : '' }} />
                                    <?php esc_html_e( 'Visible en la página', 'boots-hard' ); ?>
                                </label>
                            </p>
                            <p class="option-json">
                                <label for="section-json-{{ data.slug }}"><?php esc_html_e( 'Contenido JSON:', 'boots-hard' ); ?></label>
                                <textarea class="section-json-textarea widefat" rows="8" id="section-json-{{ data.slug }}">{{ data.json_content_formatted }}</textarea>
                            </p>
                        </div>
                    </li>
                </script>
                <?php
            }
        }
    }

    // Registrar el control personalizado
    $wp_customize->add_control( new Boots_Hard_Customize_Section_Manager_Control( $wp_customize, 'boots_hard_managed_sections_data_control', array(
        'label'       => __( 'Administrador de Secciones', 'boots-hard' ),
        'description' => __( 'Arrastra para ordenar. Activa/desactiva la visibilidad y edita el JSON de cada sección.', 'boots-hard' ),
        'section'     => 'boots_hard_section_manager_main_section',
        'settings'    => 'boots_hard_managed_sections_data', // El setting que este control manejará
        'available_sections' => $available_sections,      // Pasar las secciones detectadas al control
        'priority'    => 10,
    ) ) );

}
add_action( 'customize_register', 'boots_hard_customize_register_section_manager', 20 ); // Prioridad para asegurar que se ejecute después de otros registros si es necesario.

/**
 * Enqueue scripts para la previsualización del Personalizador.
 * Se usará para la previsualización en vivo de los cambios de JSON.
 */
function boots_hard_section_manager_preview_scripts() {
    wp_enqueue_script(
        'boots-hard-customizer-section-manager-preview-js', // Handle único
        get_theme_file_uri( 'assets/js/customizer-section-manager-preview.js' ),
        array( 'customize-preview', 'jquery' ), // Dependencias
        BOOTS_HARD_VERSION,
        true // Cargar en el footer
    );
}
add_action( 'customize_preview_init', 'boots_hard_section_manager_preview_scripts' );

?>