<?php

  get_header();

  while(have_posts()) {
    the_post(); 
    
    pageBanner(array(
    ));
    ?>
    <!-- the_title(); - gets the title of the current page
    get_the_title(ID); - gets the title of Page with the ID passed in  -->

  <div>
    <!-- if child or parent based on ID -->
    
    <?php 

    $parentId = wp_get_post_parent_id(get_the_ID());
    // returns 0 if current page has no parent
    if($parentId){ ?>
        <div>
        <p><a href="<?php echo get_permalink($parentId);?>"><i></i> Back to <?php echo get_the_title($parentId);?>
        </a> <span><?php the_title(); ?></span></p>
      </div>
    <?php }
    ?>

    <?php 
    $testArray = get_pages(array(
        'child_of' => get_the_ID()
    ));
    //returns 0 if current page has no child
    if ($parentId or $testArray){ ?>
    <!-- for the side nav to not show up if a page has no child/parent  -->
    <div style="background-color:pink; display:inline-block;">
      <h2><a href="<?php echo get_the_permalink($parentId); ?>"><?php echo get_the_title($parentId);?></a></h2>
      <ul>
        <?php 
            if($parentId){
                $findChildrenOf = $parentId;
                // ID of a child page
            }
            else{
                $findChildrenOf = get_the_ID();
                // ID of a Parent (current page)
            }
        wp_list_pages(array(
            'title_li' => NULL,
            'child_of' =>  $findChildrenOf,
            'sort_column' => 'menu_order' 
            // sorts based on Wordpress admin Menu
        )); 
        
     
        // ASSOCIATIVE ARRAY
        // $animalSounds = array(
        //     'cat' => 'meow',
        //     'dog' => 'bark',
        //     'pig' => 'oink'
        //     )

        //     echo $animalSounds['dog'];
        //     ---outputs bark
        
       } ?>
        
      </ul>
    </div>
   

    <div>
      <?php the_content(); ?>
    </div>

  </div>
    
  <?php }

  get_footer();

?>