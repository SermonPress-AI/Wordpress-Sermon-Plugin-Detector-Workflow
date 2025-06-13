<?php
/*
Plugin Name: Plugin List Plugin
Description: Allows you to retrieve a list of installed plugins via a REST API endpoint.
Version: 1.0
Author: Charlotte Wolfe
*/
add_action( 'rest_api_init', function () {
    register_rest_route( 'your-namespace/v1', '/plugins/', array(
    'methods'  => 'GET',
    'callback' => 'get_plugin_list',
    'permission_callback' => function () {
        return current_user_can( 'manage_options' );
    }
    ));

});

function get_plugin_list() {
    if ( ! function_exists( 'get_plugins' ) ) {
        require_once ABSPATH . 'wp-admin/includes/plugin.php';
    }

    $plugins = get_plugins();
    $plugin_list = array();

    foreach ( $plugins as $plugin_file => $plugin ) {
        $plugin_list[] = array(
            'name'        => $plugin['Name'],
            'description' => $plugin['Description'],
            'version'     => $plugin['Version'],
            'author'      => $plugin['Author'],
            'file'        => $plugin_file,
        );
    }

    return new WP_REST_Response( $plugin_list, 200 );
}

