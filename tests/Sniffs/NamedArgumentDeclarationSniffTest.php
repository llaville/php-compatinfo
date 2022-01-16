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
 * Named arguments Declaration
 *
 * @author Laurent Laville
 * @since Class available since Release 6.2.0
 *
 * @link https://www.php.net/releases/8.0/en.php#named-arguments
 * @link https://wiki.php.net/rfc/named_params
 * @link https://www.php.net/manual/en/functions.arguments.php#functions.named-arguments
 * @link https://php.watch/versions/8.0/named-parameters
 */
final class NamedArgumentDeclarationSniffTest extends SniffTestCase
{
    /**
     * {@inheritDoc}
     */
    public static function setUpBeforeClass(): void
    {
        parent::setUpBeforeClass();

        self::$fixtures .= 'functions' . DIRECTORY_SEPARATOR;
    }

    /**
     * Feature test to detect Named arguments syntax
     *
     * @link https://github.com/llaville/php-compatinfo/issues/334
     * @group features
     * @return void
     * @throws Exception
     */
    public function testNamedArguments()
    {
        $dataSource = 'named_arguments.php';
        $metrics    = $this->executeAnalysis($dataSource);
        $versions   = $metrics[self::$analyserId]['versions'];

        $this->assertEquals(
            '8.0.0beta1',
            $versions['php.min']
        );
        $this->assertEquals(
            '',
            $versions['php.max']
        );
    }
}
