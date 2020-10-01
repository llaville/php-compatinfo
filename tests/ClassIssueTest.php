<?php
/**
 * Unit tests for PHP_CompatInfo package, issues reported
 *
 * PHP version 7
 *
 * @category   PHP
 * @package    PHP_CompatInfo
 * @subpackage Tests
 * @author     Laurent Laville <pear@laurent-laville.org>
 * @author     Remi Collet <Remi@FamilleCollet.com>
 * @license    https://opensource.org/licenses/BSD-3-Clause The 3-Clause BSD License
 * @since      Class available since Release 4.0.0-alpha2+1
 */

namespace Bartlett\Tests\CompatInfo;

/**
 * @link https://github.com/llaville/php-compat-info/issues/171
 * @link https://github.com/llaville/php-compat-info/issues/199
 */
final class ClassIssueTest extends TestCase
{
    /**
     * {@inheritDoc}
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
     * @return void
     */
    public function testRegressionGH171()
    {
        $dataSource = 'gh171.php';
        $metrics    = $this->executeAnalysis($dataSource);
        $extensions = $metrics[self::$analyserId]['extensions'];

        $provideExtensions = [
            'Core',
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
     * @return void
     */
    public function testRegressionGH199()
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
