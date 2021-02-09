<?php declare(strict_types=1);

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
 * @since Class available since Release 5.4.0
 */
class ConditionalCodeSniffTest extends SniffTestCase
{
    /**
     * {@inheritDoc}
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
     * @return void
     */
    public function testExtensionLoadedCondition()
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
     * @return void
     */
    public function testFunctionExistsCondition()
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
     * @return void
     */
    public function testMethodExistsCondition()
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
     * @return void
     */
    public function testClassExistsCondition()
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
     * @return void
     */
    public function testInterfaceExistsCondition()
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
     * @return void
     */
    public function testTraitExistsCondition()
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
     * @return void
     */
    public function testDefinedCondition()
    {
        $dataSource = 'defined.php';
        $metrics    = $this->executeAnalysis($dataSource);
        $functions  = $metrics[self::$analyserId]['functions'];

        $this->assertArrayHasKey('defined', $functions);
    }

}
