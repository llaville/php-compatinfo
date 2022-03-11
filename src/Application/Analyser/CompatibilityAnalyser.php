<?php declare(strict_types=1);
/**
 * This file is part of the PHP_CompatInfo package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Bartlett\CompatInfo\Application\Analyser;

use Bartlett\CompatInfo\Application\Collection\ReferenceCollectionInterface;
use Bartlett\CompatInfo\Application\Collection\SniffCollectionInterface;
use Bartlett\CompatInfo\Application\DataCollector\VersionDataCollector;
use Bartlett\CompatInfo\Application\DataCollector\VersionUpdater;
use Bartlett\CompatInfo\Application\Profiler\ProfilerInterface;
use Bartlett\CompatInfo\Application\Sniffs\SniffInterface;

use PhpParser\Node;

use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\Finder\SplFileInfo;

use function array_pop;
use function array_slice;
use function call_user_func;
use function explode;
use function get_class;
use function implode;
use function in_array;
use function property_exists;
use function str_replace;
use function strtolower;

/**
 * Compatibility Analyser.
 *
 * This analyser collects different metrics to find out the minimum version
 * and the extensions required for a piece of code to run.
 *
 * @author Laurent Laville
 * @since Release 4.0.0-alpha2+1
 */
final class CompatibilityAnalyser extends AbstractSniffAnalyser
{
    protected const ANALYSER_NODE_ATTRIBUTE = 'bartlett.data_collector';
    protected const PARENT_NODE_ATTRIBUTE = 'bartlett.parent';
    protected const NAMESPACED_NAME_NODE_ATTRIBUTE = 'bartlett.name';
    protected const COLLECTOR_NAME = self::class;

    /** @var array<string, string> */
    private array $aliases;
    /** @var ReferenceCollectionInterface<array>  */
    private $references;
    private SplFileInfo $currentFile;
    /** @var array<int, mixed> */
    private array $tokens;
    /** @var callable */
    private $contextCallback;

    use VersionUpdater;

    /**
     * Initializes the compatibility analyser
     *
     * @param ProfilerInterface $profiler
     * @param SniffCollectionInterface<SniffInterface> $sniffCollection
     * @param ReferenceCollectionInterface<array> $referenceCollection
     * @param EventDispatcherInterface $compatibilityEventDispatcher
     */
    public function __construct(
        ProfilerInterface $profiler,
        SniffCollectionInterface $sniffCollection,
        ReferenceCollectionInterface $referenceCollection,
        EventDispatcherInterface $compatibilityEventDispatcher
    ) {
        $this->references = $referenceCollection;

        $keysAllowed = [
            'extensions',
            'namespaces',
            'classes',
            'interfaces',
            'traits',
            'enumerations',
            'methods',
            'generators',
            'functions',
            'constants',
            'directives',
            'conditions',
        ];

        $profiler->addCollector(
            (new VersionDataCollector($keysAllowed))->setName(self::COLLECTOR_NAME)
        );

        parent::__construct($profiler, $compatibilityEventDispatcher, $sniffCollection, self::PARENT_NODE_ATTRIBUTE, self::ANALYSER_NODE_ATTRIBUTE);
    }

    public function getCurrentFile(): SplFileInfo
    {
        return $this->currentFile;
    }

    public function getTokens(): array
    {
        return $this->tokens;
    }

    public function setTokens(array $tokens): void
    {
        $this->tokens = $tokens;
    }

    public function setCurrentFile(SplFileInfo $file): void
    {
        $this->currentFile = $file;
    }

    public function getName(): string
    {
        $parts = explode('\\', get_class($this));
        return array_pop($parts);
    }

    public function getNamespace(): string
    {
        return implode('\\', array_slice(explode('\\', get_class($this)), 0, -1));
    }

    public function getShortName(): string
    {
        return strtolower(str_replace('Analyser', '', $this->getName()));
    }

