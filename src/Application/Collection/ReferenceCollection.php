<?php declare(strict_types=1);
/**
 * This file is part of the PHP_CompatInfo package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Bartlett\CompatInfo\Application\Collection;

use Bartlett\CompatInfoDb\Domain\Repository\ClassRepository;
use Bartlett\CompatInfoDb\Domain\Repository\ConstantRepository;
use Bartlett\CompatInfoDb\Domain\Repository\FunctionRepository;

use Doctrine\Common\Collections\AbstractLazyCollection;
use Doctrine\Common\Collections\ArrayCollection;

use function array_pop;
use function array_slice;
use function in_array;
use function str_contains;

/**
 * Reference collection that collect information for the compatibility analyser.
 *
 * @phpstan-extends AbstractLazyCollection<string, array>
 * @author Laurent Laville
 * @since Release 4.0.0-alpha3
 */
final class ReferenceCollection extends AbstractLazyCollection implements ReferenceCollectionInterface
{
    private ClassRepository $classRepository;
    private ConstantRepository $constantRepository;
    private FunctionRepository $functionRepository;

    /**
     * Creates a new Reference Collection
     */
    public function __construct(
        ClassRepository $classRepository,
        ConstantRepository $constantRepository,
        FunctionRepository $functionRepository
    ) {
        $this->classRepository = $classRepository;
        $this->constantRepository = $constantRepository;
        $this->functionRepository = $functionRepository;
    }

    /**
     * @inheritDoc
     */
    public function find(string $group, string $key, int $argc = 0, ?string $extra = null): array
    {
        $this->initialize();

        if ($this->containsKey($key)) {
            $result = $this->get($key);
        } else {
            if (in_array($group, ['functions', 'methods'])) {
                $function = $this->functionRepository->getFunctionByName($key, $extra);
                if (null === $function) {
                    $result = false;
                } else {
                    $result = [
                        'ext.name'     => $function->getExtensionName(),
                        'ext.min'      => $function->getExtMin(),
                        'ext.max'      => $function->getExtMax(),
                        'php.min'      => $function->getPhpMin(),
                        'php.max'      => $function->getPhpMax(),
                        'parameters'   => $function->getParameters(),
                        'php.excludes' => $function->getExcludes(),
                        'polyfill'     => $function->getPolyfill(),
                    ];
                }
            } elseif ('constants' === $group) {
                $constant = $this->constantRepository->getConstantByName($key, $extra);
                if (null === $constant) {
                    $result = false;
                } else {
                    $result = [
                        'ext.name' => $constant->getExtensionName(),
                        'ext.min'  => $constant->getExtMin(),
                        'ext.max'  => $constant->getExtMax(),
                        'php.min'  => $constant->getPhpMin(),
                        'php.max'  => $constant->getPhpMax(),
                        'polyfill' => $constant->getPolyfill(),
                    ];
                }
            } elseif (in_array($group, ['classes', 'interfaces'])) {
                $classLike = $this->classRepository->getClassByName($key, ('interfaces' === $group));
                if (null === $classLike) {
                    $result = false;
                } else {
                    $result = [
                        'ext.name' => $classLike->getExtensionName(),
                        'ext.min'  => $classLike->getExtMin(),
                        'ext.max'  => $classLike->getExtMax(),
                        'php.min'  => $classLike->getPhpMin(),
                        'php.max'  => $classLike->getPhpMax(),
                    ];
                }
            } else {
                $result = false;
            }

            if (!$result) {
                // when not found in database, should be a user or an unknown extension element
                if (!str_contains($key, '\\')) {
                    // not qualified
                    $min = '4.0.0';
                } else {
                    $min = '5.3.0';
                }
                $result = [
                    'ext.name' => 'user',
                    'ext.min'  => '',
                    'ext.max'  => '',
                    'php.min'  => $min,
                    'php.max'  => '',
                ];
            }
            // cache to speed-up later uses
            if ('user' !== $result['ext.name']) {
                $this->set($key, $result);
            }
        }

        // compute the right version depending on number of arguments used
        if (!empty($result['parameters'])) {
            $parameters = array_slice($result['parameters'], 0, $argc);
            if (!empty($parameters)) {
                $result['php.min'] = array_pop($parameters);

                if (in_array($result['ext.name'], ['core', 'standard'])) {
                    $result['ext.min'] = $result['php.min'];
                }
            }
        }
        $result['arg.max'] = $argc;
        return $result;
    }

    /**
     * @inheritDoc
     */
    protected function doInitialize(): void
    {
        $this->collection = new ArrayCollection();
    }
}
