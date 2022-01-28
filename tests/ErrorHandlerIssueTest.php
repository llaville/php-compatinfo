<?php
/**
 * This file is part of the PHP_CompatInfo package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Bartlett\CompatInfo\Tests;

use Exception;
use function sprintf;

/**
 * @author Laurent Laville
 * @since  Release 6.0.4
 * @link https://github.com/llaville/php-compatinfo/issues/339
 */
final class ErrorHandlerIssueTest extends TestCase
{
    /**
     * {@inheritDoc}
     */
    public static function setUpBeforeClass(): void
    {
        parent::setUpBeforeClass();

        self::$fixtures .= 'noContents' . DIRECTORY_SEPARATOR;
    }

    /**
     * Regression test for issue #339
     *
     * @link https://github.com/llaville/php-compatinfo/issues/339
     *       Stop on empty/broken files during analysis
     * @group regression
     * @return void
     * @throws Exception
     */
    public function testEmptyDir()
    {
        $dataSource = 'emptyDir' . DIRECTORY_SEPARATOR;
        $metrics    = $this->executeAnalysis($dataSource);

        $this->assertCount(
            0,
            $metrics['files'],
            sprintf('Expected to analyse empty directory, but found %d file(s)', $metrics['files'])
        );
    }

    /**
     * Regression test for issue #339
     *
     * @link https://github.com/llaville/php-compatinfo/issues/339
     *       Stop on empty/broken files during analysis
     * @group regression
     * @return void
     * @throws Exception
     */
    public function testEmptyFile()
    {
        $dataSource = 'emptyFile.php';
        $metrics    = $this->executeAnalysis($dataSource);

        $this->assertCount(
            1,
            $metrics['files'],
            sprintf('Expected to analyse only one empty PHP file, but found %d file(s)', $metrics['files'])
        );

        $this->assertCount(
            1,
            $metrics['errors'],
            sprintf('Expected to found only one error, but found %d error(s)', $metrics['errors'])
        );

        $this->assertStringStartsWith('File has no contents on line 1', $metrics['errors'][0]);
    }

    /**
     * Regression test for issue #339
     *
     * @link https://github.com/llaville/php-compatinfo/issues/339
     *       Stop on empty/broken files during analysis
     * @group regression
     * @return void
     * @throws Exception
     */
    public function testWithoutOpenTag()
    {
        $dataSource = 'withoutOpenTag.php';
        $metrics    = $this->executeAnalysis($dataSource);

        $this->assertCount(
            1,
            $metrics['files'],
            sprintf('Expected to analyse only one empty PHP file, but found %d file(s)', $metrics['files'])
        );

        $this->assertCount(
            1,
            $metrics['errors'],
            sprintf('Expected to found only one error, but found %d error(s)', $metrics['errors'])
        );

        $this->assertStringStartsWith('File has no contents on line 1', $metrics['errors'][0]);
    }

    /**
     * Regression test for issue #339
     *
     * @link https://github.com/llaville/php-compatinfo/issues/339
     *       Stop on empty/broken files during analysis
     * @group regression
     * @return void
     * @throws Exception
     */
    public function testParseError()
    {
        $dataSource = 'parseError.php';
        $metrics    = $this->executeAnalysis($dataSource);

        $this->assertCount(
            1,
            $metrics['files'],
            sprintf('Expected to analyse only one file, but found %d file(s)', $metrics['files'])
        );

        $this->assertCount(
            1,
            $metrics['errors'],
            sprintf('Expected to found only one error, but found %d error(s)', $metrics['errors'])
        );

        $this->assertStringStartsWith('Syntax error, unexpected EOF on line 3', $metrics['errors'][0]);
    }
}
