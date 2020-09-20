<?php
/*
Plugin Name: Appointment Booking
Plugin URI:
Description:  Dr. Appointment Booking
Version: 1.0
Author: osmansufy
Author URI:
License: GPLv2 or later
Text Domain: app_booking
Domain Path: /languages/
*/

// Metabox class include  
require_once('inc/ClassMetabox.php');
// CPT class include
require_once('inc/ClassCPT.php');
/**Custom taxonomy class include */
require_once('inc/ClassTaxonomy.php');


class Doctors{
    public function __construct(){

       
        add_action('init',array($this,'create_app_post'));
        register_activation_hook(__FILE__,array($this,'doctor_plugin_activation'));
        add_filter( 'page_template', array($this,'wpa3396_page_template' ));
        add_action( 'plugins_loaded', array( $this, 'boking_load_textdomain' ) );
        add_action( 'init', array($this,'custom_taxonomy'));
        add_action('add_meta_boxes_appointments',array($this,'add_metabox'));
        add_action('save_post',array($this,'pt_save_metabox'));
       

        
    }

    public function boking_load_textdomain (){
        load_plugin_textdomain('app_booking', false, dirname( __FILE__ ) . "/languages");
    }
  

/**
 * create custom taxonomy for custom Post
 */

    public function custom_taxonomy(){

    $tax= new Taxonomy();
    $tax->custom_taxonomy_dr();

  }
// Add metabox in CPT
    public function add_metabox(){

        $meta=new Metabox();

    $meta->dca_add_metabox();

    }
// Save Metabox data
     
    public function pt_save_metabox($post_id){
        $saveMeta=new Metabox();

        $saveMeta->dca_save_metabox($post_id);

    }
// Create CPT
    public function create_app_post(){
       
        $appPost= new DrCPT();

        $appPost->dr_app_post();
          
        }

// Add page template in plugin 
    function wpa3396_page_template( $page_template )
{
    if ( is_page( 'booking-form' ) ) {
        $page_template = dirname( __FILE__ ) . '/templates/form_page.php';
    }
    return $page_template;
}

// create page with plugin activation for booking form
    public function doctor_plugin_activation (){
    if ( ! current_user_can( 'activate_plugins' ) ) return;

  

    global $wpdb;
  
    
  
    if ( null === $wpdb->get_row( "SELECT post_name FROM {$wpdb->prefix}posts WHERE post_name = 'booking-form'", 'ARRAY_A' ) ) {
  
       
  
      $current_user = wp_get_current_user();
  
      
  
      // create post object
  
      $page = array(
  
        'post_title'  => __( 'Booking Form' ),
  
        'post_status' => 'publish',
  
        'post_author' => $current_user->ID,
  
        'post_type'   => 'page',
         
      );
  
      
  
      // insert the post into the database
  
      wp_insert_post( $page,true );
  
    }
  }
        
    
}

new Doctors ();