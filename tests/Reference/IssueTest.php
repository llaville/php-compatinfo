<?php declare(strict_types=1);
/**
 * This file is part of the PHP_CompatInfo package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Bartlett\CompatInfo\Tests\Reference;

use Bartlett\CompatInfo\Tests\Sniffs\SniffTestCase;

/**
 * Unit tests for PHP_CompatInfo package, issues reported
 *
 * @author Laurent Laville
 * @author Remi Collet
 * @since  Class available since Release 3.4.0
 *
 * @link https://github.com/llaville/php-compat-info/issues/127
 * @link https://github.com/llaville/php-compat-info/issues/162
 * @link https://github.com/llaville/php-compat-info/issues/210
 * @link https://github.com/llaville/php-compat-info/issues/275
 */
final class IssueTest extends SniffTestCase
{
    /**
     * @inheritDoc
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
     */
    public function testRegressionGH127(): void
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
     */
    public function testRegressionGH162(): void
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
     */
    public function testRegressionGH210(): void
    {
        $dataSource = 'vfsStream-1.6.0.zip';
        $metrics    = $this->executeAnalysis($dataSource);
        $extensions = $metrics[self::$analyserId]['extensions'];

        $provideExtensions = [
            'core',
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
     */
    public function testRegressionGH275(): void
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
