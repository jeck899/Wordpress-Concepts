<?php

get_header(); 
pageBanner(array(
  'title' => 'Past Events',
  'subtitle' => 'Recap'

));
?>
<div>
<?php

$today = date('Ymd'); /* php today date*/ 
$pastEvents = new WP_Query(array(
    'paged' => get_query_var('paged',1), //to get posts in a different page number
    'post_type' => 'event',
    'meta_key' => 'event_date',
    'orderby' => 'meta_value_num',
    'order' => 'ASC',
    'meta_query' => array(
        array( /* compares event_date to today date*/
            'key' => 'event_date',
            'compare' => '<',
            'value' => $today,
            'type' => 'numeric'
        )
    )
));

while($pastEvents->have_posts()){
    $pastEvents->the_post(); 
    get_template_part('template-parts/content','event');
}
echo paginate_links(array(
    'total' => $pastEvents->max_num_pages
));
?>

</div>

<?php
get_footer();


?>