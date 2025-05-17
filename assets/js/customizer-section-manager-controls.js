/**
 * Boots Hard Theme: Customizer Section Manager Controls
 *
 * Handles the interactivity for the section manager control in the Customizer.
 * - Renders section items.
 * - Enables drag & drop sorting.
 * - Handles visibility toggles and JSON content updates.
 * - Updates the main setting value.
 */
(function (wp, $) {
    'use strict';

    if (!wp || !wp.customize) {
        console.error('wp.customize not loaded. Section Manager Controls will not work.');
        return;
    }

    // Cuando el Personalizador esté listo y el control específico también
    wp.customize.control('boots_hard_managed_sections_data_control', function (control) {
        console.log('[BH Section Manager] Control boots_hard_managed_sections_data_control found.');

        // Esperar a que el control esté completamente incrustado en la página
        control.deferred.embedded.done(function () {
            console.log('[BH Section Manager] Control embedded. Initializing...');

            var container = control.container.find('.boots-hard-section-manager-container');
            console.log('[BH Section Manager] Container found:', container.length > 0);
            var sortableList = container.find('.boots-hard-sections-sortable');
            var hiddenInput = container.find('.boots-hard-section-manager-collector');
            var itemTemplate = wp.template('bh-section-manager-item-template');

            // Función para obtener los datos actuales del input oculto (que es el setting)
            function getCurrentData() {
                try {
                    console.log('[BH Section Manager] getCurrentData called. Raw input value:', hiddenInput.val());
                    var stringValueFromInput = hiddenInput.val();
                    var cleanJsonString;

                    if (typeof stringValueFromInput !== 'string') {
                        console.warn('hiddenInput.val() did not return a string. Attempting to use direct setting value. Value:', stringValueFromInput);
                        var settingDirectValue = wp.customize.instance(control.id).get();
                        if (typeof settingDirectValue === 'string') {
                            stringValueFromInput = settingDirectValue;
                        } else if (typeof settingDirectValue === 'object' && settingDirectValue !== null) {
                            // Si el setting es un objeto, lo usamos directamente (ya debería ser un array)
                            return Array.isArray(settingDirectValue) ? settingDirectValue : [];
                        } else {
                            stringValueFromInput = '[]'; // Fallback a un array JSON vacío
                        }
                    }

                    // Decodificar entidades HTML (ej. &quot; -> ") que esc_attr pudo haber introducido
                    var tempTextarea = document.createElement('textarea');
                    tempTextarea.innerHTML = stringValueFromInput;
                    cleanJsonString = tempTextarea.value;

                    var parsedData = JSON.parse(cleanJsonString);
                    console.log('[BH Section Manager] Parsed data in getCurrentData:', parsedData);
                    return Array.isArray(parsedData) ? parsedData : [];
                } catch (e) {
                    console.error('Error parsing section data. Raw input val:', hiddenInput.val(), 'Cleaned string:', typeof cleanJsonString !== 'undefined' ? cleanJsonString : 'N/A', 'Error:', e);
                    return []; // Devolver un array vacío en caso de error
                }
            }
            function updateSettingValue(newData) {
                // console.log('[BH Section Manager] updateSettingValue called with newData:', JSON.parse(JSON.stringify(newData))); // Loguear una copia profunda
                var jsonData = JSON.stringify(newData);
                hiddenInput.val(jsonData).trigger('change'); // 'change' es importante para que WP Customizer detecte la modificación
                // También actualizamos el setting directamente para asegurar la propagación
                control.setting.set(jsonData); // Usar la referencia directa al setting del control. 'control.setting' es el objeto wp.customize.Value.
            }

            // Función para renderizar un ítem de sección
            function renderSectionItem(sectionData) {
                console.log('[BH Section Manager] renderSectionItem called with data:', sectionData);
                console.log('[BH Section Manager] Type of itemTemplate:', typeof itemTemplate); // NUEVO LOG

                // Formatear JSON para el textarea
                try {
                    var parsedJson = JSON.parse(sectionData.json_content || '{}');
                    sectionData.json_content_formatted = JSON.stringify(parsedJson, null, 2); // Indentado con 2 espacios
                } catch (e) {
                    sectionData.json_content_formatted = sectionData.json_content || '{}'; // Usar original si falla el parseo
                }

                var renderedHtml = '';
                var $item = $(); // Inicializar como objeto jQuery vacío
                try {
                    renderedHtml = itemTemplate(sectionData);
                    console.log('[BH Section Manager] Raw HTML from template function:', renderedHtml);
                    $item = $(renderedHtml);
                } catch (templateError) {
                    console.error('[BH Section Manager] Error executing itemTemplate or converting to jQuery object:', templateError);
                    console.error('[BH Section Manager] Data passed to template:', sectionData);
                    return $(); // Devolver un objeto jQuery vacío para evitar más errores
                }
                console.log('[BH Section Manager] Rendered item HTML:', $item[0].outerHTML);
                sortableList.append($item);
                console.log('[BH Section Manager] Item appended. Sortable list children count:', sortableList.children().length);
                return $item;
            }

            // Función para renderizar todos los ítems
            function renderAllItems() {
                console.log('[BH Section Manager] renderAllItems called.');
                sortableList.empty();
                var currentData = getCurrentData();
                console.log('[BH Section Manager] Data for rendering items:', currentData);
                if (!currentData || currentData.length === 0) {
                    console.warn('[BH Section Manager] No data to render items.');
                }
                currentData.forEach(function (sectionData) {
                    renderSectionItem(sectionData);
                });
                attachItemEventListeners();
            }

            // Función para recolectar los datos actuales del DOM (después de ordenar, etc.)
            function collectDataFromDOM() {
                var newData = [];
                sortableList.find('.boots-hard-section-item').each(function () {
                    var $item = $(this);
                    var slug = $item.data('section-slug');
                    var name = $item.find('.section-name').text(); // O tomarlo de un atributo si es más fiable
                    var isVisible = $item.find('.section-visible-checkbox').is(':checked');
                    var jsonContent = $item.find('.section-json-textarea').val();

                    // Validar/normalizar JSON antes de guardar
                    try {
                        var parsed = JSON.parse(jsonContent);
                        jsonContent = JSON.stringify(parsed); // Re-stringify para normalizar
                    } catch (e) {
                        console.warn('Invalid JSON for section ' + slug + '. Saving as is or default.');
                        // jsonContent = '{}'; // Opcional: resetear a JSON vacío si es inválido
                    }

                    newData.push({
                        slug: slug,
                        name: name,
                        visible: isVisible,
                        json_content: jsonContent
                    });
                });
                return newData;
            }

            // Inicializar Sortable (Drag & Drop)
            function initializeSortable() {
                sortableList.sortable({
                    handle: '.handle',
                    axis: 'y',
                    update: function () {
                        var sortedData = collectDataFromDOM();
                        updateSettingValue(sortedData);
                    }
                }).disableSelection();
            }

            // Manejadores de eventos para los ítems (visibilidad, JSON, toggle opciones)
            function attachItemEventListeners() {
                // Toggle Visibilidad (checkbox y botón icono)
                sortableList.find('.section-visible-checkbox, .section-toggle-visibility').off('click change').on('click change', function(e) {
                    e.stopPropagation();
                    var $item = $(this).closest('.boots-hard-section-item');
                    var $checkbox = $item.find('.section-visible-checkbox');
                    var $icon = $item.find('.section-toggle-visibility .dashicons');
                    var isNowVisible;

                    if ($(this).is(':checkbox')) { // Si el cambio vino del checkbox
                        isNowVisible = $checkbox.is(':checked');
                    } else { // Si vino del botón icono
                        isNowVisible = !$checkbox.is(':checked'); // Invertir estado actual del checkbox
                        $checkbox.prop('checked', isNowVisible).trigger('change'); // Sincronizar y disparar change para que otros listeners actúen
                        return; // El 'change' del checkbox se encargará del resto
                    }

                    if (isNowVisible) {
                        $icon.removeClass('dashicons-hidden').addClass('dashicons-visibility');
                    } else {
                        $icon.removeClass('dashicons-visibility').addClass('dashicons-hidden');
                    }
                    updateSettingValue(collectDataFromDOM());
                });

                // Actualización del JSON
                sortableList.find('.section-json-textarea').off('change keyup paste').on('change keyup paste', _.debounce(function () {
                    // Usamos debounce para no actualizar en cada tecla, sino tras una pausa.
                    var $textarea = $(this);
                    var newJson = $textarea.val();
                    // Intentar formatear/validar mientras se escribe (opcional, puede ser pesado)
                    try {
                        var parsed = JSON.parse(newJson);
                        // $textarea.val(JSON.stringify(parsed, null, 2)); // Auto-formatear
                    } catch (e) {
                        // Podríamos añadir una clase de error al textarea
                        $textarea.addClass('json-error');
                    }
                    if ($textarea.hasClass('json-error') && JSON.parse(newJson) !== null) {
                         $textarea.removeClass('json-error');
                    }

                    updateSettingValue(collectDataFromDOM());
                }, 500)); // 500ms debounce

                // Toggle para mostrar/ocultar opciones de la sección
                sortableList.find('.section-toggle-options').off('click').on('click', function (e) {
                    e.preventDefault();
                    var $button = $(this);
                    var $optionsDiv = $button.closest('.boots-hard-section-item').find('.section-options');
                    var isExpanded = $button.attr('aria-expanded') === 'true';

                    $optionsDiv.slideToggle(200);
                    $button.attr('aria-expanded', !isExpanded);
                    $button.find('.dashicons').toggleClass('dashicons-admin-generic dashicons-no-alt'); // Cambiar icono
                });
            }

            // Inicialización
            renderAllItems();
            console.log('[BH Section Manager] renderAllItems finished. Sortable list HTML:', sortableList[0].outerHTML);
            initializeSortable();

            // Escuchar cambios en el setting desde otros lugares (ej. reset, importación)
            // y re-renderizar si es necesario.
            control.setting.bind(function (newValue) {
                var valueToSetInInput;
                if (typeof newValue === 'string') {
                    valueToSetInInput = newValue;
                } else if (typeof newValue === 'object' && newValue !== null) {
                    // Si newValue es un objeto/array (común para settings con default array en PHP),
                    // lo convertimos a string JSON para el input.
                    valueToSetInInput = JSON.stringify(newValue);
                } else {
                    // Fallback para tipos inesperados, asegurar que sea un JSON de array vacío.
                    valueToSetInInput = '[]';
                }

                if (valueToSetInInput !== hiddenInput.val()) {
                    hiddenInput.val(valueToSetInInput); // Actualizar el input oculto con un string JSON
                    renderAllItems(); // Re-renderizar todo para reflejar el nuevo estado
                }
            });

            // Pequeño hack para asegurar que el valor inicial del setting se propague correctamente
            // al input oculto si el PHP lo renderizó con datos diferentes a los del setting.
            // Esto puede pasar si el PHP sincroniza secciones (añade nuevas/elimina viejas)
            // y el setting aún no se ha guardado con esos cambios.
            var initialDataFromPHP = hiddenInput.val();
            if (control.setting() !== initialDataFromPHP) {
                control.setting.set(initialDataFromPHP);
            }

        }); // Fin de control.deferred.embedded.done
    }); // Fin de wp.customize.control

}(wp, jQuery));