<?php declare(strict_types=1);
/**
 * This file is part of the PHP_CompatInfo package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Bartlett\CompatInfo\Application\Profiler;

use Exception;

/**
 * @author Laurent Laville
 * @since Release 6.0.0
 */
interface ProfilerInterface extends CollectorInterface
{
    /**
     * Resets all Collectors to theirs initial state.
     */
    public function reset(): void;

    /**
     * Collects all data from each Collector attached to this Profiler.
     *
     * @return Profile
     * @throws Exception
     */
    public function collect(): Profile;
}
