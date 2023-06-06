<?php
declare( strict_types = 1 );

use Yoast\WPTestUtils\WPIntegration\TestCase;
/**
 * Test: Sct_Base
 */
class Abt_Base_Test extends TestCase {
	/**
	 * This test class instance.
	 *
	 * @var Abt_Base $instance instance.
	 */
	private $instance;

	/**
	 * Settings: ABSPATH, test class file, WordPress functions.
	 */
	public static function setUpBeforeClass(): void {
		require_once ROOT_DIR . '/class/class-abt-base.php';
	}

	/**
	 * SetUp.
	 * Create instance.
	 */
	public function set_up() :void {
		parent::set_up();
		$this->instance = new Abt_Base();
	}

	/**
	 * TEST: add_prefix()
	 */
	public function test_add_prefix(): void {
		$this->assertSame( 'abt_options', $this->instance->add_prefix( 'options' ) );
	}

	/**
	 * TEST: return_plugin_url()
	 *
	 * @testWith [ "admin-bar-tools", null ]
	 *           [ "send-chat-tools", "send-chat-tools" ]
	 *
	 * @param string $expected_plugin_name plugin name.
	 * @param string $actual_plugin_name   plugin name.
	 */
	public function test_get_plugin_url( string $expected_plugin_name, ?string $actual_plugin_name ): void {
		$method = new ReflectionMethod( $this->instance, 'get_plugin_url' );
		$method->setAccessible( true );

		$this->assertSame(
			content_url( 'plugins/' . $expected_plugin_name ),
			$actual_plugin_name ? $method->invoke( $this->instance, $actual_plugin_name ) : $method->invoke( $this->instance ),
		);
	}

	/**
	 * TEST: get_plugin_name()
	 */
	public function test_get_plugin_name(): void {
		$this->assertSame( 'Admin Bar Tools', $this->instance->get_plugin_name() );
	}

	/**
	 * TEST: get_plugin_dir()
	 *
	 * @testWith [ "admin-bar-tools", null ]
	 *           [ "send-chat-tools", "send-chat-tools" ]
	 *
	 * @param string $expected_plugin_name plugin name.
	 * @param string $actual_plugin_name   plugin name.
	 */
	public function test_get_plugin_dir( string $expected_plugin_name, ?string $actual_plugin_name ): void {
		$method = new ReflectionMethod( $this->instance, 'get_plugin_dir' );
		$method->setAccessible( true );

		$this->assertSame(
			ABSPATH . 'wp-content/plugins/' . $expected_plugin_name,
			$actual_plugin_name ? $method->invoke( $this->instance, $actual_plugin_name ) : $method->invoke( $this->instance ),
		);
	}

	/**
	 * TEST: get_plugin_path()
	 */
	public function test_get_plugin_path(): void {
		$method = new ReflectionMethod( $this->instance, 'get_plugin_path' );
		$method->setAccessible( true );

		$this->assertSame(
			ABSPATH . 'wp-content/plugins/admin-bar-tools/admin-bar-tools.php',
			$method->invoke( $this->instance )
		);
		$this->assertSame(
			ABSPATH . 'wp-content/plugins/admin-bar-tools/admin-bar-tools.php',
			$method->invoke( $this->instance, 'admin-bar-tools', 'admin-bar-tools.php' ),
		);
	}

	/**
	 * TEST: get_api_namespace()
	 */
	public function test_get_api_namespace(): void {
		$method = new ReflectionMethod( $this->instance, 'get_api_namespace' );
		$method->setAccessible( true );

		$this->assertSame(
			'admin-bar-tools/v1',
			$method->invoke( $this->instance )
		);

		$this->assertSame(
			'admin-bar-tools/v1',
			$method->invoke( $this->instance, 'admin-bar-tools', 'v1' )
		);
	}

	/**
	 * TEST: get_version()
	 */
	public function test_get_version(): void {
		$method = new ReflectionMethod( $this->instance, 'get_version' );
		$method->setAccessible( true );

		$this->assertIsString( $method->invoke( $this->instance ) );
		$this->assertMatchesRegularExpression( '/^\d+\.\d+\.\d+$/', $method->invoke( $this->instance ) );
	}

	/**
	 * TEST: get_option_group()
	 */
	public function test_get_option_group(): void {
		$method = new ReflectionMethod( $this->instance, 'get_option_group' );
		$method->setAccessible( true );

		$this->assertSame(
			'admin-bar-tools-settings',
			$method->invoke( $this->instance )
		);
	}

	/**
	 * TEST: get_abt_options()
	 *
	 * @testWith [ "items", null ]
	 *           [ "locale", null ]
	 *           [ "sc", null ]
	 *           [ "theme_support", null ]
	 *           [ "version", null ]
	 *           [ "psi", "items" ]
	 *           [ "lh", "items" ]
	 *           [ "gsc", "items" ]
	 *           [ "gc", "items" ]
	 *           [ "gi", "items" ]
	 *           [ "bi", "items" ]
	 *           [ "twitter", "items" ]
	 *           [ "facebook", "items" ]
	 *           [ "hatena", "items" ]
	 *
	 * @param string  $property  Property name.
	 * @param ?string $parameter Parameter name.
	 */
	public function test_get_abt_options( string $property, ?string $parameter ): void {
		$method = new ReflectionMethod( $this->instance, 'get_abt_options' );
		$method->setAccessible( true );

		$abt_options = $method->invoke( $this->instance );
		$this->assertIsArray( $abt_options );
		if ( ! is_null( $parameter ) ) {
			$this->assertIsArray( $abt_options[ $parameter ] );
		}

		is_null( $parameter )
			? $this->assertArrayHasKey( $property, $abt_options )
			: $this->assertArrayHasKey( $property, $abt_options[ $parameter ] );
	}

	/**
	 * TEST: set_abt_options()
	 */
	public function test_set_abt_options(): void {
		$abt_base_set_abt_options = new ReflectionMethod( $this->instance, 'set_abt_options' );
		$abt_base_set_abt_options->setAccessible( true );

		$abt_base_get_abt_options = new ReflectionMethod( $this->instance, 'get_abt_options' );
		$abt_base_get_abt_options->setAccessible( true );

		$get_abt_options = $abt_base_get_abt_options->invoke( $this->instance );

		$this->assertIsArray( $get_abt_options );

		$abt_options                  = $get_abt_options;
		$abt_options['theme_support'] = ! $abt_options['theme_support'];

		$abt_base_set_abt_options->invoke( $this->instance, $abt_options );

		$actual_abt_options = $abt_base_get_abt_options->invoke( $this->instance );
		$this->assertIsArray( $actual_abt_options );

		$this->assertNotSame( $get_abt_options['theme_support'], $actual_abt_options['theme_support'] );
	}

	/**
	 * TEST: console()
	 */
	public function test_console(): void {
		$method = new ReflectionMethod( $this->instance, 'console' );
		$method->setAccessible( true );

		$this->expectOutputString( '<script>console.log("test");</script>' );
		$method->invoke( $this->instance, 'test' );
	}
}
