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
 * Unit tests for PHP_CompatInfo package, setcookie function signature sniff
 *
 * @author Laurent Laville
 * @since  Class available since Release 6.5.5
 *
 * @link https://php.watch/versions/7.3/same-site-cookies
 * @link https://wiki.php.net/rfc/same-site-cookie
 * @link https://www.php.net/manual/en/migration73.other-changes.php
 * @link https://github.com/llaville/php-compatinfo/issues/359
 */
final class SameSiteCookieSniffTest extends SniffTestCase
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
     * Data Provider to test First class callable syntax
     */
    public static function dataSourceProvider(): iterable
    {
        $provides = [
            'gh359_setcookie-options.php' => [
                'php.min' => '7.3.0beta1',
            ],
            'gh359_setcookie-options_raw.php' => [
                'php.min' => '7.3.0beta1',
            ],
            'gh359_setcookie-params.php' => [
                'php.min' => '7.3.0beta1',
            ],
        ];

        foreach ($provides as $filename => $versions) {
            yield [$filename, $versions];
        }
    }

    /**
     * Regression test issue #359
     *
     * @link https://github.com/llaville/php-compatinfo/issues/359
     *       new secookie signature not recognized
     * @group features
     * @group regression
     * @dataProvider dataSourceProvider
     * @throws Exception
     */
    public function testSignatureWithOptionsOrSameSiteArgument(string $dataSource, array $expectedVersions): void
    {
        $metrics  = $this->executeAnalysis($dataSource);
        $versions = $metrics[self::$analyserId]['versions'];

        foreach ($expectedVersions as $key => $value) {
            $this->assertEquals($value, $versions[$key]);
        }
    }
}
