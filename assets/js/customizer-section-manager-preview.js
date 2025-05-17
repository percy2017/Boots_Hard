/**
 * Boots Hard Theme: Customizer Section Manager Preview
 *
 * Handles live previewing of section reordering, visibility, and JSON content changes.
 *
 * Assumes:
 * 1. Sections in `front-page.php` (or similar) are rendered within a wrapper:
 *    <div id="boots-hard-managed-sections-wrapper"> ... </div>
 * 2. Each section part is wrapped with an ID and a class:
 *    <section id="section-preview-<?php echo esc_attr($slug); ?>" class="bh-managed-section <?php echo esc_attr($slug); ?>"> ... </section>
 * 3. Elements within each section that are editable via JSON have specific classes:
 *    - .bh-preview-title
 *    - .bh-preview-subtitle
 *    - .bh-preview-text, .bh-preview-description
 *    - .bh-preview-image (img tag), .bh-preview-background-image (div con background-image)
 *    - .bh-preview-icon (i or span tag)
 *    - .bh-preview-button (a tag)
 *    - .bh-preview-cards-container (para un contenedor de tarjetas)
 *    - .bh-preview-card-item (para cada tarjeta individual, debe tener data-card-index)
 *    - .bh-preview-featurettes-container (para un contenedor de featurettes)
 *    - .bh-preview-featurette-item (para cada featurette, debe tener data-featurette-index)
 *    (These are examples; actual classes depend on your section templates)
 */
