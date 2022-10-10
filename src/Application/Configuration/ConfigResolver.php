<?php declare(strict_types=1);
/**
 * This file is part of the PHP_CompatInfo package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Bartlett\CompatInfo\Application\Configuration;

use Symfony\Component\Console\Input\InputInterface;

use function in_array;
use function sprintf;
use function sscanf;
use const PHP_MAJOR_VERSION;
use const PHP_MINOR_VERSION;

/**
 * @author Laurent Laville
 * @since Release 6.5.0
 */
final class ConfigResolver
{
    private InputInterface $input;

    public function __construct(InputInterface $input)
    {
        $this->input = $input;
    }

    /**
     * @return string[]
     */
    public function provide(): array
    {
        $input = $this->input;

        $configFiles = [];

        if ($input->hasParameterOption('--php', true)) {
            $phpVersion = $input->getParameterOption('--php', null, true);
            list($major, $minor) = sscanf($phpVersion, "%d.%d");
        } else {
            $major = PHP_MAJOR_VERSION;
            $minor = PHP_MINOR_VERSION;
        }
        if (in_array($major, ['5', '7', '8'])) {
            $configFiles[] = sprintf('up-to-php%d%d.php', $major, $minor);
        }

        if ($input->hasParameterOption('--debug', true)) {
            $configFiles[] = 'default-logger.php';
        }

        if ($input->hasParameterOption('--no-polyfills', true)) {
            $configFiles[] = 'without-polyfill.php';
        } else {
            $configFiles[] = 'default-polyfill.php';
        }

        $configFile = $this->getOptionValue($this->input);
        if ($configFile !== null) {
            $configFiles[] = $configFile;
        } else {
            $configFiles[] = 'default.php';
        }

        return $configFiles;
    }

    private function getOptionValue(InputInterface $input): ?string
    {
        foreach (['--config', '-c'] as $optionName) {
            if ($input->hasParameterOption($optionName, true)) {
                return $input->getParameterOption($optionName, null, true);
            }
        }

        return null;
    }
}
