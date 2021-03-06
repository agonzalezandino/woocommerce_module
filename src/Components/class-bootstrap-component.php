<?php
/**
 * Packlink PRO Shipping WooCommerce Integration.
 *
 * @package Packlink
 */

namespace Packlink\WooCommerce\Components;

use Logeecom\Infrastructure\Configuration\ConfigEntity;
use Logeecom\Infrastructure\Configuration\Configuration;
use Logeecom\Infrastructure\Http\CurlHttpClient;
use Logeecom\Infrastructure\Http\HttpClient;
use Logeecom\Infrastructure\Logger\Interfaces\ShopLoggerAdapter;
use Logeecom\Infrastructure\Logger\LogData;
use Logeecom\Infrastructure\ORM\Exceptions\RepositoryClassException;
use Logeecom\Infrastructure\ORM\RepositoryRegistry;
use Logeecom\Infrastructure\Serializer\Concrete\NativeSerializer;
use Logeecom\Infrastructure\Serializer\Serializer;
use Logeecom\Infrastructure\ServiceRegister;
use Logeecom\Infrastructure\TaskExecution\Process;
use Logeecom\Infrastructure\TaskExecution\QueueItem;
use Packlink\BusinessLogic\BootstrapComponent;
use Packlink\BusinessLogic\Order\Interfaces\OrderRepository;
use Packlink\BusinessLogic\Scheduler\Models\Schedule;
use Packlink\BusinessLogic\ShippingMethod\Interfaces\ShopShippingMethodService;
use Packlink\BusinessLogic\ShippingMethod\Models\ShippingMethod;
use Packlink\WooCommerce\Components\Order\Order_Repository;
use Packlink\WooCommerce\Components\Order\Order_Shipment_Entity;
use Packlink\WooCommerce\Components\Repositories\Base_Repository;
use Packlink\WooCommerce\Components\Repositories\Queue_Item_Repository;
use Packlink\WooCommerce\Components\Services\Config_Service;
use Packlink\WooCommerce\Components\Services\Logger_Service;
use Packlink\WooCommerce\Components\ShippingMethod\Shipping_Method_Map;
use Packlink\WooCommerce\Components\ShippingMethod\Shop_Shipping_Method_Service;

/**
 * Class Bootstrap_Component
 *
 * @package Packlink\WooCommerce\Components
 */
class Bootstrap_Component extends BootstrapComponent {
	/**
	 * Initializes services and utilities.
	 */
	protected static function initServices() {
		parent::initServices();

		ServiceRegister::registerService(
			Serializer::CLASS_NAME,
			function () {
				return new NativeSerializer();
			}
		);

		ServiceRegister::registerService(
			Configuration::CLASS_NAME,
			static function () {
				return Config_Service::getInstance();
			}
		);

		ServiceRegister::registerService(
			ShopLoggerAdapter::CLASS_NAME,
			static function () {
				return Logger_Service::getInstance();
			}
		);

		ServiceRegister::registerService(
			ShopShippingMethodService::CLASS_NAME,
			static function () {
				return Shop_Shipping_Method_Service::getInstance();
			}
		);

		ServiceRegister::registerService(
			OrderRepository::CLASS_NAME,
			static function () {
				return Order_Repository::getInstance();
			}
		);

		ServiceRegister::registerService(
			HttpClient::CLASS_NAME,
			static function () {
				return new CurlHttpClient();
			}
		);
	}

	/**
	 * Initializes repositories.
	 *
	 * @throws RepositoryClassException If repository class is not instance of repository interface.
	 */
	protected static function initRepositories() {
		parent::initRepositories();

		RepositoryRegistry::registerRepository( ConfigEntity::CLASS_NAME, Base_Repository::getClassName() );
		RepositoryRegistry::registerRepository( Process::CLASS_NAME, Base_Repository::getClassName() );
		RepositoryRegistry::registerRepository( ShippingMethod::CLASS_NAME, Base_Repository::getClassName() );
		RepositoryRegistry::registerRepository( Shipping_Method_Map::CLASS_NAME, Base_Repository::getClassName() );
		RepositoryRegistry::registerRepository( Order_Shipment_Entity::CLASS_NAME, Base_Repository::getClassName() );
		RepositoryRegistry::registerRepository( Schedule::CLASS_NAME, Base_Repository::getClassName() );
		RepositoryRegistry::registerRepository( QueueItem::CLASS_NAME, Queue_Item_Repository::getClassName() );
		RepositoryRegistry::registerRepository( LogData::CLASS_NAME, Base_Repository::getClassName() );
	}
}
