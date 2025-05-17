# Boots Hard - Tema de WordPress

Boots Hard es un tema de WordPress personalizado construido con Bootstrap, diseñado para ser flexible y fácil de personalizar a través del Personalizador de WordPress.

## Características Principales

*   **Basado en Bootstrap:** Utiliza el framework Bootstrap para un diseño responsive y componentes modernos.
*   **Amplias Opciones de Personalización:** Configura fácilmente la apariencia de tu sitio a través del Personalizador de WordPress (`Apariencia` > `Personalizar`):
    *   **Colores Personalizados:**
        *   Define colores primarios, secundarios, de éxito, peligro, advertencia, información, claro y oscuro.
        *   Ajusta el color del texto y el fondo del cuerpo del sitio.
        *   El contraste del texto se ajusta automáticamente para una mejor legibilidad.
    *   **Diseño y Ancho:**
        *   Controla el ancho del contenido principal de la página (`container` vs. `container-fluid`).
        *   Define el ancho interno de las secciones de la página de inicio (`container` vs. `container-fluid`).
        *   Opción para hacer el menú de navegación principal fijo (sticky).
    *   **Tipografía:**
        *   Selecciona diferentes familias de fuentes para el cuerpo del texto y los encabezados.
    *   **Tamaños de Fuente:**
        *   Ajusta el tamaño de la fuente para el cuerpo y los encabezados principales (H1).
    *   **Espaciado entre Secciones:**
        *   Controla el espaciado vertical entre las secciones de la página de inicio utilizando las clases de utilidad de Bootstrap (`py-0` a `py-5`).
    *   **Resetear Estilos:** Un botón para restaurar todas las opciones de estilo del tema a sus valores por defecto.
*   **Estructura de Secciones Modulares:** Utiliza partes de plantilla (`template-parts/sections/`) para construir la página de inicio, facilitando la organización y reutilización del código.
*   **Navegación Personalizada:** Incluye un Navwalker personalizado de Bootstrap para una integración limpia de los menús de WordPress.

## Instalación

1.  Descarga el archivo `.zip` del tema (o clona el repositorio).
2.  En tu panel de administración de WordPress, ve a `Apariencia` > `Temas`.
3.  Haz clic en `Añadir nuevo` y luego en `Subir tema`.
4.  Selecciona el archivo `.zip` descargado y haz clic en `Instalar ahora`.
5.  Una vez instalado, haz clic en `Activar`.

## Desarrollo

Este tema ha sido desarrollado en un entorno local con:

*   **Servidor Local:** XAMPP
*   **Sistema Operativo:** Windows
*   **Editor de Código:** Visual Studio Code
*   **Plugin de Asistencia IA:** Gemini/Code de Google

### Estructura de Archivos Clave

*   `assets/`: Contiene CSS, JavaScript e imágenes.
    *   `js/customizer-preview.js`: Lógica para la previsualización en vivo del Personalizador.
    *   `js/customizer-controls.js`: Lógica para controles específicos del Personalizador (ej. botón de reseteo).
*   `inc/`: Funcionalidades principales del tema.
    *   `customizer.php`: Define todas las opciones del Personalizador.
    *   `class-bootstrap-navwalker.php`: Navwalker para los menús de Bootstrap.
*   `template-parts/sections/`: Plantillas para las diferentes secciones de la página de inicio.
*   `functions.php`: Archivo principal de funciones del tema.
*   `style.css`: Hoja de estilos principal y metadatos del tema.

## Contribuir

¡Las contribuciones son bienvenidas! Por favor, abre un issue o un pull request.