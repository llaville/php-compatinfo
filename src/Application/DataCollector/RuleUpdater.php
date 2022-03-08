<?php declare(strict_types=1);
/**
 * This file is part of the PHP_CompatInfo package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Bartlett\CompatInfo\Application\DataCollector;

use PhpParser\Node;

use function get_class;
use function iterator_to_array;
use function strrchr;
use function substr;

/**
 * @author Laurent Laville
 * @since Release 6.1.0
 */
trait RuleUpdater
{
    protected function updateNodeElementRule(Node $node, string $attributeKey, string $ruleId): void
    {
        if (empty($ruleId)) {
            return;
        }
        $nodeStore = $node->getAttribute($attributeKey);
        $nodeStore['rules'][$ruleId] = $this->getRule($ruleId);
        $node->setAttribute($attributeKey, $nodeStore);
    }

    /**
     * @return array<string, string>
     */
    protected function getRule(string $id): array
    {
        $rules = iterator_to_array(static::getRules(), true);
        return [$rules[$id]['name'] => $rules[$id]['fullDescription']];
    }

    /**
     * @see https://stackoverflow.com/questions/19901850/how-do-i-get-an-objects-unqualified-short-class-name
     */
    protected function getShortClass(): string
    {
        return substr(strrchr(get_class($this), '\\'), 1);
    }
}
