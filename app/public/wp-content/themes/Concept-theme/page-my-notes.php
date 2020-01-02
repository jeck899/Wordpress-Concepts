<?php
if(!is_user_logged_in()){
    wp_redirect(site_url('/'));
    exit;
}

  get_header();

  while(have_posts()) {
    the_post(); 
    
    pageBanner(array(
    ));
    ?>


  <div>

    <div class="create-note">
    <h2>Create New Note</h2>
    <input class="new-note-title" type="text" placeholder="Title">
    <textarea class="new-note-body" name="" id="" cols="30" rows="1" placeholder="Your Notes Here..."></textarea>
    <span class="submit-note">Create Note</span>
    <span class="note-limit-message">Limit Reached</span>

    </div>

    <ul id="my-notes">
    <?php
    $userNotes = new WP_Query(array(
        'post_type' => 'note',
        'posts_per_page' => -1,
        'author' => get_current_user_id()
    ));

    while($userNotes->have_posts()){
        $userNotes->the_post(); ?>
    <li data-id="<?php the_ID();?>">
        <!-- esc_attr - use every access on the backend for security purposes = does not allow javascripts-->
        <input class="note-title-field" readonly value="<?php echo str_replace('Private: ','',esc_attr(get_the_title()));?>"> 
        <span class="edit-note" aria-hidden="true">Edit</span>
        <span class="delete-note" aria-hidden="true">Delete</span>
        <textarea readonly class="note-body-field" cols="30" rows="1"><?php echo esc_textarea(get_the_content());?></textarea>
        <span class="update-note btn btn--blue btn--small" aria-hidden="true">Save</span>
      </li>

    <?php }

    ?>
    </ul>
    
    

  </div>
    
  <?php }

  get_footer();

?>