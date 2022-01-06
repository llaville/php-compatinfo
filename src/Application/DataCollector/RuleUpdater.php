<?php declare(strict_types=1);
/**
 * This file is part of the PHP_CompatInfo package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Bartlett\CompatInfo\Application\DataCollector;

use PhpParser\Node;

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
        $nodeStore['rule'] = $ruleId;
        $node->setAttribute($attributeKey, $nodeStore);
    }
}
