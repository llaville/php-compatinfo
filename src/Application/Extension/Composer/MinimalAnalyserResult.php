<?php declare(strict_types=1);
/**
 * This file is part of the PHP_CompatInfo package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Bartlett\CompatInfo\Application\Extension\Composer;

use Bartlett\CompatInfo\Application\Analyser\CompatibilityAnalyser;

/**
 * Get and hold just the analyser information we need for our task.
 */
final class MinimalAnalyserResult
{
    private $_versions;
    private $_extensions;

    public function setVersions($versions)
    {
        $this->_versions = $versions;
    }

    public function getVersions()
    {
        return $this->_versions;
    }

    public function setExtensions($extensions)
    {
        $this->_extensions = $extensions;
    }

    public function getExtensions()
    {
        return $this->_extensions;
    }

    /**
     * @param mixed $profileData
     * @return MinimalAnalyserResult
     */
    public static function fromProfileFactory($profileData): MinimalAnalyserResult
    {
        $result = new self();

        $data = reset($profileData);

        if (!array_key_exists(CompatibilityAnalyser::class, $data))
        {
            throw new \RuntimeException('unable to collect compatibilityData from compatinfo queryResult');
        }

        $compatibilityData = $data[CompatibilityAnalyser::class];

        $result->setVersions($compatibilityData['versions']);
        $result->setExtensions($compatibilityData['extensions']);

        return $result;
    }
}