    /**
     * {@inheritDoc}
     */
    public function beforeTraverse(array $nodes): ?array
    {
        parent::beforeTraverse($nodes);

        $this->aliases = [];
        return null;
    }

    /**
     * {@inheritDoc}
     */
    public function afterTraverse(array $nodes): ?array
    {
        parent::afterTraverse($nodes);

        foreach ($this->profiler->getCollectors() as $collector) {
            $collector->collect($nodes);
        }
        return null;
    }

    /**
     * Compute final results, only when all data sources are parsed, analysed and versions data collected
     *
     * @return array<string, mixed>
     */
    public function getData(): array
    {
        return $this->profiler->getCollector(self::COLLECTOR_NAME)->getData();
    }

    /**
     * {@inheritDoc}
     */
    public function enterNode(Node $node)
    {
        $this->contextCallback = [$this, 'enter' . str_replace('_', '', $node->getType())];

        if (is_callable($this->contextCallback)) {
            call_user_func($this->contextCallback, $node);
        }

        return parent::enterNode($node);
    }

    /**
     * {@inheritDoc}
     */
    public function leaveNode(Node $node)
    {
        if ($node instanceof Node\Scalar\MagicConst) {
            $this->contextCallback = [$this, 'leaveScalarMagicConst'];
        } else {
            $this->contextCallback = [$this, 'leave' . str_replace('_', '', $node->getType())];
        }

        if (is_callable($this->contextCallback)) {
            call_user_func($this->contextCallback, $node);
        }

        return parent::leaveNode($node);
    }

    // ---
    // >>> Leave nodes callback(s) ------------------------------------------------------------------------------------
    // ---

    private function leaveExprAssign(Node\Expr\Assign $node): void
    {
        $this->initClassAliasResolver($node);
    }

    /**
     * Compute the version of the class called.
     *
     * @param Node\Expr\New_ $node
     * @return void
     */
    private function leaveExprNew(Node\Expr\New_ $node): void
    {
        if (!$node->class instanceof Node\Name) {
            return;
        }
        $this->computeInternalVersions($node, (string) $node->class, 'classes');
    }

    /**
     * Compute the version of the function called (user or internal).
     *
     * @param Node\Expr\FuncCall $node
     * @return void
     */
    private function leaveExprFuncCall(Node\Expr\FuncCall $node): void
    {
        static $conditions = [];

        if (!$node->name instanceof Node\Name) {
            // indirect name can not be resolved
            return;
        }

        $versions = $node->getAttribute(self::ANALYSER_NODE_ATTRIBUTE);
        if (!empty($versions) && isset($versions['opt.name'])) {
            // conditional code found; skip it because already proceed by ConditionalCodeSniff
            $conditions[] = $versions['opt.name'];
            return;
        }

        $name = (string) $node->name;
        if (in_array($name, $conditions)) {
            // conditional code must not be computed to `php.min`
            return;
        }

        $this->computeInternalVersions($node, (string) $node->name, 'functions');
    }

    /**
     * Compute the version of the method called (user or internal).
     *
     * @param Node\Expr\MethodCall $node
     * @return void
     */
    private function leaveExprMethodCall(Node\Expr\MethodCall $node): void
    {
        $caller = $node->var;

        if (!$caller instanceof Node\Expr\Variable) {
            return;
        }

        if (!is_string($caller->name)) {
            // indirect method call
            return;
        }
        if (!isset($this->aliases[$caller->name])) {
            // class name resolver failure
            return;
        }

        if (!$node->name instanceof Node\Identifier) {
            // indirect method call
            return;
        }

        $qualifiedClassName = $this->aliases[$caller->name];
        $this->computeInternalVersions($node, (string) $node->name, 'methods', $qualifiedClassName);

        $node->setAttribute(self::NAMESPACED_NAME_NODE_ATTRIBUTE, $qualifiedClassName . '\\' . (string) $node->name);
    }

