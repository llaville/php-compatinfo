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
 * @since      Class available since Release 3.4.0
 */

namespace Bartlett\Tests\CompatInfo\Reference;

use Bartlett\Tests\CompatInfo\Sniffs\SniffTestCase;

/**
 * @link https://github.com/llaville/php-compat-info/issues/127
 * @link https://github.com/llaville/php-compat-info/issues/162
 * @link https://github.com/llaville/php-compat-info/issues/210
 * @link https://github.com/llaville/php-compat-info/issues/275
 */
final class IssueTest extends SniffTestCase
{
    /**
     * {@inheritDoc}
     */
    public static function setUpBeforeClass(): void
    {
        parent::setUpBeforeClass();

        self::$fixtures .= '..' . DIRECTORY_SEPARATOR . 'references' . DIRECTORY_SEPARATOR;
    }

    /**
     * Regression test for issue #127
     *
     * @link https://github.com/llaville/php-compat-info/issues/127
     *       "Interface Serializable is reported to require PHP 5.3"
     * @group regression
     * @return void
     */
    public function testRegressionGH127()
    {
        $dataSource = 'gh127.php';
        $metrics    = $this->executeAnalysis($dataSource);
        $versions   = $metrics[self::$analyserId]['versions'];

        $this->assertEquals(
            '5.1.0',
            $versions['php.min']
        );

        $this->assertEquals(
            '',
            $versions['php.max']
        );
    }

    /**
     * Regression test for issue #162
     *
     * @link https://github.com/llaville/php-compat-info/issues/162
     *       "ReflectionClass::newInstanceWithoutConstructor require PHP 5.4"
     * @group regression
     * @return void
     */
    public function testRegressionGH162()
    {
        $dataSource = 'gh162.php';
        $metrics    = $this->executeAnalysis($dataSource);
        $versions   = $metrics[self::$analyserId]['versions'];

        $this->assertEquals(
            '5.4.0',
            $versions['php.min']
        );

        $this->assertEquals(
            '',
            $versions['php.max']
        );
    }

    /**
     * Regression test for issue #210
     *
     * @link https://github.com/llaville/php-compat-info/issues/210
     *       "Regression in 4.5 : missing extensions"
     * @group regression
     * @group large
     * @return void
     */
    public function testRegressionGH210()
    {
        $dataSource = 'vfsStream-1.6.0.zip';
        $metrics    = $this->executeAnalysis($dataSource);
        $extensions = $metrics[self::$analyserId]['extensions'];

        $provideExtensions = [
            'Core',
            'standard',
            'dom',
            'date',
            'posix',
            'pcre',
            'spl',
            'xml',
            'zip',
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
     * Regression test for issue #275
     *
     * @link https://github.com/llaville/php-compat-info/issues/275
     *       "Missing extension when class name FQN is resolved under user namespace"
     * @group regression
     * @return void
     */
    public function testRegressionGH275()
    {
        $dataSource = 'vfsStreamZipTestCase.php';
        $metrics    = $this->executeAnalysis($dataSource);
        $extensions = $metrics[self::$analyserId]['extensions'];

        $this->assertArrayHasKey('zip', $extensions);

        $this->assertEquals(
            '0.1.0',
            $extensions['zip']['ext.min']
        );
        $this->assertEquals(
            '',
            $extensions['zip']['ext.max']
        );
        $this->assertEquals(
            '4.0.0',
            $extensions['zip']['php.min']
        );
        $this->assertEquals(
            '',
            $extensions['zip']['php.max']
        );
    }
}
