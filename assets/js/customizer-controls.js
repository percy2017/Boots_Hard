(function ($, api) {
    "use strict";

    // Asegúrate de que el Customizer API esté listo
    api.bind('ready', function () {

        // Busca el botón de reseteo por su ID
        $('#boots-hard-reset-styles-button').on('click', function (e) {
            e.preventDefault(); // Prevenir cualquier acción por defecto del botón

            // Confirmación (opcional pero recomendable)
            if (confirm('¿Estás seguro de que quieres resetear todos los estilos del tema a sus valores por defecto? Los cambios no guardados se perderán.')) {
                // Cambia el valor del setting 'dummy'. Esto activará el 'bind' en customizer-preview.js
                api('bh_reset_styles_button_dummy_setting').set(new Date().getTime()); // Usar timestamp para asegurar un valor nuevo
            }
        });
    });
})(jQuery, wp.customize);