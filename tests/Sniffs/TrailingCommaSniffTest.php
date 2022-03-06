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
 * Trailing comma in parameters list and closure use list (available since PHP 8.0)
 *
 * @author Laurent Laville
 * @since Release 6.2.0
 *
 * @link https://wiki.php.net/rfc/trailing_comma_in_parameter_list
 * @link https://wiki.php.net/rfc/trailing_comma_in_closure_use_list
 * @link https://php.watch/versions/8.0/trailing-comma-parameter-use-list
 */
final class TrailingCommaSniffTest extends SniffTestCase
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
     * Data Provider to test Trailing comma syntax
     *
     * @return iterable
     */
    public function trailingCommaProvider(): iterable
    {
        $provides = [
            'trailing_comma_parameters.php' => [
                'php.min' => '8.0.0alpha1',
            ],
            'trailing_comma_closure_1.php' => [
                'php.min' => '8.0.0alpha1',
            ],
            'trailing_comma_closure_2.php' => [
                'php.min' => '8.0.0alpha1',
            ],
            'gh348_function.php' => [  // test to fix regression on trying to detect trailing comma
                'php.min' => '7.0.0alpha1',
            ],
            'gh348_closure.php' => [  // test to fix regression on trying to detect trailing comma
                'php.min' => '5.3.0',
            ],
        ];

        foreach ($provides as $filename => $versions) {
            yield [$filename, $versions];
        }
    }

    /**
     * Feature test for First class callable syntax
     *
     * @link https://github.com/llaville/php-compatinfo/issues/340
     *       Trailing comma syntax is detected as PHP 8.0
     * @group group
     * @dataProvider trailingCommaProvider
     * @return void
     * @throws Exception
     */
    public function testTrailingCommaSyntax(string $dataSource, array $expectedVersions)
    {
        $metrics  = $this->executeAnalysis($dataSource);
        $versions = $metrics[self::$analyserId]['versions'];

        foreach ($expectedVersions as $key => $value) {
            $this->assertEquals($value, $versions[$key]);
        }
    }
}
