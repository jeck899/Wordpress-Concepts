<?php

get_header();

while(have_posts()){
the_post();
pageBanner();
?>
    <div>
        <p><a href="<?php echo site_url('/blog');?>"><i></i>Blog Home</a> <span>Posted By: <?php the_author_posts_link();?> on <?php the_time('n.j.y');?> in <?php echo get_the_category_list(',')?></span></p>
  </div>

<?php }
get_footer();
?>