<?php

get_header();

while(have_posts()){
the_post();
pageBanner(array(
));
?>

<div>
        <p><a href="<?php echo get_post_type_archive_link('event');?>"><i></i>Events Home</a> <span><?php the_title() ?></span></p>
  </div>

<p><?php the_post_thumbnail('professorLandscape'); the_content();?></p>

<?php
 $likedCount = new WP_Query(array(
   'post_type' => 'like',
   'meta_query' => array(
     array(
       'key' => 'liked_professor_id',
       'compare' => '=',
       'value' => get_the_ID()
     )
   )
     ));
// to fill icon when liked 
// needs to have css styles
     $existStatus ='no';

     if(is_user_logged_in()){
      $existQuery = new WP_Query(array(
        'author' => get_current_user_id(),
        'post_type' => 'like',
        'meta_query' => array(
          array(
            'key' => 'liked_professor_id',
            'compare' => '=',
            'value' => get_the_ID()
          )
        )
          ));
  
      if($existQuery->found_posts){
        $existStatus = 'yes';
      }
     }

?>

<span class="like-box" data-like=<?php echo $existQuery->posts[0]->ID;?> data-professor="<?php the_ID(); ?>" data-exists="<?php echo $existStatus; ?>">
  <i class="fa fa-heart-o" aria-hidden="true"></i>
  <i class="fa fa-heart" aria-hidden="true"></i>
  <span class="like-count"><?php echo $likedCount->found_posts; ?></span>
</span>

<?php
    $relatedPrograms = get_field('related_programs');
    
    if($relatedPrograms){echo '<h2>Subject(s) Thought</h2>';
      echo '<ul>';
      foreach($relatedPrograms as $program) {?>
        <li><a href="<?php echo get_the_permalink($program);?>"><?php echo get_the_title($program);?></a></li>
        <?php
        echo '</ul>';
     }
    }
 }
get_footer();
?>
