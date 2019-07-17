<?php

/**
 *  Crea una página de opciones para el tema
 */
require_once dirname(__FILE__) . '/inc/opciones.php';

/**
 *  Crea un Widget con los próximos cursos
 */
require_once dirname(__FILE__) . '/inc/widgets.php';

/**
 *  Agrega los Posts Types de los Instructores y Clases
 */
require_once dirname(__FILE__) . '/inc/posttypes.php';

/**
 *  Agregar CMB2
 */
require_once dirname(__FILE__) . '/cmb2.php';

/**
 * Agregar campos personalizados de CMB
 *
 */
require_once dirname(__FILE__) . '/inc/custom-fields.php';

/**
 *  Agregar queries.php
 */
require_once dirname(__FILE__) . '/inc/queries.php';
/**
 *              Imágenes destacadas para páginas
 */

function money_format($floatcurr, $curr = 'EUR')
{ }
//Formatear monedas. La función money_format() no funciona en Windows
function asEuro($value)
{
    return number_format(($value), 2);
}

add_action('init', 'edc_imagen_destacada');
function edc_imagen_destacada($id)
{
    $imagen = get_the_post_thumbnail_url($id, 'full');
    $html = '';
    $clase = false;
    if ($imagen) {
        $clase = true;
        $html .= '<div class="container">';
        $html .=        '<div class="row imagen-destacada"></div>';
        $html .=    '</div>';

        // Agregar estilos linealmente
        wp_register_style('custom', false);
        wp_enqueue_style('custom');

        // Creamos el css para el custom
        $imagen_destacada_css = "
            .imagen-destacada {
                    background-image: url({$imagen});
                     }
        ";
        wp_add_inline_style('custom', $imagen_destacada_css);
    }
    return array($html, $clase);
}

/** ========= Funciones que se cargar al activar el tema */
function edc_setup()
{
    //Definir el tamaño de las imágenes
    add_image_size('mediano', 510, 340, true);
    add_image_size('cuadrada_mediana', 350, 350, true);

    //Permitir imágenes destacadas
    add_theme_support('post-thumbnails');
    //Permitir 'Ancho Completo" en el editor
    add_theme_support('align-wide');
    // Dejar que WP maneje los títulos
    add_theme_support('title-tag');
    /*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
    add_theme_support(
        'html5',
        array(
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
        )
    );
    // Habilitar el modo oscuro para el editor
    add_theme_support('editor-styles');
    add_theme_support('dark-editor-style');

    // add_theme_support('custom-logo');
    add_theme_support('custom-logo', array(
        'height'      => 100,
        'width'       => 400,
        'flex-height' => true,
        'flex-width'  => true,
        'header-text' => array('site-title', 'site-description'),
    ));


    // Menú de navegación
    register_nav_menus(array(
        'menu_principal' => esc_html__('Menú Principal', 'escuelacocina')
    ));
}
add_action('after_setup_theme', 'edc_setup');
/**============ Agrega la clase nav-link de bootstrap al menu principal*/
function edc_enlace_class($atts, $item, $args)
{
    if ($args->theme_location == 'menu_principal') {
        $atts['class'] = 'nav-link';
    }
    return $atts;
}
add_filter('nav_menu_link_attributes', 'edc_enlace_class', 10, 3);


// =========== Carga de los estilos y scripts
function edc_scripts()
{
    // ========== Carga los estilos ===========
    wp_enqueue_style('bootstrap-css', get_template_directory_uri() . '/css/bootstrap.css', false, '4.1.3');
    wp_enqueue_style('style', get_stylesheet_uri(), array('bootstrap-css'));
    // ========== Carga los scripst =======-====
    wp_enqueue_script('jquery');
    wp_enqueue_script(
        'popper',
        get_template_directory_uri() . '/js/popper.js',
        'jquery',
        '1.0',
        true
    );
    wp_enqueue_script(
        'bootstrap-js',
        get_template_directory_uri() . '/js/bootstrap.js',
        array('popper'),
        '1.0',
        true
    );
}
add_action('wp_enqueue_scripts', 'edc_scripts');

/** Agrega un mensaje personalizado a la página en el admin */

add_filter('display_post_states', 'edc_cambiar_estado', 10, 2);
function edc_cambiar_estado($states, $post)
{
    if (('page' === get_post_type($post->ID)) && ('page-clases.php' == get_page_template_slug($post->ID))) {
        $states[] = __('Página de Clases <a href="edit.php?post_type=clases_cocina"> Administrar Clases</a> ');
    }
    return $states;
}

/** Soporte a Widgets para nuesttro tema */
add_action('widgets_init', 'edc_widgets_sidebar');
function edc_widgets_sidebar()
{
    register_sidebar(array(
        'name'              =>  'Widget Lateral', // Nombre que va a mostrar en la página de Widgets
        'id'                    =>  'sidebar_widget',
        'before_widget' =>   '<div class="proximos-cursos">',
        'after_widget'   =>   '</div>',
        'before_title'     =>  '<h2 class="text-center text-light separador inverso">',
        'after_title'        =>  '</h2>',
    ));
}

function crear_aviso_copyright()
{
    $todos_posts = get_posts('post_status=publish&order=ASC');
    $primer_post = $todos_posts[0];
    $primer_post_fecha = $primer_post->post_date_gmt;
    _e('Copyright &copy; ');
    if (substr($primer_post_fecha, 0, 4) == date('Y')) {
        echo date('Y');
    } else {
        echo substr($primer_post_fecha, 0, 4) . "-" . date('Y');
    }
    echo ' <strong>' . get_bloginfo('name') . '</strong> ';
    //_e('Todos los derechos reservados.');
}
