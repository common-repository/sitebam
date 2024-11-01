<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class SiteBam {

	public function __construct()
	{
		
	}

	public function init() 
	{
		$this->init_admin();
    		$this->enqueue_script();
    		$this->enqueue_admin_styles();
	}

	public function init_admin() {
		register_setting( 'sitebam', 'sitebamid' );
    		add_action( 'admin_menu', array( $this, 'create_nav_page' ) );
	}

	public function create_nav_page() {
		add_options_page(
		  esc_html__( 'SiteBam', 'sitebam' ), 
		  esc_html__( 'SiteBam', 'sitebam' ), 
		  'manage_options',
		  'sitebam_settings',
		  array($this,'admin_view')
		);
	}

	public static function admin_view()
	{
		require_once plugin_dir_path( __FILE__ ) . '/../admin/views/settings.php';
	}

	public static function sitebam_script()
	{
		$sitebamid = get_option( 'sitebamid' );
		$is_admin = is_admin();

		$sitebamid = trim($sitebamid);
		if (!$sitebamid) {
			return;
		}

		if ( $is_admin ) {
			return;
		}

    		//wp_register_script( 'sitebam', 'https://remote.sitebam.com/rcd/?sb='.$sitebamid,array(),true);
    		wp_enqueue_script( 'sitebam','https://remote.sitebam.com/rcd/?sb='.$sitebamid,array(),'',true );
    
	}

	private function enqueue_script() {
		add_action( 'wp_enqueue_scripts', array($this, 'sitebam_script') );
	}

    	private function enqueue_admin_styles() {
       	 add_action( 'admin_enqueue_scripts', array($this, 'sitebam_admin_styles' ) );
    	}

    	public static function sitebam_admin_styles() {
        	wp_register_style( 'sitebam_custom_admin_style', plugins_url( '../admin/static/sitebam-admin.css', __FILE__ ), array(), '20190701b', 'all' );
        	wp_enqueue_style( 'sitebam_custom_admin_style' );
    	}

}

?>
