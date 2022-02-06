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
 * Non-capturing catches syntax (available since PHP 8.0)
 *
 * @author Laurent Laville
 * @since Release 6.2.0
 *
 * @link https://wiki.php.net/rfc/non-capturing_catches
 * @link https://php.watch/versions/8.0/catch-exception-type
 */
final class NonCapturingCatchSniffTest extends SniffTestCase
{
    /**
     * {@inheritDoc}
     */
    public static function setUpBeforeClass(): void
    {
        parent::setUpBeforeClass();

        self::$fixtures .= 'controls' . DIRECTORY_SEPARATOR;
    }

    /**
     * Feature test that catch exceptions only by type
     *
     * @link https://github.com/llaville/php-compatinfo/issues/341
     *       Catch exceptions without capturing them to variables
     * @group features
     * @return void
     * @throws Exception
     */
    public function testCatchExceptionOnlyByType()
    {
        $dataSource = 'non-capturing_catches.php';
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
