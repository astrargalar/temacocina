<?php

/**
 * Template Name: Página con iconos
 */


get_header(); ?>

<?php while (have_posts()) : the_post();

    get_template_part('template-parts/contenido', 'paginas');
    get_template_part('template', 'parts/iconos'); //forma de cargar el template cuando tiene un solo nombre




endwhile; ?>
<?php get_footer(); ?>