<?php declare(strict_types=1);
/**
 * This file is part of the PHP_CompatInfo package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Bartlett\CompatInfo\Tests\PhpParser\NodeVisitor;

use Bartlett\CompatInfo\Application\PhpParser\NodeVisitor\NameResolverVisitor;
use Bartlett\CompatInfo\Application\PhpParser\NodeVisitor\ParentContextVisitor;
use Bartlett\CompatInfo\Tests\TestCase;

use PhpParser\Node;
use PhpParser\NodeTraverser;
use PhpParser\Parser;
use PhpParser\ParserFactory;

/**
 * NameResolver to initialize full qualified name on new attribute specified by option
 * - nodeAttributeNamespacedName
 * rather than use the `namespacedName` property of each node to avoid possible conflicts
 *
 * @author Laurent Laville
 * @since Release 5.4.0
 */
final class NameResolverVisitorTest extends TestCase
{
    private static Parser $parser;
    private static NodeTraverser $traverser;
    private static string $nodeAttributeNamespacedName;

    /**
     * @inheritDoc
     */
    public static function setUpBeforeClass(): void
    {
        parent::setUpBeforeClass();

        self::$fixtures .= 'visitors' . DIRECTORY_SEPARATOR;

        self::$nodeAttributeNamespacedName = 'bartlett.name';

        self::$parser = (new ParserFactory)->createForNewestSupportedVersion();
        self::$traverser = new NodeTraverser();
        self::$traverser->addVisitor(new ParentContextVisitor());
        self::$traverser->addVisitor(new NameResolverVisitor());
    }

    public function testNamespace(): Node\Stmt\Namespace_
    {
        $stmts = $this->parseAndResolve('namespaces.php');

        $namespace = $stmts[0];
        $this->assertInstanceOf(Node\Stmt\Namespace_::class, $namespace);

        return $namespace;
    }

    /**
     * @depends testNamespace
     */
    public function testConstantInNamespace(Node\Stmt\Namespace_ $namespace): void
    {
        /** @var Node\Stmt\Const_ $constOne */
        $constOne = $namespace->stmts[0];
        $this->assertInstanceOf(Node\Stmt\Const_::class, $constOne);
        foreach ($constOne->consts as $const) {
            $this->assertEquals('ONE', (string) $const->name);
            $this->assertEquals('NS\ONE', (string) $const->getAttribute(self::$nodeAttributeNamespacedName));
        }
    }

    /**
     * @depends testNamespace
     */
    public function testClassInNamespace(Node\Stmt\Namespace_ $namespace): Node\Stmt\Class_
    {
        $class = $namespace->stmts[2];
        $this->assertInstanceOf(Node\Stmt\Class_::class, $class);
        $this->assertEquals('C', (string) $class->name);
        $this->assertEquals('NS\C', (string) $class->getAttribute(self::$nodeAttributeNamespacedName));

        return $class;
    }

    /**
     * @depends testClassInNamespace
     */
    public function testClassConstInNamespace(Node\Stmt\Class_ $class): void
    {
        foreach ($class->getConstants() as $constants) {
            foreach ($constants->consts as $const) {
                $this->assertEquals('THREE', (string) $const->name);
                $this->assertEquals('NS\C\THREE', (string) $const->getAttribute(self::$nodeAttributeNamespacedName));
            }
        }
    }

    /**
     * @depends testClassInNamespace
     */
    public function testMethodInNamespace(Node\Stmt\Class_ $class): void
    {
        foreach ($class->getMethods() as $index => $method) {
            if (0 === $index) {
                $this->assertEquals('instanceOf', (string) $method->name);
                $this->assertEquals('NS\C\instanceOf', (string) $method->getAttribute(self::$nodeAttributeNamespacedName));
            } else {
                $this->assertEquals('f', (string) $method->name);
                $this->assertEquals('NS\C\f', (string) $method->getAttribute(self::$nodeAttributeNamespacedName));
            }
        }
    }

    /**
     * @depends testNamespace
     */
    public function testFunctionInNamespace(Node\Stmt\Namespace_ $namespace): void
    {
        /** @var Node\Stmt\Function_ $class */
        $function = $namespace->stmts[3];
        $this->assertInstanceOf(Node\Stmt\Function_::class, $function);
    }

    /**
     * Build and resolve AST corresponding to $fixture source code.
     *
     * @return Node[]
     */
    private function parseAndResolve(string $fixture): array
    {
        $stmts = self::$parser->parse(
            file_get_contents(self::$fixtures . $fixture)
        );
        return self::$traverser->traverse($stmts);
    }
}
