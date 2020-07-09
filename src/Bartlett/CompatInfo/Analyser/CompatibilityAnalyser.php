<?php declare(strict_types=1);

/**
 * Compatibility Analyser
 *
 * @category PHP
 * @package  PHP_CompatInfo
 * @author   Laurent Laville <pear@laurent-laville.org>
 * @license  https://opensource.org/licenses/BSD-3-Clause The 3-Clause BSD License
 */

namespace Bartlett\CompatInfo\Analyser;

use Bartlett\CompatInfo\Collection\SniffCollection;
use Bartlett\CompatInfo\DataCollector\DataCollectorInterface;
use Bartlett\CompatInfo\DataCollector\ErrorHandler;
use Bartlett\CompatInfo\DataCollector\Normalizer\NodeNormalizer;
use Bartlett\CompatInfo\DataCollector\VersionDataCollector;
use Bartlett\CompatInfo\PhpParser\NodeVisitor\FilterVisitor;
use Bartlett\CompatInfo\Profiler\Profiler;
use Bartlett\CompatInfo\Util\Database;
use Bartlett\CompatInfo\Collection\ReferenceCollection;

use PhpParser\Node;

use function call_user_func;
use function property_exists;

/**
 * This analyzer collects different metrics to find out the minimum version
 * and the extensions required for a piece of code to run.
 *
 * @category PHP
 * @package  PHP_CompatInfo
 * @author   Laurent Laville <pear@laurent-laville.org>
 * @license  https://opensource.org/licenses/BSD-3-Clause The 3-Clause BSD License
 * @since    Class available since Release 4.0.0-alpha2+1
 */
class CompatibilityAnalyser extends AbstractSniffAnalyser
{
    protected const ANALYSER_NODE_ATTRIBUTE = 'bartlett.data_collector';
    protected const PARENT_NODE_ATTRIBUTE = 'bartlett.parent';
    protected const NAMESPACED_NAME_NODE_ATTRIBUTE = 'bartlett.name';
    protected const COLLECTOR_NAME = self::class;

    private $aliases;
    private $references;
    private $profiler;

    /** @var ErrorHandler */
    private $errorHandler;

    /**
     * Initializes the compatibility analyser
     *
     * @param Profiler $profiler
     * @param SniffCollection $sniffCollection
     */
    public function __construct(Profiler $profiler, SniffCollection $sniffCollection)
    {
        $pdo = Database::initRefDb();
        $this->references = new ReferenceCollection([], $pdo);

        $visitor = new FilterVisitor(
            new NodeNormalizer()
        );

        $this->profiler = $profiler;
        $this->profiler->addCollector(
            (new VersionDataCollector($visitor))->setName(self::COLLECTOR_NAME)
        );

        $this->sniffs = $sniffCollection;

        parent::__construct(self::PARENT_NODE_ATTRIBUTE, self::ANALYSER_NODE_ATTRIBUTE);
    }

    public function setErrorHandler(ErrorHandler $errorHandler): void
    {
        $this->errorHandler = $errorHandler;

        foreach ($this->profiler->getCollectors() as $collector) {
            /** @var DataCollectorInterface $collector */
            $collector->addFile($this->getCurrentFile());
            $collector->addErrors($this->errorHandler->getErrors());
        }
    }

    /**
     * {@inheritDoc}
     */
    public function beforeTraverse(array $nodes)
    {
        parent::beforeTraverse($nodes);

        $this->aliases = [];
    }

    /**
     * {@inheritDoc}
     */
    public function afterTraverse(array $nodes)
    {
        parent::afterTraverse($nodes);

        foreach ($this->profiler->getCollectors() as $collector) {
            /** @var DataCollectorInterface $collector */
            $collector->collect($nodes);
        }
    }

    /**
     * {@inheritDoc}
     */
    public function enterNode(Node $node)
    {
        $this->contextCallback = [$this, 'enter' . str_replace('_', '', $node->getType())];

        if (!empty($this->contextCallback) && is_callable($this->contextCallback)) {
            call_user_func($this->contextCallback, $node);
        }

        parent::enterNode($node);
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

        if (!empty($this->contextCallback) && is_callable($this->contextCallback)) {
            call_user_func($this->contextCallback, $node);
        }

        parent::leaveNode($node);
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
            // conditional code must not be compute to `php.min`
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

        if (!is_string($caller->name) && !$caller->name instanceof Node\Identifier) {
            // indirect method call
            return;
        }
        if (!isset($this->aliases[(string) $caller->name])) {
            // class name resolver failure
            return;
        }

        if (!$node->name instanceof Node\Identifier) {
            // indirect method call
            return;
        }

        $qualifiedClassName = $this->aliases[(string) $caller->name];
        $this->computeInternalVersions($node, (string) $node->name, 'methods', $qualifiedClassName);

        $node->setAttribute(self::NAMESPACED_NAME_NODE_ATTRIBUTE, $qualifiedClassName . '\\'. (string) $node->name);
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
            // Dynamic access to static methods is now possible since PHP 5.3
            // @link https://www.php.net/manual/en/migration53.new-features.php
            $this->updateNodeElementVersion($node, self::ANALYSER_NODE_ATTRIBUTE, ['php.min' => '5.3.0']);
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

        $node->setAttribute(self::NAMESPACED_NAME_NODE_ATTRIBUTE, $className . '\\'. (string) $node->name);
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
            /**
             * when the class name is an expression,
             * we consider it as unresolved
             */
            return;
        }
        $assign = $node->var;
        if ($assign instanceof Node\Expr\PropertyFetch
            && is_string($assign->name)
        ) {
            $property = $assign->name;

            if ($assign->var instanceof Node\Expr\Variable
                && is_string($assign->var->name)
                && is_string($property)
            ) {
                $object = $assign->var->name;

                $this->aliases[$object .'_'. $property] = (string) $class;
            }

        } elseif ($assign instanceof Node\Expr\Variable
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
     * @param null $extra
     *
     * @return void
     */
    private function computeInternalVersions(Node $node, string $element, string $context, $extra = null): void
    {
        $versions = $node->getAttribute(self::ANALYSER_NODE_ATTRIBUTE);
        if ($versions === null) {
            // find reference info
            $argc     = isset($node->args) ? count($node->args) : 0;
            $versions = $this->references->find($context, $element, $argc, $extra);
            $versions['ext.all'] = $versions['php.all'] = '';

            // cache to speed-up later uses
            $node->setAttribute(self::ANALYSER_NODE_ATTRIBUTE, $versions);
        }
    }
}
