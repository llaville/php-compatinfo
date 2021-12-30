<?php declare(strict_types=1);
/**
 * This file is part of the PHP_CompatInfo package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Bartlett\CompatInfo\Application\Service;

use Symfony\Component\Finder\Finder;

use function is_dir;
use function pathinfo;
use function realpath;
use function substr;
use const PATH_SEPARATOR;

/**
 * @author Laurent Laville
 * @since 5.4.0, 6.0.0
 */
class SourceProvider
{
    /**
     * @param string $source
     * @param string[] $exclude
     * @return Finder
     */
    public static function getFinder(string $source, array $exclude): Finder
    {
        $src = $source;

        if (PATH_SEPARATOR == ';') {
            // on windows platform, remove the drive identifier
            $src = substr($src, 2);
        }

        if (is_dir($src)) {
            $provider = ['in' => $src];
        } else {
            $ext = pathinfo($src, PATHINFO_EXTENSION);

            if (in_array($ext, ['phar', 'zip', 'gz', 'tar', 'tgz', 'rar'])) {
                // archive file
                $provider = ['in' => 'phar://' . $src];
            } else {
                $provider = ['in' => dirname($src), 'name' => basename($src), 'depth' => 0];
            }
        }

        if (substr($provider['in'], 0, 1) == '.') {
            // relative local file
            $provider['in'] = realpath($provider['in']);
        }
        if (PATH_SEPARATOR == ';') {
            // normalizes path to unix format
            $provider['in'] = str_replace(DIRECTORY_SEPARATOR, '/', $provider['in']);
        }
        if (!isset($provider['name'])) {
            // default file extensions to scan
            $provider['name'] = '/\\.(php|inc|phtml)$/';
        }

        $finder = new Finder();
        $finder
            ->files()
            ->in($provider['in'])
            ->exclude($exclude)
            ->name($provider['name'])
        ;
        if (isset($provider['depth'])) {
            $finder->depth('== ' . $provider['depth']);
        }
        return $finder;
    }
}
