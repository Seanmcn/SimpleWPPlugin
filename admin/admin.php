<?php
    require_once(ABSPATH . "wp-content/plugins/simple-wp-plugin/includes/config.php");

    /**
     * Class simpleWPPluginAdmin
     */
    class simpleWPPluginAdmin
    {

        /**
         * @var
         */
        private $version;

        /**
         * simpleWPPluginAdmin constructor.
         *
         * @param $version
         */
        public function __construct($version)
        {
            $this->version = $version;
        }

        /**
         * This runs when the plugin installs
         */
        public function installation()
        {
            global $wpdb;
            global $dbVersion;
            // Adding database tables or data would be done here.
            require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        }

        /**
         * Register and load stylesheets to be displayed on admin page
         */
        public function adminEnqueueStyles()
        {
            wp_register_style('simpleWPPluginCss', WP_PLUGIN_URL . '/simple-wp-plugin/admin/css/main.css');
            wp_enqueue_style('simpleWPPluginCss');
        }

        /**
         * Register and load javascript to be displayed on admin page
         */
        public function adminEnqueueScripts()
        {
            wp_enqueue_media();

            wp_register_script('simpleWPPluginAdminJS', WP_PLUGIN_URL . '/simple-wp-plugin/admin/js/main.js', array('jquery', 'bmabNoty'));
            wp_enqueue_script('simpleWPPluginAdminJS');
        }

        /**
         * Registers an item in the admin setting menu.
         */
        function adminMenu()
        {
            add_options_page('Simple WP Plugin Settings', 'simple-wp-plugin-settings', 'manage_options', 'wine_db', array(
                $this,
                'adminSettingsPage'
            ));
        }

        /**
         * Loads the admin settings page
         */
        function adminSettingsPage()
        {
            require_once plugin_dir_path(__FILE__) . 'partials/settingsManager.php';
        }
    }