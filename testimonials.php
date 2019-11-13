<?php 

$args = array(
    'post_type'     => 'testimonial',
    'posts_per_page' => 4
);

$query = new WP_Query($args);

if ($query->have_posts() && $query->found_posts >= 4) : ?>

<section id="testimonials"    style='background: url(<?= get_theme_file_uri() ?>/img/testiomnials-background.webp);'>
        <h3>Testimonials</h3>
        <div class="container-slide">

            <div class="gallery items-3">
                <div id="item-1" class="control-operator"></div>
                <div id="item-2" class="control-operator"></div>
                <div id="item-3" class="control-operator"></div>
                <div id="item-4" class="control-operator"></div>

                <?php while ($query->have_posts()) : $query->the_post(); ?>
                <figure class="item">
                    <div class="profil">
                    <?php the_post_thumbnail(); ?>
                        <?= apply_filters( 'the_content', $post->post_content ); ?>
                        <div class="arrow-down"></div>
                        <p class="testimonial-name"><?= the_title(); ?></p>
                    </div>
                </figure>

                <?php endwhile; ?>

                <div class="controls">
                    <a href="#item-1" class="control-button">•</a>
                    <a href="#item-2" class="control-button">•</a>
                    <a href="#item-3" class="control-button">•</a>
                    <a href="#item-4" class="control-button">•</a>
                </div>
            </div>
        </div>
        </div>
    </section>

    <?php endif; ?>