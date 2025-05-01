<?php declare(strict_types=1);
/**
 * This file is part of the PHP_CompatInfo package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Bartlett\CompatInfo\Application\DataCollector;

use PhpParser\Node;

use function array_merge;
use function in_array;
use function version_compare;

/**
 * @author Laurent Laville
 * @since Release 5.4.0
 */
trait VersionUpdater
{
    /** @var array<string, mixed> */
    protected static array $php4 = [
        'ext.name' => 'user',
        'ext.min'  => '',
        'ext.max'  => '',
        'ext.all'  => '',
        'php.min'  => '4.0.0',
        'php.max'  => '',
        'php.all'  => '',
        'matches'  => 0,
        'declared' => false,
        'rules'    => [],
    ];

    /**
     * Updates the base version if current ref version is greater
     */
    protected function updateVersion(string $current, string &$base): bool
    {
        if (version_compare($current, $base, 'gt')) {
            $base = $current;
            return true;
        }
        return false;
    }

    /**
     * Updates the version of a specific element.
     *
     * @param array<string, mixed> $target
     * @param array<string, string> $versions
     */
    protected function updateElementVersion(array &$target, array $versions): bool
    {
        $updated = false;
        $allowedKeys = ['php.min', 'php.max', 'php.all'];

        if (isset($versions['ext.name']) && ($versions['declared'] ?? false) === false && 'user' !== $versions['ext.name']) {
            $allowedKeys = array_merge(['ext.min', 'ext.max', 'ext.all'], $allowedKeys);
            $target['ext.name'] = $versions['ext.name'];
        }

        foreach ($target as $key => &$value) {
            if (!in_array($key, $allowedKeys)) {
                // updates versions part only on above keys
                continue;
            }
            if (null === $value) {
                continue;
            }
            if ($this->updateVersion($versions[$key] ?? '', $value)) {
                $updated = true;
            }
        }
        return $updated;
    }

    /**
     * Updates the version of a specific element in a node of the AST.
     *
     * @param array<string, string> $versions
     */
    protected function updateNodeElementVersion(Node $node, string $attributeKey, array $versions): void
    {
        $currentVersion = $node->getAttribute($attributeKey, self::$php4);
        $this->updateElementVersion($currentVersion, $versions);
        $node->setAttribute($attributeKey, $currentVersion);
    }

    /**
     * Updates versions of an Extension.
     *
     * @param array<string, array<string, mixed>|string> $target
     * @param array<string, string> $versions
     */
    protected function updateExtension(string $name, array &$target, array $versions): bool
    {
        if (!isset($target[$name])) {
            $target[$name] = $versions;
            $target[$name]['ext.name'] = $name;
            return true;
        }

        return $this->updateElementVersion($target[$name], $versions);
    }
}
