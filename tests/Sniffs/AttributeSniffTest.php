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
 * Attributes since PHP 8.0.0 alpha1
 *
 * @author Laurent Laville
 * @since Release 6.2.0
 *
 * @link https://www.php.net/releases/8.0/en.php#attributes
 * @link https://wiki.php.net/rfc/attributes_v2
 * @link https://www.php.net/manual/en/language.attributes.php
 * @link https://php.watch/versions/8.0/attributes
 */
final class AttributeSniffTest extends SniffTestCase
{
    /**
     * {@inheritDoc}
     */
    public static function setUpBeforeClass(): void
    {
        parent::setUpBeforeClass();

        self::$fixtures .= 'attributes' . DIRECTORY_SEPARATOR;
    }

    /**
     * Feature test for Attributes
     *
     * @link https://github.com/llaville/php-compatinfo/issues/335
     * @group feature
     * @return void
     * @throws Exception
     */
    public function testAttributes()
    {
        $dataSource = 'basic.php';
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
