<div>
        <h2><a href="<?php the_permalink();?>"><?php the_title(); ?></a></h2>
    </div>
    <div>
        <p>Posted By: <?php the_author_posts_link();?> on <?php the_time('n.j.y');?> in <?php echo get_the_category_list(',')?></p>
    </div>
    <div>
    <?php the_excerpt(); ?>
    <p><a href="<?php the_permalink();?>">Continue Reading &raquo;</a></p>
    </div>