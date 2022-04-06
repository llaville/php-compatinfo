<?php declare(strict_types=1);
/**
 * This file is part of the PHP_CompatInfo package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Bartlett\CompatInfo\Application\Polyfills;

use Composer\InstalledVersions;

/**
 * CompatInfoDB 4.2.0 supports symfony/polyfill which the latest release v1.25.0 requires PHP 7.1.0 minimum
 *
 * @author Laurent Laville
 * @since Release 6.4.0
 */
abstract class AbstractPolyfillInstalled implements PolyfillInterface
{
    /**
     * {@inheritDoc}
     */
    abstract public function getName(): string;

    /**
     * {@inheritDoc}
     */
    public function getVersion(): string
    {
        return InstalledVersions::getVersion($this->getName());
    }
}
