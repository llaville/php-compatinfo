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
 * AllowDynamicProperties attribute is available since PHP 8.2.0 alpha1
 *
 * @author Laurent Laville
 * @since Release 7.0.1
 *
 * @link https://www.php.net/manual/en/class.allowdynamicproperties
 */
final class AllowDynamicPropertiesAttributeSniffTest extends SniffTestCase
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
     * Feature test for AllowDynamicProperties attribute
     *
     * @link https://github.com/llaville/php-compatinfo/issues/363
     * @group feature
     * @throws Exception
     */
    public function testAttributes(): void
    {
        $dataSource = 'allow_dynamic_properties.php';
        $metrics    = $this->executeAnalysis($dataSource);
        $classes    = $metrics[self::$analyserId]['classes'];

        $this->assertEquals(
        '8.2.0alpha1',  // due to native AllowDynamicProperties attribute
            $classes['ClassAllowsDynamicProperties']['php.all']
        );
    }
}
