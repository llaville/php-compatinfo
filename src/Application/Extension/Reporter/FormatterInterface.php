<?php declare(strict_types=1);
/**
 * This file is part of the PHP_CompatInfo package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Bartlett\CompatInfo\Application\Extension\Reporter;

/**
 * @author Laurent Laville
 * @since Release 6.1.0
 */
interface FormatterInterface
{
    /**
     * @param object $object
     * @param string[] $formats
     * @return bool
     */
    public function supportsFormatting(object $object, array $formats): bool;

    /**
     * @param mixed $data Data to format
     * @return void
     */
    public function format($data): void;
}
