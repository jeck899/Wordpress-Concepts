<!DOCTYPE html>
<html lang="en">
<head>
<?php wp_head();?>

</head>
<body>
    
    <h1><a style="text-decoration:none;"  href="<?php echo site_url()?>">Concepts</a></h1>

    <header>
    <!-- <ul>
        <li><a href="<?php echo site_url('/about-us')?>">About Us</a></li>
        <li><a href="#">Programs</a></li>
        <li><a href="#">Events</a></li>
        <li><a href="#">Campuses</a></li>
        <li><a href="#">Blog</a></li>
        <li><a href="#">Log In</a></li>
        <li><a href="#">Sign Up</a></li>
        
    </ul> -->

  
    
    <?php
    wp_nav_menu(array(
        'theme_location' => 'headerMenuLocation'
    ));
    ?>
<?php if(is_user_logged_in()){ ?>
              <li><a href="<?php echo esc_url(site_url('/my-notes'));?>">My Notes</a></li>   
            <li><a href="<?php echo wp_logout_url();?>">
            <span><?php echo get_avatar(get_current_user_id(),60)?></span>
            <span>Log Out</span>
            </a></li>
           
            <?php
        }

        else{?>
            <li><a href="<?php echo wp_login_url();?>">Login</a></li>
            <li><a href="<?php echo wp_registration_url();?>">Sign Up</a></li>
            <?php
        }
        
        ?>

<a href="<?php echo esc_url(site_url('/search'))?>"> NON JS SEARCH  </a> <!--'return false' to not laod links --> 
   <img class="search-icon" style="width:20px; display:inline-block" src="data:image/png;base64,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" alt="">
    <div class="search-overlay">
            <input type="text" placeholder="What are you looking for?" id="search-item">
        </div>
    <img class="search-close" style="width:20px; display:inline-block" src="https://cdn1.vectorstock.com/i/1000x1000/16/40/close-button-close-icon-line-x-cross-in-circle-vector-23841640.jpg" alt="">
    <div id="search-overlay__results"></div> 
    


    </header>
