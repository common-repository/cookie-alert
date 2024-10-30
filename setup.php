<?php

    if(!class_exists('cookie_alert_settings_page')) {
	class cookie_alert_settings_page {
        
		// Construct the plugin object
		public function __construct() {

            add_action('admin_init', array(&$this, 'admin_init'));
        	add_action('admin_menu', array(&$this, 'add_menu'));
		} 
		
        
        // hook into WP's admin_init action hook
        public function admin_init() {
            
        	// Registra opzioni
        	register_setting('cookie_alert_template-group', 'cookiealert_attivo');
        	register_setting('cookie_alert_template-group', 'cookiealert_testo');
        	register_setting('cookie_alert_template-group', 'cookiealert_informativa');
        	register_setting('cookie_alert_template-group', 'cookiealert_link');
        	register_setting('cookie_alert_template-group', 'cookiealert_testobottone');
        	register_setting('cookie_alert_template-group', 'cookiealert_posizione');
        	register_setting('cookie_alert_template-group', 'cookiealert_colorebottone');

        	// Sezione di Setup Titolo
        	add_settings_section(
        	    'cookie_alert_template-section', 
        	    'Opzioni Cookie Alert',
        	    array(&$this, 'cookie_alert_plugin_template'), 
        	    'cookie_alert_template'
        	);
        	
        	// Opzione Attivo/Spento
            add_settings_field(
                'cookie_alert_template-cookiealert_attivo', 
                'Attivo/Non Attivo', 
                array(&$this, 'settings_field_input_radio_1'), 
                'cookie_alert_template', 
                'cookie_alert_template-section',
                array(
                    'fieldradio' => 'cookiealert_attivo'
                )
            );
            
            //Opzione Testo del Messaggio
            add_settings_field(
                'cookie_alert_template-cookiealert_testo', 
                'Testo del Messaggio', 
                array(&$this, 'settings_field_input_textarea'), 
                'cookie_alert_template', 
                'cookie_alert_template-section',
                array(
                    'fieldarea' => 'cookiealert_testo',
                    'titolo' => 'Testo del Messaggio'
                )
            );
            
            //Opzione URL Informativa
            add_settings_field(
                'cookie_alert_template-cookiealert_informativa', 
                'Url all\'informativa',
                array(&$this, 'settings_field_input_text'), 
                'cookie_alert_template', 
                'cookie_alert_template-section',
                array(
                    'field' => 'cookiealert_informativa',
                    'titolo' => 'URL Informativa'
                )
            );
            
            //Opzione Testo del link
            add_settings_field(
                'cookie_alert_template-cookiealert_link', 
                'Testo del Link',
                array(&$this, 'settings_field_input_text'), 
                'cookie_alert_template', 
                'cookie_alert_template-section',
                array(
                    'field' => 'cookiealert_link',
                    'titolo' =>'Testo del Link' 
                )
            );
            
             //Opzione Testo del Bottone
            add_settings_field(
                'cookie_alert_template-cookiealert_testobottone', 
                'Bottone di Chiusura', 
                array(&$this, 'settings_field_input_text'), 
                'cookie_alert_template', 
                'cookie_alert_template-section',
                array(
                    'field' => 'cookiealert_testobottone',
                    'titolo' =>'Bottone di Chiusura' 
                )
            );
            
            //Opzione Colore Bottone
            add_settings_field(
                'cookie_alert_template-cookiealert_colorebottone', 
                'Colore del Bottone', 
                array(&$this, 'settings_field_input_text'), 
                'cookie_alert_template', 
                'cookie_alert_template-section',
                array(
                    'field' => 'cookiealert_colorebottone',
                    'titolo' => 'Colore del Bottone (Es. #ff00cc)'
                )
            );
            
            
            //Opzione Posizione
            add_settings_field(
                'cookie_alert_template-cookiealert_posizione', 
                'Posizione del Banner',
                array(&$this, 'settings_field_input_radio_2'), 
                'cookie_alert_template', 
                'cookie_alert_template-section',
                array(
                    'fieldradio' => 'cookiealert_posizione'
                )
            );
            
            // Possibly do additional admin_init tasks
        } 
        
        public function cookie_alert_plugin_template() {
            // Think of this as help text for the section.
            echo _e( 'Personalizza in tuo messaggio.', 'cookiealert' );
        }
        
        
        //Stampa gli input radio Attivo / Spento
        public function settings_field_input_radio_1($args) {
            // Get the field name from the $args array
            $fieldradio = $args['fieldradio'];
            // Get the value of this setting
            $value = get_option($fieldradio);
            // echo a proper input type="text"
            
            if($value == 'active') {
            
            
            echo '<input type="radio" name="cookiealert_attivo" id="check_attivo" value="active" checked><label for="check_attivo">' . _e( "Attivo", "cookiealert" ) . '</label>';
                
            echo '<input type="radio" name="cookiealert_attivo" id="check_spento" value="disabled"><label for="check_spento">'
                . _e( "Non attivo", "cookiealert" ) . '</label>';
                
            } else {
                
            
            echo '<input type="radio" name="cookiealert_attivo" id="check_attivo"  value="active"><label for="check_attivo">' . _e( "Attivo", "cookiealert" ) . '</label>';
                
            echo '<input type="radio" name="cookiealert_attivo" id="check_spento" value="disabled" checked><label for="check_spento">' . _e( "Non attivo", "cookiealert" ). '</label>';
            
            }
        } 
        
        
        
        //Stampa gli input radio Top / Bottom
        public function settings_field_input_radio_2($args) {
            // Get the field name from the $args array
            $fieldradio = $args['fieldradio'];
            // Get the value of this setting
            $value = get_option($fieldradio);
            // echo a proper input type="text"
            
            if($value == 'top') {
            
            echo '<input type="radio" name="cookiealert_posizione" id="check_top" value="top" checked><label for="check_top">' . _e( "Top", "cookiealert" ) . '</label>';
            echo '<input type="radio" name="cookiealert_posizione" id="check_bottom" value="bottom"><label for="check_bottom">' . _e( "Bottom", "cookiealert" ) . '</label>';
                
            } else {
            
                
            echo '<input type="radio" name="cookiealert_posizione" value="top"><label for="check_top">' 
                  . _e( "Top", "cookiealert" ) . '</label>';
                
            echo '<input type="radio" name="cookiealert_posizione" id="check_bottom" value="bottom" checked><label for="check_bottom">' . _e( "Bottom", "cookiealert" ) . '</label>';
            
            }
        } 
        
        
        
        //Stampa la textarea
        public function settings_field_input_textarea($args) {
            // Get the field name from the $args array
            $fieldarea = $args['fieldarea'];
            //Titolo del campo
            $fieldtitolo = $args['titolo'];
            // Get the value of this setting
            $value = get_option($fieldarea);
            // echo a proper input type="text"
            echo sprintf('<textarea rows="10" cols="50" name="%s" id="%s" >%s</textarea>', $fieldarea, $fieldarea, $value);
        } 
        
        //Stampa gli input text 
        public function settings_field_input_text($args) {
            // Get the field name from the $args array
            $field = $args['field'];
            //Titolo del campo 
            $fieldtitolo = $args['titolo'];
            // Get the value of this setting
            $value = get_option($field);
            // echo a proper input type="text"
            echo sprintf('<input type="text" name="%s" id="%s" value="%s" />', $field, $field, $value);
        } 
        
       
        
        //Menu	
        public function add_menu() {
            // Add a page to manage this plugin's settings
        	add_options_page(
        	    'Cookie Alert', 
        	    'Cookie Alert', 
        	    'manage_options', 
        	    'cookie_alert_template', 
        	    array(&$this, 'plugin_settings_page')
        	);
        } // END public function add_menu()
    
        /**
         * Menu Callback
         */		
        public function plugin_settings_page()
        {
        	if(!current_user_can('manage_options'))
        	{
        		wp_die(__('You do not have sufficient permissions to access this page.'));
        	}
	
        	// Render the settings template
        	include(sprintf("%s/template/setup.php", dirname(__FILE__)));
        } // END public function plugin_settings_page()
    } // END class WP_Plugin_Template_Settings
} // END if(!class_exists('WP_Plugin_Template_Settings'))
