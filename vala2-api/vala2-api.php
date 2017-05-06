<?php /*
Plugin Name: VALA 2.0 API
Description: This plugin fetches data from VALA 2.0 System.
Author: VALA System Team
Version: 2.0
Author URI: http://api.dev.valasystem.com/
*/

define('VALA_PLUGIN_BASENAME', basename( dirname( __FILE__ ) ), true);
define('VALA_PLUGIN_DIR', WP_PLUGIN_DIR . '/' . VALA_PLUGIN_BASENAME . '/'); 
define( 'VALA_FILE', __FILE__ );
define( 'VALA_PLUGIN_URL', plugin_dir_url( VALA_FILE ) );

class VALA_API_Plugin {
    
    /**
     * Current version.
     * @TODO Update version number for new releases
     * @var    string
     */
    const CURRENT_VERSION = '2.0';

    /**
     * Translation domain
     * @var string
     */
    const TEXT_DOMAIN = 'vala';

    /**
     * Options instance.
     * @var object
     */
    private $_data = null;
    
    private $vala_functions;
    
    // vala client
    public $api_methods;
    
    /**
     * Initializing object
     *
     * Plugin register actions, filters and hooks.
     */
    function __construct () {
        global $wpdb, $wp_version;
        
        // Activation deactivation hooks
        register_activation_hook(__FILE__, array($this, 'install'));
        register_deactivation_hook(__FILE__, array($this, 'uninstall'));

        // Actions
        add_action('init', array($this, 'init'), 99);
        add_action('admin_init', array($this, 'admin_init'), 99);
        add_action('admin_menu', array($this, 'admin_menu'));
        
        // Public scripts
        add_action( 'wp_enqueue_styles', array($this,'enqueue_styles') );
        add_action( 'wp_enqueue_scripts', array($this,'enqueue_scripts') );
        
        // Admin Scripts
        add_action( 'admin_enqueue_styles', array($this, 'admin_enqueue_styles') );
        add_action( 'admin_enqueue_scripts', array($this, 'admin_enqueue_scripts') );
    }
    
      /**
     * Initialize the plugin
     *
     * @see        http://codex.wordpress.org/Plugin_API/Action_Reference
     * @see        http://adambrown.info/p/wp_hooks/hook/init
     */
     function init() {
        global $wpdb, $wp_rewrite, $current_user, $blog_id, $wp_version;
        $this->start_plugin_session();
        
        $version = preg_replace('/-.*$/', '', $wp_version);
        
        $this->api_methods = new ValaApiMethods();
        
        $plugin_creds = $this->get_option_keys();
        
        if ( isset( $_POST ) && isset( $_POST['_wpnonce'] ) && wp_verify_nonce( $_POST['_wpnonce'], 'vala-update-options') ) {
            $options = array();
            $options['vala_user_key'] = $_POST['vala_default']['vala_user_key'];
            $options['vala_pass_key'] = $_POST['vala_default']['vala_pass_key'];
            $options['authenticated'] = FALSE;
            
            $options = apply_filters('vala_settings-before_save', $options);
            
            
            $this->vala_settings_saved = 1;
            
            $creds = $this->get_option_keys();
            $resp = $this->api_methods->authenticate( $creds['vala_user_key'], $creds['vala_pass_key'] );
            
            if( !isset( $resp['error'] ) )
            {
                $this->vala_settings_authenticated = 1;
                $options['authenticated'] = TRUE;
                $options['vala_access_token'] = $this->api_methods->getAccessToken();
            } 
            
            update_option('vala_api_keys', $options);
            
        }
        
    }
    
    function start_plugin_session() {
        if(!session_id()) {
            session_start();
        }
    }
    
    function admin_init() {
        // do nothing yet  
    }
    
    function admin_enqueue_styles() {
        wp_deregister_style( 'jquery.filetree' );
        wp_register_style( 'jquery.filetree', plugins_url( '/css/jquery.filetree.min.css', __FILE__) , array() , false, false);
        //wp_enqueue_style('jquery.filetree');
        wp_enqueue_style('ngg_progressbar');
    }
    function admin_enqueue_scripts() {
        global $wp_query;
        
        printf(
            '<script type="text/javascript">var _vala2_ajax_url="%s";</script>',
             admin_url('admin-ajax.php')
        );
        do_action('vala-load_scripts-public');        
        wp_deregister_script( 'jquery.filetree' );
        wp_register_script( 'jquery.filetree', plugins_url( '/js/jquery.filetree.min.js', __FILE__), array(), false, false);
        //wp_enqueue_script('jquery.filetree');
        wp_enqueue_script('ngg_progressbar');
    }     
    
