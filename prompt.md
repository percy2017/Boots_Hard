# Proyecto teme generico con bootstrap
El tema es una plantilla con secciones harcodeadas.

## Esquema definido
c:\xampp\htdocs\wp-content\themes\boots-hard\
├── assets/
│   ├── css/
│   │   └── customizer-controls.js # Script para controles del personalizador (ej. botón reset)
│   │   └── style.css
│   ├── js/
│   │   ├── customizer-preview.js
│   │   └── scripts.js
│   └── svg/
│       └── screenshot.svg
├── inc/
│   ├── customizer.php
│   └── class-bootstrap-navwalker.php
├── template-parts/
│   ├── sections/
│   │   ├── feature-custom-cards.php
│   │   ├── featurettes.php
│   │   └── elements-bootstraps.php
│   ├── content-none.php
│   ├── content-page.php
│   ├── content-post.php
│   └── content.php
├── 404.php
├── archive.php
├── comments.php
├── footer.php
├── front-page.php
├── functions.php
├── header.php
├── index.php
├── page.php
├── README.txt
├── screenshot.png
├── search.php
├── sidebar.php
├── single.php
└── style.css


## Estructura de estilos es personalizar
Personalizador (Raíz: #customize-theme-controls)
└── Menú Principal de Opciones
    ├── Tema activo: Boots Hard
    │
    ├── Identidad del sitio
    ├── Menús
    ├── Estilos del Tema (nuestro)
    │   └── (Al expandir este panel)
    │       ├── Colores Personalizados
    │       │   └── (Controles para color primario, secundario, texto cuerpo, fondo cuerpo, success, danger, warning, info, light, dark)
    │       ├── Diseño y Ancho
    │       │   ├── Ancho del Contenido Principal (Página) (container / container-fluid)
    │       │   ├── Ancho Interno de Secciones (container / container-fluid)
    │       │   └── Menú de Navegación Fijo (Sticky) (checkbox)
    │       ├── Tipografía
    │       │   ├── Familia de Fuente (Cuerpo)
    │       │   └── Familia de Fuente (Encabezados)
    │       ├── Tamaños de Fuente
    │       │   ├── Tamaño de Fuente (Cuerpo, en px)
    │       │   └── Tamaño de Fuente (H1, en px)
    │       ├── Espaciado entre Secciones
    │       │   └── Espaciado Vertical de Secciones (py-0 a py-5)
    │       └── Resetear Estilos
    │           └── (Botón para restaurar todos los ajustes de este panel a sus valores por defecto)
    ├── Widgets
    ├── Ajustes de la página de inicio
    └── CSS adicional
--
### Funcionamiento Post-Implementación

1.  **Acceso y Modificación en el Personalizador:**
    *   Navegas a `Apariencia` > `Personalizar` en tu panel de WordPress.
    *   Encontrarás el nuevo panel: **"Estilos del Tema (nuestro)"**.
        *   Al expandirlo, verás las secciones:
            *   `Colores Personalizados`
            *   `Diseño y Ancho`
            *   `Tipografía`
            *   `Tamaños de Fuente`
            *   `Espaciado entre Secciones`
            *   `Resetear Estilos`
    *   Modificas los valores usando los controles (selectores de color, listas, etc.).
    *   **Previsualización Instantánea:** Gracias a la comunicación entre el Personalizador y tu sección `c:\xampp\htdocs\wp-content\themes\boots-hard\template-parts\sections\elements-bootstraps.php` (y el resto de tu tema), verás los cambios reflejados al instante en el panel de vista previa. Para muchos ajustes (como colores), esto se logrará sin recargar la página, usando JavaScript (`c:\xampp\htdocs\wp-content\themes\boots-hard\assets\js\customizer-preview.js`).

2.  **Guardado de Opciones:**
    *   Cuando los estilos te convenzan, haces clic en el botón **"Publicar"**.
    *   WordPress almacena estas configuraciones (colores, fuentes, tamaños) en la base de datos. Estos valores están vinculados a los `settings` que definimos en `c:\xampp\htdocs\wp-content\themes\boots-hard\inc\customizer.php`.

3.  **Aplicación de Estilos en el Sitio Web:**
    *   Al cargar cualquier página de tu sitio, la lógica en `c:\xampp\htdocs\wp-content\themes\boots-hard\inc\customizer.php` (enganchada a `wp_head`) recupera los valores guardados.
    *   Se genera dinámicamente un bloque `<style>` con el CSS correspondiente a tus selecciones, el cual se inserta en el `<head>` de la página, aplicando así los estilos personalizados a todo el sitio.
    *   El botón **"Resetear Estilos"** utilizará el archivo `c:\xampp\htdocs\wp-content\themes\boots-hard\assets\js\customizer-preview.js` para revertir los ajustes a sus valores por defecto directamente en la interfaz del Personalizador, actualizando también la vista previa al instante.
