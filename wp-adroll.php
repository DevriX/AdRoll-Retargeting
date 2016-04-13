<?php
/*
* Plugin Name:         AdRoll Retargeting
* Plugin URI:          https://www.adroll.com/product/web-retargeting
* Description:         AdRoll is the most effective retargeting platform in the world. This plugin easily integrates your AdRoll code across your WordPress site.
* Author:              nofearinc
* Author URI:          http://devwp.eu
* Version: 			   1.1
*/

class WP_AdRoll {

	public function WP_AdRoll() {
		$this->init();
	}
	
	// initial point of action
	public function init() {
		add_action('admin_menu', array($this, 'register_page'));
		add_action('admin_init', array($this, 'register_settings'));
		add_action('wp_footer', array($this,'send_to_frontend'));
	}
	
	// register page call
	public function register_page() {
		add_options_page('AdRoll', 'AdRoll Retargeting', 'manage_options', 'wp_adroll', array($this, 'adrl_page'));
	}
	
	// register settings group
	public function register_settings() {
		register_setting('adrl_setting', 'adrl_setting');
		
		add_settings_section(
			'adrl_settings_section',         // ID used to identify this section and with which to register options
			'AdRoll Unique ID’s',                  // Title to be displayed on the administration page
			array($this, 'adrl_settings_callback'), // Callback used to render the description of the section
			'wp_adroll'                           // Page on which to add this section of options
		);
		
		add_settings_field(
			'adrl_adv_id',                      // ID used to identify the field throughout the theme
			'AdRoll adv_id',                           // The label to the left of the option interface element
			array($this, 'adrl_adv_id_callback'),   // The name of the function responsible for rendering the option interface
			'wp_adroll',                          // The page on which this option will be displayed
			'adrl_settings_section'         // The name of the section to which this field belongs
		);
		
		add_settings_field(
			'adrl_pix_id',                      // ID used to identify the field throughout the theme
			'AdRoll pix_id',                           // The label to the left of the option interface element
			array($this, 'adrl_pix_id_callback'),   // The name of the function responsible for rendering the option interface
			'wp_adroll',                          // The page on which this option will be displayed
			'adrl_settings_section'         // The name of the section to which this field belongs
		);		
		
	}
	
	
	// general settings group callback
	public function adrl_settings_callback() {
		//$out = '<h3>AdRoll Retargeting</h3>';
		$out = '';
		echo $out;
	}
	
	// define settings field adv_id
	public function adrl_adv_id_callback() {
		$val = get_option('adrl_setting', '');
		$val = $val['adrl_adv_id'];
		
		echo '<div><input type="text" id="adrl_adv_id" name="adrl_setting[adrl_adv_id]" value="'.$val.'" /></div>';
	}
	
	// define settings field pix_id
	public function adrl_pix_id_callback() {
		$val = get_option('adrl_setting', '');
		$val = $val['adrl_pix_id'];
		
		echo '<div><input type="text" id="adrl_pix_id" name="adrl_setting[adrl_pix_id]" value="'.$val.'" /></div>';
	}
	
	// call the page template here
	public function adrl_page() {
		include_once 'wp-adroll-admin-tpl.php';
	}

	// print the code based on the parameters
	public function send_to_frontend() {
		$adrl_setting = get_option('adrl_setting', '');
		if(!empty($adrl_setting) && !empty($adrl_setting['adrl_adv_id']) && !empty($adrl_setting['adrl_pix_id'])) {
			$adv_id = $adrl_setting['adrl_adv_id'];
			$pix_id = $adrl_setting['adrl_pix_id'];
			
			include_once 'footer-script-code.php';			
		}
	}
	
}

$wp_adroll = new WP_AdRoll();
