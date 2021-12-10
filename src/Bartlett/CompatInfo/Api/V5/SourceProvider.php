<?php declare(strict_types=1);

namespace Bartlett\CompatInfo\Api\V5;

use Symfony\Component\Finder\Finder;

use function is_dir;
use function is_file;
use function pathinfo;
use function realpath;
use function substr;
use const PATH_SEPARATOR;

/**
 * @since Class available since Release 5.4.0
 */
class SourceProvider
{
    public function getFinder(string $source, array $exclude): ?Finder
    {
        $source = trim($source);

        $src = realpath($source);

        if (false === $src) {
            return null;
        }

        if (PATH_SEPARATOR == ';') {
            // on windows platform, remove the drive identifier
            $src = substr($src, 2);
        }

        if (is_dir($src)) {
            $provider = array('in' => $src);
        } elseif (is_file($src)) {
            $ext = pathinfo($src, PATHINFO_EXTENSION);

            if (in_array($ext, array('phar', 'zip', 'gz', 'tar', 'tgz', 'rar'))) {
                // archive file
                $provider = array('in' => 'phar://' . $src);
            } else {
                $provider = array('in' => dirname($src), 'name' => basename($src), 'depth' => 0);
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
