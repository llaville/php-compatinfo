<?php declare(strict_types=1);

namespace Bartlett\CompatInfo\Application\Profiler;

/**
 * @since Release 5.4.0
 */
final class Profile implements CollectorInterface
{
    private string $token;
    /** @var array<string, mixed> */
    private array $data;

    use CollectorTrait;

    /**
     * Profile constructor.
     *
     * @param string $token
     * @param array<string, mixed> $data
     */
    public function __construct(string $token, iterable $data)
    {
        $this->token = $token;
        $this->data = $data;
    }

    /**
     * @return array<string, array<string, mixed>>
     */
    public function getData(): array
    {
        return [$this->token => $this->data];
    }
}
