<?php declare(strict_types=1);
/**
 * This file is part of the PHP_CompatInfo package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Bartlett\CompatInfo\Application\Extension\Composer;

/**
 * Parses a given composer.json file for relevant content.
 */
final class Parser
{
    private array $_composerData;

    /**
     * @throws \JsonException
     */
    public function __construct(string $path)
    {
        if (!file_exists($path)) {
            throw new \RuntimeException(sprintf('composer.json file not found at %s', $path));
        }
        if (!is_readable($path)) {
            throw new \RuntimeException(sprintf('composer.json file not readable at %s', $path));
        }

        $this->_composerData = json_decode(file_get_contents($path), true, 512, JSON_THROW_ON_ERROR);
    }

    public function getRequire(): array
    {
        return array_key_exists('require', $this->_composerData)
            ? $this->_composerData['require']
            : [];
    }

    public function getPhpVersion(): ?string
    {
        return (array_key_exists('config', $this->_composerData)
                && array_key_exists('platform', $this->_composerData['config'])
                && array_key_exists('php', $this->_composerData['config']['platform']))
            ? $this->_composerData['config']['platform']['php']
            : null;
    }

    public function getExtensions(): array
    {
        $extensions = [];

        if (array_key_exists('require', $this->_composerData)) {
            foreach ($this->_composerData['require'] as $name => $value) {
                if (strpos($name, 'ext-') === 0) {
                    $extensions[substr($name, 4)] = $value;
                }
            }
        }

        return $extensions;
    }
}
