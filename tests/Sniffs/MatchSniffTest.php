<?php declare(strict_types=1);
/**
 * This file is part of the PHP_CompatInfo package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Bartlett\CompatInfo\Tests\Sniffs;

use Exception;

/**
 * Match expressions (available since PHP 8.0)
 *
 * @author Laurent Laville
 * @since Release 6.2.0
 *
 * @link https://www.php.net/manual/en/control-structures.match.php
 * @link https://wiki.php.net/rfc/match_expression_v2
 * @link https://php.watch/versions/8.0/match-expression
 */
final class MatchSniffTest extends SniffTestCase
{
    /**
     * @inheritDoc
     */
    public static function setUpBeforeClass(): void
    {
        parent::setUpBeforeClass();

        self::$fixtures .= 'controls' . DIRECTORY_SEPARATOR;
    }

    /**
     * Feature test to detect Match expressions
     *
     * @link https://github.com/llaville/php-compatinfo/issues/337
     * @group features
     * @throws Exception
     */
    public function testMatchExpressions(): void
    {
        $dataSource = 'match_expr.php';
        $metrics    = $this->executeAnalysis($dataSource);
        $versions   = $metrics[self::$analyserId]['versions'];

        $this->assertEquals(
            '8.0.0alpha3',
            $versions['php.min']
        );
        $this->assertEquals(
            '',
            $versions['php.max']
        );
    }
}
