<?php declare(strict_types=1);
/**
 * This file is part of the PHP_CompatInfo package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Bartlett\CompatInfo\Application\PhpParser\NodeVisitor;

use Doctrine\Common\Collections\ArrayCollection;

use PhpParser\Node;
use PhpParser\NodeVisitor\FindingVisitor;

use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

use function array_replace;

/**
 * @author Laurent Laville
 * @since Release 5.4.0
 */
class FilterVisitor extends FindingVisitor implements NodeVisitor
{
    protected NormalizerInterface $normalizer;
    /** @var array<string, string> */
    protected array $context;

    /**
     * FilterVisitor constructor.
     *
     * @param NormalizerInterface $normalizer
     * @param array<string, string> $context
     */
    public function __construct(NormalizerInterface $normalizer, array $context = [])
    {
        $this->normalizer = $normalizer;

        $default = [
            'nodeAttributeParentKeyStore' => 'bartlett.parent',
            'nodeAttributeKeyStore' => 'bartlett.data_collector',
        ];
        $this->context = array_replace($default, $context);

        $key = $this->context['nodeAttributeKeyStore'];
        $filterCallback = function (Node $node) use ($key) {
            return $node->hasAttribute($key);
        };

        parent::__construct($filterCallback);
    }

    /**
     * @return ArrayCollection<int, mixed>
     */
    public function getCollection(): ArrayCollection
    {
        $collection = new ArrayCollection($this->getFoundNodes());

        $mappedCollection =
            $collection->map(function ($node) {
                return $this->normalizer->normalize($node, '', $this->context);
            })
        ;

        return
            $mappedCollection->filter(function ($value) {
                return null !== $value;
            })
        ;
    }
}
