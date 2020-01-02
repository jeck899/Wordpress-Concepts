<?php

get_header();

while(have_posts()){
the_post();
pageBanner();
?>
<p><?php the_field('main_body_content');?></p>

<?php
$relatedProfessors = new WP_Query(array(
    'posts_per_page' => -1, /* -1 to query all that match the conditions */
    'post_type' => 'professor',
    'orderby' => 'title',
    'order' => 'ASC',
    'meta_query' => array( //inner array acts as filter
        array(
          'key' => 'related_programs',
          'compare' => 'LIKE', //contains
          'value' => '"' . get_the_ID() . '"'
        )
    )
));

if($relatedProfessors->have_posts()){
  
 echo '<h2> ' . get_the_title() . ' Professors</h2>';
 echo '<ul>';
 while($relatedProfessors->have_posts()){
  $relatedProfessors -> the_post();?>
 <span> 
  <li><a href="<?php the_permalink()?>">
  <?php the_title() ?></a>
 <img src="<?php the_post_thumbnail_url('professorLandscape')?>" alt="">
 </li> 
 <?php
 }
 echo '</ul>';
}

 wp_reset_postdata(); // to reset queries

?>   

<?php
$today = date('Ymd'); /* php today date*/ 
$homepageEvents = new WP_Query(array(
    'posts_per_page' => 2, /* -1 to query all that match the conditions */
    'post_type' => 'event',
    'meta_key' => 'event_date',
    'orderby' => 'meta_value_num',
    'order' => 'ASC',
    'meta_query' => array( //inner array acts as filter
        array( /* compares event_date to today date*/
            'key' => 'event_date',
            'compare' => '>=',
            'value' => $today,
            'type' => 'numeric'
        ),
        array(
          'key' => 'related_programs',
          'compare' => 'LIKE', //contains
          'value' => '"' . get_the_ID() . '"'
        )
    )
));

if($homepageEvents->have_posts()){
  
 echo '<h2>Upcoming ' . get_the_title() . ' Events</h2>';

 while($homepageEvents->have_posts()){
  $homepageEvents -> the_post();get_template_part('template-parts/content','event');
  
 }
}

?>   

<?php }
get_footer();
?>