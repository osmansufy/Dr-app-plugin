<?php

require_once(plugin_dir_path(__DIR__).'doctors_app.php');

class DrCPT {

    public function dr_app_post(){

        $dcApp= new Doctors();
       
        $labels = [
           "name" => __( "Appointments", "app_booking" ),
           "singular_name" => __( "Appointment ", "app_booking" ),
           "all_items" => __( "All Appointment", "app_booking" ),
           "add_new" => __( "Add Appointment", "app_booking" ),
           "add_new_item" => __( "Add new Appointment", "app_booking" ),
           "edit_item" => __( "Edit Appointment", "app_booking" ),
           "new_item" => __( "New Appointment", "app_booking" ),
           "view_item" => __( "View Appointment", "app_booking" ),
           "view_items" => __( "View Appointment", "app_booking" ),
           "search_items" => __( "Appointments", "app_booking" ),
           "not_found" => __( "Appointment not found", "app_booking" ),
       ];
   
       $args = [
           "label" => __( "Appointments", "app_booking" ),
           "labels" => $labels,
           "description" => "",
           "public" => true,
           "publicly_queryable" => true,
           "show_ui" => true,
           "show_in_rest" => true,
           "rest_base" => "",
           "rest_controller_class" => "WP_REST_Posts_Controller",
           "has_archive" => true,
           "show_in_menu" => true,
           "show_in_nav_menus" => true,
           "delete_with_user" => false,
           "exclude_from_search" => false,
           "capability_type" => "post",
           "map_meta_cap" => true,
           "hierarchical" => false,
           'register_meta_box_cb' => array($dcApp,'add_metabox'),
           "rewrite" => [ "slug" => "appointments", "with_front" => false ],
           "query_var" => true,
           "supports" => [ "title","thumbnail", "custom-fields", "comments", 'post-formats',"revisions" ],
           "taxonomies" =>array( 
               "doctors", 
               "Type of Disease"
           ),
       ];
   
       register_post_type( "appointments", $args );
   }
   
}