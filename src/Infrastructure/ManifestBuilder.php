<?php declare(strict_types=1);
/**
 * This file is part of the PHP_CompatInfo package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Bartlett\CompatInfo\Infrastructure;

use Bartlett\BoxManifest\Composer\ManifestBuilderInterface;
use Bartlett\BoxManifest\Composer\ManifestFactory;

use KevinGH\Box\Box;
use KevinGH\Box\Configuration\Configuration;

use function implode;
use function phpversion;
use function sprintf;
use function substr;
use const PHP_EOL;

/**
 * @author Laurent Laville
 * @since Release 6.3.0
 */
final class ManifestBuilder implements ManifestBuilderInterface
{
    private const PREFIX = 'bartlett/php-compatinfo';

    public static function toText(Configuration $config, Box $box): ?string
    {
        return ManifestFactory::create(self::class, $config, $box);
    }

    /**
     * {@inheritDoc}
     */
    public function __invoke(array $content): string
    {
        $composerJson = $content['composer.json'];
        $installedPhp = $content['installed.php'];
        $rootPackage = $installedPhp['root'];
        $entries = [];

        if (isset($rootPackage['pretty_version'])) {
            $version = sprintf(
                '%s@%s',
                $rootPackage['pretty_version'],
                substr($rootPackage['reference'], 0, 7)
            );
        } else {
            $version = $rootPackage['version'];
        }
        $entries[] = sprintf('%s: <info>%s</info>', $rootPackage['name'], $version);

        $allRequirements = [
            '' => $composerJson['require'],
            ' (for development)' => $composerJson['require-dev'],
        ];

        foreach ($allRequirements as $category => $requirements) {
            foreach ($requirements as $req => $constraint) {
                $prefix = self::PREFIX . ' ';
                if (!empty($constraint)) {
                    $constraint = sprintf('<comment>%s</comment>', $constraint);
                    $prefix .= 'requires';
                } else {
                    $prefix .= 'uses';
                }
                $installedPhp['versions'][$req]['prefix'] = $prefix;
                if ('php' === $req) {
                    $entries[] = sprintf('%s%s %s: <info>%s</info>', $prefix, $category, "$req $constraint", phpversion());
                } elseif (substr($req, 0, 4) === 'ext-') {
                    $extension = substr($req, 4);
                    $entries[] = sprintf('%s%s %s: <info>%s</info>', $prefix, $category, "$req $constraint", phpversion($extension));
                } else {
                    $installedPhp['versions'][$req]['constraint'] = $constraint;
                    $installedPhp['versions'][$req]['category'] = $category;
                }
            }
        }

        foreach ($installedPhp['versions'] as $package => $values) {
            if ($rootPackage['name'] === $package) {
                continue;
            }
            if (isset($values['pretty_version'])) {
                $category = $values['category'] ?? '';
                $constraint = $values['constraint'] ?? '';
                $prefix = $values['prefix'] ?? self::PREFIX . ' uses';
                $entries[] = sprintf('%s%s %s: <info>%s</info>', $prefix, $category, "$package $constraint", $values['pretty_version']);
            } // otherwise, it's a virtual package
        }

        return implode(PHP_EOL, $entries);
    }
}
