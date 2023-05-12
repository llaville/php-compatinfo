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
 * Unit tests for PHP_CompatInfo package, keyword reserved sniff
 *
 * @author Laurent Laville
 * @since  Class available since Release 5.4.0
 *
 * @link http://php.net/manual/en/reserved.keywords.php
 * @link https://www.php.net/manual/en/reserved.other-reserved-words.php
 * @link https://wiki.php.net/rfc/reserve_more_types_in_php_7
 * @link https://wiki.php.net/rfc/reserve_even_more_types_in_php_7
 * @link https://github.com/llaville/php-compat-info/issues/186
 */
final class KeywordReservedSniffTest extends SniffTestCase
{
    /**
     * {@inheritDoc}
     */
    public static function setUpBeforeClass(): void
    {
        parent::setUpBeforeClass();

        self::$fixtures .= 'keywords' . DIRECTORY_SEPARATOR;
    }

    /**
     * Regression test for issue #186
     *
     * @link https://github.com/llaville/php-compat-info/issues/186
     *       Add sniff for new reserved words in PHP7
     * @group regression
     * @dataProvider forbiddenNamesProvider
     * @param string $dataSource
     * @param array $expectedVersions
     * @return void
     * @throws Exception
     */
    public function testForbiddenNamesInClassInterfaceTraitNamespace(string $dataSource, array $expectedVersions): void
    {
        $metrics  = $this->executeAnalysis($dataSource);
        $versions = $metrics[self::$analyserId]['versions'];

        foreach ($expectedVersions as $key => $value) {
            $this->assertEquals($value, $versions[$key]);
        }
    }

    /**
     * Data Provider to test keyword reserved to names classes, interfaces, traits and namespaces
     *
     * @return iterable
     */
    public static function forbiddenNamesProvider(): iterable
    {
        $provides = [
            'reserved_names_in_objects.php' => [
                'php.min'      => '5.4.0',
                'php.max'      => '7.2.0',
            ],
            'reserved_names_in_namespaces.php' => [
                'php.min'      => '5.3.0',
                'php.max'      => '7.2.0',
            ]
        ];

        foreach ($provides as $filename => $versions) {
            yield [$filename, $versions];
        }
    }
}
