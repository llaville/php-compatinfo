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
 * Override attribute since PHP 8.3.0 alpha3
 *
 * @author Laurent Laville
 * @since Release 7.1.0
 *
 * @link https://wiki.php.net/rfc/marking_overriden_methods
 * @link https://stitcher.io/blog/new-in-php-83##%5Boverride%5D-attribute-rfc
 */
final class OverrideAttributeSniffTest extends SniffTestCase
{
    /**
     * @inheritDoc
     */
    public static function setUpBeforeClass(): void
    {
        parent::setUpBeforeClass();

        self::$fixtures .= 'attributes' . DIRECTORY_SEPARATOR;
    }

    /**
     * Feature test for Override attribute
     *
     * @link https://github.com/llaville/php-compatinfo/issues/366
     * @group feature
     * @return void
     * @throws Exception
     */
    public function testAttributes()
    {
        $dataSource = 'override.php';
        $metrics    = $this->executeAnalysis($dataSource);
        $traits     = $metrics[self::$analyserId]['traits'];

        $this->assertEquals(
            '8.3.0alpha3',  // due to native override attribute
            $traits['T']['php.all']
        );
        $this->assertEquals(
            '7.1.0',  // because attribute act as a comment
            $traits['T']['php.min']
        );
    }
}
