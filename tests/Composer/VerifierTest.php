<?php declare(strict_types=1);
/**
 * This file is part of the PHP_CompatInfo package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Bartlett\CompatInfo\Tests\Composer;

use Bartlett\CompatInfo\Application\Analyser\CompatibilityAnalyser;
use Bartlett\CompatInfo\Application\Extension\Composer\MinimalAnalyserResult;
use Bartlett\CompatInfo\Application\Extension\Composer\Parser;
use Bartlett\CompatInfo\Application\Extension\Composer\Verifier;
use Bartlett\CompatInfo\Tests\TestCase;

/**
 * Unit tests for PHP_CompatInfo package, composer related
 *
 * @author Karsten Deubert
 *
 * @link https://github.com/llaville/php-compatinfo/issues/353
 */
final class VerifierTest extends TestCase
{
    /**
     * {@inheritDoc}
     */
    public static function setUpBeforeClass(): void
    {
        parent::setUpBeforeClass();

        self::$fixtures .= 'composer' . DIRECTORY_SEPARATOR;
    }

    /**
     * feature test for feature #353
     *
     * @group features
     * @return void
     */
    public function testVerifierSuccess()
    {
        $analyserData = include(self::$fixtures.'minimalStaticParserResult.php');
        $data = reset($analyserData);

        $minimalAnalyserResult = new MinimalAnalyserResult();
        $minimalAnalyserResult->setVersions($data[CompatibilityAnalyser::class]['versions']);
        $minimalAnalyserResult->setExtensions($data[CompatibilityAnalyser::class]['extensions']);

        $composerParser = new Parser(self::$fixtures.'php-extensions-version.json');

        $verifier = new Verifier($minimalAnalyserResult, $composerParser);
        $verifierResult = $verifier->verify();

        $expectedHaveErrorMessages = false;
        $this->assertEquals($expectedHaveErrorMessages, $verifier->haveErrorsInMessages());

        $expectedMessages = array (
            0 =>
                array (
                    'type' => Verifier::MESSAGE_TYPE_INFO,
                    'message' => 'configured php platform version 7.4.0 in composer.json matches the required php version constraint ^7.4 || ^8.0',
                ),
            1 =>
                array (
                    'type' => Verifier::MESSAGE_TYPE_INFO,
                    'message' => 'minimal required php version 7.4.0 from analysis matches the required php version constraint in composer.json ^7.4 || ^8.0',
                ),
            2 =>
                array (
                    'type' => Verifier::MESSAGE_TYPE_INFO,
                    'message' => 'the composer.json platform-php config 7.4.0 is >= the required php minimal version 7.4.0 from analysis',
                ),
            3 =>
                array (
                    'type' => Verifier::MESSAGE_TYPE_INFO,
                    'message' => 'the required extension phar (>= version 1.0.0) is not listed in composer.json but bundled',
                ),
            4 =>
                array (
                    'type' => Verifier::MESSAGE_TYPE_INFO,
                    'message' => 'the required extension spl (>= version 5.1.0) is listed in composer.json ext-spl (version *)',
                ),
            5 =>
                array (
                    'type' => Verifier::MESSAGE_TYPE_INFO,
                    'message' => 'the required extension core (>= version 7.2.0) is not listed in composer.json but bundled',
                ),
            6 =>
                array (
                    'type' => Verifier::MESSAGE_TYPE_INFO,
                    'message' => 'the required extension date (>= version 5.2.0) is not listed in composer.json but bundled',
                ),
            7 =>
                array (
                    'type' => Verifier::MESSAGE_TYPE_INFO,
                    'message' => 'the required extension standard (>= version 8.0.0alpha1) is not listed in composer.json but bundled',
                ),
            8 =>
                array (
                    'type' => Verifier::MESSAGE_TYPE_INFO,
                    'message' => 'the required extension json (>= version 1.6.0) is listed in composer.json ext-json (version *)',
                ),
            9 =>
                array (
                    'type' => Verifier::MESSAGE_TYPE_WARNING,
                    'message' => 'the extension libxml (version *) which is listed in composer.json was not found by the analyser, might be removed from the requirements (make sure you also check your dependencies before removing)',
                ),
            10 =>
                array (
                    'type' => Verifier::MESSAGE_TYPE_WARNING,
                    'message' => 'the extension pcre (version *) which is listed in composer.json was not found by the analyser, might be removed from the requirements (make sure you also check your dependencies before removing)',
                ),
        );

        $this->assertEquals($expectedMessages, $verifier->getMessages());

        $expectedVerifierResult = true;
        $this->assertEquals($expectedVerifierResult, $verifierResult);
    }

