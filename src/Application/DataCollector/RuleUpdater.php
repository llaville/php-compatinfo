<?php declare(strict_types=1);

namespace Bartlett\CompatInfo\Application\DataCollector;

use PhpParser\Node;

/**
 * @since Release 6.1.0
 * @author Laurent Laville
 */
trait RuleUpdater
{
    protected function updateNodeElementRule(Node $node, string $attributeKey, string $ruleId): void
    {
        if (empty($ruleId)) {
            return;
        }
        $nodeStore = $node->getAttribute($attributeKey);
        $nodeStore['rule'] = $ruleId;
        $node->setAttribute($attributeKey, $nodeStore);
    }
}
