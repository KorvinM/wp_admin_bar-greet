<?php
/*
Plugin Name: Toolbar Greeting
Plugin URI: 
Description: Allows the user to change the default 'Howdy' greeting in the Toolbar. Go to Settings>General to configure with your chosen greeting!
Version: 1.4
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
            $kvn_ydwh_Settings = new kvn_ydwh_Settings();add_filter( 'admin_bar_menu', array( $this, 'replace' ) );        	
		} // END public function __construct
		
		
		/* replace WordPress Howdy in WordPress 3.3
	 	*  see http://wp-snippets.com/replace-howdy-in-wordpress-3-3-admin-bar/ 
		*/
		
		public function replace( $wp_admin_bar ) {
			$ydwh_option = get_option('greeting');
			
			$ydwh_my_account=$wp_admin_bar->get_node('my-account');
			$ydwh_newtitle = str_replace( 'Howdy,', $ydwh_option, $ydwh_my_account->title );            
			$wp_admin_bar->add_node( array(
				'id' => 'my-account',
				'title' => $ydwh_newtitle,
				) );	
			
		}
		
		public static function uninstall ()
		{
			if ( ! current_user_can( 'activate_plugins' ) )
			    return;
			delete_option('greeting');
		} // END public static function uninstall

	
		
	} // END class kvn_ydwh
} // END if(!class_exists('kvn_ydwh'))

if(class_exists('kvn_ydwh'))
{
	// Uninstallation hook
	register_uninstall_hook(__FILE__, array('kvn_ydwh', 'uninstall'));
	// instantiate the plugin class
	$kvn_ydwh = new kvn_ydwh();
	
    if(isset($kvn_ydwh)) {
        
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
