<?php
/**
 * This file represents an example of the code that themes would use to register
 * the required plugins.
 *
 * It is expected that theme authors would copy and paste this code into their
 * functions.php file, and amend to suit.
 *
 * @package	   TGM-Plugin-Activation
 * @subpackage Example
 * @version	   2.5.2 
 * @author	   Thomas Griffin <thomas@thomasgriffinmedia.com>
 * @author	   Gary Jones <gamajo@gamajo.com>
 * @copyright  Copyright (c) 2012, Thomas Griffin
 * @license	   http://opensource.org/licenses/gpl-2.0.php GPL v2 or later
 * @link       https://github.com/thomasgriffin/TGM-Plugin-Activation
 */

/**
 * Include the TGM_Plugin_Activation class.
 */
require_once dirname( __FILE__ ) . '/class-tgm-plugin-activation.php';

add_action( 'tgmpa_register', 'tt_register_required_plugins' );
/**
 * Register the required plugins for this theme.
 *
 * In this example, we register two plugins - one included with the TGMPA library
 * and one from the .org repo.
 *
 * The variable passed to tgmpa_register_plugins() should be an array of plugin
 * arrays.
 *
 * This function is hooked into tgmpa_init, which is fired within the
 * TGM_Plugin_Activation class constructor.
 */
function tt_register_required_plugins($get_plugins = false) {

	/**
	 * Array of plugin arrays. Required keys are name and slug.
	 * If the source is NOT from the .org repo, then source is also required.
	 */
	$plugins = array(

		// This is an example of how to include a plugin pre-packaged with a theme
        array(
            'name'     				=> 'Tesla Framework', // The plugin name
            'slug'     				=> 'tesla-framework', // The plugin slug (typically the folder name)
            'source'   				=> get_template_directory() . '/plugins/tesla-framework/tesla-framework_' . tt_get_plugin_version('tesla-framework') . '.zip', // The plugin source
            'required' 				=> true, // If false, the plugin is only 'recommended' instead of required
            'version' 				=> tt_get_plugin_version('tesla-framework'), // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
            'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
            'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
            'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
        ),
  //       array(
		// 	'name'     				=> 'Revolution Slider', // The plugin name
		// 	'slug'     				=> 'revslider', // The plugin slug (typically the folder name)
		// 	'source'   				=> get_template_directory() . '/plugins/rev_slider/revslider_'.tt_get_plugin_version('rev_slider').'.zip', // The plugin source
		// 	'required' 				=> false, // If false, the plugin is only 'recommended' instead of required
		// 	'version' 				=> tt_get_plugin_version('rev_slider'), // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
		// 	'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
		// 	'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
		// 	'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
		// ),
  //       array(
  //           'name'     				=> 'Tesla Login Customizer', // The plugin name
  //           'slug'     				=> 'tesla-login-customizer', // The plugin slug (typically the folder name)
  //           'source'   				=> 'https://downloads.wordpress.org/plugin/tesla-login-customizer.zip', // The plugin source
  //           'required' 				=> false, // If false, the plugin is only 'recommended' instead of required
  //           'version' 				=> '1.1', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
  //           'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
  //           'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
  //           'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
  //       ),
		
		array(
			'name'     				=> 'Visual Composer', // The plugin name
			'slug'     				=> 'js_composer', // The plugin slug (typically the folder name)
			'source'   				=> get_template_directory() . '/plugins/vc/js_composer_' . tt_get_plugin_version('vc') . '.zip', // The plugin source
			'required' 				=> true, // If false, the plugin is only 'recommended' instead of required
			'version' 				=> tt_get_plugin_version('vc'), // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
		),

	);
    if($get_plugins)
        return $plugins;

	/**
	 * Array of configuration settings. Amend each line as needed.
	 * If you want the default strings to be available under your own theme domain,
	 * leave the strings uncommented.
	 * Some of the strings are added into a sprintf, so see the comments at the
	 * end of each line for what each argument will be.
	 */
	$config = array(
		'id'           => 'tt_locales',             // Unique ID for hashing notices for multiple instances of TGMPA.
		'default_path' => '',                      // Default absolute path to bundled plugins.
		'menu'         => 'tgmpa-install-plugins', // Menu slug.
		'parent_slug'  => 'themes.php',            // Parent menu slug.
		'capability'   => 'edit_theme_options',    // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
		'has_notices'  => true,                    // Show admin notices or not.
		'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
		'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic' => false,                   // Automatically activate plugins after installation or not.
		'message'      => '',                      // Message to output right before the plugins table.
	);

	tgmpa( $plugins, $config );
}
/**
 * Force Visual Composer to initialize as "built into the theme". This will hide certain tabs under the Settings->Visual Composer page
 */
add_action( 'vc_before_init', 'tt_vcSetAsTheme' );
function tt_vcSetAsTheme() {
	vc_set_as_theme();
}