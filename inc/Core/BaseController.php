<?php 
/**
 * @package ginkgos
 * @since 0.0.1
 */
namespace GINKGOS\Core;

class BaseController
{
	public $theme_path;

	public $theme_url;

	public $theme;

	public $managers = array();

	private static $db_options;

	public function __construct() {
		$this->theme_path = GINKGOS_PATH;
		$this->theme_url = GINKGOS_URL;
		$this->theme = GINKGOS_NAME;

		$this->managers = array_merge(array(), self::get_options());
	}

	/**
     * Get options from static array()
     *
     * @since 0.0.1
     * @return array    Return array of options.
     */
    public static function get_options() {
        if (empty(self::$db_options)) { self::refresh(); }
        return self::$db_options;
    }

	/**
     * Update  static option array.
     * 
     * @since 0.0.1
     */
    public static function refresh() {
        self::$db_options = wp_parse_args(
            self::get_db_options(),
            self::defaults()
        );
    }

	/**
     * Get options from static array() from database
     *
     * @since 0.0.1
     * @return array    Return array of options from database.
     */
    public static function get_db_options() {
        return get_theme_mods();
    }

	/**
     * Get specific option
     *
     * @since 0.0.1
     * @return array    Return array of options.
     */
    public static function get_option($opt) {
        if (empty(self::$db_options)) { self::refresh(); }
        return self::$db_options[$opt];
    }

	/**
     * Set default option values
     *
     * @since 0.0.1
     * @return default values of the .
     */
    public static function defaults() {
        $defaults_app = self::loadPHPConfig(GINKGOS_PATH . 'core/options.php');
        return array_merge(array(), $defaults_app);
    }

	/**
     * LoadPHPConfig - load default config for plugin
     * 
     * @since 0.0.1
     * @return array()
     */
    public static function loadPHPConfig($path)
    {
        
        if ( ! file_exists($path)) {
            return array();
        }
        
        $content = require $path;
        
        return $content;
    }
}