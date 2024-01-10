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
 * Constants in Traits are available since PHP 8.2.0
 *
 * @author Laurent Laville
 * @since Class available since Release 7.0.1
 *
 * @link https://wiki.php.net/rfc/constants_in_traits
 * @link https://github.com/llaville/php-compatinfo/issues/363
 */
final class ConstantsInTraitsSniffTest extends SniffTestCase
{
    /**
     * @inheritDoc
     */
    public static function setUpBeforeClass(): void
    {
        parent::setUpBeforeClass();

        self::$fixtures .= 'traits' . DIRECTORY_SEPARATOR;
    }

    /**
     * Constants in Traits are available since PHP 8.2
     *
     * @throws Exception
     */
    public function testPhp82Feature(): void
    {
        $dataSource = 'constants.php';
        $metrics    = $this->executeAnalysis($dataSource);
        $traits     = $metrics[self::$analyserId]['traits'];

        $this->assertEquals(
            '8.2.0beta3',
            $traits['Foo']['php.min']
        );
        $this->assertEquals(
            '',
            $traits['Foo']['php.max']
        );
    }
}
