<span><?php 
   $eventDate = new DateTime(get_field('event_date'));
    echo $eventDate->format('M')
?></span>
<span>
<?php 
    $eventDate = new DateTime(get_field('event_date'));
    echo $eventDate->format('d')
?>
</span>

<h5><a href="<?php the_permalink();?>"><?php  the_title();?></a></h5>

<p><?php if(has_excerpt()){
    echo get_the_excerpt();}
    else {echo wp_trim_words(get_the_content(),18);}?>
    <a href="<?php the_permalink();?>">Learn More</a></p>
 