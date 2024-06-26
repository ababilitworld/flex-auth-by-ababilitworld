<?php
    namespace Ababilitworld\FlexAuthByAbabilitworld\Auth;

    (defined( 'ABSPATH' ) && defined( 'WPINC' )) || die();

    use function AbabilItWorld\FlexCoreByAbabilitworld\{
		Core\Library\Function\wp_error_handler,
		Core\Library\Function\wp_function
	};

	if ( ! class_exists( '\AbabilItWorld\FlexAuthByAbabilitworld\Auth\Auth' ) ) 
	{
		class Auth 
		{
			/**
			 * Object wp_error
			 *
			 * @var object
			 */
			private $wp_error;

			public static $tokenName = 'fabaToken';

			public static $appRootId = 'flex-auth-by-ababilitworld';
	
			/**
			 * Constructor
			 */
			public function __construct() 
			{
				$this->wp_error = wp_error_handler();
				add_action('plugins_loaded',array($this, 'plugins_loaded'));				
				add_action('admin_enqueue_scripts', array($this, 'enqueue_scripts' ) );
				add_action('admin_menu', array($this, 'admin_menu' ) );				
			}

			/**
			 * Add Admin menu
			 *
			 * Add admin menu
			 */
            public function plugins_loaded()
            {
											
			}

			/**
			 * Add Admin menu
			 *
			 * Add admin menu
			 */
            public function enqueue_scripts()
            {
				wp_enqueue_script( 'flex-auth-by-ababilitworld', PLUGIN_URL . '/dist/bundle.js', [ 'jquery', 'wp-element' ], wp_rand(), true );
				wp_localize_script( 'flex-auth-by-ababilitworld', 'flexAuthByAbabilItWorld', [
					'apiUrl' => home_url( '/wp-json/flex-auth-by-ababilitworld' ),
					'tokenName' => self::$tokenName,
					'appRootId' => self::$appRootId,
					'nonce' => wp_create_nonce( 'wp_rest' ),
				] );											
			}
	
			/**
			 * Add Admin menu
			 *
			 * Add admin menu
			 */
            public function admin_menu()
            {
				add_menu_page(
					__('Flex Auth', 'flex-auth-by-ababilitworld'),
					__('Flex Auth', 'flex-auth-by-ababilitworld'),
					'manage_options',
					'flex-auth-by-ababilitworld',
					array($this, 'render_page'),
					'dashicons-admin-post',
					9
				);
            }

			/**
			 * Render Flex Auth page
			 */
			public function render_page() 
			{
				?>
					<div id="<?php echo esc_attr(self::$appRootId.'-wrap');?>">
						<div id="<?php echo esc_attr(self::$appRootId);?>">

						</div>
					</div>
				<?php
			}
			
			/**
			 * Initializes the class
			 *
			 * Create instance if not exist.
			 */
			public static function instance() 
			{
				static $instance = false;
	
				if ( ! $instance ) 
				{
					$instance = new self();
				}
	
				return $instance;
			}
	
		}

        //new Auth();
	
		/**
		 * Return the instance
		 *
		 * @return \AbabilItWorld\FlexAuthByAbabilitworld\Core\Auth\Auth
		 */
		function auth() 
		{
			return Auth::instance();
		}
	
		// take off
		//auth();

		
	}
	
?>