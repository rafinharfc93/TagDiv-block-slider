<?php
/*
Plugin Name: Td Omnesweb Slider 1
Plugin URI: http://omnesweb.com.br
Description: tagDiv API plugin
Author: Rafael Fernandes - Omnesweb
Version: 1.0
Author URI: http://omnesweb.com.br
*/
class td_omnesweb_slider_1_plugin {
    var $plugin_url = '';
    var $plugin_path = '';

    function __construct() {
        $this->plugin_url = plugins_url('', __FILE__); // path used for elements like images, css, etc which are available on end user
        $this->plugin_path = dirname(__FILE__); // used for internal (server side) files

        add_action('td_global_after', array($this, 'hook_td_global_after')); // hook used to add or modify items via Api
        add_action('admin_enqueue_scripts', array('td_omnesweb_slider_1_plugin', 'td_plugin_wpadmin_css')); // hook used to add custom css for wp-admin area
        add_action('wp_enqueue_scripts', array('td_omnesweb_slider_1_plugin', 'td_plugin_frontend_css')); // hook used to add custom css used on frontend area
    }

    static function td_plugin_wpadmin_css() {
        wp_enqueue_style('td-plugin-framework', plugins_url('', __FILE__) . '/wp-admin/style.css'); // backend css (admin_enqueue_scripts)
    }

    static function td_plugin_frontend_css() {
        wp_enqueue_style('td-plugin-omnesweb-td-blocks-frontend', plugins_url('', __FILE__) . '/css/style.css', null, time());
        wp_enqueue_script('td-plugin-omnesweb-td-blocks-frontend', plugins_url('', __FILE__) . '/js/scripts.js', null, time());
    }

    function hook_td_global_after()    { //add the api code inside this function
        
        // Add a new module
        td_api_module::add('td_module_omnesweb_slider_1',
            array(
                'file' => $this->plugin_path . "/modules/td_module_omnesweb_slider_1.php",
                'text' => 'OmnesWeb Slider 1',
                'img' => $this->plugin_url . '/images/modules/td_module_omnesweb_slider_1.png',
                'used_on_blocks' => array('td_block_omnesweb_slider_1'),
                'excerpt_title' => 12,
                'excerpt_content' => 25,
                'enabled_on_more_articles_box' => true,
                'enabled_on_loops' => true,
                'uses_columns' => true, // if the module uses columns on the page template + loop
                'category_label' => true,
                'class' => 'td_module_wrap td-animation-stack',
            )
        );

        // Add a new block
        td_api_block::add('td_block_omnesweb_slider_1',
            array(
                'map_in_visual_composer' => true,
                'map_in_td_composer' => true,
                "name" => 'OmnesWeb Slider 1',
                "base" => 'td_block_omnesweb_slider_1',
                "class" => 'td_block_omnesweb_slider_1',
                "controls" => "full",
                "category" => 'Blocks',
                'tdc_category' => 'Blocks',
                'icon' => 'icon-pagebuilder-td_block_omnesweb_slider_1',
                'file' => $this->plugin_path . '/shortcodes/td_block_omnesweb_slider_1.php',
                "params" => array_merge(
                    // td_config::get_map_block_general_array(),
                    array(
                        array(
                            "param_name" => "item_height",
                            "type" => "textfield",
                            "value" => '800px',
                            "heading" => __('Altura do Slide', 'td_blocks_omnesweb'),
                            "description" => "",
                            "holder" => "div",
                            "class" => "tdc-textfield-small",
                            "placeholder" => '800',
                        ),
                    ),
                    array_merge(td_config::get_map_filter_array(), array(
                        array(
                            "param_name" => "exibir_homepage",
                            "type" => "dropdown",
                            "value" => array("Não" => "0", "Sim" => "1"),
                            "heading" => 'Itens marcados como Homepage:',
                            "description" => "Ao ativar este filtro, apenas itens marcados como homepage irão aparecer no bloco",
                            "holder" => "div",
                            "class" => "tdc-dropdown-big",
                            'group' => 'Filter'
                        ),
                    ))
                    // td_config::get_map_block_ajax_filter_array(),
                    // td_config::get_map_block_pagination_array()
                )
            )
        );
    }

}
new td_omnesweb_slider_1_plugin();