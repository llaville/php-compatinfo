<?php declare(strict_types=1);
/**
 * This file is part of the PHP_CompatInfo package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Bartlett\CompatInfo\Tests\Sniffs;

/**
 * Unit tests for PHP_CompatInfo package, declare sniff
 *
 * @author Laurent Laville
 * @since  Class available since Release 5.4.0
 *
 * @link https://www.php.net/manual/en/control-structures.declare.php
 * @link https://wiki.php.net/rfc/scalar_type_hints_v5#strict_types_declare_directive
 */
final class DeclareSniffTest extends SniffTestCase
{
    /**
     * @inheritDoc
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
     */
    public static function directivesProvider(): iterable
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
