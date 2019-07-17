<?php

/**
 *      Metaboxes para el homepage
 */

add_action('cmb2_admin_init', 'edc_campos_homepage');
/**
 * Hook in and add a metabox that only appears on the 'About' page
 */
function edc_campos_homepage()
{
    $prefix = 'edc_homepage_';
    $id_home = get_option('page_on_front');
    /**
     * Metabox to be displayed on a single page ID
     */
    $edc_campos_homepage = new_cmb2_box(array(
        'id'           => $prefix . 'homepage',
        'title'        => esc_html__('Campos Homepage', 'cmb2'),
        'object_types' => array('page'), // Post type
        'context'      => 'normal',
        'priority'     => 'high',
        'show_names'   => true, // Show field names on the left
        'show_on'      => array(
            'id' => array($id_home),
        ), // Specific post IDs to display this metabox
    ));
    $edc_campos_homepage->add_field(array(
        'name'    => esc_html__('Texto superior 1', 'cmb2'),
        'desc'    => esc_html__('texto para la parte superior del sitio web', 'cmb2'),
        'id'      => $prefix . 'texto_superior_1',
        'type'    => 'wysiwyg',
        'options' => array(
            'textarea_rows' => 5,
        ),
    ));
    $edc_campos_homepage->add_field(array(
        'name' => esc_html__('Imagen hero 1', 'cmb2'),
        'desc' => esc_html__('Primera imagen para la parte superior', 'cmb2'),
        'id'   => $prefix . 'imagen_superior_1',
        'type' => 'file',
    ));
    // Campos de licenciatura
    $edc_campos_homepage->add_field(array(
        'name'    => esc_html__('Texto licenciatura', 'cmb2'),
        'desc'    => esc_html__('Añada el texto para la licenciatura', 'cmb2'),
        'id'      => $prefix . 'texto_licenciatura',
        'type'    => 'wysiwyg',
        'options' => array(
            'textarea_rows' => 5,
        ),
    ));
    $edc_campos_homepage->add_field(array(
        'name' => esc_html__('Imagen fondo licenciatura', 'cmb2'),
        'desc' => esc_html__('Imagen de fondo para la licenciatura', 'cmb2'),
        'id'   => $prefix . 'imagen_licenciatura',
        'type' => 'file',
    ));
}

add_action('cmb2_admin_init', 'edc_seccion_nosotros');
/**
 * Hook in and add a metabox to demonstrate repeatable grouped fields
 */
function edc_seccion_nosotros()
{
    //$id_pagina = basename(get_page_template());
    $prefix = 'edc_group_';
    /**
     * Repeatable Field Groups
     */
    $edc_iconos = new_cmb2_box(
        array(
            'id'           => 'edc_group_metabox',
            'title'        => esc_html__('Iconos con descripción', 'cmb2'),
            'object_types' => array('page'), // post type
            // 'show_on'      => array('key' => 'page-template', 'value' => '../template-parts/page-iconos.php'),//No funciona en las versiones > 5 de WP
            'show_on'      => array('id' => array(12,)),
            'context'      => 'normal', //  'normal', 'advanced', or 'side'
            'priority'     => 'high',  //  'high', 'core', 'default' or 'low'
            'show_names'   => true, // Show field names on the left
        )
    );
    $edc_iconos->add_field(array(
        'name' => esc_html__('Título sección', 'cmb2'),
        'desc' => esc_html__('Añadir Título para la sección (opcional)', 'cmb2'),
        'id'   => $prefix . 'titulo_iconos',
        'type' => 'text',
    ));
    // $group_field_id is the field id string, so in this case: 'yourprefix_group_demo'
    $group_field_id = $edc_iconos->add_field(array(
        'id'          => $prefix . 'nosotros',
        'type'        => 'group',
        'description' => esc_html__('Agregar opciones según se necesite', 'cmb2'),
        'options'     => array(
            'group_title'    => esc_html__('Característica {#}', 'cmb2'), // {#} gets replaced by row number
            'add_button'     => esc_html__('Añadir otro grupo', 'cmb2'),
            'remove_button'  => esc_html__('Eliminar', 'cmb2'),
            'sortable'       => true,
            'closed'      => true, // true to have the groups closed by default
            // 'remove_confirm' => esc_html__( 'Are you sure you want to remove?', 'cmb2' ), // Performs confirmation before removing group.
        ),
    ));

    $edc_iconos->add_group_field($group_field_id, array(
        'name'       => esc_html__('Título', 'cmb2'),
        'id'         => 'titulo_icono',
        'type'       => 'text',
        // 'repeatable' => true, // Repeatable fields are supported w/in repeatable groups (for most types)
    ));

    $edc_iconos->add_group_field($group_field_id, array(
        'name'        => esc_html__('Descripcion', 'cmb2'),
        'description' => esc_html__('Agregar descripción a esta caracteristica', 'cmb2'),
        'id'          => 'desc_icono',
        'type'        => 'textarea_small',
    ));

    $edc_iconos->add_group_field($group_field_id, array(
        'name' => esc_html__('Icono', 'cmb2'),
        'id'   => 'imagen_icono',
        'type' => 'file',
    ));
}
/**
 * Blog
 */
