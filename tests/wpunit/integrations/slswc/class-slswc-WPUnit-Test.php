<?php

namespace BrianHenryIE\WP_Plugin_Updater\Integrations\SLSWC;

use BrianHenryIE\ColorLogger\ColorLogger;
use BrianHenryIE\WP_Plugin_Updater\Exception\Licence_Does_Not_Exist_Exception;
use BrianHenryIE\WP_Plugin_Updater\Exception\Max_Activations_Exception;
use BrianHenryIE\WP_Plugin_Updater\Exception\Slug_Not_Found_On_Server_Exception;
use BrianHenryIE\WP_Plugin_Updater\Licence;
use BrianHenryIE\WP_Plugin_Updater\Integrations\SLSWC\Model\Product;
use BrianHenryIE\WP_Plugin_Updater\Model\Plugin_Update_Interface;
use BrianHenryIE\WP_Plugin_Updater\Settings_Interface;
use DateTimeImmutable;
use Mockery;
use Psr\Log\NullLogger;

/**
 * @coversDefaultClass \BrianHenryIE\WP_Plugin_Updater\Integrations\SLSWC\SLSWC
 */
class SLSWC_WPUnit_Test extends \lucatume\WPBrowser\TestCase\WPTestCase {

	/**
	 * @covers ::activate_licence
	 * @covers ::server_request
	 * @covers ::validate_response
	 */
	public function test_activate_licence() {

		$body          = file_get_contents( codecept_root_dir( 'tests/_data/slswc/activate-success.json' ) );
		$response_code = 200;

		add_filter(
			'pre_http_request',
			function () use ( $body, $response_code ) {
				return array(
					'body'     => $body,
					'response' => array( 'code' => $response_code ),
				);
			}
		);

		$licence = new Licence();
		$licence->set_licence_key( 'abc123' );
		$licence->set_status( 'active' );
		$licence->set_last_updated( new DateTimeImmutable() );
		$licence->set_expiry_date( new DateTimeImmutable() );

		$settings = Mockery::mock( Settings_Interface::class )->makePartial();
		$settings->expects( 'get_plugin_slug' )->zeroOrMoreTimes();
		$settings->expects( 'get_licence_data_option_name' )
				->andReturn( 'a_plugin_licence' );
		$settings->expects( 'get_licence_server_host' )
				->andReturn( 'https://whatever.127' );

		$logger = new ColorLogger();

		$sut = new SLSWC( $settings, $logger );

		/** @var Licence $result */
		$result = $sut->activate_licence( $licence );

		$this->assertEquals( 'active', $result->get_status() );
	}

	/**
	 * TODO: This does not communicate to the user that the licence was already activated.
	 *
	 * @covers ::activate_licence
	 * @covers ::server_request
	 * @covers ::validate_response
	 */
	public function test_activate_licence_already_activated() {

		$body          = file_get_contents( codecept_root_dir( 'tests/_data/slswc/activate-success.json' ) );
		$response_code = 200;

		add_filter(
			'pre_http_request',
			function () use ( $body, $response_code ) {
				return array(
					'body'     => $body,
					'response' => array( 'code' => $response_code ),
				);
			}
		);

		$licence = new Licence();
		$licence->set_licence_key( 'abc123' );
		$licence->set_status( 'active' );
		$licence->set_last_updated( new DateTimeImmutable() );
		$licence->set_expiry_date( new DateTimeImmutable() );

		$settings = Mockery::mock( Settings_Interface::class )->makePartial();
		$settings->expects( 'get_plugin_slug' )->zeroOrMoreTimes();
		$settings->expects( 'get_licence_data_option_name' )
				->andReturn( 'a_plugin_licence' );
		$settings->expects( 'get_licence_server_host' )
				->andReturn( 'https://whatever.127' );

		$logger = new ColorLogger();

		$sut = new SLSWC( $settings, $logger );

		/** @var Licence $result */
		$result = $sut->activate_licence( $licence );

		$this->assertEquals( 'active', $result->get_status() );
	}

	public function test_deactivate_licence(): void {

		$body          = file_get_contents( codecept_root_dir( 'tests/_data/slswc/deactivate-success.json' ) );
		$response_code = 200;

		add_filter(
			'pre_http_request',
			function () use ( $body, $response_code ) {
				return array(
					'body'     => $body,
					'response' => array( 'code' => $response_code ),
				);
			}
		);

		$licence = new Licence();
		$licence->set_licence_key( 'abc123' );
		$licence->set_status( 'active' );
		$licence->set_last_updated( new DateTimeImmutable() );
		$licence->set_expiry_date( new DateTimeImmutable() );

		$settings = Mockery::mock( Settings_Interface::class )->makePartial();
		$settings->expects( 'get_plugin_slug' )->zeroOrMoreTimes();
		$settings->expects( 'get_licence_data_option_name' )
				->andReturn( 'a_plugin_licence' );
		$settings->expects( 'get_licence_server_host' )
				->andReturn( 'https://whatever.127' );

		$logger = new ColorLogger();

		$sut = new SLSWC( $settings, $logger );

		/** @var Licence $result */
		$result = $sut->deactivate_licence( $licence );

		$this->assertEquals( 'deactivated', $result->get_status() );
	}

