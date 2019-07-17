 <?php get_header(); ?>
 <div class="container">
     <div class="row justify-content-center pl-3">
         <div class="col-md-8">
             <blockquote class="subtitulo text-center pl-3">
                 <?php
                    $id_blog = get_option('page_for_posts');
                    echo get_post_meta($id_blog, 'edc_blog_slogan_blog', true);
                    ?>
             </blockquote>
         </div><!-- col-md-8-->
     </div><!-- row-->
 </div>
 <!--container-->
 <div class="container">
     <div class="row">
         <main class="col-lg-9 col-md-8">
             <h1 class="separador text-center mb-3">
                 Nuestro Blog
             </h1>
             <?php while (have_posts()) : the_post(); ?>
                 <div class="row entrada mb-4">
                     <div class="col-md-4">
                         <a href="<?php the_permalink(); ?>">
                             <?php the_post_thumbnail('mediano', array('class' => 'img-fluid')); ?></a>
                     </div><!-- col-md-4 Foto de la entrada-->
                     <div class="col-md-8">
                         <div class="contenido-entrada pt-4 pt-md-0">
                             <a href="<?php the_permalink(); ?>">
                                 <h3><?php the_title(); ?></h3>
                             </a>
                             <?php get_template_part('template-parts/meta', 'post'); ?>
                             <p><?php the_excerpt(); ?></p>
                             <a href="<?php the_permalink(); ?>" class="btn btn-primary text-light">Ver entrada</a>
                         </div><!-- contenido-entrada-->
                     </div><!-- col-md-8 -->
                 </div>
             <?php endwhile; ?>
             <ul class="pagination  mt-4">
                 <li class="page-item">
                     <?php
                        previous_posts_link('
                                <span class="page-link" aria-hidden="true">&laquo; Anteriores</span>
                                <span class="sr-only">Anteriores</span>
                                ');
                        ?>
                 </li>
                 <li class="page-item">
                     <?php
                        next_posts_link('
                                <span class="page-link" aria-hidden="true">Siguientes &raquo;</span>
                                <span class="sr-only">Siguientes</span>
                                ');
                        ?>
                 </li>
             </ul>
         </main>
         <!--col - lg - 9 -->
         <?php get_sidebar(); ?>
     </div><!-- row-->
 </div>
 <!--container-->

 <?php get_footer(); ?>