<?php

    /**
     * Manages loading dependencies and defining admin and public hooks.
     * Class simpleWPPlugin
     */
    class simpleWPPlugin
    {
        /**
         * @var
         */
        protected $loader;
        /**
         * @var string
         */
        protected $plugin_slug;
        /**
         * @var string
         */
        protected $version;

        /**
         * simpleWPPlugin constructor.
         */
        public function __construct()
        {
            $this->plugin_slug = 'simpleWPPlugin';
            $this->version = '1.0';

            $this->loadDependencies();
            $this->defineAdminHooks();
            $this->definePublicHooks();
        }

        /**
         * Loads public and admin dependencies
         */
        private function loadDependencies()
        {
            require_once plugin_dir_path(dirname(__FILE__)) . 'admin/admin.php';
            require_once plugin_dir_path(dirname(__FILE__)) . 'public/public.php';
            require_once plugin_dir_path(__FILE__) . 'loader.php';
            $this->loader = new simpleWPPluginLoader();
        }

        /**
         * Defines what functions from simpleWPPluginAdmin() should be in WP terms (actions, shortcodes, filters)
         */
        private function defineAdminHooks()
        {
            $admin = new simpleWPPluginAdmin($this->getVersion());
            $this->loader->addAction('admin_menu', $admin, 'adminMenu');
            $this->loader->addAction('admin_enqueue_styles', $admin, 'adminEnqueueStyles');
            $this->loader->addAction('admin_enqueue_scripts', $admin, 'adminEnqueueScripts');
        }

        /**
         * Defines what functions from simpleWPPluginPublic() should be in WP terms (actions, shortcodes, filters)
         */
        private function definePublicHooks()
        {
            $public = new simpleWPPluginPublic($this->getVersion());
            $this->loader->addShortCode('simple-wp-plugin-shortcode', $public, 'displayShortCodePage');
        }

        /**
         * Runs when the plugin activates in wp-admin panel
         */
        public function activatePlugin()
        {
            // check user can activate plugin
            if (!current_user_can('activate_plugins')) {
                return;
            }
            $plugin = isset($_REQUEST['plugin']) ? $_REQUEST['plugin'] : '';
            check_admin_referer("activate-plugin_{$plugin}");

            $admin = new simpleWPPluginAdmin($this->getVersion());
            $admin->installation();
        }

        /**
         * Run's the loader
         */
        public function run()
        {
            $this->loader->run();
        }

        /**
         * Returns the plugin version
         * @return string
         */
        public function getVersion()
        {
            return $this->version;
        }

    }