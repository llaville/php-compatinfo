<?php declare(strict_types=1);
/**
 * This file is part of the PHP_CompatInfo package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Bartlett\CompatInfo\Application\Sniffs\FunctionDeclarations;

use Bartlett\CompatInfo\Application\Sniffs\SniffAbstract;

use PhpParser\Node;

use Generator;
use function in_array;
use function strcasecmp;

/**
 * Return Type Declarations since PHP 7.0.0 alpha1
 *
 * @author Laurent Laville
 * @since Release 5.4.0
 *
 * @link https://wiki.php.net/rfc/return_types
 * @link https://www.php.net/manual/en/migration70.new-features.php#migration70.new-features.return-type-declarations
 * @link https://www.php.net/releases/8.1/en.php#never_return_type
 * @link https://wiki.php.net/rfc/null-false-standalone-types
 * @link https://wiki.php.net/rfc/true-type
 * @see tests/Sniffs/ReturnTypeDeclarationSniffTest
 */
final class ReturnTypeDeclarationSniff extends SniffAbstract
{
    // Rules identifiers for SARIF report
    private const CA70 = 'CA7001';
    private const CA8105 = 'CA8105';
    private const CA8106 = 'CA8106';
    private const CA8202 = 'CA8202';

    /**
     * {@inheritDoc}
     */
    public function enterNode(Node $node)
    {
        if (!$this->hasReturnType($node)) {
            return null;
        }
        /** @var Node\FunctionLike $node */

        $returnType = $node->getReturnType();

        if ($returnType instanceof Node\IntersectionType) {
            // @link https://wiki.php.net/rfc/pure-intersection-types
            $min = '8.1.0alpha3';
            $ruleId = self::CA8105;
        } elseif ($returnType instanceof Node\NullableType) {
            // @link https://www.php.net/manual/en/migration71.new-features.php#migration71.new-features.nullable-types
            $min = '7.1.0';
            $ruleId = self::CA70;
        } elseif ($returnType instanceof Node\Identifier && strcasecmp($returnType->name, 'void') === 0) {
            // @link https://www.php.net/manual/en/migration71.new-features.php#migration71.new-features.void-functions
            $min = '7.1.0';
            $ruleId = self::CA70;
        } elseif ($returnType instanceof Node\Identifier && strcasecmp($returnType->name, 'never') === 0) {
            // @link https://wiki.php.net/rfc/noreturn_type
            $min = '8.1.0alpha1';
            $ruleId = self::CA8106;
        } elseif ($returnType instanceof Node\Identifier && in_array($returnType->name, ['null', 'false', 'true'])) {
            // @link https://wiki.php.net/rfc/null-false-standalone-types
            // @link https://wiki.php.net/rfc/true-type
            $min = '8.2.0alpha1';
            $ruleId = self::CA8202;
        } else {
            $min = '7.0.0alpha1';
            $ruleId = self::CA70;
        }
        $this->updateNodeElementVersion($node, $this->attributeKeyStore, ['php.min' => $min]);
        $this->updateNodeElementRule($node, $this->attributeKeyStore, $ruleId);
        return null;
    }

    /**
     * {@inheritdoc}
     */
    public function getRules(): Generator
    {
        yield self::CA70 => [
            'name' => $this->getShortClass(),
            'fullDescription' => 'Return Type Declarations are available since PHP 7.0.0',
            'helpUri' => '%baseHelpUri%/01_Components/03_Sniffs/Features/#php-70',
        ];
        yield self::CA8105 => [
            'name' => $this->getShortClass(),
            'fullDescription' => 'Return Intersection Type Declarations are available since PHP 8.1.0',
            'helpUri' => '%baseHelpUri%/01_Components/03_Sniffs/Features/#php-81',
        ];
        yield self::CA8106 => [
            'name' => $this->getShortClass(),
            'fullDescription' => 'Return Never Type Declaration is available since PHP 8.1.0',
            'helpUri' => '%baseHelpUri%/01_Components/03_Sniffs/Features/#php-81',
        ];
        yield self::CA8202 => [
            'name' => $this->getShortClass(),
            'fullDescription' => 'Null False and True Type Declaration are available since PHP 8.2.0',
            'helpUri' => '%baseHelpUri%/01_Components/03_Sniffs/Features/#php-82',
        ];
    }

    private function hasReturnType(Node $node): bool
    {
        if ($node instanceof Node\FunctionLike) {
            return (null !== $node->getReturnType());
        }
        return false;
    }
}
