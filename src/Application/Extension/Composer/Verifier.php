<?php declare(strict_types=1);
/**
 * This file is part of the PHP_CompatInfo package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Bartlett\CompatInfo\Application\Extension\Composer;

use Composer\Semver\Comparator;
use Composer\Semver\Semver;

use Bartlett\CompatInfoDb\Application\Query\Show\ShowQuery;
use Bartlett\CompatInfoDb\Application\Query\Show\ShowHandler;
use Bartlett\CompatInfoDb\Domain\Factory\ExtensionFactory;
use Bartlett\CompatInfoDb\Domain\ValueObject\Extension;

/**
 * Verifies an analyser result set against parsed composer.json data.
 */
final class Verifier
{
    public const MESSAGE_TYPE_INFO = 1;
    public const MESSAGE_TYPE_WARNING = 2;
    public const MESSAGE_TYPE_ERROR = 3;

    private MinimalAnalyserResult $_minimalAnalyserResult;
    private Parser $_composerJsonParser;

    private array $_composerRequire;
    private ?string $_composerPhpVersion;

    private array $_messages;

    /**
     * @param MinimalAnalyserResult $minimalAnalyserResult
     * @param Parser $composerJsonParser
     */
    public function __construct(MinimalAnalyserResult $minimalAnalyserResult, Parser $composerJsonParser)
    {
        $this->_minimalAnalyserResult = $minimalAnalyserResult;
        $this->_composerJsonParser = $composerJsonParser;

        $this->_composerRequire = $composerJsonParser->getRequire();
        $this->_composerPhpVersion = $composerJsonParser->getPhpVersion();
    }

