<?php
declare( strict_types = 1 );

use Yoast\WPTestUtils\WPIntegration\TestCase;
/**
 * Test: Abt_Options
 */
class Abt_Options_Test extends TestCase {
	/**
	 * This test class instance.
	 *
	 * @var Abt_Options $instance instance.
	 */
	private $instance;

	/**
	 * Settings: ABSPATH, test class file, WordPress functions.
	 */
	public static function set_up_before_class(): void {
		require_once ROOT_DIR . '/class/class-abt-options.php';
	}

	/**
	 * SetUp.
	 * Create instance.
	 */
	public function set_up() :void {
		parent::set_up();
		$this->instance = new Abt_Options();
	}

	/**
	 * TEST: is_key_exists()
	 */
	public function test_is_key_exists(): void {
		$this->markTestIncomplete( 'This test has not been implemented yet.' );
	}

	/**
	 * TEST: register_options()
	 */
	public function test_register_options(): void {
		$this->markTestIncomplete( 'This test has not been implemented yet.' );
	}

	/**
	 * TEST: set_properties()
	 */
	public function test_set_properties(): void {
		$this->markTestIncomplete( 'This test has not been implemented yet.' );
	}

	/**
	 * TEST: is_abt_options_exists()
	 */
	public function test_is_abt_options_exists(): void {
		$this->assertTrue( $this->instance->is_abt_options_exists() );

		delete_option( 'abt_options' );
		$this->assertFalse( ( new Abt_Options() )->is_abt_options_exists() );
	}

	/**
	 * TEST: is_theme_support()
	 */
	public function test_is_theme_support(): void {
		$this->markTestIncomplete( 'This test has not been implemented yet.' );
	}
}
