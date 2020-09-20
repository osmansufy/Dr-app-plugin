<?php

/**
 * Register custom taxonomy for custom Post appointments
 */
class Taxonomy {

    public function custom_taxonomy_dr (){
        $labels = array(
              'name'              => _x( 'Type of Diseases', 'diseases', 'app_booking' ),
              'singular_name'     => _x( 'Type of Disease', 'disease', 'app_booking' ),
              'search_items'      => __( 'Search Type of Diseases', 'app_booking' ),
              'all_items'         => __( 'All Type of Diseases', 'app_booking' ),
              'parent_item'                => null,
              'parent_item_colon'          => null,
              'parent_item'       => __( 'Parent Type of Disease', 'app_booking' ),
              'parent_item_colon' => __( 'Parent Type of Disease:', 'app_booking' ),
              'edit_item'         => __( 'Edit Type of Disease', 'app_booking' ),
              'update_item'       => __( 'Update Type of Disease', 'app_booking' ),
              'add_new_item'      => __( 'Add New Type of Disease', 'app_booking' ),
              'new_item_name'     => __( 'New Type of Disease Name', 'app_booking' ),
              'menu_name'         => __( 'Type of Disease', 'app_booking' ),
          );
       
          $args = array(
              'hierarchical' => false,
              'public'=>true,
              'label' => 'Type of Disease', // display name
              'query_var' => true,
              'labels'                => $labels,
              'update_count_callback' => '_update_post_term_count',
              'show_ui' => true,
              'show_in_nav_menus'=>true,
              'show_in_menu'=>true,
              'show_in_rest' => true,
              'show_admin_column' => true,
              
              'rewrite'           => array( 'slug' => 'diseases' ,'with_front' => true, ),
          );
       
          register_taxonomy( 'diseases', array( 'appointments' ), $args );
       
          
          unset( $labels );
          unset($args);
      
        $labels = array(
          'name'                       => _x( 'Doctors', 'doctors', 'app_booking' ),
          'singular_name'              => _x( 'Doctor', 'doctor', 'app_booking' ),
          'search_items'               => __( 'Search doctors', 'app_booking' ),
          'popular_items'              => __( 'Popular doctors', 'app_booking' ),
          'all_items'                  => __( 'All doctors', 'app_booking' ),
          'parent_item'                => null,
          'parent_item_colon'          => null,
          'edit_item'                  => __( 'Edit doctor', 'app_booking' ),
          'update_item'                => __( 'Update doctor', 'app_booking' ),
          'add_new_item'               => __( 'Add New doctor', 'app_booking' ),
          'new_item_name'              => __( 'New doctor Name', 'app_booking' ),
          'separate_items_with_commas' => __( 'Separate doctors with commas', 'app_booking' ),
          'add_or_remove_items'        => __( 'Add or remove doctors', 'app_booking' ),
          'choose_from_most_used'      => __( 'Choose from the most used doctors', 'app_booking' ),
          'not_found'                  => __( 'No doctors found.', 'app_booking' ),
          'menu_name'                  => __( 'doctors', 'app_booking' ),
      );
      
      
              register_taxonomy( 
                  'doctors',
                  'appointments',
                  array(
                      'hierarchical' => true,
                      'public'=>true,
                      'label' => 'Doctors', // display name
                      'query_var' => true,
                      'show_ui' => true,
                      'show_in_nav_menus'=>true,
                      'show_in_menu'=>true,
                      // 'show_in_rest' => true,
                      'show_admin_column' => true,
          
                      'labels'                => $labels,
                      'rewrite' => array(
                          'slug' => 'doctors',    // This controls the base slug that will display before each term
                          'with_front' => true,  // Don't display the category base before
                          
                      )
                      ));
          }
}