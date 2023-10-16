<?php

/**
 * Plugin Name: Lock Multisite User Account
 * Plugin URI: https://github.com/amydinsyahira/lock-multisite-user-account
 * Description: Lock multisite user accounts with REST API
 * Version: 1.0.0
 * Author: Amydin
 * Author URI: https://www.upwork.com/freelancers/~01717d44e6a048ffe0
 * Text Domain: centris
 *
 * @package LockMultisiteUserAccount
 * @author Amydin
 * @version 1.0.0
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

class Lock_Multisite_User_Account
{
    public function __construct()
    {
        // Add filter to check user's account lock status
        add_filter('wp_authenticate_user', array($this, 'check_lock'));
    }

    /**
     * Applying user lock filter on user's authentication
     * 
     * @param object $user          WP_User object
     * @return \WP_Error || $user   If account is locked then return WP_Error object, else return WP_User object
     */
    public function check_lock($user)
    {
        if (is_wp_error($user)) return $user;
        if (is_multisite() && is_object($user) && isset($user->ID) && 'yes' === get_user_meta((int)$user->ID, sanitize_key('centris_user_locked'), true)) {
            $error_message = get_option('centris_locked_message'); // TODO: custom message
            return new WP_Error('locked', ($error_message) ? $error_message : __('Your account is locked! Please call your Administrator.', 'centris'));
        }
        return $user;
    }
}

new Lock_Multisite_User_Account();

//  Load user meta class in admin panel
if (is_admin()) {
    //  Load user meta file
    require_once plugin_dir_path(__FILE__) . 'includes/class-user-meta.php';
}
//  Load REST API class
require_once plugin_dir_path(__FILE__) . 'includes/class-rest-api.php';
