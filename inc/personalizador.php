<?php
// Crear un panel “Mis Opciones” en el Personalizador del Tema
/**
 * Para mostrar automáticamente nuestro código de Google Analytics en el head de nuestro sitio, también dentro del functions.php agregaremos estas líneas:
 *
 *
 * //Add Google Analytics Code
 * if (get_option('my_google_analytics')) {
 * function add_google_analytics_code() {
 * echo get_option('my_google_analytics');
 * }
 * add_action( 'wp_head', 'add_google_analytics_code' );
 *}
 *
 * Y para recuperar cualquiera de las URLs de redes sociales que hemos configurado para montar nuestra botonera
 * por ejemplo en el header o footer, bastará con llamar a la función get_option() e indicar el ID de la opción que
 * deseamos obtener desde el template correspondiente.
 *
 */
function my_customize_register($wp_customize)
{
    $wp_customize->add_panel('my_custom_options', array(
        'title' => __('Mis Opciones', 'textdomain'),
        'priority' => 160,
        'capability' => 'edit_theme_options',
    ));

    // Section para Google Analytics
    $wp_customize->add_section('google_analytics_section', array(
        'title' => __('Google Analytics', 'textdomain'),
        'panel' => 'my_custom_options',
        'priority' => 1,
        'capability' => 'edit_theme_options',
    ));

    // Section para Redes Sociales
    $wp_customize->add_section('social_section', array(
        'title' => __('Redes Sociales', 'textdomain'),
        'panel' => 'my_custom_options',
        'priority' => 2,
        'capability' => 'edit_theme_options',
    ));

    //Google Analytics
    $wp_customize->add_setting('my_google_analytics', array(
        'type' => 'theme_mod',
        'capability' => 'edit_theme_options',
    ));

    $wp_customize->add_control('my_google_analytics', array(
        'label' => __('Código de Google Analytics', 'textdomain'),
        'section' => 'google_analytics_section',
        'priority' => 1,
        'type' => 'textarea',
    ));

    //Redes Sociales: Facebook
    $wp_customize->add_setting('my_facebook_url', array(
        'type' => 'option',
        'capability' => 'edit_theme_options',
    ));

    $wp_customize->add_control('my_facebook_url', array(
        'label' => __('Facebook URL', 'textdomain'),
        'section' => 'social_section',
        'priority' => 1,
        'type' => 'text',
    ));

    //Redes Sociales: Twitter
    $wp_customize->add_setting('my_twitter_url', array(
        'type' => 'option',
        'capability' => 'edit_theme_options',
    ));

    $wp_customize->add_control('my_twitter_url', array(
        'label' => __('Twitter URL', 'textdomain'),
        'section' => 'social_section',
        'priority' => 2,
        'type' => 'text',
    ));

    //Redes Sociales: Google Plus
    $wp_customize->add_setting('my_googleplus_url', array(
        'type' => 'option',
        'capability' => 'edit_theme_options',
    ));

    $wp_customize->add_control('my_googleplus_url', array(
        'label' => __('Google Plus URL', 'textdomain'),
        'section' => 'social_section',
        'priority' => 3,
        'type' => 'text',
    ));
}
add_action('customize_register', 'my_customize_register');

function themeslug_customize_register($wp_customize)
{
    // Do stuff with $wp_customize, the WP_Customize_Manager object.
}
$wp_customize->add_panel('panel_id', array(
    'priority' => 160,
    'capability' => 'edit_theme_options',
    'theme_supports' => '', // Rarely needed
    'title' => __('Título Panel', 'your_textdomain'),
    'description' => __('Descripción Panel', 'your_textdomain'),
));
$wp_customize->add_section('section_id', array(
    'title' => __('Título Section', 'your_textdomain'),
    'description' => __('Descripción Section', 'your_textdomain'),
    'panel' => 'panel_id', // Not typically needed.
    'priority' => 160,
    'capability' => 'edit_theme_options',
    'theme_supports' => '', // Rarely needed.
));
$wp_customize->add_setting('setting_id', array(
    'type' => 'theme_mod', // or 'option'
    'capability' => 'edit_theme_options',
    'theme_supports' => '', // Rarely needed.
    'default' => '', // Ej: #000000
    'transport' => 'refresh', // or postMessage
    'sanitize_callback' => '', // Ej: 'sanitize_hex_color'
    'sanitize_js_callback' => '', // Basically to_json.
));
$wp_customize->add_control('setting_id', array(
    'type' => 'date',
    'priority' => 10, // Within the section.
    'section' => 'section_id', // Required, core or custom.
    'label' => __('Fecha', 'your_textdomain'),
    'description' => __('Descripción', 'your_textdomain'),
    'input_attrs' => array(
        'class' => 'my-custom-class-for-js',
        'style' => 'border: 1px solid #900',
        'placeholder' => __('dd/mm/yyyy', 'your_textdomain'),
    ),
    'active_callback' => 'is_front_page',
));
// Range
$wp_customize->add_control('setting_id', array(
    'type' => 'range',
    'section' => 'section_id',
    'label' => __('Etiqueta', 'your_textdomain'),
    'input_attrs' => array(
        'min' => 0,
        'max' => 10,
        'step' => 2,
    ),
));
// Radio
$wp_customize->add_control('setting_id', array(
    'type' => 'radio',
    'section' => 'section_id',
    'label' => __('Etiqueta', 'your_textdomain'),
    'choices' => array(
        'on' => __('On', 'your_textdomain'),
        'off' => __('Off', 'your_textdomain'),
    ),
));
// Select
$categories = get_categories();
$cats = array();
foreach ($categories as $category) {
    $cats[$category->slug] = $category->name;
}

$wp_customize->add_control('setting_id', array(
    'type' => 'select',
    'section' => 'section_id',
    'label' => __('Etiqueta', 'your_textdomain'),
    'choices' => $cats
));

// Dropdown
$wp_customize->add_control('setting_id', array(
    'type' => 'dropdown-pages',
    'section' => 'section_id',
    'label' => __('Etiqueta', 'your_textdomain'),
));
//Color picker
$wp_customize->add_control(
    new WP_Customize_Color_Control(
        $wp_customize,
        'setting_id',
        array(
            'label' => __('Etiqueta', 'your_textdomain'),
            'section' => 'section_id',
        )
        // Required, core or custom.
    )
);
//Media
$wp_customize->add_control(
    new WP_Customize_Media_Control(
        $wp_customize,
        'setting_id',
        array(
            'mime_type' => 'image', // image, audio, video, application
            'label' => __('Etiqueta', 'your_textdomain'),
            'section' => 'section_id',
        ) // Required, core or custom.
    )
);
add_action('customize_register', 'themeslug_customize_register');
//Controles personalizados
class WP_New_Menu_Customize_Control extends WP_Customize_Control
{
    public $type = 'new_menu';
    public function render_content()
    { ?>
    <button class="button button-primary" id="create-new-menu-submit" tabindex="0"><?php _e('Create Menu', 'your_textdomain'); ?></button>
<?php }
} ?>

//Consultar en https://desarrollowp.com/blog/tutoriales/sacale-partido-al-personalizador-wordpress/