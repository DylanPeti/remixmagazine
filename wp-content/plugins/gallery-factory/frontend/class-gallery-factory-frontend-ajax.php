<?php
/**
 * @package   Gallery_Factory
 * @author    Vilyon Studio <vilyonstudio@gmail.com>
 * @link      http://galleryfactory.vilyon.net
 * @copyright 2015 Vilyon Studio
 *
 * Class contains frontend-related AJAX functionality.
 */

if (!class_exists("VLS_Gallery_Factory_Frontend_AJAX")) {
    /**
     * Class VLS_Gallery_Factory_Frontend_AJAX
     */
    class VLS_Gallery_Factory_Frontend_AJAX
    {

        private static $_instance = null;

        /**
         * Constructor of the class. Registering hooks here.
         */
        private function __construct()
        {
            // init hook
            add_action('init', array($this, 'init'));

        }

        /**
         * Cloning instances of this class is forbidden.
         */
        private function __clone()
        {
        }

        /**
         * Deserialisation of this class is forbidden.
         */
        private function __wakeup()
        {
        }

        /**
         * Static method for getting class instance
         * @return null|VLS_Gallery_Factory_Frontend
         */
        public static function instance()
        {
            if (self::$_instance == null) {
                self::$_instance = new self();
            }

            return self::$_instance;
        }

        public function init()
        {
            add_action('wp_ajax_vls_gf_get_album_page', array($this, 'get_album_page'));
            add_action('wp_ajax_nopriv_vls_gf_get_album_page', array($this, 'get_album_page'));
        }

        public function get_album_page()
        {

            $album_id = intval($_REQUEST['album_id']);
            $page_no = intval($_REQUEST['page_no']);

            $gf_front = VLS_Gallery_Factory_Frontend::instance();

            $html = $gf_front->get_page_html($album_id, $page_no, $page_no, false);

            echo $html;

            wp_die();

        }


    }
}

return VLS_Gallery_Factory_Frontend_AJAX::instance();
