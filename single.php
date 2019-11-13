<div class="center">
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
<?php the_post_thumbnail(); ?>
<?php endwhile; endif; ?>
</div>