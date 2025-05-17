# Proyecto teme generico con bootstrap
El tema es una plantilla con secciones harcodeadas.

## Esquema definido
c:\xampp\htdocs\wp-content\themes\boots-hard\
├── assets/
│   ├── css/
│   │   ├── customizer-section-manager-controls.css # NUEVO: Estilos para el control del gestor de secciones
│   │   └── style.css
│   ├── js/
│   │   ├── customizer-controls.js # Script para controles del personalizador (ej. botón reset)
│   │   ├── customizer-preview.js
│   │   ├── customizer-section-manager-controls.js # NUEVO: JS para controles del gestor de secciones (drag & drop)
│   │   ├── customizer-section-manager-preview.js  # NUEVO: JS para previsualización de cambios JSON en secciones
│   │   └── scripts.js
│   ├── img/ # Directorio para imágenes de ejemplo si fueran necesarias
│   └── svg/ # Directorio para SVGs (placeholders, iconos, etc.)
│       └── screenshot.svg
├── inc/
│   ├── customizer.php
│   ├── customizer-section-manager.php             # NUEVO: Lógica Customizer para gestor de secciones
│   ├── section-renderer.php                       # NUEVO: Función para mostrar secciones gestionadas
│   └── class-bootstrap-navwalker.php
├── template-parts/
│   ├── sections/
│   │   ├── feature-custom-cards.php # Adaptada para JSON e image_id
│   │   ├── featurettes.php          # Adaptada para JSON e image_id
│   │   └── elements-bootstraps.php  # Usada para estilos, no gestionada por JSON
│   ├── content-none.php
│   ├── content-page.php
│   ├── content-post.php
│   └── content.php
├── 404.php
├── archive.php
├── comments.php
├── footer.php
├── front-page.php # Modificada para usar section-renderer.php
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
    ├── Estilos del Tema (Panel existente)
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
    │
    ├── Gestión de Secciones de Inicio (NUEVO PANEL)
    │   └── (Al expandir este panel)
    │       └── Control Principal: Lista de Secciones (con Drag & Drop)
    │           ├── Elemento Sección: [nombre-seccion-1.php] (detectada automáticamente de template-parts/sections/)
    │           │   ├── Checkbox/Icono: [ ] Visible
    │           │   └── Textarea: Contenido JSON (para textos, iconos, image_id para multimedia)
    │           │
    │           ├── Elemento Sección: [nombre-seccion-2.php] (detectada automáticamente)
    │           │   ├── Checkbox/Icono: [ ] Visible
    │           │   └── Textarea: Contenido JSON
    │           │
    │           └── (Se listarán dinámicamente todas las secciones de 'template-parts/sections/')
    │
    ├── Widgets
    ├── Ajustes de la página de inicio
    └── CSS adicional
--
### Funcionamiento Post-Implementación
#### A. Para "Estilos del Tema" (Funcionalidad Existente):
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

#### B. Para "Gestión de Secciones de Inicio" (Nueva Funcionalidad):
1.  **Configuración en el Personalizador:**
    *   Accedes a `Apariencia` > `Personalizar`.
    *   Encontrarás el nuevo panel **"Gestión de Secciones de Inicio"**. Aquí podrás:
        *   Ver las secciones de `c:\xampp\htdocs\wp-content\themes\boots-hard\template-parts\sections\` (que tengan el comentario `/** Section Name: ... */` y estén adaptadas) listadas automáticamente.
        *   Arrastrar y soltar (drag & drop) para reordenar las secciones. La lógica para esto estará en `c:\xampp\htdocs\wp-content\themes\boots-hard\assets\js\customizer-section-manager-controls.js`.
        *   Marcar/desmarcar un checkbox para mostrar u ocultar cada sección en el front-end.
        *   Editar un campo de texto `textarea` con el JSON para modificar el contenido (textos, `image_id` para imágenes, iconos, etc.) de cada sección.
        *   Los ítems del control tienen estilos básicos aplicados por `c:\xampp\htdocs\wp-content\themes\boots-hard\assets\css\customizer-section-manager-controls.css`.
    *   **Previsualización Instantánea:**
        *   Los cambios de orden y visibilidad se reflejarán inmediatamente en la vista previa.
        *   Los cambios en el JSON para títulos principales de sección (ej. `section_title`) se previsualizan instantáneamente.
        *   **Pendiente de Afinar:** La previsualización instantánea de imágenes basadas en `image_id` (requiere AJAX o una estrategia diferente en `customizer-section-manager-preview.js`).
        *   **Pendiente de Afinar:** La previsualización instantánea de elementos anidados dentro del JSON (ej. tarjetas individuales, featurettes individuales) requiere una lógica más avanzada en `customizer-section-manager-preview.js`.

2.  **Guardado de la Configuración:**
    *   Al hacer clic en "Publicar", WordPress guardará:
        *   El orden de las secciones.
        *   El estado de visibilidad (visible/oculto) de cada una.
        *   El contenido JSON específico para cada sección.
    *   Estos datos se almacenarán como opciones del tema (theme mods) en la base de datos, gestionados por la lógica en `c:\xampp\htdocs\wp-content\themes\boots-hard\inc\customizer-section-manager.php`.

3.  **Visualización en el Sitio (Front-end):**
    *   Cuando un visitante cargue la `front-page.php` (o donde se muestren las secciones):
        *   La función definida en `c:\xampp\htdocs\wp-content\themes\boots-hard\inc\section-renderer.php` se ejecutará.
        *   Esta función leerá el orden, la visibilidad y los JSONs guardados desde las opciones del tema.
        *   Iterará sobre las secciones configuradas: si una sección está marcada como visible, cargará su plantilla (ej. `get_template_part('template-parts/sections/nombre-seccion')`) y le pasará los datos del JSON decodificado.
        *   Las plantillas de sección (ej. `feature-custom-cards.php`, `featurettes.php`) usan los datos del JSON, incluyendo `image_id` para obtener las URLs de las imágenes mediante `wp_get_attachment_image_src()`.
        *   Las secciones ocultas simplemente no se cargarán.

### Consideraciones Adicionales / Pendientes de Afinar
*   Mejorar la previsualización instantánea en `c:\xampp\htdocs\wp-content\themes\boots-hard\assets\js\customizer-section-manager-preview.js` para imágenes (con `image_id` vía AJAX) y para elementos anidados en el JSON.
*   Refinar los estilos CSS del control en `c:\xampp\htdocs\wp-content\themes\boots-hard\assets\css\customizer-section-manager-controls.css` según sea necesario.
