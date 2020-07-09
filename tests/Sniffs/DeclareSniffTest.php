<?php
/**
 * Unit tests for PHP_CompatInfo package, declare sniff
 *
 * PHP version 7
 *
 * @category   PHP
 * @package    PHP_CompatInfo
 * @subpackage Tests
 * @author     Laurent Laville <pear@laurent-laville.org>
 * @license    https://opensource.org/licenses/BSD-3-Clause The 3-Clause BSD License
 * @since      Class available since Release 5.4.0
 */

namespace Bartlett\Tests\CompatInfo\Sniffs;

/**
 * Declare
 *
 * @link https://www.php.net/manual/en/control-structures.declare.php
 * @link https://wiki.php.net/rfc/scalar_type_hints_v5#strict_types_declare_directive
 *
 * @since Class available since Release 5.4.0
 */
final class DeclareSniffTest extends SniffTestCase
{
    /**
     * {@inheritDoc}
     */
    public static function setUpBeforeClass(): void
    {
        parent::setUpBeforeClass();

        self::$fixtures .= 'directives' . DIRECTORY_SEPARATOR;
    }

    /**
     * Feature test for directives detection
     *
     * @group features
     * @dataProvider directivesProvider
     * @param string $dataSource
     * @param array $expectedVersions
     * @return void
     */
    public function testDirectiveDeclarations(string $dataSource, array $expectedVersions): void
    {
        $metrics    = $this->executeAnalysis($dataSource);
        $versions   = $metrics[self::$analyserId]['versions'];

        foreach ($expectedVersions as $key => $value) {
            $this->assertEquals($value, $versions[$key]);
        }
    }

    /**
     * Data Provider to test directive declarations
     *
     * @return iterable
     */
    public function directivesProvider(): iterable
    {
        $provides = [
            'ticks.php' => [
                'php.min' => '4.0.0',
            ],
            'encoding.php' => [
                'php.min' => '5.3.0',
            ],
            'strict_types.php' => [
                'php.min' => '7.0.0',
            ],
        ];

        foreach ($provides as $filename => $versions) {
            yield [$filename, $versions];
        }
    }
}
