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
 * Unit tests for PHP_CompatInfo package, PHP 8.2 features
 *
 * @author Laurent Laville
 * @since  Class available since Release 7.0.1
 *
 * @link https://github.com/llaville/php-compatinfo/issues/363
 */
final class Php82IssueTest extends TestCase
{
    /**
     * @inheritDoc
     */
    public static function setUpBeforeClass(): void
    {
        parent::setUpBeforeClass();

        self::$fixtures .= 'features' . DIRECTORY_SEPARATOR . 'php82' . DIRECTORY_SEPARATOR;
    }

    /**
     * Data Source Provider to test some PHP 8.2 features
     */
    public static function dataSourceProvider(): iterable
    {
        if (extension_loaded('random')) {
            $phpMin = '8.2.0beta1';
        } else {
            // @see Bartlett\CompatInfo\Application\Sniffs\ControlStructures\NonCapturingCatchSniff for details
            $phpMin = '8.0.0alpha1';
        }

        $provides = [
            'random_extension.php' => [
                'php.min' => $phpMin,
            ],
        ];

        foreach ($provides as $filename => $versions) {
            yield [$filename, $versions];
        }
    }

    /**
     * Regression test for some PHP 8.2 features
     *
     * @group features
     * @dataProvider dataSourceProvider
     * @throws Exception
     */
    public function testPhp82Features(string $dataSource, array $expectedVersions): void
    {
        $metrics    = $this->executeAnalysis($dataSource);
        $versions   = $metrics[self::$analyserId]['versions'];

        foreach ($expectedVersions as $key => $value) {
            $this->assertEquals($value, $versions[$key]);
        }
    }
}
