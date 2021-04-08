<?php declare(strict_types=1);

/**
 * Collect and analyse metrics of parsing results.
 *
 * PHP version 7
 *
 * @category PHP
 * @package  PHP_CompatInfo
 * @author   Laurent Laville <pear@laurent-laville.org>
 * @license  https://opensource.org/licenses/BSD-3-Clause The 3-Clause BSD License
*/

namespace Bartlett\CompatInfo\Api;

use Bartlett\CompatInfo\Profiler\Profile;
use Bartlett\Reflect\Api\BaseApi;

use function func_get_args;

/**
 * Collect and analyse metrics of parsing results.
 *
 * @category PHP
 * @package  PHP_CompatInfo
 * @author   Laurent Laville <pear@laurent-laville.org>
 * @license  https://opensource.org/licenses/BSD-3-Clause The 3-Clause BSD License
 * @since    Class available since Release 5.4.0
 */
class Analyser extends BaseApi
{
    /**
     * Analyse a data source and display results.
     *
     * @param string $source Path to the data source
     * @param array $exclude Sets excluded file or directory names for scanning
     * @param bool $stop_on_failure Stop execution upon first error generated during lexing, parsing or some other operation
     *
     * @return Profile
     */
    public function run(string $source, array $exclude = [], bool $stop_on_failure = null): Profile
    {
        return $this->request('analyser/run', 'POST', func_get_args());
    }
}
