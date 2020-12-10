<?php
/*
Plugin Name: Rizoa Hook
*/
// require_once(__FILE__) . '/adminpage.php';

add_action("wp_footer", "mfp_Add_text");
// Define 'mfp_Add_Text'
function mfp_Add_text()
{
  echo "After the footer is loaded, my text is added";
}


// init
add_action( 'init', 'wporg_callback' );
function wporg_callback() {
    // do something
    echo 'nginit';
}


// filter
add_filter("get_the_excerpt", "mfp_Add_Text_To_Excerpt");
function mfp_Add_Text_To_Excerpt($old_Excerpt)
{
  $new_Excerpt = "<b>Excerpt: </b>" . $old_Excerpt;
  return $new_Excerpt;
}
function wporg_filter_title( $title ) {
    return 'The ' . $title . ' was filtered';
}
add_filter( 'the_title', 'wporg_filter_title' );




function wpdocs_register_my_custom_menu_page() {
    add_menu_page(
        __( 'Custom Menu Title', 'textdomain' ),
        'custom menu',
        'manage_options',
        'rizoa/adminpage.php',
        '',
        '',
        1
    );
}
add_action( 'admin_menu', 'wpdocs_register_my_custom_menu_page' );




function wporg_settings_init() {
    // register a new setting for "reading" page
    register_setting('general', 'wporg_setting_name');
 
    // register a new section in the "reading" page
    add_settings_section(
        'wporg_settings_section',
        'WPOrg Settings Section', 'wporg_settings_section_callback',
        'general'
    );
 
    // register a new field in the "wporg_settings_section" section, inside the "reading" page
    add_settings_field(
        'wporg_settings_field',
        'WPOrg Setting', 'wporg_settings_field_callback',
        'general',
        'wporg_settings_section'
    );
}
 
/**
 * register wporg_settings_init to the admin_init action hook
 */
add_action('admin_init', 'wporg_settings_init');
 
/**
 * callback functions
 */
 
// section content cb
function wporg_settings_section_callback() {
    echo '<p>WPOrg Section Introduction.</p>';
}
 
// field content cb
function wporg_settings_field_callback() {
    // get the value of the setting we've registered with register_setting()
    $setting = get_option('wporg_setting_name');
    // output the field
    ?>
    <input type="text" name="wporg_setting_name" value="<?php echo isset( $setting ) ? esc_attr( $setting ) : ''; ?>">
    <?php
}