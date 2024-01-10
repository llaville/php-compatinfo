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
 * Unit test for dynamic class constant fetch syntax
 *
 * @author Laurent Laville
 * @since  Class available since Release 7.1.0
 *
 * @link https://www.php.net/releases/8.3/en.php#dynamic_class_constant_fetch
 * @link https://wiki.php.net/rfc/dynamic_class_constant_fetch
 * @link https://stitcher.io/blog/new-in-php-83#dynamic-class-constant-fetch-rfc
 */
final class DynamicClassConstantFetchSniffTest extends SniffTestCase
{
    /**
     * @inheritDoc
     */
    public static function setUpBeforeClass(): void
    {
        parent::setUpBeforeClass();

        self::$fixtures .= 'constants' . DIRECTORY_SEPARATOR;
    }

    /**
     * Feature test for dynamic class constant fetch syntax
     *
     * @group features
     * @throws Exception
     */
    public function testDynamicClassConstantFetch(): void
    {
        $dataSource = 'dynamic_class_const_fetch.php';
        $metrics    = $this->executeAnalysis($dataSource);
        $versions   = $metrics[self::$analyserId]['versions'];

        $this->assertEquals(
            '8.3.0alpha1',
            $versions['php.min']
        );

        $this->assertEquals(
            '',
            $versions['php.max']
        );
    }
}
