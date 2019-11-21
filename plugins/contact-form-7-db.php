<?php
/*
Plugin Name: Contact Form 7 DB
Plugin URI: https://evanjuge.fr
Description: Just to save in database the contact form.
Author: Evan JUGE
Version: 1.0
Author URI: http://evanjuge.fr
*/
function contactform7_before_send_mail( $form ) {
    global $wpdb;
    $form = WPCF7_Submission::get_instance();
    if ($form) 
        $formData = $form->get_posted_data();
    $title = $formData['your-name'];
    $email  = $formData['your-email'];
    $subject = $formData['your-subject'];
    $message = $formData['your-message'];

    $wpdb->insert( 'wp_mails', array( 'mail_name' =>$title, 'mail_email' => $email, 'mail_subject' => $subject, 'mail_message' =>$message ), array( '%s','%s','%s','%s' ) );
}
remove_all_filters ('wpcf7_before_send_mail');
add_action( 'wpcf7_before_send_mail', 'contactform7_before_send_mail' );

function pluginprefix_deactivation() {
    global $wpdb;
    $wpdb->query('DROP TABLE `wp_mails`');
}
register_deactivation_hook( __FILE__, 'pluginprefix_deactivation' );

global $wpdb;
$charset_collate = $wpdb->get_charset_collate();
$commissions_table_name = $wpdb->prefix . 'mails';
$commissions_sql = "CREATE TABLE IF NOT EXISTS $commissions_table_name (
	mail_id mediumint(9) NOT NULL AUTO_INCREMENT,
	mail_name tinytext DEFAULT NULL,
	mail_email tinytext DEFAULT NULL,
	mail_subject tinytext DEFAULT NULL,
	mail_message longtext DEFAULT NULL,
	time datetime DEFAULT CURRENT_TIMESTAMP NOT NULL,
	PRIMARY KEY  (mail_id)
) $charset_collate;";
require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
dbDelta($commissions_sql);