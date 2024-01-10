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
 * Constructor property promotion (available since PHP 8.0)
 *
 * @author Laurent Laville
 * @since Release 6.2.0
 *
 * @link https://www.php.net/manual/en/language.oop5.decon.php#language.oop5.decon.constructor.promotion
 * @link https://wiki.php.net/rfc/constructor_promotion
 * @link https://php.watch/versions/8.0/constructor-property-promotion
 * @see tests/Sniffs/PropertyPromotionSniffTest.php
 */
final class PropertyPromotionSniffTest extends SniffTestCase
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
     * Feature test to detect Constructor property promotion
     *
     * @link https://github.com/llaville/php-compatinfo/issues/336
     * @group features
     * @throws Exception
     */
    public function testConstructorPromotion(): void
    {
        $dataSource = 'constructor_promotion.php';
        $metrics    = $this->executeAnalysis($dataSource);
        $versions   = $metrics[self::$analyserId]['versions'];

        $this->assertEquals(
            '8.0.0alpha1',
            $versions['php.min']
        );
        $this->assertEquals(
            '',
            $versions['php.max']
        );
    }
}
