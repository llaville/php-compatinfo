<?php declare(strict_types=1);
/**
 * This file is part of the PHP_CompatInfo package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Bartlett\CompatInfo\Tests\Sniffs;

/**
 * No specific sniff defined. This is the "VersionResolverVisitor" that initialize base min version.
 *
 * Arrow function syntax is available since PHP 7.4.0
 *
 * @author Laurent Laville
 * @since  Class available since Release 5.4.0
 *
 * @link https://wiki.php.net/rfc/arrow_functions_v2
 * @link https://www.php.net/manual/en/migration74.new-features.php#migration74.new-features.core.arrow-functions
 */
final class ArrowFunctionSniffTest extends SniffTestCase
{
    /**
     * {@inheritDoc}
     */
    public static function setUpBeforeClass(): void
    {
        parent::setUpBeforeClass();

        self::$fixtures .= 'functions' . DIRECTORY_SEPARATOR;
    }

    /**
     * Feature test to detect Arrow functions in OOP
     *
     * @group features
     * @return void
     */
    public function testArrowFunctionInObjectContext()
    {
        $dataSource = 'arrow_functions.php';
        $metrics    = $this->executeAnalysis($dataSource);
        $methods    = $metrics[self::$analyserId]['methods'];

        $this->assertEquals(
            '7.4.0',
            $methods['Test\method']['php.min']
        );

        $this->assertEquals(
            '',
            $methods['Test\method']['php.max']
        );
    }
}
