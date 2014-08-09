<?php
if(!class_exists('kvn_ydwh_Settings'))
{
	class kvn_ydwh_Settings {
		
		public function __construct(){
			add_action('admin_init', array(&$this, 'admin_init'));// register actions
		}// END public function __construct
		
		public function admin_init() {//hook into WP's admin_init action hook
			register_setting('general', 'greeting', 'wp_filter_nohtml_kses');//maybe not the best sanitise filter to use
			add_settings_section(
				'kvn_ydwh-section',
				'',
				array(&$this, 'settings_section_kvn_ydwh'),
				'general'
			);
			
			add_settings_field(
				'kvn_ydwh-greeting',
				'Replacement Text:',
				array(&$this, 'settings_field_input_text'),
				'general',
				'kvn_ydwh-section',
				array(
					'field' => 'greeting'
				)
			);
		}// END public function admin_init
        
        public function settings_section_kvn_ydwh() {// callback to add title and help text
		  echo '<h3 id="ydwh_greet">Toolbar Greeting</h3><em>Change the greeting in the toolbar. Default: <strong>Howdy</strong> </em><br>';
		}

		public function settings_field_input_text($args) {//provides text inputs for settings fields
			// Get the field name from the $args array
			$field = $args['field'];
			// Get the value of this setting
			$value = get_option($field);
			// echo a proper input type="text"
			echo sprintf('<input type="text" name="%s" id="%s" value="%s" />', $field, $field, $value);
		} // END public function settings_field_input_text($args)

	} // END class kvn_ydwh_Settings
} // END if(!class_exists('kvn_ydwh_Settings'))
