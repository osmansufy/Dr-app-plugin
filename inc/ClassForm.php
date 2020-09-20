<?php

class FormPost{

   public function _construct(){

 
    $this->post_submit();

    }
    

 public function post_submit(){
    if( 'POST' == $_SERVER['REQUEST_METHOD'] && !empty( $_POST['action'] ) &&  $_POST['action'] == "new_post") {

        // Do some minor form validation 
        if (isset ($_POST['title'])) {
            $title =  $_POST['title'];
        } else {
            echo 'Please enter the Patient name';
        }
        
    
        // ADD THE FORM INPUT TO $new_post ARRAY
        $new_post = array(
        'post_title'	=>	$title,
     
        'post_status'	=>	'publish',           // Choose: publish, preview, future, draft, etc.
        'post_type'	=>	'appointments'  //'post',page' or use a custom post type if you want to
        );
    
        //SAVE THE POST
        $pid = wp_insert_post($new_post);
        // Save Doctors name 
        $doctor_name=sanitize_text_field($_POST['cat'] );
        wp_set_post_terms( $pid,$doctor_name, 'doctors' );
    
        //SET Patinent's Diseases   PROPERLY
        
        $diseases=sanitize_text_field($_POST['pt_disease'] );
        wp_set_post_terms( $pid,$diseases, 'diseases');
    
        // update meta value of CPT
       $email=sanitize_text_field($_POST['f_email']);
       $phone= sanitize_text_field($_POST['f_phone']);
       $date=sanitize_text_field($_POST['f_date']);
       $address= sanitize_text_field($_POST['f_address']);
    
        update_post_meta($pid, 'pt_email',$email);
        update_post_meta($pid, 'pt_phone',$phone);
        update_post_meta($pid, 'pt_date',$date);
        update_post_meta($pid, 'pt_address',$address);


        echo "Booking is completed";
    
    
    } // END THE IF STATEMENT THAT STARTED THE WHOLE FORM
    
    //POST THE POST YO
    do_action('wp_insert_post', 'wp_insert_post');
 }

}