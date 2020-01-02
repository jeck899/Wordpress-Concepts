<?php

get_header();
pageBanner();
while(have_posts()){
the_post();?>

<div>
        <p><a href="<?php echo get_post_type_archive_link('event');?>"><i></i>Events Home</a> <span><?php the_title() ?></span></p>
  </div>

<p><?php the_content();?></p>
<?php
    $relatedPrograms = get_field('related_programs');
    
    if($relatedPrograms){echo '<h2>Related Program(s)</h2>';
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