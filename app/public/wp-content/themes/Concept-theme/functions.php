<?php

require get_theme_file_path('/Includes/search-route.php');
require get_theme_file_path('/Includes/like-route.php');

function concept_custom_rest() {
    register_rest_field('post','authorName',array(
        'get_callback' => function(){return get_the_author();}
    ));
    register_rest_field('note','userNoteCount',array(
        'get_callback' => function(){return count_user_posts(get_current_user_id(),'note');}
    )); // for delete Note Method

    // register_rest_field('post','objectName',array(
    //     'get_callback' => function(){return sampleFunction();}
    // ));
}

add_action('rest_api_init','concept_custom_rest');

function pageBanner($args = NULL) {
    if(!$args['title']){
       $args['title'] = get_the_title();
    }

    if(!$args['subtitle']){
        $args['subtitle'] = get_field('page_banner_subtitle');
     }

     if(!$args['photo']){
        if(get_field('page_banner_background_image')){
            $args['photo'] = get_field('page_banner_background_image')['sizes']['pageBanner'];
        } else{
            $args['[photo'] = get_theme_file_uri('/images/ocean.jpg');
        }
     }
    ?>

<div style="background-image:url(<?php echo $args['photo']; ?>">
<h2><?php echo $args['title'];?></h2>
<p><?php echo $args['subtitle']; ?></p>
</div>
<?php
}



function function_name() {
    wp_enqueue_script('js_file',get_theme_file_uri('/index.js'), array('jquery'), microtime(),true);
    wp_enqueue_style('custom-google-fonts','//fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i|Roboto:100,300,400,400i,700,700i');
    wp_enqueue_style('font_name','//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css'); 
    wp_enqueue_style('style_name', get_stylesheet_uri());
    wp_localize_script('js_file','conceptData',array(
        'root_url' => get_site_url(),
        'nonce' => wp_create_nonce('wp_rest') //to give access to rest 
       ));
}

add_action('wp_enqueue_scripts','function_name');
// add_action(when to call function,name of function )

function function_name2(){
    register_nav_menu('headerMenuLocation','Header Menu Location');
    register_nav_menu('footerLocationOne','Footer One');
    register_nav_menu('footerLocationTwo','Footer Two');    
    //adds navigation menu to wordpress admin 
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails'); // feature images
    add_image_size('professorLandscape', 400, 260, array('left','top'));
    add_image_size('professorPortrait', 480, 650, true);
    add_image_size('pageBanner', 1500, 300, true);
    // to add title to every page dynamically
}

add_action('after_setup_theme','function_name2');

function adjust_queries ($query) {
    if(!is_admin() AND is_post_type_archive('program' AND $query->is_main_query())){
        $query->set('orderby','title');
        $query->set('order','ASC');
        $query->set('post_per_page',-1);
    }
    
    if (!is_admin() AND is_post_type_archive('event') AND $query->is_main_query()) {
        $today = date('Ymd');
        $query->set('meta_key','event_date');
        $query->set('orderby','meta_value_num');
        $query->set('order','ASC');
        $query->set('meta_query',array(
            array( /* compares event_date to today date*/
                'key' => 'event_date',
                'compare' => '>=',
                'value' => $today,
                'type' => 'numeric'
            )
        ));
    }
}

add_action('pre_get_posts','adjust_queries');

//Redirect subscriber accounts to homepage




add_action('admin_init', 'redirectSubstoFrontEnd');



function redirectSubstoFrontEnd(){
    $ourCurrentUser = wp_get_current_user();

    if(count($ourCurrentUser -> roles) == 1 AND $ourCurrentUser->roles[0] == 'subscriber'){
wp_redirect(site_url('/'));
exit;
    }
}

//remove admin premises to subs
add_action('wp_loaded', 'noSubsAdminBar');

function noSubsAdminBar(){
    $ourCurrentUser = wp_get_current_user();

    if(count($ourCurrentUser -> roles) == 1 AND $ourCurrentUser->roles[0] == 'subscriber'){
show_admin_bar(false);

    }
}


// Customize Login Screen
add_filter('login_headerurl','ourHeaderUrl');

function ourHeaderUrl(){
    return esc_url(site_url('/'));
}

// load css in registration page
add_action('login_enqueue_scripts','ourLoginCSS');

function ourLoginCSS(){
    wp_enqueue_style('style_name', get_stylesheet_uri());
    // download course login.css file for sample
}

add_filter('loo_headertitle','ourLoginTitle');

function ourLoginTitle(){
    return get_bloginfo('name');
}

// Force note posts to be private
add_filter('wp_insert_post_data','makeNotePrivate',10,2);

function makeNotePrivate($data, $postarr){
    // to disable html tags
    if($data['post_type'] == 'note'){
        if(count_user_posts(get_current_user_id(), 'note') > 4 AND $postarr['ID']){ //limits number of posts of user
            die("You have reached your note limit");
        }
        $data['post_content'] = sanitize_text_area_field( $data['post_content']);
        $data['title'] = sanitize_text_field( $data['title']);
    }

    if($data['post_type'] == 'note' AND $data['post_status']!= 'trash'){
    $data['post_status'] = "private";
    }
   
    return $data;
}