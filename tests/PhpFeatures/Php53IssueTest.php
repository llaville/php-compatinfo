<?php declare(strict_types=1);
/**
 * This file is part of the PHP_CompatInfo package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Bartlett\CompatInfo\Tests\PhpFeatures;

use Bartlett\CompatInfo\Tests\TestCase;

use Exception;

/**
 * Unit tests for PHP_CompatInfo package, issues reported
 *
 * @author Laurent Laville
 * @since  Class available since Release 6.4.0
 *
 * @link https://github.com/llaville/php-compatinfo/issues/213
 */
final class Php53IssueTest extends TestCase
{
    /**
     * {@inheritDoc}
     */
    public static function setUpBeforeClass(): void
    {
        parent::setUpBeforeClass();

        self::$fixtures .= 'features' . DIRECTORY_SEPARATOR . 'php53' . DIRECTORY_SEPARATOR;
    }

    /**
     * Data Source Provider to test some PHP 5.3 features
     *
     * @return iterable
     */
    public static function dataSourceProvider(): iterable
    {
        $provides = [
            'gh213_static_method.php' => [
                'php.min' => '5.3.0',
            ],
            'gh213_static_property.php' => [
                'php.min' => '5.3.0',
            ],
        ];

        foreach ($provides as $filename => $versions) {
            yield [$filename, $versions];
        }
    }

    /**
     * Regression test for feature #213
     *
     * @link https://github.com/llaville/php-compat-info/issues/213
     *       Dynamic access to static methods and properties are not detected
     * @group features
     * @group regression
     * @dataProvider dataSourceProvider
     * @return void
     * @throws Exception
     */
    public function testRegressionGH213(string $dataSource, array $expectedVersions)
    {
        $metrics    = $this->executeAnalysis($dataSource);
        $versions   = $metrics[self::$analyserId]['versions'];

        foreach ($expectedVersions as $key => $value) {
            $this->assertEquals($value, $versions[$key]);
        }
    }
}
