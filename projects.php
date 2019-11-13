<?php
$args = array(
    'post_type'     => 'project',
    'posts_per_page' => 4
);

$query = new WP_Query($args);
?>
<?php if ($query->have_posts() && $query->found_posts >= 4) : ?>
    <section id="projects">
        <h3>Projects</h3>
        <div class="section-p mt-25">
            <p>You'll love our work. Check it out!</p>
        </div>
        <div class="grid">
            <?php while ($query->have_posts()) : $query->the_post(); ?>
                <article class="col-3 col-s-6">
                    <a href='<?= the_permalink() ?>'>
                    <?php if ((function_exists('has_post_thumbnail')) && (has_post_thumbnail())) { ?>
                        <?php the_post_thumbnail(); ?>
                    <?php }
                            ?>
                    <div class="overlay"></div>
                    </a>
                </article>

            <?php endwhile; ?>
        </div>
    </section>
<?php endif; ?>