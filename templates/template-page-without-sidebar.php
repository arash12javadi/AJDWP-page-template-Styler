<?php
/*
Template Name: Page With Right Sidebar
*/
get_header();
?>

<div class="container">
    <div class="row">
        <!-- Main content -->
        <main role="main" class="col-md-12 ml-sm-auto col-lg-12 px-md-4">
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

    </div>
</div>

<?php
get_footer();
?>
