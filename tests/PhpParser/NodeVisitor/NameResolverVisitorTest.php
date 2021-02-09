<?php declare(strict_types=1);

/**
 * NameResolver to initialize full qualified name on new attribute specified by option
 * - nodeAttributeNamespacedName
 * rather than use the `namespacedName` property of each node to avoid possible conflicts
 */

namespace Bartlett\CompatInfo\Tests\PhpParser\NodeVisitor;

use Bartlett\CompatInfo\Application\PhpParser\NodeVisitor\NameResolverVisitor;
use Bartlett\CompatInfo\Application\PhpParser\NodeVisitor\ParentContextVisitor;
use Bartlett\CompatInfo\Tests\TestCase;

use PhpParser\Lexer\Emulative;
use PhpParser\Node;
use PhpParser\NodeTraverser;
use PhpParser\ParserFactory;

/**
 * @since Release 5.4.0
 */
final class NameResolverVisitorTest extends TestCase
{
    private static $parser;
    private static $traverser;
    private static $nodeAttributeNamespacedName;

    /**
     * {@inheritDoc}
     */
    public static function setUpBeforeClass(): void
    {
        parent::setUpBeforeClass();

        self::$fixtures .= 'visitors' . DIRECTORY_SEPARATOR;

        self::$nodeAttributeNamespacedName = 'bartlett.name';

        $lexer = new Emulative([
            'usedAttributes' => [
                'comments', 'startLine', 'endLine', 'startTokenPos', 'endTokenPos'
            ]
        ]);
        self::$parser = (new ParserFactory)->create(ParserFactory::PREFER_PHP7, $lexer);
        self::$traverser = new NodeTraverser();
        self::$traverser->addVisitor(new ParentContextVisitor());
        self::$traverser->addVisitor(new NameResolverVisitor());
    }

    public function testNamespace()
    {
        $stmts = $this->parseAndResolve('namespaces.php');

        /** @var Node\Stmt\Namespace_ $namespace */
        $namespace = $stmts[0];
        $this->assertInstanceOf(Node\Stmt\Namespace_::class, $namespace);

        return $namespace;
    }

    /**
     * @depends testNamespace
     */
    public function testConstantInNamespace(Node\Stmt\Namespace_ $namespace)
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
    public function testClassInNamespace(Node\Stmt\Namespace_ $namespace)
    {
        /** @var Node\Stmt\Class_ $class */
        $class = $namespace->stmts[2];
        $this->assertInstanceOf(Node\Stmt\Class_::class, $class);
        $this->assertEquals('C', (string) $class->name);
        $this->assertEquals('NS\C', (string) $class->getAttribute(self::$nodeAttributeNamespacedName));

        return $class;
    }

    /**
     * @depends testClassInNamespace
     */
    public function testClassConstInNamespace(Node\Stmt\Class_ $class)
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
    public function testMethodInNamespace(Node\Stmt\Class_ $class)
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
    public function testFunctionInNamespace(Node\Stmt\Namespace_ $namespace)
    {
        /** @var Node\Stmt\Function_ $class */
        $function = $namespace->stmts[3];
        $this->assertInstanceOf(Node\Stmt\Function_::class, $function);
    }

    /**
     * Build and resolve AST corresponding to $fixture source code.
     *
     * @param string $fixture
     * @return array
     */
    private function parseAndResolve(string $fixture): array
    {
        $stmts = self::$parser->parse(
            file_get_contents(self::$fixtures . $fixture)
        );
        return self::$traverser->traverse($stmts);
    }
}
