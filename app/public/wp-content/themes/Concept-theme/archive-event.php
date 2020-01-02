<?php

get_header(); 
pageBanner(array(
    'title' => 'All Events',
    'subtitle' => 'Archives Subtitle'
    
));
?>

<div>
<div style="background-size:cover; background-image: url(<?php echo get_theme_file_uri('/images/ocean.jpg') ?>);">
  
  <div>
    <p><?php the_archive_description();?></p>
  </div>
</div>  
</div>

<div>
<?php
while(have_posts()){
    the_post();
    get_template_part('template-parts/content','event');
}
echo paginate_links();
?>

<hr>

<p>Looking for a recap of past events? <a href="<?php echo site_url('/past-events')?>">Checkout our past events archive.</a></p>

</div>

<?php
get_footer();


?>