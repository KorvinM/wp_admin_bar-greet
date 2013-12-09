<?php
/*
Plugin Name: Toolbar Greeting
Plugin URI: 
Description: Allows the user to change the default 'Howdy' greeting in the Toolbar. Go to Settings>General to configure with your chosen greeting!
Version: 1.3
Author: Korvin M
Author URI: korvin.org
License: GPL2
*/
/*

Plugin template courtesy Francis Yaconiello

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License, version 2, as 
published by the Free Software Foundation.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

if(!class_exists('kvn_ydwh'))
{
	class kvn_ydwh
	{
		/**
		 * Construct the plugin object
		 */
		public function __construct()
		{
        	// Initialize Settings
            require_once(sprintf("%s/settings.php", dirname(__FILE__)));
            $kvn_ydwh_Settings = new kvn_ydwh_Settings();
			
			
	
			add_filter( 'admin_bar_menu', 'kvn_replace_ydwh');
        	
		} // END public function __construct

	   		
		/**
		 * Activate the plugin
		 */
		public static function activate()
		{
			// Do nothing
		} // END public static function activate
	
		/**
		 * Deactivate the plugin
		 */		
		public static function deactivate()
		{
			// Do nothing
		} // END public static function deactivate
	} // END class kvn_ydwh
} // END if(!class_exists('kvn_ydwh'))

if(class_exists('kvn_ydwh'))
{
	// Installation and uninstallation hooks
	register_activation_hook(__FILE__, array('kvn_ydwh', 'activate'));
	register_deactivation_hook(__FILE__, array('kvn_ydwh', 'deactivate'));

	// instantiate the plugin class
	$kvn_ydwh = new kvn_ydwh();
	
    if(isset($kvn_ydwh)) {
		
		/* replace WordPress Howdy in WordPress 3.3
	 	*  see http://wp-snippets.com/replace-howdy-in-wordpress-3-3-admin-bar/ 
		*/
		
		function kvn_replace_ydwh( $wp_admin_bar ) {
			$ydwh_option = get_option('greeting');
			if ($ydwh_option != ''){//if option is not empty. Could be !=false but less bytes this way & works as well. Both catch accidental spaces in an otherwise empty option.
				$ydwh_my_account=$wp_admin_bar->get_node('my-account');
				$ydwh_newtitle = str_replace( 'Howdy,', $ydwh_option, $ydwh_my_account->title );            
				$wp_admin_bar->add_node( array(
					'id' => 'my-account',
					'title' => $ydwh_newtitle,
					) );	
			}
		}
        
		// Add the settings link to the plugins page
        function kvn_ydwh_settings_link($links){
            $kvn_ydwh_settings_link = '<a href="options-general.php#ydwh_greet">Setting</a>';
            array_unshift($links, $kvn_ydwh_settings_link);
            return $links;
        }

        $kvn_ydwh_plugin = plugin_basename(__FILE__);
        add_filter("plugin_action_links_$kvn_ydwh_plugin", 'kvn_ydwh_settings_link');

    }

	
}
