<footer>
<h2>This is the Footer Area.</h2>

<h3>Explore Us</h3>
<?php
    // wp_nav_menu(array(
    //     'theme_location' => 'footerLocationOne'
    // ));
    ?>
<ul>
        <li <?php if (is_page('about-us') or wp_get_post_parent_id(0) == 16) echo 'class="current-menu-item"'?>><a href="<?php echo site_url('/about-us')?>">About Us</a></li>
        <li><a href="">Programs</a></li>
        <li><a href="">Events</a></li>
        <li><a href="">Campuse</a></li>
        <li <?php if (get_post_type() == 'post') echo 'class="current-menu-item"'?>><a href="<?php echo site_url('/blog')?>">Blog</a></li> 
        <li <?php if (get_post_type() == 'event' or is_page('past-events') ) echo 'class="current-menu-item"'?>><a href="<?php echo get_post_type_archive_link('event');?>">Event</a></li>
        <li <?php if (get_post_type() == 'program') echo 'class="current-menu-item"'?>><a href="<?php echo get_post_type_archive_link('event');?>">Event</a></li> 
        <?php if(is_user_logged_in()){ ?>
            <li><a href="<?php echo wp_logout_url();?>">
            <span><?php echo get_avatar(get_current_user_id(),60)?></span>
            <span>Log Out</span>
            </a></li>
            <?php
        }

        else{?>
            <li><a href="<?php echo site_url('/wp-login.php')?>">Login</a></li>
            <li><a href="<?php echo site_url('/wp-login.php?action=register')?>">Sign Up</a></li>
            <?php
        }
        
        ?>
        

    </ul>

<h3>Learn</h3>
<?php
    // wp_nav_menu(array(
    //     'theme_location' => 'footerLocationTwo'
    // ));
    ?>
    
    <ul>
        <li><a href="">Legal</a></li>
        <li><a href="<?php echo site_url('/privacy-policy')?>">Privacy</a></li>
        <li><a href="">Careers</a></li>    
    </ul>

<h3>Connect With Us</h3>

            <ul class="min-list social-icons-list group">
              <li><a href="#" class="social-color-facebook"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
              <li><a href="#" class="social-color-twitter"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
              <li><a href="#" class="social-color-youtube"><i class="fa fa-youtube" aria-hidden="true"></i></a></li>
              <li><a href="#" class="social-color-linkedin"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
              <li><a href="#" class="social-color-instagram"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
            </ul>
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
            <script src="index.js" charset="utf-8"></script>

<?php wp_footer(); ?>
</footer>
</body>
</html>

