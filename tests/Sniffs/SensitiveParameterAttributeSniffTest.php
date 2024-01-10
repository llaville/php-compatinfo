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
 * SensitiveParameter attribute is available since PHP 8.2.0 alpha1
 *
 * @author Laurent Laville
 * @since Release 7.0.1
 *
 * @link https://www.php.net/manual/en/class.sensitiveparameter
 */
final class SensitiveParameterAttributeSniffTest extends SniffTestCase
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
     * Feature test for SensitiveParameter attribute
     *
     * @link https://github.com/llaville/php-compatinfo/issues/363
     * @group feature
     * @throws Exception
     */
    public function testAttributes(): void
    {
        $dataSource = 'sensitive_parameter.php';
        $metrics    = $this->executeAnalysis($dataSource);
        $functions  = $metrics[self::$analyserId]['functions'];

        $this->assertEquals(
            '8.2.0alpha1',  // due to native SensitiveParameter attribute
            $functions['sensitiveParametersWithAttribute']['php.all']
        );
    }
}