    function enqueue_scripts()
    {
        wp_deregister_script( 'bxslider' );
        wp_register_script( 'bxslider', plugins_url( '/js/jquery.bxslider.min.js', __FILE__), array(), false, false);
        wp_register_script( 'vala2-scripts', plugins_url( '/js/scripts.js', __FILE__), array(), false, false);
    }
    
    function enqueue_styles()
    {
        wp_deregister_style( 'bxslider-css' );
        wp_register_style( 'bxslider-css', plugins_url( '/css/jquery.bxslider.css', __FILE__) , array() , false, false);
        wp_register_style( 'vala2-css', plugins_url( '/css/styles.css', __FILE__) , array() , false, false);
    }
    
    /**
     * Add the admin menus
     *
     * @see        http://codex.wordpress.org/Adding_Administration_Menus
     */
    public function admin_menu() {
        global $submenu, $menu;

        $perms = 'manage_options';
        add_menu_page( 'VALA 2.0', 'VALA', $perms, 'vala2api', array($this, 'admin_page'), '', 83.3 ); 
        add_submenu_page( 'vala2api', __('Import Gallery', self::TEXT_DOMAIN), __('Import Gallery', self::TEXT_DOMAIN), $perms, 'vala2_winners_circle',  array($this,'ngg_import_gallery_page') );
    }
    
    /**
     * Activation hook
     *
     * Create tables if they don't exist and add plugin options
     *
     * @see     http://codex.wordpress.org/Function_Reference/register_activation_hook
     *
     * @global    object    $wpdb
     */
    function install () {
        global $wpdb;
        if (!get_option('vala_api_keys', false)) add_option('vala_api_keys', array());
    }
    
    /**
     * Deactivation hook
     *
     * @see        http://codex.wordpress.org/Function_Reference/register_deactivation_hook
     *
     * @global    object    $wpdb
     */
    function uninstall() {
        global $wpdb;
        
        delete_option('vala_api_keys'); 
    }
    
    public function admin_page(){
        global $wpdb, $table_prefix;
        
        if(!current_user_can('manage_options')) {
            echo "<p>" . __('Nice Try...', self::TEXT_DOMAIN) . "</p>";  //If accessed properly, this message doesn't appear.
            return;
        }
        
        if (isset($this->vala_settings_saved) && $this->vala_settings_saved == 1) {
            echo '<div class="updated fade"><p>'.__('Settings saved.', self::TEXT_DOMAIN).'</p></div>';   
            
            if( isset( $this->vala_settings_authenticated ) && $this->vala_settings_authenticated == 1 )
                echo '<div class="updated fade"><p>'.__('Authenticated.', self::TEXT_DOMAIN).'</p></div>';
            else
                echo '<div class="error fade"><p>'.__('Invalid Credentials.', self::TEXT_DOMAIN).'</p></div>';
        }
        
        
        
        // include page
        require_once VALA_PLUGIN_DIR . 'page/admin.html';
    }
    
    public function ngg_import_gallery_page()
    {
        wp_enqueue_style('jquery.filetree');
        wp_enqueue_script('jquery.filetree');
      
         if( !is_plugin_active( 'nextgen-gallery/nggallery.php' ) )
                echo '<div class="updated fade"><p>Please install & activate <a href="http://wordpress.org/plugins/nextgen-gallery/" target="_blank">NextGEN Gallery</a> to allow this extension to work.</p></div>';
        else{
            $galleries = C_Gallery_Mapper::get_instance()->find_all();
            //if (!$sec_actor->is_allowed('nextgen_edit_gallery_unowned')) {
                $galleries_all = $galleries;
                $galleries = array();
                foreach ($galleries_all as $gallery) {
                    //if ($sec_actor->is_user() && $sec_actor->get_entity_id() == (int) $gallery->author) {
                        $galleries[] = $gallery;
                    //}
                }
           // }
            
            // include page
            require_once VALA_PLUGIN_DIR . 'page/import_vala2.html';
        }
    }
    
    public function get_option_keys()
    {
        return get_option('vala_api_keys'); 
    }
    
}

// Get VALA 2.0 API Class
require_once VALA_PLUGIN_DIR . 'lib/vala2.0.php';
require_once VALA_PLUGIN_DIR . 'lib/plugin-functions.php';

// Shortcodes
require_once VALA_PLUGIN_DIR . 'inc/shortcodes.php';
require_once VALA_PLUGIN_DIR . 'inc/ajax-functions.php';
require_once VALA_PLUGIN_DIR . 'inc/templates.php';

// Lets get things started
$__vala2api = new VALA_API_Plugin(); // @TODO: Refactor
?>
