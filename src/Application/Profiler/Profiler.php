<?php declare(strict_types=1);
/**
 * This file is part of the PHP_CompatInfo package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Bartlett\CompatInfo\Application\Profiler;

use Bartlett\CompatInfo\Application\DataCollector\DataCollectorInterface;

use Ramsey\Uuid\Uuid;

use function array_merge;

/**
 * @author Laurent Laville
 * @since Release 5.4.0
 */
final class Profiler implements ProfilerInterface
{
    use CollectorTrait;

    private string $token;

    public function __construct(?string $token)
    {
        if (empty($token)) {
            $this->token = Uuid::uuid4()->toString();
        } else {
            $this->token = $token;
        }
    }

    /**
     * @inheritDoc
     */
    public function reset(): void
    {
        foreach ($this->collectors as $collector) {
            $collector->reset();
        }
    }

    /**
     * @inheritDoc
     */
    public function collect(): Profile
    {
        $data = ['files' => [], 'errors' => []];

        foreach ($this->getCollectors() as $collector) {
            /** @var DataCollectorInterface $collector */
            $data[$collector->getName()] = $collector->getData();
            $data['files'] = array_merge($data['files'], $collector->getFiles());
            $data['errors'] = array_merge($data['errors'], $collector->getErrors());
        }

        return new Profile($this->token, $data);
    }
}
