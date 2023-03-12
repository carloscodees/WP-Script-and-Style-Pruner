<?php

/**
 * @package  snowPreloaderScript
 */

namespace Inc\Base;

use Inc\Api\Callbacks\AdminCallbacks;
use \Inc\Base\BaseController;

/**
 *
 */
class CustomMetaBoxController extends BaseController
{
     /**
     * @var AdminCallbacks
     */
    public $collbacks;

    public function register()
    {
        $this->collbacks    = new AdminCallbacks();
        add_action('add_meta_boxes', [$this, 'add_custom_meta_box']);
        add_action('save_post',      [$this, 'save_post_meta_data']);
    }

    /**
     * Added custom meta box
     * 
     * @return void
     */
    function add_custom_meta_box()
    {
        $screens = ['post', 'page'];
        foreach ($screens as $screen) {
            add_meta_box(
                'hide-page-title',           // Unique ID
                __('Preloader Scripts - Styles', 'aquila'),  // Box title
                [$this, 'meta_box_init_html'],  // Content callback, must be of type callable
                $screen,                   // Post type
                // 'side' // context
            );
        }
    }

    /**
     * Custom meta box HTML( for form )
     *
     * @param object $post Post.
     *
     * @return void
     */
    public function meta_box_init_html($post)
    {
        $data   = $this->get_script_and_style($post->ID);
        // $value  = get_post_meta($post->ID, '_hide_page_title', true);
        /**
         * Use nonce for verification.
         * This will create a hidden input field with id and name as
         * 'hide_title_meta_box_nonce_name' and unique nonce input value.
         */
        wp_nonce_field(plugin_basename(__FILE__), 'hide_title_meta_box_nonce_name');
        $this->collbacks->metaBox($data, $post);
    }
    /**
     *  Get Script and Style all
     * 
     *  @param any id of pages post
     */
    public function get_script_and_style($ID)
    {

        $result = [];
        $result['scripts'] = [];
        $result['styles'] = [];
        global $wp_scripts;
        foreach ($wp_scripts->queue as $script) :
            if(strpos($wp_scripts->registered[$script]->src, 'http') !== false) : 
            $value  = get_post_meta($ID,  $wp_scripts->registered[$script]->handle . '-handle-script', true);
            $result['scripts'][] =  [
                "handle"    => $wp_scripts->registered[$script]->handle,
                "src"       => $wp_scripts->registered[$script]->src,
                "active"    => $value == 'on' ? true : false
            ];
            endif;
        endforeach;
        global $wp_styles;
        foreach ($wp_styles->queue as $style) :
            if(strpos($wp_styles->registered[$style]->src, 'http') !== false) : 
            $value_style  = get_post_meta($ID,  $wp_styles->registered[$style]->handle . '-handle-style', true);
            $result['styles'][] =  [
                "handle" => $wp_styles->registered[$style]->handle,
                "src"    => $wp_styles->registered[$style]->src,
                "active" => $value_style == 'on' ? true : false
            ];
            endif;
        endforeach;

        return $result;
    }

    /**
	 * Save post meta into database
	 * when the post is saved.
	 *
	 * @param integer $post_id Post id.
	 *
	 * @return void
	 */
	public function save_post_meta_data( $post_id ) {

		/**
		 * When the post is saved or updated we get $_POST available
		 * Check if the current user is authorized
		 */
		if ( ! current_user_can( 'edit_post', $post_id ) ) {
			return;
		}

		/**
		 * Check if the nonce value we received is the same we created.
		 */
		if ( ! isset( $_POST['hide_title_meta_box_nonce_name'] ) ||
		     ! wp_verify_nonce( $_POST['hide_title_meta_box_nonce_name'], plugin_basename(__FILE__) )
		) {
			return;
		}
       
		if ( array_key_exists( 'ite', $_POST ) ) {
            foreach($_POST['ite'] as $key_scripts => $value) {
                $script_items[] = [$key_scripts =>  $value === 'on' ? 'on' : 'off'];
            }        
                update_post_meta(
                    $post_id,
                   'preloader-handle-script',
                    $script_items
                );
            }
            if ( array_key_exists( 'ite_2', $_POST ) ) {
                foreach($_POST['ite_2'] as $key_scripts => $value) {
                    $style_items[] = [$key_scripts =>  $value === 'on' ? 'on' : 'off'];
                   
                }
                 update_post_meta(
                        $post_id,
                        'preloader-handle-style',
                        $style_items 
                    );
            }			
	}
}
