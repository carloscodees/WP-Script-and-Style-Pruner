<?php
/**
 * @package  MyPackages
 */
namespace Inc\Api\Callbacks;

use \Inc\Base\BaseController;

class AdminCallbacks extends BaseController
{
    public  function generateMenu(){
        return [
             [
                 'name'      => 'General',
                 'tab'       => '',
                 'function'  => [$this, 'general']
             ],
             [
                 'name' => 'Global Scripts',
                 'tab'  => 'global_scripts',
                 'function'  => [$this, 'testing']
             ], 
             [
                 'name' => 'Global Styles',
                 'tab'  => 'global_styles',
                 'function'  => 'global style'
             ]
         ];
     
     }
    /**
     *  Views Dashboard Items
     */
    public function adminDashboard()
    {      
        return require_once( "$this->plugin_path/templates/admin/DashboardView.php" );
    }
    /**
     *  Views metaBox
     * 
     *  @param data all scritps and style
     *  @param post post data
     */
    public function metaBox($data, $post)
    {
        return require_once("$this->plugin_path/templates/admin/MetaBoxView.php");
    }
    public function testing() {
         return require_once("$this->plugin_path/templates/general.php");
    }
    public function general() {
        return require_once("$this->plugin_path/templates/admin.php");
   }
}