<?php declare(strict_types=1);
/**
 * This file is part of the PHP_CompatInfo package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Bartlett\CompatInfo\Application\Profiler;

/**
 * @author Laurent Laville
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
