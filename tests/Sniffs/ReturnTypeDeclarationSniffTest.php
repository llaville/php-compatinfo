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
 * Unit tests for PHP_CompatInfo package, return type declaration sniff
 *
 * @author Laurent Laville
 * @since  Class available since Release 5.4.0
 *
 * @link https://wiki.php.net/rfc/return_types
 * @link https://www.php.net/manual/en/migration70.new-features.php#migration70.new-features.return-type-declarations
 * @link https://www.php.net/manual/en/migration71.new-features.php#migration71.new-features.void-functions
 * @link https://github.com/llaville/php-compat-info/issues/233
 * @link https://github.com/llaville/php-compat-info/issues/273
 * @link https://www.php.net/releases/8.1/en.php#pure_intersection_types
 * @link https://wiki.php.net/rfc/pure-intersection-types
 * @link https://wiki.php.net/rfc/null-false-standalone-types
 * @link https://wiki.php.net/rfc/true-type
 */
final class ReturnTypeDeclarationSniffTest extends SniffTestCase
{
    /**
     * @inheritDoc
     */
    public static function setUpBeforeClass(): void
    {
        parent::setUpBeforeClass();

        self::$fixtures .= 'functions' . DIRECTORY_SEPARATOR;
    }

    /**
     * Regression test issue #233
     *
     * @link https://github.com/llaville/php-compat-info/issues/233
     *       PHP 7 requirement not detected for return type hint
     * @group regression
     * @throws Exception
     */
    public function testReturnTypeHint(): void
    {
        $dataSource = 'return_types.php';
        $metrics    = $this->executeAnalysis($dataSource);
        $versions   = $metrics[self::$analyserId]['versions'];

        $this->assertEquals(
            '7.0.0',
            $versions['php.min']
        );

        $this->assertEquals(
            '',
            $versions['php.max']
        );
    }

    /**
     * Regression test for issue #273
     *
     * @link https://github.com/llaville/php-compat-info/issues/273
     *       PHP 7.1 Nullable types not being detected
     * @group regression
     * @throws Exception
     */
    public function testNullableReturnTypeHint(): void
    {
        $dataSource = 'gh273.php';
        $metrics    = $this->executeAnalysis($dataSource);
        $versions   = $metrics[self::$analyserId]['versions'];
        $functions  = $metrics[self::$analyserId]['functions'];

        $this->assertEquals(
            '7.1.0',
            $versions['php.min']
        );

        $this->assertEquals(
            '',
            $versions['php.max']
        );

        $this->assertEquals(
            '7.1.0',
            $functions['testReturn1']['php.min']
        );

        $this->assertEquals(
            '7.1.0',
            $functions['testReturn2']['php.min']
        );
    }

    /**
     * Feature test for return type void functions detection
     *
     * @link https://www.php.net/manual/en/migration71.new-features.php#migration71.new-features.void-functions
     * @group features
     * @throws Exception
     */
    public function testVoidFunctions(): void
    {
        $dataSource = 'void_functions.php';
        $metrics    = $this->executeAnalysis($dataSource);
        $functions  = $metrics[self::$analyserId]['functions'];

        $this->assertEquals(
            '4.0.0',
            $functions['noReturnType']['php.min']
        );

        $this->assertEquals(
            '',
            $functions['noReturnType']['php.max']
        );

        $this->assertEquals(
            '7.1.0',
            $functions['voidReturnType']['php.min']
        );

        $this->assertEquals(
            '',
            $functions['voidReturnType']['php.max']
        );
    }

    /**
     * Feature test for return intersection types
     *
     * @link https://github.com/llaville/php-compatinfo/issues/326
     * @group features
     * @throws Exception
     */
    public function testIntersectionTypes(): void
    {
        $dataSource = 'return_intersection_types.php';
        $metrics    = $this->executeAnalysis($dataSource);
        $functions  = $metrics[self::$analyserId]['methods'];

        $this->assertEquals(
            '8.1.0alpha3',
            $functions['B\test']['php.min']
        );
    }

    /**
     * Feature test for return never type
     *
     * @link https://github.com/llaville/php-compatinfo/issues/327
     * @group features
     * @throws Exception
     */
    public function testNeverReturnType(): void
    {
        $dataSource = 'return_never.php';
        $metrics    = $this->executeAnalysis($dataSource);
        $functions  = $metrics[self::$analyserId]['functions'];

        $this->assertEquals(
            '8.1.0alpha1',
            $functions['redirect']['php.min']
        );
    }

    /**
     * Feature test for return null, false or true type
     *
     * @link https://github.com/llaville/php-compatinfo/issues/363
     * @link https://wiki.php.net/rfc/null-false-standalone-types
     * @link https://wiki.php.net/rfc/true-type
     * @group features
     * @throws Exception
     */
    public function testNullOrBooleanReturnType(): void
    {
        $dataSource = 'return_null_bool.php';
        $metrics    = $this->executeAnalysis($dataSource);
        $functions  = $metrics[self::$analyserId]['methods'];

        $this->assertEquals(
            '8.2.0alpha1',
            $functions['Falsy\alwaysFalse']['php.min']
        );
        $this->assertEquals(
            '8.2.0alpha1',
            $functions['Falsy\alwaysTrue']['php.min']
        );
        $this->assertEquals(
            '8.2.0alpha1',
            $functions['Falsy\alwaysNull']['php.min']
        );
    }
}