    /**
     * Compute the version of the method statically called (user or internal).
     *
     * @param Node\Expr\StaticCall $node
     * @return void
     */
    private function leaveExprStaticCall(Node\Expr\StaticCall $node): void
    {
        if ($node->class instanceof Node\Expr\Variable) {
            // Dynamic access to static methods/properties is now possible since PHP 5.3
            // @see Bartlett\CompatInfo\Application\Sniffs\Classes\DynamicAccessSniff
            return;
        }

        if (!$node->name instanceof Node\Identifier) {
            // method name is not predictable; see also ClassExprSyntaxSniff for alternative
            return;
        }

        if (!$node->class instanceof Node\Name) {
            // cannot resolved indirect call
            return;
        }

        $className = (string) $node->class;
        $this->computeInternalVersions($node, (string) $node->name, 'methods', $className);

        $node->setAttribute(self::NAMESPACED_NAME_NODE_ATTRIBUTE, $className . '\\' . (string) $node->name);
    }

    /**
     * Compute the version of magic constants fetch (internal).
     *
     * @param Node\Scalar\MagicConst $node
     * @return void
     */
    private function leaveScalarMagicConst(Node\Scalar\MagicConst $node): void
    {
        $this->computeInternalVersions($node, $node->getName(), 'constants');
    }

    /**
     * Compute the version of standard constants fetch (user or internal).
     *
     * @param Node\Expr\ConstFetch $node
     * @return void
     */
    private function leaveExprConstFetch(Node\Expr\ConstFetch $node): void
    {
        $parent = $node->getAttribute(self::PARENT_NODE_ATTRIBUTE);

        if ($parent instanceof Node\Stmt\Const_) {
            return;
        }

        $this->computeInternalVersions($node, (string) $node->name, 'constants');
    }

    // ---
    // <<< Leave nodes callback(s) ------------------------------------------------------------------------------------
    // ---

    /**
     * Creates an alias that identify the original class.
     *
     * @param Node\Expr\Assign $node
     *
     * @return void
     */
    private function initClassAliasResolver(Node\Expr\Assign $node): void
    {
        if (!property_exists($node->expr, 'class')) {
            return;
        }

        // variable or property that hold an instance of a new class statement
        $class = $node->expr->class;

        if (!$class instanceof Node\Name) {
            // when the class name is an expression, we consider it as unresolved
            return;
        }
        $assign = $node->var;
        if (
            $assign instanceof Node\Expr\PropertyFetch
            && $assign->name instanceof Node\Identifier
        ) {
            $property = $assign->name;

            if (
                $assign->var instanceof Node\Expr\Variable
                && is_string($assign->var->name)
            ) {
                $object = $assign->var->name;

                $this->aliases[$object . '_' . $property] = (string) $class;
            }
        } elseif (
            $assign instanceof Node\Expr\Variable
            && is_string($assign->name)
        ) {
            $this->aliases[$assign->name] = (string) $class;
        }
    }

    /**
     * Compute the version of an internal function.
     *
     * @param Node $node
     * @param string $element
     * @param string $context
     * @param string|null $extra
     *
     * @return void
     */
    private function computeInternalVersions(Node $node, string $element, string $context, ?string $extra = null): void
    {
        $versions = $node->getAttribute(self::ANALYSER_NODE_ATTRIBUTE);
        if ($versions === null) {
            // find reference info
            $argc     = isset($node->args) ? count($node->args) : 0;
            $versions = $this->references->find($context, $element, $argc, $extra);
            $versions['ext.all'] = $versions['php.all'] = '';
            if (isset($versions['polyfill'])) {
                $versions['php.all'] = $versions['php.min'];
                $versions['php.min'] = '4.0.0';
            }

            // cache to speed-up later uses
            $node->setAttribute(self::ANALYSER_NODE_ATTRIBUTE, $versions);
        }
    }
}
