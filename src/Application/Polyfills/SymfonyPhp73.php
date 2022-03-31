<?php declare(strict_types=1);
/**
 * This file is part of the PHP_CompatInfo package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Bartlett\CompatInfo\Application\Polyfills;

use function version_compare;

/**
 * @author Laurent Laville
 * @since Release 6.4.0
 */
final class SymfonyPhp73 extends AbstractPolyfillInstalled
{
    /**
     * {@inheritDoc}
     */
    public function getName(): string
    {
        return 'symfony/polyfill-php73';
    }

    /**
     * {@inheritDoc}
     */
    public function getVersion(): string
    {
        $installed = parent::getVersion();

        if (version_compare($installed, '1.20.0.0', 'lt')) {
            return '5.3.3';
        }
        return '7.1.0';
    }
}
