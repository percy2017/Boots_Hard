(function( $ ) {
    "use strict";

    // Object to hold CSS rules for live preview.
    var previewStyles = {};

    // Function to update the live preview <style> tag
    function updateLivePreviewStyles() {
        var styleTagId = 'boots-hard-customizer-preview-styles';
        var styleTag = $( '#' + styleTagId );

        if ( ! styleTag.length ) {
            $( 'head' ).append( '<style id="' + styleTagId + '" type="text/css"></style>' );
            styleTag = $( '#' + styleTagId );
        }

        var fullCss = '';
        $.each(previewStyles, function(key, cssRule) {
            if (cssRule) {
                fullCss += cssRule;
            }
        });
        styleTag.html( fullCss );
    }

    // Helper function for contrasting text color in JS
    function getContrastingTextColorJS( hexColor ) {
        if ( !hexColor ) return '#000000'; // Default to black if no color provided
        hexColor = hexColor.replace('#', '');
        if (hexColor.length === 3) {
            hexColor = hexColor[0] + hexColor[0] + hexColor[1] + hexColor[1] + hexColor[2] + hexColor[2];
        }
        if (hexColor.length !== 6) {
            return '#000000'; // Default to black if invalid hex
        }
        var r = parseInt(hexColor.substring(0, 2), 16);
        var g = parseInt(hexColor.substring(2, 4), 16);
        var b = parseInt(hexColor.substring(4, 6), 16);
        // Calculate luminance using the W3C formula
        var lumR = r / 255, lumG = g / 255, lumB = b / 255;
        var sR = lumR <= 0.03928 ? lumR / 12.92 : Math.pow((lumR + 0.055) / 1.055, 2.4);
        var sG = lumG <= 0.03928 ? lumG / 12.92 : Math.pow((lumG + 0.055) / 1.055, 2.4);
        var sB = lumB <= 0.03928 ? lumB / 12.92 : Math.pow((lumB + 0.055) / 1.055, 2.4);
        var luminance = 0.2126 * sR + 0.7152 * sG + 0.0722 * sB;
        
        return luminance > 0.179 ? '#000000' : '#ffffff';
    }

    function applyColorStyles(settingKey, newval, selectors) {
        var textColor = getContrastingTextColorJS(newval);
        var css = '';

        if (selectors.text) css += selectors.text + ' { color: ' + newval + '; } ';
        if (selectors.btn) {
            css += selectors.btn + ' { background-color: ' + newval + '; border-color: ' + newval + '; color: ' + textColor + '; } ';
            css += selectors.btn + ':hover { filter: brightness(' + (textColor === '#ffffff' ? '90%' : '110%') + '); } ';
        }
        if (selectors.btnOutline) {
            css += selectors.btnOutline + ' { color: ' + newval + '; border-color: ' + newval + '; } ';
            css += selectors.btnOutline + ':hover { background-color: ' + newval + '; color: ' + textColor + '; } ';
        }
        if (selectors.alert) css += selectors.alert + ' { background-color: ' + newval + '; border-color: ' + newval + '; color: ' + textColor + '; } ';
        if (selectors.bg) css += selectors.bg + ' { background-color: ' + newval + ' !important; } ';
        if (selectors.textBg) css += selectors.textBg + ' { background-color: ' + newval + ' !important; color: ' + textColor + ' !important; } ';
        if (selectors.progressBar) css += selectors.progressBar + ' { background-color: ' + newval + ' !important; color: ' + textColor + '; } ';

        previewStyles[settingKey] = css;
        updateLivePreviewStyles();
    }

    // --- Live Preview (postMessage) ---

    // Color Primario
    wp.customize( 'bh_primary_color', function( value ) {
        value.bind( function( newval ) {
            applyColorStyles('bh_primary_color', newval, {
                text: 'a, .text-primary',
                btn: '.btn-primary',
                btnOutline: '.btn-outline-primary',
                alert: '.alert-primary',
                bg: '.bg-primary',
                textBg: '.text-bg-primary',
                progressBar: '.progress-bar.bg-primary'
            });
        } );
    } );

    // Color Secundario
    wp.customize( 'bh_secondary_color', function( value ) {
        value.bind( function( newval ) {
            applyColorStyles('bh_secondary_color', newval, {
                text: '.text-secondary',
                btn: '.btn-secondary',
                btnOutline: '.btn-outline-secondary',
                alert: '.alert-secondary',
                bg: '.bg-secondary',
                textBg: '.text-bg-secondary'
            });
        } );
    } );

    // Color del Texto del Cuerpo
    wp.customize( 'bh_body_text_color', function( value ) {
        value.bind( function( newval ) {
            previewStyles.bh_body_text_color = 'body, p, h1, h2, h3, h4, h5, h6 { color: ' + newval + '; } ';
            updateLivePreviewStyles();
        } );
    } );

    // Color de Fondo del Cuerpo
    wp.customize( 'bh_body_bg_color', function( value ) {
        value.bind( function( newval ) {
            previewStyles.bh_body_bg_color = 'body { background-color: ' + newval + '; } ';
            updateLivePreviewStyles();
        } );
    } );

    // Tamaño de Fuente del Cuerpo
    wp.customize( 'bh_body_font_size', function( value ) {
        value.bind( function( newval ) {
            previewStyles.bh_body_font_size = 'body { font-size: ' + newval + 'px; } ';
            updateLivePreviewStyles();
        } );
    } );

    // Tamaño de Fuente H1
    wp.customize( 'bh_h1_font_size', function( value ) {
        value.bind( function( newval ) {
            previewStyles.bh_h1_font_size = 'h1, .h1 { font-size: ' + newval + 'px; } ';
            updateLivePreviewStyles();
        } );
    } );

    // Color Success
    wp.customize( 'bh_success_color', function( value ) {
        value.bind( function( newval ) {
            applyColorStyles('bh_success_color', newval, {
                text: '.text-success',
                btn: '.btn-success',
                btnOutline: '.btn-outline-success',
                alert: '.alert-success',
                bg: '.bg-success',
                textBg: '.text-bg-success',
                progressBar: '.progress-bar.bg-success'
            });
        } );
    } );

    // Color Danger
    wp.customize( 'bh_danger_color', function( value ) {
        value.bind( function( newval ) {
            applyColorStyles('bh_danger_color', newval, {
                text: '.text-danger',
                btn: '.btn-danger',
                btnOutline: '.btn-outline-danger',
                alert: '.alert-danger',
                bg: '.bg-danger'
            });
        } );
    } );

    // Color Warning
    wp.customize( 'bh_warning_color', function( value ) {
        value.bind( function( newval ) {
            applyColorStyles('bh_warning_color', newval, {
                text: '.text-warning',
                btn: '.btn-warning',
                btnOutline: '.btn-outline-warning',
                alert: '.alert-warning',
                bg: '.bg-warning'
            });
        } );
    } );

    // Color Info
    wp.customize( 'bh_info_color', function( value ) {
        value.bind( function( newval ) {
            applyColorStyles('bh_info_color', newval, {
                text: '.text-info',
                btn: '.btn-info',
                btnOutline: '.btn-outline-info',
                alert: '.alert-info',
                bg: '.bg-info'
            });
        } );
    } );

    // Color Light
    wp.customize( 'bh_light_color', function( value ) {
        value.bind( function( newval ) {
            applyColorStyles('bh_light_color', newval, {
                btn: '.btn-light',
                btnOutline: '.btn-outline-light',
                alert: '.alert-light',
                bg: '.bg-light'
            });
             var olLightTextColor = getContrastingTextColorJS(newval);
             var olLightHoverBgColor = newval;
             var olLightHoverTextColor = getContrastingTextColorJS(olLightHoverBgColor);
             var olLightCss = '.btn-outline-light { color: ' + (olLightTextColor === '#ffffff' ? '#212529' : olLightTextColor) + '; border-color: ' + newval + '; } ';
             olLightCss += '.btn-outline-light:hover { background-color: ' + olLightHoverBgColor + '; color: ' + olLightHoverTextColor + '; }';
             previewStyles.bh_light_color_outline_special = olLightCss;
             updateLivePreviewStyles();
        } );
    } );

    // Color Dark
    wp.customize( 'bh_dark_color', function( value ) {
        value.bind( function( newval ) {
            applyColorStyles('bh_dark_color', newval, {
                btn: '.btn-dark',
                btnOutline: '.btn-outline-dark',
                alert: '.alert-dark',
                bg: '.bg-dark'
            });
        } );
    } );

    // Espaciado entre Secciones
    wp.customize( 'bh_section_spacing_class', function( value ) {
        value.bind( function( newval ) {
            var $sections = $( '.bh-theme-section' ); 
            if ( $sections.length ) {
                var spacingClassesToRemove = 'py-0 py-1 py-2 py-3 py-4 py-5';
                $sections.removeClass( spacingClassesToRemove ).addClass( newval );
            }
        } );
    } );

    // Ancho del Contenido Principal (Página)
    wp.customize( 'bh_page_container_class', function( value ) {
        value.bind( function( newval ) {
            // El div#content es el que cambia su clase container/container-fluid
            var $pageContainer = $( '#content' ); 

            if ( $pageContainer.length ) {
                // Guardar otras clases existentes (como 'site-content') y solo reemplazar 'container' o 'container-fluid'
                var currentClasses = $pageContainer.attr('class').split(' ');
                var newClassArray = currentClasses.filter(function(cls) {
                    return cls !== 'container' && cls !== 'container-fluid';
                });
                newClassArray.push(newval); // Añadir la nueva clase (container o container-fluid)
                $pageContainer.attr('class', newClassArray.join(' '));
            }
        } );
    } );

    // Ancho Interno de Secciones
    wp.customize( 'bh_section_inner_container_class', function( value ) {
        value.bind( function( newval ) {
            // Esto apunta a los .container o .container-fluid DENTRO de tus .bh-theme-section
            var $sectionInnerContainers = $( '.bh-theme-section > .container, .bh-theme-section > .container-fluid' );
            if ( $sectionInnerContainers.length ) {
                $sectionInnerContainers.removeClass( 'container container-fluid' ).addClass( newval );
            }
        } );
    } );

    // Menú de Navegación Fijo
    wp.customize( 'bh_fixed_navbar', function( value ) {
        value.bind( function( newval ) {
            var $masthead = $( '#masthead' ); // Selector para tu header principal
            if ( $masthead.length ) {
                if ( newval ) {
                    $masthead.addClass( 'fixed-top' );
                } else {
                    $masthead.removeClass( 'fixed-top' );
                }
            }
        } );
    } );

    // --- Reset Button Functionality ---
    wp.customize( 'bh_reset_styles_button_dummy_setting', function( setting ) {
        setting.bind( function() { 
            console.log('BH Customizer: Reset button triggered. Attempting to reset settings...'); // DEBUG
            if ( typeof bootsHardCustomizerReset !== 'undefined' &&
                 typeof bootsHardCustomizerReset.settings !== 'undefined' ) {

                $.each( bootsHardCustomizerReset.settings, function( setting_key, item_object ) {
                    console.log('BH Customizer: Attempting to reset - ID:', item_object.id, 'Default:', item_object.default); // DEBUG
                    if ( wp.customize( item_object.id ) ) { 
                       wp.customize( item_object.id ).set( item_object.default );
                       console.log('BH Customizer: Successfully set default for:', item_object.id); // DEBUG
                    } else {
                       console.warn('BH Customizer: Setting not found in Customizer API - ID:', item_object.id); // DEBUG
                    }
                });
            } else {
                console.warn( 'Boots Hard Customizer: Reset data (bootsHardCustomizerReset.settings) not found in customizer-preview.js.' );
            }
        } );
    } );
})( jQuery );
