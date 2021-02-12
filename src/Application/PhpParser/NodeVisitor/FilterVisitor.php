<?php declare(strict_types=1);

namespace Bartlett\CompatInfo\Application\PhpParser\NodeVisitor;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

use PhpParser\Node;
use PhpParser\NodeVisitor\FindingVisitor;

use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

use function array_replace;

/**
 * @since Release 5.4.0
 */
class FilterVisitor extends FindingVisitor implements NodeVisitor
{
    /** @var NormalizerInterface */
    protected $normalizer;

    /** @var array */
    protected $context;

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
     * {@inheritDoc}
     */
    public function getCollection(): Collection
    {
        $collection = new ArrayCollection($this->getFoundNodes());

        $mappedCollection =
            $collection->map(function($node) {
                return $this->normalizer->normalize($node, '', $this->context);
            })
        ;

        return
            $mappedCollection->filter(function (array $value) {
                return null !== $value;
            })
        ;
    }
}
