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
 * Unit test case for Static variable initializers
 *
 * @author Laurent Laville
 * @since  Class available since Release 7.1.0
 *
 * @link https://wiki.php.net/rfc/arbitrary_static_variable_initializers
 */
final class StaticVarInitializerSniffTest extends SniffTestCase
{
    /**
     * @inheritDoc
     */
    public static function setUpBeforeClass(): void
    {
        parent::setUpBeforeClass();

        self::$fixtures .= 'expressions' . DIRECTORY_SEPARATOR;
    }

    /**
     * Feature test to detect static variable initializers
     *
     * @group features
     * @throws Exception
     */
    public function testStaticVariableInitializer(): void
    {
        $dataSource = 'static_var_initializer.php';
        $metrics    = $this->executeAnalysis($dataSource);
        $functions  = $metrics[self::$analyserId]['functions'];

        $this->assertEquals(
            '8.3.0alpha1',
            $functions['foo']['php.min']
        );
    }
}
