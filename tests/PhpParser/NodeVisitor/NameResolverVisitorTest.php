<?php declare(strict_types=1);
/**
 * This file is part of the PHP_CompatInfo package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Bartlett\CompatInfo\Tests\PhpParser\NodeVisitor;

use PhpParser\Node\Stmt\Namespace_;
use PhpParser\Node\Stmt\Const_;
use PhpParser\Node\Stmt\Class_;
use PhpParser\Node\Stmt\Function_;

use PHPUnit\Framework\Attributes\Depends;

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

    public function testNamespace(): Namespace_
    {
        $stmts = $this->parseAndResolve('namespaces.php');

        $namespace = $stmts[0];
        $this->assertInstanceOf(Namespace_::class, $namespace);

        return $namespace;
    }

    #[Depends('testNamespace')]
    public function testConstantInNamespace(Namespace_ $namespace): void
    {
        /** @var Const_ $constOne */
        $constOne = $namespace->stmts[0];
        $this->assertInstanceOf(Const_::class, $constOne);
        foreach ($constOne->consts as $const) {
            $this->assertEquals('ONE', (string) $const->name);
            $this->assertEquals('NS\ONE', (string) $const->getAttribute(self::$nodeAttributeNamespacedName));
        }
    }

    #[Depends('testNamespace')]
    public function testClassInNamespace(Namespace_ $namespace): Class_
    {
        $class = $namespace->stmts[2];
        $this->assertInstanceOf(Class_::class, $class);
        $this->assertEquals('C', (string) $class->name);
        $this->assertEquals('NS\C', (string) $class->getAttribute(self::$nodeAttributeNamespacedName));

        return $class;
    }

    #[Depends('testClassInNamespace')]
    public function testClassConstInNamespace(Class_ $class): void
    {
        foreach ($class->getConstants() as $constants) {
            foreach ($constants->consts as $const) {
                $this->assertEquals('THREE', (string) $const->name);
                $this->assertEquals('NS\C\THREE', (string) $const->getAttribute(self::$nodeAttributeNamespacedName));
            }
        }
    }

    #[Depends('testClassInNamespace')]
    public function testMethodInNamespace(Class_ $class): void
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

    #[Depends('testNamespace')]
    public function testFunctionInNamespace(Namespace_ $namespace): void
    {
        /** @var Function_ $class */
        $function = $namespace->stmts[3];
        $this->assertInstanceOf(Function_::class, $function);
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
