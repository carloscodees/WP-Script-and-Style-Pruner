<?php
/**
 * @package  MyPackages
 */
namespace Inc\Pages;



use \Inc\Api\SettingsApi;
use \Inc\Base\BaseController;
use \Inc\Api\Callbacks\AdminCallbacks;


class Admin extends BaseController
{
    /**
     * @var SettingsApi
     */
    public $setting;

    /**
     * @var AdminCallbacks
     */
    public $collbacks;
    /**
     * @var array
     */
    public $pages = [];
    public $subpages = [];

    public function register()
    {
        $this->setting      = new SettingsApi();
        $this->collbacks    = new AdminCallbacks();
        $this->setPages();
        $this->setSubPages();
        $this->setting->addPages( $this->pages )->withSubPage('Dasboard')->addSubPages($this->subpages)->register();
    }

    public function setPages()
    {
        $this->pages =  [
            [
                'page_title' => 'Template Plugin',
                'menu_title' => 'template',
                'capability' => 'manage_options',
                'menu_slug' => 'template_plugin',
                'callback' => [$this->collbacks, 'adminDashboard'],
                'icon_url' => 'dashicons-store',
                'position' => 110
            ]
        ];
    }

    public function setSubPages()
    {

        $this->subpages =  [
            [
                'parent_slug' => 'template_plugin',
                'menu_title' => 'templete sub menu',
                'capability' => 'manage_options',
                'menu_slug' => 'template_plugin_submenu',
                'callback' => function(){echo "<h1>I am Sub menu</h1>";}
            ],
            [
                'parent_slug' => 'template_plugin',
                'menu_title' => 'templete sub menu 2',
                'capability' => 'manage_options',
                'menu_slug' => 'template_plugin_submenu_two',
                'callback' => function(){echo "<h1>I am Sub menu</h1>";}
            ]
        ];
    }

}