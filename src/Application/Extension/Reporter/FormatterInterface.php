<?php declare(strict_types=1);

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
