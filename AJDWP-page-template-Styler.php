<?php

if ( ! defined( 'ABSPATH' ) ) exit; 

/**
 * Plugin Name:       AJDWP-page-template-Styler
 * Plugin URI:        https://github.com/arash12javadi/
 * Description:       Two sidebars, namely "AJDWP Sidebar Left for Page Templates" and "AJDWP Sidebar Right for Page Templates," have been incorporated into your WordPress admin under Appearance -> Widgets. Additionally, five new page templates have been introduced, utilizing these left or right widgets for the sidebar. The Saira font, identified as "AJDWP_fonts_Saira," has also been included. Feel free to make it !important if you wish to modify the font for the entire website. Furthermore, essential WooCommerce CSS has been integrated into this plugin. Enjoy :)
 * Version:           1
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            Arash Javadi
 * Author URI:        https://arashjavadi.com/  
 */


//__________________________________________________________________________//
//                       ADD JAVASCRIPTS AND CSS
//__________________________________________________________________________//

wp_enqueue_style( 'AJDWP_page_temps_CSS', plugins_url( '/css.css' , __FILE__ ), false, '1.0', 'all' );
wp_enqueue_style( 'AJDWP_pt_woo_CSS', plugins_url( 'woo/woo.css' , __FILE__ ), false, '1.0', 'all' );
wp_enqueue_script( 'AJDWP_plugin_bootstrap-js-4.3.1', 'https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js' );
wp_enqueue_script( 'AJDWP_plugin_bootstrap-bundle-4.3.1', 'https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js' );
wp_enqueue_style( 'AJDWP_plugin_bootstrap_css', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css' );    
wp_enqueue_style( 'AJDWP_plugin_fontawsome_4.7.0', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css' );    
wp_enqueue_script( 'AJDWP_plugin_bootstrap_js', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js' );  


//__________________________________________________________________________//
//                               CODES HERE                   
//__________________________________________________________________________//

//--------------------------- Add template to the pages ---------------------------//

function add_custom_templates() {
   $temps = [];
   $temps['template-page-with-left-sidebar.php'] = 'Page With Left Sidebar';
   $temps['template-page-with-right-sidebar.php'] = 'Page With Right Sidebar';
   $temps['template-fluid-page-with-left-sidebar.php'] = 'Page Full-With Left Sidebar';
   $temps['template-fluid-page-with-right-sidebar.php'] = 'Page Full-With Right Sidebar';
   $temps['template-page-without-sidebar.php'] = 'Page Without Sidebar';
   $temps['template-canvas.php'] = 'Full Canvas';  // Corrected template name

   return $temps;
}

function include_custom_template($page_templates, $theme, $post) {
   $templates = add_custom_templates();
   foreach($templates as $tk => $tv) {
      $page_templates[$tk] = $tv;
   }
   return $page_templates;
}
add_filter('theme_page_templates', 'include_custom_template', 10, 3);

function my_template_select($template){
   global $post;
   $page_temp_slug = get_page_template_slug($post->ID);
   $templates = add_custom_templates();
   if(isset($templates[$page_temp_slug])){
      $template = plugin_dir_path(__FILE__).'templates/'. $page_temp_slug;
   }
   return $template;
}

add_filter('template_include', 'my_template_select', 99);

//--------------------------- Register a custom sidebar ---------------------------//

function AJDWP_register_template_sidebar() {
    register_sidebar(
      array(
        'name'          => 'AJDWP sidebar left for page Templates',
        'id'            => 'lsbfpt',
        'description'   => 'This is a left sidebar for added templates.',
        'class'         => 'sidebar-left',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h2 class="AJDWP-widget-class-left">',
        'after_title'   => '</h2>',
      )
   );

    register_sidebar(
      array(
       'name'          => 'AJDWP sidebar right for page Templates',
       'id'            => 'rsbfpt',
       'description'   => 'This is a right sidebar for added templates.',
       'class'         => 'sidebar-right',
       'before_widget' => '<div id="%1$s" class="widget %2$s">',
       'after_widget'  => '</div>',
       'before_title'  => '<h2 class="AJDWP-widget-class-right">',
       'after_title'   => '</h2>',
      )
   );
}
add_action('widgets_init', 'AJDWP_register_template_sidebar');



//--------------------------- Add font Saira ---------------------------//


function plugin_custom_styles() {
   echo '<style>
      * {
           font-family: "AJDWP_fonts_Saira";
       }
   </style>';
}

add_action('wp_head', 'plugin_custom_styles');
