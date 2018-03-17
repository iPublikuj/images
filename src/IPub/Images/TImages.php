<?php
/**
 * TImages.php
 *
 * @copyright      More in license.md
 * @license        http://www.ipublikuj.eu
 * @author         Adam Kadlec http://www.ipublikuj.eu
 * @package        iPublikuj:Images!
 * @subpackage     common
 * @since          1.0.0
 *
 * @date           05.04.14
 */

declare(strict_types = 1);

namespace IPub\Images;

use IPub\Images\Templating;

/**
 * Extension trait
 *
 * @package        iPublikuj:Images!
 * @subpackage     common
 *
 * @author         Adam Kadlec <adam.kadlec@ipublikuj.eu>
 */
trait TImages
{
	/**
	 * @var ImagesLoader
	 */
	protected $imagesLoader;

	/**
	 * @var Templating\Helpers
	 */
	protected $imgHelpers;

	/**
	 * @param ImagesLoader $imagesLoader
	 * @param Templating\Helpers $imagesHelpers
	 */
	public function injectImages(
		ImagesLoader $imagesLoader,
		Templating\Helpers $imagesHelpers
	) : void {
		$this->imagesLoader = $imagesLoader;
		$this->imgHelpers = $imagesHelpers;
	}
}
