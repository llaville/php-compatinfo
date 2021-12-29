<?php declare(strict_types=1);
/**
 * This file is part of the PHP_CompatInfoDB package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

require_once __DIR__ . '/vendor/autoload.php';

use Composer\Factory;
use Composer\IO\NullIO;

/**
 * Composer script that prepare metadata to compile PHAR version of application.
 *
 * @author Laurent Laville
 */
class ComposerScripts
{
    /**
     * Generate metadata when box compile read metadata directive.
     *
     * @return null|array<int, string>
     */
    public static function getPharMetadata(): ?array
    {
        $composer = Factory::create(new NullIO());
        $locker = $composer->getLocker();

        try {
            $lockData = $locker->getLockData();
        } catch (LogicException $e) {
            // Composer installation was not run.
            return null;
        }

        $installed = [];

        foreach (array_keys($lockData['platform']) as $type) {
            if ('php' === $type) {
                $installed[$type] = phpversion();
            } else {
                $installed[$type] = phpversion(str_replace('ext-', '', $type));
            }
        }

        foreach ($lockData['packages'] as $package) {
            $installed[$package['name']] = $package['version'];
        }

        foreach ($lockData['packages-dev'] as $package) {
            $installed[$package['name']] = $package['version'];
        }

        $rootPackage = $composer->getPackage();

        $componentCollection = [];

        $requires = array_merge(
            $rootPackage->getRequires(),
            $rootPackage->getDevRequires()
        );

        foreach ($requires as $type => $require) {
            $prettyString = (string) $require->getPrettyString($rootPackage);
            if (isset($installed[$type])) {
                $prettyString .= sprintf(' : <info>%s</info>', $installed[$type]);
            }
            $componentCollection[] = $prettyString;
        }

        return $componentCollection;
    }
}
return ComposerScripts::getPharMetadata();
