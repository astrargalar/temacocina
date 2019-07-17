<?php get_header(); ?>

<?php while (have_posts()) : the_post();

    get_template_part('template-parts/contenido', 'post'); ?>

    <div class="comentarios container">
        <?php
        if (comments_open() || get_comments_number()) : // Comprueba que si existen comentarios o si están permitidos
            comments_template(); //Abre automáticamente comments.php
        else :
            echo "<p class='text-center comentarios-cerrados alert alert-danger'>Los comentarios están cerrados</p>";
        endif;
        ?>
    </div>

<?php endwhile; ?>
<?php get_footer(); ?>