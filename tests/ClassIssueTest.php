<?php declare(strict_types=1);
/**
 * This file is part of the PHP_CompatInfo package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Bartlett\CompatInfo\Tests;

/**
 * Unit tests for PHP_CompatInfo package, issues reported
 *
 * @author Laurent Laville
 * @author Remi Collet
 * @since  Class available since Release 4.0.0-alpha2+1
 *
 * @link https://github.com/llaville/php-compat-info/issues/171
 * @link https://github.com/llaville/php-compat-info/issues/199
 */
final class ClassIssueTest extends TestCase
{
    /**
     * @inheritDoc
     */
    public static function setUpBeforeClass(): void
    {
        parent::setUpBeforeClass();

        self::$fixtures .= 'classes' . DIRECTORY_SEPARATOR;
    }

    /**
     * Regression test for issue #171
     *
     * @link https://github.com/llaville/php-compat-info/issues/171
     *       "Missing extension on class inheritance"
     * @group regression
     */
    public function testRegressionGH171(): void
    {
        $dataSource = 'gh171.php';
        $metrics    = $this->executeAnalysis($dataSource);
        $extensions = $metrics[self::$analyserId]['extensions'];

        $provideExtensions = [
            'core',
            'xmlwriter',
            'mongo',
        ];

        foreach ($provideExtensions as $e) {
            $this->assertArrayHasKey(
                $e,
                $extensions,
                "Extension $e is not found in analysis results while it should be"
            );
        }
    }

    /**
     * Regression test for issue #199
     *
     * @link https://github.com/llaville/php-compat-info/issues/199
     *       "Class inheritance lifts requirements to >= PHP 5.3.0"
     * @group regression
     */
    public function testRegressionGH199(): void
    {
        $dataSource = 'gh199.php';
        $metrics    = $this->executeAnalysis($dataSource);
        $versions   = $metrics[self::$analyserId]['versions'];

        $this->assertEquals(
            '4.0.0',
            $versions['php.min']
        );

        $this->assertEquals(
            '',
            $versions['php.max']
        );
    }
}
