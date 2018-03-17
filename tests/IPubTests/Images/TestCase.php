<?php
/**
 * Test: IPub\Images\TestCase
 * @testCase
 *
 * @copyright      More in license.md
 * @license        https://www.ipublikuj.eu
 * @author         Adam Kadlec https://www.ipublikuj.eu
 * @package        iPublikuj:Images!
 * @subpackage     Tests
 * @since          1.0.0
 *
 * @date           28.02.15
 */

declare(strict_types = 1);

namespace IPubTests\Images;

use Nette;
use Nette\Application;
use Nette\Application\UI;

use Tester;

use IPub\Images;

use League\Flysystem;

require_once __DIR__ . '/../bootstrap.php';
require_once __DIR__ . '/RouterFactory.php';

abstract class TestCase extends Tester\TestCase
{
	/**
	 * @var Nette\Application\IPresenterFactory
	 */
	protected $presenterFactory;

	/**
	 * @var Nette\DI\Container
	 */
	protected $container;

	/**
	 * Set up
	 */
	public function setUp() : void
	{
		parent::setUp();

		$this->container = $this->createContainer();

		// Get presenter factory from container
		$this->presenterFactory = $this->container->getByType(Nette\Application\IPresenterFactory::class);
	}

	/**
	 * @return Application\IPresenter
	 */
	protected function createPresenter() : Application\IPresenter
	{
		// Create test presenter
		$presenter = $this->presenterFactory->createPresenter('Test');
		// Disable auto canonicalize to prevent redirection
		$presenter->autoCanonicalize = FALSE;

		return $presenter;
	}

	/**
	 * @return Nette\DI\Container
	 */
	protected function createContainer() : Nette\DI\Container
	{
		$config = new Nette\Configurator();
		$config->setTempDirectory(TEMP_DIR);

		$config->addParameters([
			'wwwDir'   => realpath(__DIR__ . DIRECTORY_SEPARATOR . 'web'),
			'mediaDir' => realpath(__DIR__ . DIRECTORY_SEPARATOR . 'media'),
		]);

		Images\DI\ImagesExtension::register($config);

		$config->addConfig(__DIR__ . '/files/config.neon');
		$config->addConfig(__DIR__ . '/files/presenters.neon');

		return $config->createContainer();
	}
}

class TestPresenter extends UI\Presenter
{
	use Images\TImages;

	public function renderDefault() : void
	{
		// Set template for component testing
		$this->template->setFile(__DIR__ . DIRECTORY_SEPARATOR . 'templates' . DIRECTORY_SEPARATOR . 'default.latte');
	}
}
