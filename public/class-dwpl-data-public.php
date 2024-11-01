<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    Dwpl_Data
 * @subpackage Dwpl_Data/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Dwpl_Data
 * @subpackage Dwpl_Data/public
 * @author     Your Name <email@example.com>
 */
class Dwpl_Data_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $dwpl_data    The ID of this plugin.
	 */
	private $dwpl_data;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $dwpl_data       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $dwpl_data, $version ) {

		$this->dwpl_data = $dwpl_data;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Dwpl_Data_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Dwpl_Data_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->dwpl_data, plugin_dir_url( __FILE__ ) . 'css/dwpl-data-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Dwpl_Data_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Dwpl_Data_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->dwpl_data, plugin_dir_url( __FILE__ ) . 'js/dwpl-data-public.js', array( 'jquery' ), $this->version, false );

	}

}