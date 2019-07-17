<?php

/**
 * Template Name: Listado Clases
 */
get_header(); ?>
<div class="container mb-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <blockquote class="subtitulo text-center pl-3">
                <?php while (have_posts()) : the_post();
                    the_content();
                    $titulo = get_the_title();
                endwhile;
                ?>
            </blockquote>
        </div><!-- col-md-8-->
    </div><!-- row-->
</div>
<!--container-->
<section class="clases mt-5 py-5">
    <h1 class="separador text-center mb-3">
        <?php echo $titulo; ?>
    </h1>
    <div class="container">
        <div class="row">
            <?php edc_query_cursos(); ?>
        </div><!-- row-->
    </div>
    <!--container-->
</section>
<?php get_footer(); ?>