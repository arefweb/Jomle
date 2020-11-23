<?php
/*
 * Plugin Name:       Jomle
 * Plugin URI:        https://arefweb.ir
 * Description:       A text field to show on your site with short-code
 * Version:           1.0.0
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            Aref Movahedzadeh
 * Author URI:        https://arefweb.ir
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       jomle
 */


if (! defined('ABSPATH')){
  die();
}


class Jomle{

  function register(){
    add_action("admin_enqueue_scripts", array($this, 'enqueue'));
    add_action( 'admin_menu', array($this, 'add_admin_pages') );
    add_filter( 'plugin_action_links_' . plugin_basename( __FILE__ ), array($this, 'settings_link') );
    $this->j_install();
    add_shortcode('jomle', array($this, 'jomle_shortcode'));
  }

  function add_admin_pages(){
    add_menu_page('Jomle','Jomle','manage_options', 'jomle_plugin', array($this, 'admin_page'),'dashicons-welcome-write-blog', 50 );
  }

  function admin_page(){
    require __DIR__.'/template/admin.php';
  }

  function settings_link( $actions){
    /* WordPress Plugin links are inside an array. So we declare settings link
       as an array to append it to the other links in the array. */
    $actions[] = '<a href="' . admin_url( 'admin.php?page=jomle_plugin' ) . '">Settings</a>';
    return $actions;
  }

  function activate(){
    flush_rewrite_rules();
  }

  function deactivate(){
    flush_rewrite_rules();
  }


  function enqueue(){
    wp_enqueue_style("jomle-main-style", plugins_url( 'assets/jomle-style.css', __FILE__ ) );
    wp_enqueue_script("jomle-main-script", plugins_url( 'assets/jomle-scripts.js', __FILE__ ),  array(), false, true);
  }

  // Create table
  function j_install(){
    // this is the WordPress database access object
    global $wpdb;
    // Database Table Prefix
    $table_name = $wpdb->prefix . "jomle";

    $charset_collate = $wpdb->get_charset_collate();

    $sql = "CREATE TABLE $table_name (
      id mediumint(6) unsigned NOT NULL auto_increment,
      title text NOT NULL,
      text text NOT NULL,
      shortcode text,
      PRIMARY KEY  (id)
     ) $charset_collate;";

    // We need to load following file in order to use dbDelta()
    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    dbDelta( $sql );
  }

  function jomle_shortcode( $atts = [], $content = null) {
    global $wpdb;
    $table_name = $wpdb->prefix . 'jomle';

    $last_rows = $wpdb->get_results( "SELECT * FROM $table_name ORDER BY id DESC LIMIT 1" );
    $row_id = $last_rows[0]->id;

    $atts = shortcode_atts( array(
      'id' => $row_id
    ), $atts, 'jomle' );
    $id = $atts['id'];
    $results = $wpdb->get_results( "SELECT * FROM $table_name WHERE id=$id");

    foreach ( $results  as $result ) {
      return "<span id='jomle-tx-". $id ."'>". $result->text ."</span>" ;
    }
  }

}

if (class_exists('Jomle')){
  $jomle = new Jomle();
  $jomle->register();
}

register_activation_hook( __FILE__, array($jomle, 'activate'));

register_deactivation_hook( __FILE__, array($jomle, 'deactivate') );




