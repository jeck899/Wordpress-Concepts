<?php

get_header(); 
pageBanner(array(
  'title' => get_the_archive_title(),
  'subtitle' => get_the_archive_description()
  
));
?>

<!-- <div>
<div style="background-size:cover; background-image: url(<?php echo get_theme_file_uri('/images/ocean.jpg') ?>);">
  <h1>
      <?php /* if (is_category()) {
     single_cat_title();
  }
  
  if(is_author()){
     echo 'Posts by:'; the_author();
  } */


  // the_archive_title();
  
  ?> 
  </h1> -->
 
</div>  
</div>

<div>
<?php
while(have_posts()){
    the_post(); ?>
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

<?php
}
echo paginate_links();
?>

</div>

<?php
get_footer();


?>