    /**
     * Verify if the composer file matches the analysis result.
     *
     * @return bool
     */
    public function verify(): bool
    {
        // 1) internal composer.json check if there is a mismatch between require-php and config-platform-php versions

        if ($this->_composerPhpVersion && isset($this->_composerRequire['php'])) {
            if (!Semver::satisfies($this->_composerPhpVersion, $this->_composerRequire['php'])) {
                $this->addMessage(
                    self::MESSAGE_TYPE_ERROR,
                    sprintf(
                        'configured php platform version %s in composer.json does not match the required php version constraint %s',
                        $this->_composerPhpVersion,
                        $this->_composerRequire['php']
                    ));
            } else {
                $this->addMessage(
                    self::MESSAGE_TYPE_INFO,
                    sprintf(
                        'configured php platform version %s in composer.json matches the required php version constraint %s',
                        $this->_composerPhpVersion,
                        $this->_composerRequire['php']
                    ));
            }
        }

        // 2) php version check: check if requires-php is valid

        if (isset($this->_composerRequire['php'])) {
            // -> required range should be >= than min version from analysis
            if (isset($this->_minimalAnalyserResult->getVersions()['php.min']) && !empty($this->_minimalAnalyserResult->getVersions()['php.min'])) {
                if (!Semver::satisfies($this->_minimalAnalyserResult->getVersions()['php.min'], $this->_composerRequire['php'])) {
                    $this->addMessage(
                        self::MESSAGE_TYPE_ERROR,
                        sprintf(
                            'minimal required php version %s from analysis does not match the required php version constraint in composer.json %s',
                            $this->_minimalAnalyserResult->getVersions()['php.min'],
                            $this->_composerRequire['php']
                        ));
                } else {
                    $this->addMessage(
                        self::MESSAGE_TYPE_INFO,
                        sprintf(
                            'minimal required php version %s from analysis matches the required php version constraint in composer.json %s',
                            $this->_minimalAnalyserResult->getVersions()['php.min'],
                            $this->_composerRequire['php']
                        ));
                }
            }

            // -> required range should be <= than max version from analysis
            if (isset($this->_minimalAnalyserResult->getVersions()['php.max']) && !empty($this->_minimalAnalyserResult->getVersions()['php.max'])) {
                if (!Semver::satisfies($this->_minimalAnalyserResult->getVersions()['php.max'], $this->_composerRequire['php'])) {
                    $this->addMessage(
                        self::MESSAGE_TYPE_ERROR,
                        sprintf(
                            'maximal required php version %s from analysis does not match the required php version constraint in composer.json %s',
                            $this->_minimalAnalyserResult->getVersions()['php.max'],
                            $this->_composerRequire['php']
                        ));
                } else {
                    $this->addMessage(
                        self::MESSAGE_TYPE_INFO,
                        sprintf(
                            'maximal required php version %s from analysis matches the required php version constraint in composer.json %s',
                            $this->_minimalAnalyserResult->getVersions()['php.max'],
                            $this->_composerRequire['php']
                        ));
                }
            }
        } else {
            if (isset($this->_minimalAnalyserResult->getVersions()['php.min'])) {
                $this->addMessage(
                    self::MESSAGE_TYPE_INFO,
                    sprintf(
                        'composer minimum php version should be set to at least %s',
                        $this->_minimalAnalyserResult->getVersions()['php.min']
                    )
                );
            }
            if (isset($this->_minimalAnalyserResult->getVersions()['php.max'])) {
                $this->addMessage(
                    self::MESSAGE_TYPE_INFO,
                    sprintf(
                        'composer maximum php version should be set to %s',
                        $this->_minimalAnalyserResult->getVersions()['php.max']
                    )
                );
            }
        }


        // 3) php version check: check if config-platform-php is valid

        if ($this->_composerPhpVersion) {
            if (isset($this->_minimalAnalyserResult->getVersions()['php.min']) && !empty($this->_minimalAnalyserResult->getVersions()['php.min'])) {
                // -> should be >= than min version from analysis
                if (!Comparator::greaterThanOrEqualTo($this->_composerPhpVersion, $this->_minimalAnalyserResult->getVersions()['php.min'])) {
                    $this->addMessage(
                        self::MESSAGE_TYPE_ERROR,
                        sprintf(
                            'the composer.json platform-php config %s is not >= the required php minimal version %s from analysis',
                            $this->_composerPhpVersion,
                            $this->_minimalAnalyserResult->getVersions()['php.min']
                        ));
                } else {
                    $this->addMessage(
                        self::MESSAGE_TYPE_INFO,
                        sprintf(
                            'the composer.json platform-php config %s is >= the required php minimal version %s from analysis',
                            $this->_composerPhpVersion,
                            $this->_minimalAnalyserResult->getVersions()['php.min']
                        ));
                }
            }
            if (isset($this->_minimalAnalyserResult->getVersions()['php.max']) && !empty($this->_minimalAnalyserResult->getVersions()['php.max'])) {
                // -> should be <= than max version from analysis
                if (!Comparator::lessThanOrEqualTo($this->_composerPhpVersion, $this->_minimalAnalyserResult->getVersions()['php.max'])) {
                    $this->addMessage(
                        self::MESSAGE_TYPE_ERROR,
                        sprintf(
                            'the composer.json platform-php config %s is not <= the required php maximal version %s from analysis',
                            $this->_composerPhpVersion,
                            $this->_minimalAnalyserResult->getVersions()['php.max']
                        ));
                } else {
                    $this->addMessage(
                        self::MESSAGE_TYPE_INFO,
                        sprintf(
                            'the composer.json platform-php config %s is <= the required php maximal version %s from analysis',
                            $this->_composerPhpVersion,
                            $this->_minimalAnalyserResult->getVersions()['php.max']
                        ));
                }
            }
        }

        // 4) check if all required extensions are there

        $composerRequiredPhpExtensions = $this->_composerJsonParser->getExtensions();

        $traversedAnalyserExtensions = [];

        foreach ($this->_minimalAnalyserResult->getExtensions() as $extension => $data) {
            var_export($extension, true);
            var_export($data, true);
            $traversedAnalyserExtensions[] = $extension;
            if (array_key_exists($extension, $composerRequiredPhpExtensions)) {
                $this->addMessage(
                    self::MESSAGE_TYPE_INFO,
                    sprintf(
                        'the required extension %s (>= version %s) is listed in composer.json %s (version %s)',
                        $extension,
                        $data['ext.min'],
                        'ext-'.$extension,
                        $composerRequiredPhpExtensions[$extension]
                    ));
            } else {
                if (self::getExtensionIsOptionalInfo($extension)) {
                    $this->addMessage(
                        self::MESSAGE_TYPE_ERROR,
                        sprintf(
                            'the required extension %s (>= version %s) is optional and not listed in composer.json',
                            $extension,
                            $data['ext.min']
                        ));
                } else {
                    $this->addMessage(
                        self::MESSAGE_TYPE_INFO,
                        sprintf(
                            'the required extension %s (>= version %s) is not listed in composer.json but bundled',
                            $extension,
                            $data['ext.min']
                        ));
                }
            }
        }

        // @TODO do we also support extension version checks?

        // 5) list composer required extensions that are not part of the analysis result

        foreach ($composerRequiredPhpExtensions as $requiredExtensionName => $requiredExtensionVersion) {
            if (!in_array($requiredExtensionName, $traversedAnalyserExtensions)) {
                $this->addMessage(
                    self::MESSAGE_TYPE_WARNING,
                    sprintf(
                        'the extension %s (version %s) which is listed in composer.json was not found by the analyser, might be removed from the requirements (make sure you also check your dependencies before removing)',
                        $requiredExtensionName,
                        $requiredExtensionVersion
                    ));
            }
        }

        return !$this->haveErrorsInMessages();
    }

    /**
     * Crude way to get the is-optional information from compatInfoDB json files.
     *
     * @TODO should be fully replaced by the correct call to the compatInfoDB
     *
     * @param string $extensionName
     * @return bool
     */
    public static function getExtensionIsOptionalInfo(string $extensionName): bool
    {
        $isOptional = true;

        // crude way to not allow unwanted directory traversal
        $sanitizedName = str_replace(['/', '.'], ['', ''], $extensionName);

        $jsonPath = __DIR__.'/../../../../vendor/bartlett/php-compatinfo-db/data/reference/extension/'.$sanitizedName.'/extensions.json';

        if (file_exists($jsonPath)) {
            $jsonContent = json_decode(file_get_contents($jsonPath), true);
            $isOptional = $jsonContent['type'] !== 'bundle';
        }

        return $isOptional;
    }

    /**
     * @param int $type
     * @param string $message
     * @return void
     */
    private function addMessage(int $type = self::MESSAGE_TYPE_INFO, string $message = ''): void
    {
        $this->_messages[] = [
            'type' => $type,
            'message' => $message
        ];
    }

    /**
     * @return bool
     */
    public function haveErrorsInMessages(): bool
    {
        foreach ($this->_messages as $message) {
            if ($message['type'] === self::MESSAGE_TYPE_ERROR) {
                return true;
            }
        }

        return false;
    }

    /**
     * Return messages for wrong or missing composer.json entries.
     *
     * @return array
     */
    public function getMessages(): array
    {
        return $this->_messages;
    }
}
