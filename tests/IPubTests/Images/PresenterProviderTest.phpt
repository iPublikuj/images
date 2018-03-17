<?php
/**
 * Test: IPub\Images\Providers
 * @testCase
 *
 * @copyright      More in license.md
 * @license        https://www.ipublikuj.eu
 * @author         Adam Kadlec https://www.ipublikuj.eu
 * @package        iPublikuj:Images!
 * @subpackage     Tests
 * @since          2.0.0
 *
 * @date           12.05.15
 */

declare(strict_types = 1);

namespace IPubTests\Images;

use Nette;

use Tester;
use Tester\Assert;

use IPub\Images;
use IPub\Images\Providers;

use League\Flysystem;

require_once __DIR__ . '/TestCase.php';

class PresenterProviderTest extends TestCase
{
	public function testRegisteringProviders() : void
	{
		$provider = $this->container->getService('images.providers.presenter');

		Assert::true($provider instanceof Providers\PresenterProvider);

		/** @var Images\ImagesLoader $loader */
		$loader = $this->container->getService('images.loader');

		Assert::true($loader instanceof Images\ImagesLoader);
		Assert::true($loader->getProvider('presenter') instanceof Providers\PresenterProvider);
	}

	public function testPresenterProvider() : void
	{
		/** @var Images\ImagesLoader $loader */
		$loader = $this->container->getService('images.loader');
		/** @var Providers\PresenterProvider $provider */
		$provider = $loader->getProvider('presenter');

		$url = $provider->request('default', NULL, 'ipublikuj-logo-large.png', '50x50');
		Assert::same('http:///images/50x50/ipublikuj-logo-large.png?storage=default', $url);
		$url = $provider->request('default', NULL, 'ipublikuj-logo-large.png', '120x120');
		Assert::same('http:///images/120x120/ipublikuj-logo-large.png?storage=default', $url);
		$url = $provider->request('default', NULL, 'ipublikuj-logo-large.png', '50x50', 'fit');
		Assert::same('http:///images/50x50-fit/ipublikuj-logo-large.png?storage=default', $url);
	}
}

\run(new PresenterProviderTest());
