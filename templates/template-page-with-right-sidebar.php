<?php
/*
Template Name: Page With Right Sidebar
*/
get_header();
?>

<div class="container">
    <div class="row">
        
        <!-- Main content -->
        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
            <!-- Your page content goes here -->
            <?php
            if (have_posts()) :
                while (have_posts()) :
                    the_post();
                    the_content();
                endwhile;
            endif;
            ?>
        </main>

        <!-- Right Sidebar -->
        <nav id="sidebar" class="col-md-3 col-lg-2 d-md-block bg-light sidebar">
            <!-- Sidebar content goes here -->
            <div class="sidebar-sticky">
                <?php 
                    if (is_active_sidebar('rsbfpt')) {
                        echo '<div id="custom-sidebar" class="custom-sidebar">';
                        dynamic_sidebar('rsbfpt'); // Correct ID
                        echo '</div>';
                    } else {
                        echo 'Sidebar is not active.';
                    }
                ?>
            </div>
        </nav>

    </div>
</div>

<?php
get_footer();
?>
