<?php

class Jsun_Wp_Public {

    private $plugin_name;
    private $version;
    private $routes;

    public function __construct($plugin_name, $version) {
        $this->plugin_name = $plugin_name;
        $this->version = $version;

        $this->routes = array(
            'app-login' => array(
                'path' => '/app-login',
                'methods' => 'POST',
                'callback' => 'app_login', 
            ),
            'app-register' => array(
                'path' => '/app-register',
                'methods' => 'POST',
                'callback' => 'app_register', 
            ),
        );
        update_option('jsun_wp_plugin_routes', $this->routes);  
    }

    public function enqueue_styles() {
        wp_enqueue_style($this->plugin_name, plugin_dir_url(__FILE__) . 'css/jsun-wp-public.css', array(), $this->version, 'all');
    }

    public function enqueue_scripts() {
        wp_enqueue_script($this->plugin_name, plugin_dir_url(__FILE__) . 'js/jsun-wp-public.js', array('jquery'), $this->version, false);
    }

    public function register_rest_routes() {        
        foreach ($this->routes as $route_key => $route) {
            register_rest_route($this->plugin_name.'/v1', $route['path'], array(
                'methods' => $route['methods'],
                'callback' => array($this, $route['callback']),
            ));
        }        
            
    }    

    public function app_login(WP_REST_Request $request) {

        $user = wp_authenticate($request->get_param('username'), $request->get_param('password'));

        if (is_wp_error($user)) {
            return new WP_Error('authentication_failed', __('Invalid username or password'), array('status' => 401));
        } else {
            return array(
                'status' => 'success',
                'user' => $user->data
            );
        }
    }

    public function app_register(WP_REST_Request $request) {

        $user_login = wp_slash( $request->get_param('first_name'));
        $user_email = wp_slash( $request->get_param('email') );
        $user_pass  = $request->get_param('password');
        $userdata = compact( 'user_login', 'user_email', 'user_pass' );
        $user = wp_insert_user( $userdata );

        if (is_wp_error($user)) {
            return $user;
        }

        $user_meta = array(
            'first_name' => $request->get_param('first_name'), 
            'last_name' => $request->get_param('last_name'), 
        );

        foreach ($user_meta as $key => $value) {
            update_user_meta($user, $key, $value);
        }

        return $user;        
    }

}


