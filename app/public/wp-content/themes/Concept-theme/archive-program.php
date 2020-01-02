<?php

get_header(); 
pageBanner(array(
  'title' => 'All Programs',
  'subtitle' => 'Program Subtitle'
  
));
?>

<div>
<div style="background-size:cover; background-image: url(<?php echo get_theme_file_uri('/images/ocean.jpg') ?>);">
  <!-- <h1>
      <?php /* if (is_category()) {
     single_cat_title();
  }
  
  if(is_author()){
     echo 'Posts by:'; the_author();
  } */


  // the_archive_title();
  ?>

  
  
  </h1>
  <p>There is something for everyone. Have a look aroundd. </p> -->
  <div>
    <p><?php the_archive_description();?></p>
  </div>
</div>  
</div>

<ul>

<div>
<?php
while(have_posts()){
    the_post(); ?>
    <li><a href="<?php the_permalink();?>"><?php the_title();?></a></li>
<?php
}
echo paginate_links();
?>
</ul>


</div>

<?php
get_footer();


?>