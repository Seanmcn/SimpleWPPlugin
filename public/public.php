<?php
    require_once(ABSPATH . "wp-content/plugins/simple-wp-plugin/includes/config.php");

    /**
     * Class simpleWPPluginPublic
     */
    class simpleWPPluginPublic
    {
        /**
         * @var
         */
        private $version;

        /**
         * simpleWPPluginPublic constructor.
         *
         * @param $version
         */
        public function __construct($version)
        {
            $this->version = $version;
        }

        /**
         * Requires a file to be displayed on the shortcode [simple-wp-plugin-shortcode] which is defined in includes/manager.php
         * @param $content
         * @return string
         */
        public function displayShortCodePage($content)
        {
            ob_start();
            require_once plugin_dir_path(dirname(__FILE__)) . 'public/partials/display.php';
            $template = ob_get_contents();
            $content .= $template;
            ob_end_clean();

            return $content;
        }
    }