add_action('cmb2_admin_init', 'edc_campos_blog');

function edc_campos_blog()
{
    $prefix = 'edc_blog_';
    $id_blog = get_option('page_for_posts');

    $edc_campos_blog = new_cmb2_box(
        array(
            'id'           =>  $prefix . 'blog',
            'title'        => esc_html__(' Campos Blog',  'cmb 2'),
            'object_types' => array('page'), // Post type
            'context'      =>  'normal',
            'priority'     =>  'high',
            'show_names'   => true, // Show field names on the left
            'show_on'      => array(
                'id' => array($id_blog),
            )
        )
    );

    $edc_campos_blog->add_field(array(
        'name'       => esc_html__('Slogan Blog', 'cmb2'),
        'desc'      => esc_html__('Añadir descripción al Blog', 'cmb2'),
        'id'         => $prefix . 'slogan_blog',
        'type'       => 'text',
        // 'repeatable' => true, // Repeatable fields are supported w/in repeatable groups (for most types)
    ));
}

// Añade campos al post type de Clases
add_action('cmb2_admin_init', 'edc_campos_clases');
/**
 * Hook in and add a metabox to demonstrate repeatable grouped fields
 */
function edc_campos_clases()
{
    //$id_pagina = basename(get_page_template());
    $prefix = 'edc_cursos_';
    /**
     * Repeatable Field Groups
     */
    $edc_campos_cursos = new_cmb2_box(
        array(
            'id'           => $prefix . 'metabox',
            'title'        => esc_html__('Información de clases y cursos', 'cmb2'),
            'object_types' => array('clases_cocina'), // post type
            // 'show_on'      => array('key' => 'page-template', 'value' => '../template-parts/page-iconos.php'),//No funciona en las versiones > 5 de WP
            'context'      => 'normal', //  'normal', 'advanced', or 'side'
            'priority'     => 'high',  //  'high', 'core', 'default' or 'low'
            'show_names'   => true, // Show field names on the left
        )
    );
    // Agregar subtítulo del Curso
    $edc_campos_cursos->add_field(array(
        'name'       => esc_html__('Subtítulo del curso', 'cmb2'),
        'desc'      => esc_html__('Añadir subtítulo para el curso', 'cmb2'),
        'id'         => $prefix . 'subtitulo',
        'type'       => 'text',
        'column' => true,
        // 'repeatable' => true, // Repeatable fields are supported w/in repeatable groups (for most types)
    ));
    // Agregar un separador para agrupar
    $edc_campos_cursos->add_field(array(
        'name'       => esc_html__('Información sobre la fecha y horarios del curso', 'cmb2'),
        'desc'      => esc_html__('Añadir información relacionada con las fechas, días y horas del Curso', 'cmb2'),
        'id'         => $prefix . 'info',
        'type'       => 'title',
        // 'repeatable' => true, // Repeatable fields are supported w/in repeatable groups (for most types)
    ));
    // Agregar fecha y hora del curso
    $edc_campos_cursos->add_field(array(
        'name'       => esc_html__('Indicaciones de los días', 'cmb2'),
        'desc'      => esc_html__('Añadir las indicaciones ej: Todos los sábados', 'cmb2'),
        'id'         => $prefix . 'indicaciones',
        'type'       => 'text',
        'column' => true,
        // 'repeatable' => true, // Repeatable fields are supported w/in repeatable groups (for most types)
    ));
    // Agregar campo de fecha de Inicio del curso
    $edc_campos_cursos->add_field(array(
        'name' => esc_html__('Fecha de inicio de Curso', 'cmb2'),
        'desc' => esc_html__('Añadir la fecha de inicio del  Curso', 'cmb2'),
        'id'   => $prefix . 'fecha_inicio_curso',
        'type' => 'text_date',
        'date_format' => 'd /m/ Y',
    ));
    // Agregar campo de fecha de fin del curso
    $edc_campos_cursos->add_field(array(
        'name' => esc_html__('Fecha de finalización de Curso', 'cmb2'),
        'desc' => esc_html__('Añadir la fecha defin del  Curso', 'cmb2'),
        'id'   => $prefix . 'fecha_fin_curso',
        'type' => 'text_date',
        'date_format' => 'd /m/ Y',
    ));
    //  Agregar campo hora de inicio de las clases
    $edc_campos_cursos->add_field(array(
        'name' => esc_html__('Hora de inicio de las clases', 'cmb2'),
        'desc' => esc_html__('Añadir hora de inicio de las clases', 'cmb2'),
        'id'   => $prefix . 'hora_inicio_clase',
        'type' => 'text_time',
        'time_format' => 'H:i', // Set to 24hr format
    ));
    //  Agregar campo hora de finalización de las clases
    $edc_campos_cursos->add_field(array(
        'name' => esc_html__('Hora de finalización de las clases', 'cmb2'),
        'desc' => esc_html__('Añadir hora finalización de las clases', 'cmb2'),
        'id'   => $prefix . 'hora_fin_clase',
        'type' => 'text_time',
        'time_format' => 'H:i', // Set to 24hr format
    ));
    // Agregar un separador para agrupar
    $edc_campos_cursos->add_field(array(
        'name'       => esc_html__('Información extra del curso', 'cmb2'),
        'desc'      => esc_html__('Añadir cupo, precio y el instructor en esta sección', 'cmb2'),
        'id'         => $prefix . 'bloque',
        'type'       => 'title',
        // 'repeatable' => true, // Repeatable fields are supported w/in repeatable groups (for most types)
    ));
    $edc_campos_cursos->add_field(array(
        'name' => esc_html__('Precio del curso', 'cmb2'),
        'desc' => esc_html__('Introducir precio del curso', 'cmb2'),
        'id'   => $prefix . 'costo',
        'type' => 'text_money',
        'before_field' => '€',
        'column' => true
        // 'repeatable' => true,
    ));
    // Cupo de alumnos. Se hace con campo tipo text porque no hay tipo número
    $edc_campos_cursos->add_field(array(
        'name'       => esc_html__('Cupo de alumnos', 'cmb2'),
        'desc'      => esc_html__('Añadir Número de alumnos', 'cmb2'),
        'id'         => $prefix . 'cupo',
        'type'       => 'text',
        'column' => true,
        // 'repeatable' => true, // Repeatable fields are supported w/in repeatable groups (for most types)
    ));
    // ¿Qué incluye el curso. Se hace con este campo que se puede repetir tantas veces como se necesite
    $edc_campos_cursos->add_field(array(
        'name'       => esc_html__('¿Qué incluye el curso?', 'cmb2'),
        'desc'      => esc_html__('Añadir lo que incluye el curso (1 por línea)', 'cmb2'),
        'id'         => $prefix . 'incluye',
        'type'       => 'text',
        'repeatable' => true, // Repeatable fields are supported w/in repeatable groups (for most types)
        'column' => true,
    ));
    // Chef Instructor del curso. Se hace a traves de un plugins ajax-search
    $edc_campos_cursos->add_field(array(
        'name'       => esc_html__('Chef Instructor del Curso?', 'cmb2'),
        'desc'      => esc_html__('Seleccionar el Chef que impartirá el Curso', 'cmb2'),
        'id'         => $prefix . 'chef',
        'limit' => 10,
        'type'       => 'post_search_ajax',
        'query_args' => array(
            'post_type' => array('chefs'),
            'post_status' => array('publish'),
            'post_per_page' => -1,
        ),
    ));
}
add_action('cmb2_admin_init', 'edc_campos_galeria');
/**
 * Hook in and add a metabox to demonstrate repeatable grouped fields
 */
function edc_campos_galeria()
{
    //$id_pagina = basename(get_page_template());
    $prefix = 'edc_galeria_';
    /**
     * Repeatable Field Groups
     */
    $edc_galeria = new_cmb2_box(
        array(
            'id'           => $prefix . 'metabox',
            'title'        => esc_html__('Galería de Imágenes', 'cmb2'),
            'object_types' => array('page'), // post type
            // 'show_on'      => array(
            //    'key' => 'page-template',
            //    'value' => '../template-parts/page-galeria.php'
            //  ), //No funciona en las versiones > 5 de WP
            'show_on'      => array('id' => array(100,)),
            'context'      => 'normal', //  'normal', 'advanced', or 'side'
            'priority'     => 'high',  //  'high', 'core', 'default' or 'low'
            'show_names'   => true, // Show field names on the left
        )
    );

    //Campo para hacer la galería de imágenes
    $edc_galeria->add_field(array(
        'name'         => esc_html__('Imágenes', 'cmb2'),
        'desc'         => esc_html__('Cargar aquí las imágenes para la galería.', 'cmb2'),
        'id'           => $prefix . 'imagenes',
        'type'         => 'file_list',
        'preview_size' => array(100, 100), // Default: array( 50, 50 )
    ));
}