(function (wp, $) {
    'use strict';

    if (!wp || !wp.customize) {
        console.error('wp.customize not loaded. Section Manager Preview will not work.');
        return;
    }

    console.log('[BH Preview] customizer-section-manager-preview.js loaded.');

    // Listen for changes to our main setting
    wp.customize('boots_hard_managed_sections_data', function (setting) {
        setting.bind(function (newValue) {
            var managedSectionsData;
            try {
                managedSectionsData = JSON.parse(newValue);
            } catch (e) {
                console.error('[BH Preview] Error parsing managed sections data for preview:', e, 'Raw value:', newValue);
                return;
            }

            if (!Array.isArray(managedSectionsData)) {
                console.error('[BH Preview] Managed sections data is not an array for preview. Value:', managedSectionsData);
                return;
            }

            var $sectionsWrapper = $('#boots-hard-managed-sections-wrapper'); // Wrapper en front-page.php
            if (!$sectionsWrapper.length) {
                // console.warn('#boots-hard-managed-sections-wrapper not found in preview.');
                // Podría ser que la página de inicio no sea la que se está previsualizando
                // o que aún no se haya cargado. Intentaremos más tarde si es un problema de timing.
            }

            // Detach all current sections to re-order and manage visibility efficiently
            var $existingSectionPreviews = $sectionsWrapper.children('.bh-managed-section').detach();
            var sectionElementsToAppend = [];

            managedSectionsData.forEach(function (sectionConfig) {
                console.log('[BH Preview] Processing section config:', sectionConfig.slug, sectionConfig);
                var $sectionPreview = $existingSectionPreviews.filter('#section-preview-' + sectionConfig.slug);

                if (!$sectionPreview.length) {
                    // This case implies the section was not initially rendered by PHP.
                    // For full dynamic addition/removal, front-page.php would need to be more dynamic
                    // or we'd need AJAX to fetch section HTML. For now, we assume all sections
                    // are in the DOM initially, and we just show/hide/reorder.
                    console.warn('[BH Preview] Preview for section ' + sectionConfig.slug + ' not found in DOM. It might need to be added dynamically if it was not rendered by PHP.');
                    return; // Skip if not found
                }

                if (sectionConfig.visible) {
                    // Update content from JSON
                    try {
                        var jsonData = JSON.parse(sectionConfig.json_content || '{}');
                        console.log('[BH Preview] Parsed JSON for section ' + sectionConfig.slug + ':', jsonData);

                        // Example updates - adapt these selectors and properties to your section structures
                        // --- Título General de la Sección ---
                        if (typeof jsonData.section_title !== 'undefined') {
                            $sectionPreview.find('.bh-preview-title').text(jsonData.section_title);
                        }

                        // --- Elementos Simples (ejemplos) ---
                        if (typeof jsonData.subtitle !== 'undefined') {
                            $sectionPreview.find('.bh-preview-subtitle').text(jsonData.subtitle);
                        }
                        if (typeof jsonData.text !== 'undefined') {
                            $sectionPreview.find('.bh-preview-text').html(jsonData.text); // Use .html() if content can have HTML
                        }
                        if (typeof jsonData.description !== 'undefined') {
                            $sectionPreview.find('.bh-preview-description').html(jsonData.description);
                        }
                        if (typeof jsonData.icon_class !== 'undefined') {
                            // Assuming icon_class is the full set of classes for the icon
                            $sectionPreview.find('.bh-preview-icon').attr('class', 'bh-preview-icon ' + jsonData.icon_class).toggle(!!jsonData.icon_class);
                        }
                        if (typeof jsonData.button_text !== 'undefined') {
                            $sectionPreview.find('.bh-preview-button').text(jsonData.button_text).toggle(jsonData.button_text !== '');
                        }
                        if (typeof jsonData.button_url !== 'undefined') {
                            $sectionPreview.find('.bh-preview-button').attr('href', jsonData.button_url);
                        }

                        // --- Manejo de Imágenes (con image_id) ---
                        // Para una previsualización REAL de image_id, necesitaríamos AJAX.
                        // Por ahora, si el JSON tuviera una 'image_url_preview' (que el control PHP podría añadir), la usaríamos.
                        // O, si la plantilla PHP ya renderizó una imagen basada en el ID, no hacemos nada aquí para la imagen en sí,
                        // solo la mostramos/ocultamos si el ID es 0.
                        if (typeof jsonData.image_id !== 'undefined') {
                            var $imageElement = $sectionPreview.find('.bh-preview-image');
                            var $backgroundImageElement = $sectionPreview.find('.bh-preview-background-image');

                            if (parseInt(jsonData.image_id, 10) > 0) {
                                // Aquí es donde haríamos AJAX para obtener la URL si no la tenemos.
                                // Por ahora, asumimos que la plantilla PHP se encarga de la imagen inicial.
                                // Si el JSON tuviera una 'image_url_preview', la usaríamos:
                                // if (jsonData.image_url_preview) {
                                //    $imageElement.attr('src', jsonData.image_url_preview).show();
                                //    $backgroundImageElement.css('background-image', 'url(' + jsonData.image_url_preview + ')').show();
                                // } else {
                                //    $imageElement.show(); // Mostrar la imagen que ya está (si la plantilla la puso)
                                //    $backgroundImageElement.show();
                                // }
                                $imageElement.show();
                                $backgroundImageElement.show();
                            } else {
                                $imageElement.hide(); // O cambiar a un placeholder
                                $backgroundImageElement.hide(); // O cambiar a un placeholder
                            }
                        }

                        // --- Manejo de Elementos Anidados (Ejemplo para Tarjetas) ---
                        if (jsonData.cards && Array.isArray(jsonData.cards)) {
                            var $cardsContainer = $sectionPreview.find('.bh-preview-cards-container');
                            // Podríamos necesitar recrear las tarjetas si el número cambia, o actualizarlas in-place.
                            // Por simplicidad, actualizaremos las existentes si coinciden los índices.
                            jsonData.cards.forEach(function(cardData, index) {
                                var $cardItem = $cardsContainer.find('.bh-preview-card-item[data-card-index="' + index + '"]');
                                if ($cardItem.length) {
                                    if (typeof cardData.title !== 'undefined') {
                                        $cardItem.find('.bh-preview-card-title').text(cardData.title);
                                    }
                                    if (typeof cardData.text !== 'undefined') {
                                        $cardItem.find('.bh-preview-card-text').html(cardData.text);
                                    }
                                    // Actualización de imagen para la tarjeta (requeriría AJAX para image_id)
                                    if (typeof cardData.image_id !== 'undefined') {
                                        var $cardImageDiv = $cardItem.find('.card-cover'); // Asumiendo que es un div con background-image
                                        if (parseInt(cardData.image_id, 10) > 0) {
                                            // AJAX para obtener URL o usar una 'image_url_preview' si estuviera disponible
                                            // $cardImageDiv.css('background-image', 'url(URL_OBTENIDA_O_PREVIEW)').show();
                                            $cardImageDiv.show(); // Mostrar lo que ya está
                                        } else {
                                            $cardImageDiv.hide(); // O placeholder
                                        }
                                    }
                                }
                            });
                        }

                        // --- Manejo de Elementos Anidados (Ejemplo para Featurettes) ---
                        if (jsonData.featurettes && Array.isArray(jsonData.featurettes)) {
                            var $featurettesContainer = $sectionPreview.find('.bh-preview-featurettes-container'); // Necesitarías este wrapper en tu HTML
                            jsonData.featurettes.forEach(function(featuretteData, index) {
                                var $featuretteItem = $featurettesContainer.find('.bh-preview-featurette-item[data-featurette-index="' + index + '"]'); // Necesitarías este data-attribute
                                if ($featuretteItem.length) {
                                    if (typeof featuretteData.title !== 'undefined') $featuretteItem.find('.bh-preview-featurette-title').text(featuretteData.title);
                                    if (typeof featuretteData.subtitle_muted !== 'undefined') $featuretteItem.find('.bh-preview-featurette-subtitle').text(featuretteData.subtitle_muted);
                                    if (typeof featuretteData.description !== 'undefined') $featuretteItem.find('.bh-preview-featurette-text').html(featuretteData.description);
                                    // Actualización de imagen para featurette (requeriría AJAX para image_id)
                                    if (typeof featuretteData.image_id !== 'undefined') {
                                        var $featuretteImage = $featuretteItem.find('.bh-preview-featurette-image');
                                        if (parseInt(featuretteData.image_id, 10) > 0) $featuretteImage.show(); else $featuretteImage.hide();
                                    }
                                }
                            });
                        }

                    } catch (e) {
                        console.warn('[BH Preview] Error parsing/applying JSON for section ' + sectionConfig.slug + ' in preview:', e, 'JSON content:', sectionConfig.json_content);
                    }
                    sectionElementsToAppend.push($sectionPreview); // Add to the list to be re-appended
                }
            });

            // Re-append visible sections in the new order
            $sectionsWrapper.append(sectionElementsToAppend);
            console.log('[BH Preview] Sections re-appended to wrapper.');
        });
    });

}(wp, jQuery));