	/**
	 * @covers ::get_remote_product_information
	 * @covers ::server_request
	 * @covers ::validate_response
	 */
	public function test_get_product_information(): void {

		$body          = file_get_contents( codecept_root_dir( 'tests/_data/slswc/get-product-information-success.json' ) );
		$response_code = 200;

		add_filter(
			'pre_http_request',
			function () use ( $body, $response_code ) {
				return array(
					'body'     => $body,
					'response' => array( 'code' => $response_code ),
				);
			}
		);

		$licence = new Licence();
		$licence->set_licence_key( '87486a5c45612f31ffdeb77506d20d4d3a157d37' );
		$licence->set_status( 'active' );
		$licence->set_last_updated( new DateTimeImmutable() );
		$licence->set_expiry_date( new DateTimeImmutable() );

		update_option( 'a_plugin_licence', $licence );

		$settings = Mockery::mock( Settings_Interface::class )->makePartial();
		$settings->expects( 'get_licence_data_option_name' )
				->andReturn( 'a_plugin_licence' );
		$settings->expects( 'get_plugin_information_option_name' )
				->andReturn( 'a_plugin_plugin_information' );
		$settings->expects( 'get_licence_server_host' )
				->andReturn( 'https://updatestest.bhwp.ie' );
		$settings->expects( 'get_plugin_slug' )
				->andReturn( 'test-plugin' );

		$logger = new NullLogger();

		$sut = new SLSWC( $settings, $logger );

		/** @var Product $result */
		$result = $sut->get_remote_product_information( $licence );

		$this->assertEquals( 'a-plugin', $result->get_software_slug() );
	}

	/**
	 * @covers ::get_remote_check_update
	 * @covers ::server_request
	 * @covers ::validate_response
	 */
	public function test_check_update_success(): void {

		$body          = file_get_contents( codecept_root_dir( 'tests/_data/slswc/check-update-success.json' ) );
		$response_code = 200;

		add_filter(
			'pre_http_request',
			function () use ( $body, $response_code ) {
				return array(
					'body'     => $body,
					'response' => array( 'code' => $response_code ),
				);
			}
		);

		$licence = new Licence();
		$licence->set_licence_key( 'abc123' );
		$licence->set_status( 'active' );
		$licence->set_last_updated( new DateTimeImmutable() );
		$licence->set_expiry_date( new DateTimeImmutable() );

		$settings = Mockery::mock( Settings_Interface::class )->makePartial();
		$settings->expects( 'get_licence_data_option_name' )
				->andReturn( 'a_plugin_licence' );
		$settings->expects( 'get_plugin_information_option_name' )
				->andReturn( 'a_plugin_plugin_information' );
		$settings->expects( 'get_licence_server_host' )
				->andReturn( 'https://updatestest.bhwp.ie' );
		$settings->expects( 'get_plugin_slug' )
				->andReturn( 'test-plugin' );

		$logger = new NullLogger();

		$sut = new SLSWC( $settings, $logger );

		/** @var Plugin_Update_Interface $result */
		$result = $sut->get_remote_check_update( $licence );

		$this->assertEquals( '1.2.0', $result->get_version() );
	}

	// "Invalid parameter(s): slug" happens when the licence key is correct but does not match the plugin slug.

	// deactivating a licence twice results in the same success response from the server.


	public function test_validate_response_licence_not_found(): void {
		$this->expectExceptionForResponse(
			codecept_root_dir( 'tests/_data/slswc/invalid-parameters-licence-key-slug.json' ),
			400,
			Licence_Does_Not_Exist_Exception::class
		);
		// Slug_Not_Found_On_Server_Exception::class
	}

	public function test_validate_response_max_activations(): void {
		$this->expectExceptionForResponse(
			codecept_root_dir( 'tests/_data/slswc/max-activations-reached.json' ),
			200,
			Max_Activations_Exception::class
		);
	}

	public function expectExceptionForResponse( string $response_body_file, int $response_code, $expected_exception_class ): void {
		$this->expectException( $expected_exception_class );

		$body = file_get_contents( $response_body_file );

		add_filter(
			'pre_http_request',
			function () use ( $body, $response_code ) {
				return array(
					'body'     => $body,
					'response' => array( 'code' => $response_code ),
				);
			}
		);

		$licence = new Licence();
		$licence->set_licence_key( 'abc123' );
		$licence->set_status( 'active' );
		$licence->set_last_updated( new DateTimeImmutable() );
		$licence->set_expiry_date( new DateTimeImmutable() );

		update_option( 'a_plugin_licence', $licence );

		$settings = Mockery::mock( Settings_Interface::class )->makePartial();
		$settings->expects( 'get_plugin_slug' )->zeroOrMoreTimes();
		$settings->expects( 'get_licence_data_option_name' )
				->andReturn( 'a_plugin_licence' );
		$settings->expects( 'get_licence_server_host' )
				->andReturn( 'https://whatever.127' );

		$logger = new ColorLogger();

		$sut = new SLSWC( $settings, $logger );

		$sut->activate_licence( $licence );
	}
}
