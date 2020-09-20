<?php

Class Metabox{
    
    public function __construct(){
        
    }

    public function is_secured($nonce_field,$action,$post_id){
       
        $nonce=isset($_POST[$nonce_field])? $_POST[$nonce_field]: '';

        if ($nonce=='') {
            return false;
        }

        if(! wp_verify_nonce( $nonce,$action )){
            return false;
        }

        if(!current_user_can('edit_post',$post_id)){
            return false;
        }

        if (wp_is_post_autosave( $post_id )){
            return false;
        }
        if (wp_is_post_revision( $post_id )) {
            return false ;
        }
return true ;
    }
 function dca_save_metabox($post_id){

    if(! $this->is_secured('pt_info_field','pt_info',$post_id)){
        return $post_id;
    }
    $pt_email=isset($_POST['pt_email']) ? $_POST['pt_email'] : '';
    $pt_phone=isset($_POST['pt_phone']) ? $_POST['pt_phone'] : '';
    $pt_address=isset($_POST['pt_address']) ? $_POST['pt_address'] : '';
    $pt_date=isset($_POST['pt_date']) ? $_POST['pt_date'] : '';

   $pt_email=sanitize_email($pt_email);
   $pt_phone=sanitize_text_field( $pt_phone );
   $pt_address=sanitize_text_field( $pt_address );
   $pt_date=sanitize_text_field( $pt_date );

    update_post_meta($post_id, 'pt_email',$pt_email);
    update_post_meta($post_id, 'pt_phone',$pt_phone);
    update_post_meta($post_id, 'pt_date',$pt_date);
    update_post_meta($post_id, 'pt_address',$pt_address);
}


    public function dca_add_metabox (){
        add_meta_box('patient_details', __('Patient Informations','app_booking'), array($this,'dca_display_metabox'));
    }


    function dca_display_metabox ($post){
        $email  = get_post_meta( $post->ID, 'pt_email', true );
        $phone  = get_post_meta( $post->ID, 'pt_phone', true );
        $date  = get_post_meta( $post->ID, 'pt_date', true );
        $address  = get_post_meta( $post->ID, 'pt_address', true );
        $pLabel=__('Phone number','app_booking');
        $eLabel=__('Email','app_booking');
        $aLabel=__('Address','app_booking');
        $dLabel=__('Date','app_booking');
        wp_nonce_field( 'pt_info', 'pt_info_field' );
        
        $metabox_html =<<<EOD
        <label for="pt_phone">$pLabel </label><br />
<input type="number" name="pt_phone" value="{$phone}" id="pt_phone" />
<br/>
<label for="pt_email">$eLabel</label><br />
<input type="email" name="pt_email" id="pt_email" value="{$email} " />
<br />
<label for="pt_adress" >$aLabel</label><br />
<textarea  rows="4" cols="50"  name="pt_address" id="pt_address">$address</textarea>
<br/>
<label for="pt_date">$dLabel </label><br />
<input type="text" name="pt_date"value="{$date} " id="pt_date"  value=""/>
EOD;
        echo $metabox_html;
    }

}