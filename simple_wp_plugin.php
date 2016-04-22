<?php
    /**
     * Simple plugin framework for Wordpress to build on.
     *
     * @package simple-wp-plugin
     * @wordpress-plugin
     * Plugin Name:       Simple WP Plugin Framework
     * Plugin URI:        https://github.com/Seanmcn/SimpleWPPlugin
     * Version:           1.0.0
     * Author:            Sean McNamara
     * Author URI:        http://seanmcn.com
     * Text Domain:       SimpleWPPlugin
     * License:           GPL-2.0+
     * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
     * Domain Path:       /languages
     */

    // If this file is called directly, then abort execution.
    if (!defined('WPINC')) {
        die;
    }

    require_once plugin_dir_path(__FILE__) . 'includes/manager.php';


    function runSimplePlugin()
    {

        $simplePlugin = new simpleWPPlugin();
        register_activation_hook(__FILE__, array($simplePlugin, 'activatePlugin'));
        $simplePlugin->run();


    }

    runSimplePlugin();