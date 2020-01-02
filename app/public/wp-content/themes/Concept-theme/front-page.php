<?php
get_header();

while(have_posts()){
the_post();?>
<h2 class="white-link" style=" background-size: cover; background-image: url(<?php 
echo get_theme_file_uri('/images/library-hero.jpg') ?>)"><a href="<?php the_permalink();?>" ><?php the_title();?></a>
<p><?php the_content();?></p>
<a href="<?php echo get_post_type_archive_link('program');?>">Find Your Major</a>
</h2>

<hr>


<?php } ?>

<h2>Upcoming Events</h2>

<?php
$today = date('Ymd'); /* php today date*/ 
$homepageEvents = new WP_Query(array(
    'posts_per_page' => 2, /* -1 to query all that match the conditions */
    'post_type' => 'event',
    'meta_key' => 'event_date',
    'orderby' => 'meta_value_num',
    'order' => 'ASC',
    'meta_query' => array(
        array( /* compares event_date to today date*/
            'key' => 'event_date',
            'compare' => '>=',
            'value' => $today,
            'type' => 'numeric'
        )
    )
));

while($homepageEvents->have_posts()){
 $homepageEvents -> the_post();
 get_template_part('template-parts/content','event');
}
?>

<p><a href="<?php echo get_post_type_archive_link('event');?>">View All Events</a></p>


<h2>From our Blogs</h2>

<?php
$homePagePosts = new WP_query(array(
    'posts_per_page' => 2,
    // 'category_name' => 'news'
));

while($homePagePosts->have_posts()){
    $homePagePosts->the_post(); ?>

<a href = "<?php the_permalink();?>"><span><?php the_time('M')?></span>
<span><?php the_time('d')?></span> 
</a>

<h5><a href="<?php the_permalink();?>"><?php the_title(); ?></a></h5>

<p><?php if(has_excerpt()){
    echo get_the_excerpt();}
    else {echo wp_trim_words(get_the_content(),18);}
    
    ?> <a href="<?php the_permalink();?>">Read More</a></p>  

<?php
    } wp_reset_postdata();
?>
    <p><a href="<?php echo site_url('/blog');?>">View all Blog Posts.</a></p>
<?php
get_footer();
?>