<?php
$args = array(
    'post_type'     => 'news',
    'posts_per_page' => 3
);

$query = new WP_Query($args); ?>
<section id="latest-news">
        <h3>Latest News</h3>
        <div class="section-p mt-25">
            <p>If you are interested in the latest articles in the industry, take a sneak peek at our blog. You have nothing to loose!</p>
        </div>
        <?php if ($query->have_posts()) :?>
        <a href="#" title="See blog" class="latest-news-button"><i class="fa fa-chevron-circle-right"></i>See blog </a>
        <div class="container">
        <?php while ($query->have_posts()) : $query->the_post(); ?>
            <div class="new">
                <div class="post">
                    <div class="post-image" style="background-image: url('<?= the_post_thumbnail_url() ?>');"></div>
                    <p><a href="#" title="<?= the_title(); ?>" class="post-title"><?= the_title(); ?></a></p>
                    <div class="post-entry">
                    <?= apply_filters( 'the_content', $post->post_content ); ?>
                        <a href="<?= the_permalink() ?>" title="Read more" class="post-button"><i class="fa fa-chevron-circle-right"></i>Read more </a>
                </div>
            </div>
            </div>
            <?php endwhile; ?>
        <?php else:?>
        <h2>There are currently no news available</h2>
        
        <?php endif; ?>
        </div>
    </section>