<?php

/* 
 * Contains functions and definations for REST API
 * 
 * @package LockMultisiteUserAccount
 * @author Amydin
 * @version 1.0.0
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

class Lock_Multisite_User_Account_REST_API
{
    public function __construct()
    {
        //  Add action to register the rest api
        add_action('rest_api_init', function () {
            register_rest_route('wp/v2', '/users/lock', [
                'methods'  => 'POST',
                'callback' => array($this, 'wp_users_lock_callback'),
                'args' => [
                    'user_id'
                ],
            ]);
        });
        add_action('rest_api_init', function () {
            register_rest_route('wp/v2', '/users/lock', [
                'methods'  => 'DELETE',
                'callback' => array($this, 'wp_users_lock_callback'),
                'args' => [
                    'user_id'
                ],
            ]);
        });
    }

    public function wp_users_lock_callback($request)
    {
        if (!is_multisite()) {
            return new WP_REST_Response(
                array(
                    'status' => 403,
                    'response' => 'Please enable Multisite to make use of this endpoint.',
                ),
                403
            );
            die();
        }
        $current_user_id = get_current_user_id();
        $route = $request->get_route();
        $json = $request->get_json_params();
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && preg_match("/users\/lock/", $route)) {
            if (!isset($json) || !isset($json['user_id']) || !is_array($json['user_id']) || empty($json['user_id'])) {
                return new WP_REST_Response(
                    array(
                        'status' => 400,
                        'response' => 'The user_id on the request body is required.',
                    ),
                    400
                );
                die();
            }
            foreach ($json['user_id'] as $user_id) {
                if ($user_id === $current_user_id) continue;
                $this->lock_user($user_id);
            }
            return new WP_REST_Response(
                array(
                    'status' => 201,
                    'response' => 'The users has been locked.',
                    'body_response' => $json
                ),
                201
            );
        } elseif ($_SERVER['REQUEST_METHOD'] === 'DELETE' && preg_match("/users\/lock/", $route)) {
            if (!isset($json) || !isset($json['user_id']) || !is_array($json['user_id']) || empty($json['user_id'])) {
                return new WP_REST_Response(
                    array(
                        'status' => 400,
                        'response' => 'The user_id on the request body is required.',
                    ),
                    400
                );
                die();
            }
            foreach ($json['user_id'] as $user_id) {
                $this->unlock_user($user_id);
            }
            return new WP_REST_Response(
                array(
                    'status' => 200,
                    'response' => 'The users has been unlocked.',
                    'body_response' => $json
                ),
                200
            );
        }
        return new WP_REST_Response(
            array(
                'status' => 400,
                'response' => 'Invalid route of API.',
            ),
            400
        );
        die();
    }

    public function lock_user($user_id)
    {
        update_user_meta((int)$user_id, sanitize_key('centris_user_locked'), 'yes');
        $sessions = WP_Session_Tokens::get_instance($user_id);
        $sessions->destroy_all();
    }

    public function unlock_user($user_id)
    {
        delete_user_meta((int)$user_id, sanitize_key('centris_user_locked'));
    }
}

new Lock_Multisite_User_Account_REST_API();
