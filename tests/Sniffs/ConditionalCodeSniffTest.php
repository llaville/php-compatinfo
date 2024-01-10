<?php declare(strict_types=1);
/**
 * This file is part of the PHP_CompatInfo package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Bartlett\CompatInfo\Tests\Sniffs;

/**
 * Detect all of these conditional code signatures:
 * - [extension_loaded](https://www.php.net/manual/en/function.extension-loaded.php)
 * - [function_exists](https://www.php.net/manual/en/function.function-exists.php)
 * - [method_exists](https://www.php.net/manual/en/function.method-exists)
 * - [class_exists](https://www.php.net/manual/en/function.class-exists.php)
 * - [interface_exists](https://www.php.net/manual/en/function.interface-exists.php)
 * - [trait_exists](https://www.php.net/manual/en/function.trait-exists.php)
 * - [defined](https://www.php.net/manual/en/function.defined)
 *
 * @author Laurent Laville
 * @since  Class available since Release 5.4.0
 */
class ConditionalCodeSniffTest extends SniffTestCase
{
    /**
     * @inheritDoc
     */
    public static function setUpBeforeClass(): void
    {
        parent::setUpBeforeClass();

        self::$fixtures .= 'conditions' . DIRECTORY_SEPARATOR;
    }

    /**
     * Feature test for conditional code `extension_loaded` usage
     *
     * @group features
     */
    public function testExtensionLoadedCondition(): void
    {
        $dataSource = 'extension_loaded.php';
        $metrics    = $this->executeAnalysis($dataSource);
        $functions  = $metrics[self::$analyserId]['functions'];

        $this->assertArrayHasKey('extension_loaded', $functions);
    }

    /**
     * Feature test for conditional code `function_exists` usage
     *
     * @group features
     */
    public function testFunctionExistsCondition(): void
    {
        $dataSource = 'function_exists.php';
        $metrics    = $this->executeAnalysis($dataSource);
        $functions  = $metrics[self::$analyserId]['functions'];

        $this->assertArrayHasKey('function_exists', $functions);
    }

    /**
     * Feature test for conditional code `method_exists` usage
     *
     * @group features
     */
    public function testMethodExistsCondition(): void
    {
        $dataSource = 'method_exists.php';
        $metrics    = $this->executeAnalysis($dataSource);
        $functions  = $metrics[self::$analyserId]['functions'];

        $this->assertArrayHasKey('method_exists', $functions);
    }

    /**
     * Feature test for conditional code `class_exists` usage
     *
     * @group features
     */
    public function testClassExistsCondition(): void
    {
        $dataSource = 'class_exists.php';
        $metrics    = $this->executeAnalysis($dataSource);
        $functions  = $metrics[self::$analyserId]['functions'];

        $this->assertArrayHasKey('class_exists', $functions);
    }

    /**
     * Feature test for conditional code `interface_exists` usage
     *
     * @group features
     */
    public function testInterfaceExistsCondition(): void
    {
        $dataSource = 'interface_exists.php';
        $metrics    = $this->executeAnalysis($dataSource);
        $functions  = $metrics[self::$analyserId]['functions'];

        $this->assertArrayHasKey('interface_exists', $functions);
    }

    /**
     * Feature test for conditional code `trait_exists` usage
     *
     * @group features
     */
    public function testTraitExistsCondition(): void
    {
        $dataSource = 'trait_exists.php';
        $metrics    = $this->executeAnalysis($dataSource);
        $functions  = $metrics[self::$analyserId]['functions'];

        $this->assertArrayHasKey('trait_exists', $functions);
    }

    /**
     * Feature test for conditional code `defined` usage
     *
     * @group features
     */
    public function testDefinedCondition(): void
    {
        $dataSource = 'defined.php';
        $metrics    = $this->executeAnalysis($dataSource);
        $functions  = $metrics[self::$analyserId]['functions'];

        $this->assertArrayHasKey('defined', $functions);
    }
}
