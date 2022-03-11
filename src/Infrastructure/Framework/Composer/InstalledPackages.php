<?php declare(strict_types=1);
/**
 * This file is part of the PHP_CompatInfo package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Bartlett\CompatInfo\Infrastructure\Framework\Composer;

use Bartlett\CompatInfo\Application\Analyser\CompatibilityAnalyser;
use Bartlett\CompatInfo\Application\Query\Analyser\Compatibility\GetCompatibilityQuery;
use Bartlett\CompatInfo\Application\Query\QueryBusInterface;
use Bartlett\CompatInfo\Infrastructure\Framework\Symfony\DependencyInjection\ContainerFactory;

use Composer\InstalledVersions;

use OutOfBoundsException;
use Throwable;
use function array_flip;
use function array_intersect;
use function file_get_contents;
use function file_put_contents;
use function getenv;
use function json_decode;
use function json_encode;
use const JSON_PRETTY_PRINT;

/**
 * @author Laurent Laville
 * @since Release 6.4.0
 */
final class InstalledPackages extends InstalledVersions
{
    /**
     * @return array<string, mixed>
     */
    public static function getInstalledPolyfills(): array
    {
        $polyfillsCache = getenv('APP_CACHE_DIR') . DIRECTORY_SEPARATOR . 'php-compatinfo-polyfills.lock';
        if (file_exists($polyfillsCache)) {
            return json_decode(file_get_contents($polyfillsCache), true);
        }

        $polyfillPackages = [
            'paragonie/random_compat',
            'ircmaxell/password_compat',
            'symfony/polyfill-apcu',
            'symfony/polyfill-ctype',
            'symfony/polyfill-php72',
            'symfony/polyfill-php73',
            'symfony/polyfill-php74',
            'symfony/polyfill-php80',
            'symfony/polyfill-php81',
            'symfony/polyfill-iconv',
            'symfony/polyfill-intl-grapheme',
            'symfony/polyfill-intl-icu',
            'symfony/polyfill-intl-messageformatter',
            'symfony/polyfill-intl-idn',
            'symfony/polyfill-intl-normalizer',
            'symfony/polyfill-mbstring',
            'symfony/polyfill-util',
            'symfony/polyfill-uuid',
            'symfony/polyfill-xml',
        ];

        $installedPackages = parent::getInstalledPackages();

        $installedPolyfills = array_flip(
            array_intersect($polyfillPackages, $installedPackages)
        );
        foreach ($installedPolyfills as $packageName => $path) {
            try {
                $source = InstalledVersions::getInstallPath($packageName);
                $installedPolyfills[$packageName] = [
                    'source' => $source,
                    'constants' => [],
                    'functions' => [],
                ];
            } catch (OutOfBoundsException $e) {
            }
        }

        $container = (new ContainerFactory())->create();
        $queryBus = $container->get(QueryBusInterface::class);

        foreach ($installedPolyfills as $polyfill => $values) {
            $compatibilityQuery = new GetCompatibilityQuery(
                $values['source'],
                [],
                false,
                ''
            );

            try {
                $profile = $queryBus->query($compatibilityQuery);
                $data = $profile->getData();
                $response = reset($data);
                $conditions = $response[CompatibilityAnalyser::class]['conditions'];

                foreach (array_keys($conditions) as $condition) {
                    $matches = [];
                    preg_match('/(defined|function_exists|extension_loaded)\((.*)\)/', $condition, $matches);

                    if ($matches[1] === 'defined') {
                        $installedPolyfills[$polyfill]['constants'][] = $matches[2];
                    } elseif ($matches[1] === 'function_exists') {
                        $installedPolyfills[$polyfill]['functions'][] = $matches[2];
                    }
                }
            } catch (Throwable $e) {
            }
        }

        file_put_contents($polyfillsCache, json_encode($installedPolyfills, JSON_PRETTY_PRINT));
        return $installedPolyfills;
    }
}
