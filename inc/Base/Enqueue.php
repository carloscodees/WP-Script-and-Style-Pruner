<?php
/**
 * @package  AlecadddPlugin
 */
namespace Inc\Base;

use \Inc\Base\BaseController;
/**
 *
 */
class Enqueue extends BaseController
{
    public function register() {
        add_action( 'admin_enqueue_scripts', array( $this, 'enqueue' ) );
        add_action( 'wp_enqueue_scripts'   , array( $this, 'enqueue' ) );
        add_action( 'wp_print_scripts'     , [$this, 'de_enqueue']);
        add_action( 'wp_print_styles'      , [$this, 'de_style_enqueue']);
    }

    function enqueue() {
        // enqueue all our scripts
        wp_enqueue_style(   'mypluginstyle' , $this->plugin_url . 'assets/mystyle.css' );
        wp_enqueue_script(  'mypluginscript', $this->plugin_url . 'assets/metaboxStore.js' );
        wp_enqueue_style(  'semantic-iu-style', $this->plugin_url    . 'assets/lib/semantic/semantic.min.css'  );
        wp_enqueue_script(  'semantic-iu-script', $this->plugin_url    . 'assets/lib/semantic/semantic.min.js'  );
    }
    function de_enqueue() {
        if (get_post_type() === 'post' || get_post_type() === 'page') {
            $id     = get_the_ID();
            $array  = unserialize(get_post_meta($id)['preloader-handle-script'][0]);
            if(!$array) return;
            foreach($array as $key => $items){
                foreach($items as $handle => $items_handler){
                    if($items_handler == 'on'){
                        wp_deregister_script( $handle );
                    }
                }
            }
        } 
    }
    function de_style_enqueue() {
        if (get_post_type() === 'post' || get_post_type() === 'page') {
            $id     = get_the_ID();
            $array  = unserialize(get_post_meta($id)['preloader-handle-style'][0]);   
            if(!$array) return;
            foreach($array as $key => $items){
                foreach($items as $handle => $items_handler){
                    if($items_handler == 'on'){
                        wp_deregister_style( $handle );
                    }
                }
            }
        }
    }
}