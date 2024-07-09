<?php
class Jsun_Wp_Public {

    private $plugin_name;
    private $version;

    public function __construct($plugin_name, $version) {
        $this->plugin_name = $plugin_name;
        $this->version = $version;
    }

    private $routes = array(
        array(
            'path' => '/app-login',
            'methods' => 'POST',
            'callback' => 'app_login', 
        )
    );

    public function enqueue_styles() {
        wp_enqueue_style($this->plugin_name, plugin_dir_url(__FILE__) . 'css/jsun-wp-public.css', array(), $this->version, 'all');
    }

    public function enqueue_scripts() {
        wp_enqueue_script($this->plugin_name, plugin_dir_url(__FILE__) . 'js/jsun-wp-public.js', array('jquery'), $this->version, false);
    }

    public function register_rest_routes() {        
        foreach ($this->routes as $route) {
            $r = register_rest_route($this->plugin_name.'/v1', $route['path'], array(
                'methods' => $route['methods'],
                'callback' => array($this, $route['callback']),
            ));
        }        
        update_option('jsun_wp_plugin_routes', $this->routes);      
    }    

    public function app_login(WP_REST_Request $request) {
        $parameters = $request->get_params();

        $username = $request->get_param('username');
        $password = $request->get_param('password');
        $user = wp_authenticate($username, $password);
        if (is_wp_error($user)) {
            return new WP_Error('authentication_failed', __('Invalid username or password'), array('status' => 401));
        } else {
            return array(
                'status' => 'success',
                'user' => $user->data
            );
        }
    }

}