    /**
     * feature test for feature #353
     *
     * @group features
     * @return void
     */
    public function testVerifierErrorComposerPhpMismatch()
    {
        $analyserData = include(self::$fixtures.'minimalStaticParserResult.php');
        $data = reset($analyserData);

        $minimalAnalyserResult = new MinimalAnalyserResult();
        $minimalAnalyserResult->setVersions($data[CompatibilityAnalyser::class]['versions']);
        $minimalAnalyserResult->setExtensions($data[CompatibilityAnalyser::class]['extensions']);

        $composerParser = new Parser(self::$fixtures.'php-extensions-version-5.6-mismatch.json');

        $verifier = new Verifier($minimalAnalyserResult, $composerParser);
        $verifierResult = $verifier->verify();

        $expectedHaveErrorMessages = true;
        $this->assertEquals($expectedHaveErrorMessages, $verifier->haveErrorsInMessages());

        $expectedMessages = array (
            0 =>
                array (
                    'type' => Verifier::MESSAGE_TYPE_ERROR,
                    'message' => 'configured php platform version 5.6.0 in composer.json does not match the required php version constraint ^7.4 || ^8.0',
                ),
            1 =>
                array (
                    'type' => Verifier::MESSAGE_TYPE_INFO,
                    'message' => 'minimal required php version 7.4.0 from analysis matches the required php version constraint in composer.json ^7.4 || ^8.0',
                ),
            2 =>
                array (
                    'type' => Verifier::MESSAGE_TYPE_ERROR,
                    'message' => 'the composer.json platform-php config 5.6.0 is not >= the required php minimal version 7.4.0 from analysis',
                ),
            3 =>
                array (
                    'type' => Verifier::MESSAGE_TYPE_INFO,
                    'message' => 'the required extension phar (>= version 1.0.0) is not listed in composer.json but bundled',
                ),
            4 =>
                array (
                    'type' => Verifier::MESSAGE_TYPE_INFO,
                    'message' => 'the required extension spl (>= version 5.1.0) is listed in composer.json ext-spl (version *)',
                ),
            5 =>
                array (
                    'type' => Verifier::MESSAGE_TYPE_INFO,
                    'message' => 'the required extension core (>= version 7.2.0) is not listed in composer.json but bundled',
                ),
            6 =>
                array (
                    'type' => Verifier::MESSAGE_TYPE_INFO,
                    'message' => 'the required extension date (>= version 5.2.0) is not listed in composer.json but bundled',
                ),
            7 =>
                array (
                    'type' => Verifier::MESSAGE_TYPE_INFO,
                    'message' => 'the required extension standard (>= version 8.0.0alpha1) is not listed in composer.json but bundled',
                ),
            8 =>
                array (
                    'type' => Verifier::MESSAGE_TYPE_INFO,
                    'message' => 'the required extension json (>= version 1.6.0) is listed in composer.json ext-json (version *)',
                ),
            9 =>
                array (
                    'type' => Verifier::MESSAGE_TYPE_WARNING,
                    'message' => 'the extension libxml (version *) which is listed in composer.json was not found by the analyser, might be removed from the requirements (make sure you also check your dependencies before removing)',
                ),
            10 =>
                array (
                    'type' => Verifier::MESSAGE_TYPE_WARNING,
                    'message' => 'the extension pcre (version *) which is listed in composer.json was not found by the analyser, might be removed from the requirements (make sure you also check your dependencies before removing)',
                ),
        );

        $this->assertEquals($expectedMessages, $verifier->getMessages());

        $expectedVerifierResult = false;
        $this->assertEquals($expectedVerifierResult, $verifierResult);
    }

    /**
     * feature test for feature #353
     *
     * @group features
     * @return void
     */
    public function testVerifierErrorMissingOptionalModule()
    {
        $analyserData = include(self::$fixtures.'minimalStaticParserResultAmqp.php');
        $data = reset($analyserData);

        $minimalAnalyserResult = new MinimalAnalyserResult();
        $minimalAnalyserResult->setVersions($data[CompatibilityAnalyser::class]['versions']);
        $minimalAnalyserResult->setExtensions($data[CompatibilityAnalyser::class]['extensions']);

        $composerParser = new Parser(self::$fixtures.'php.json');

        $verifier = new Verifier($minimalAnalyserResult, $composerParser);
        $verifierResult = $verifier->verify();

        $expectedHaveErrorMessages = true;
        $this->assertEquals($expectedHaveErrorMessages, $verifier->haveErrorsInMessages());

        $expectedMessages = array (
            0 =>
                array (
                    'type' => Verifier::MESSAGE_TYPE_INFO,
                    'message' => 'minimal required php version 7.4.0 from analysis matches the required php version constraint in composer.json ^7.4',
                ),
            1 =>
                array (
                    'type' => Verifier::MESSAGE_TYPE_INFO,
                    'message' => 'the required extension phar (>= version 1.0.0) is not listed in composer.json but bundled',
                ),
            2 =>
                array (
                    'type' => Verifier::MESSAGE_TYPE_INFO,
                    'message' => 'the required extension spl (>= version 5.1.0) is not listed in composer.json but bundled',
                ),
            3 =>
                array (
                    'type' => Verifier::MESSAGE_TYPE_INFO,
                    'message' => 'the required extension core (>= version 7.2.0) is not listed in composer.json but bundled',
                ),
            4 =>
                array (
                    'type' => Verifier::MESSAGE_TYPE_INFO,
                    'message' => 'the required extension date (>= version 5.2.0) is not listed in composer.json but bundled',
                ),
            5 =>
                array (
                    'type' => Verifier::MESSAGE_TYPE_INFO,
                    'message' => 'the required extension standard (>= version 8.0.0alpha1) is not listed in composer.json but bundled',
                ),
            6 =>
                array (
                    'type' => Verifier::MESSAGE_TYPE_ERROR,
                    'message' => 'the required extension amqp (>= version 1.6.0) is optional and not listed in composer.json',
                ),
        );

        $this->assertEquals($expectedMessages, $verifier->getMessages());

        $expectedVerifierResult = false;
        $this->assertEquals($expectedVerifierResult, $verifierResult);
    }

    /**
     * Data Source Provider
     *
     * @return iterable
     */
    public function dataSourceProviderExtensionIsOptionalInfo(): iterable
    {
        $provides = [
            'core' => false,
            'spl'  => false,
            'json' => false, // but only since 7.3, might be a problem for us
            'ampq' => true
        ];

        foreach ($provides as $filename => $versions) {
            yield [$filename, $versions];
        }
    }

    /**
     * feature test for feature #353
     *
     * @group features
     * @dataProvider dataSourceProviderExtensionIsOptionalInfo
     * @return void
     */
    public function testGetExtensionIsOptionalInfo(string $dataSource, bool $expectedData)
    {
        $this->assertEquals($expectedData, Verifier::getExtensionIsOptionalInfo($dataSource));
    }
}
