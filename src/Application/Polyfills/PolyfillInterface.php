<?php declare(strict_types=1);
/**
 * This file is part of the PHP_CompatInfo package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Bartlett\CompatInfo\Application\Polyfills;

/**
 * @author Laurent Laville
 * @since Release 6.4.0
 */
interface PolyfillInterface
{
    public function getName(): string;
    public function getVersion(): string;
}
