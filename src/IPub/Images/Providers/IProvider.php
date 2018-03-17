<?php
/**
 * IProvider.php
 *
 * @copyright      More in license.md
 * @license        https://www.ipublikuj.eu
 * @author         Adam Kadlec https://www.ipublikuj.eu
 * @package        iPublikuj:Images!
 * @subpackage     Providers
 * @since          2.0.0
 *
 * @date           12.05.16
 */

declare(strict_types = 1);

namespace IPub\Images\Providers;

use IPub\Images\Exceptions;

/**
 * Image provider interface
 *
 * @package        iPublikuj:Images!
 * @subpackage     Providers
 *
 * @author         Adam Kadlec <adam.kadlec@ipublikuj.eu>
 */
interface IProvider
{
	/**
	 * @return string
	 */
	public function getName() : string;

	/**
	 * @param string $storage
	 * @param string|NULL $namespace
	 * @param string $filename
	 * @param string|NULL $size
	 * @param string|NULL $algorithm
	 *
	 * @return string
	 * 
	 * @throws Exceptions\InvalidArgumentException
	 * @throws Exceptions\InvalidStateException
	 * @throws Exceptions\FileNotFoundException
	 */
	public function request(string $storage, ?string $namespace = NULL, string $filename, ?string $size = NULL, ?string $algorithm = NULL) : string;
}
