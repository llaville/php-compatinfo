<?php
/**
 * Compatibility Analyser
 *
 * @category PHP
 * @package  PHP_CompatInfo
 * @author   Laurent Laville <pear@laurent-laville.org>
 * @license  http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version  GIT: $Id$
 * @link     http://php5.laurent-laville.org/compatinfo/
 */

namespace Bartlett\CompatInfo\Analyser;

use Bartlett\CompatInfoDb\Environment;
use Bartlett\CompatInfo\Collection\ReferenceCollection;
use Bartlett\CompatInfo\PhpParser\ConditionalCodeNodeProcessor;

use Bartlett\Reflect\Analyser\AbstractAnalyser;

use PhpParser\Node;

/**
 * This analyzer collects different metrics to find out the minimum version
 * and the extensions required for a piece of code to run.
 *
 * @category PHP
 * @package  PHP_CompatInfo
 * @author   Laurent Laville <pear@laurent-laville.org>
 * @license  http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version  Release: @package_version@
 * @link     http://php5.laurent-laville.org/compatinfo/
 * @since    Class available since Release 4.0.0-alpha2+1
 */
class CompatibilityAnalyser extends AbstractAnalyser
{
    const GLOBAL_NAMESPACE = '+global';

    protected static $php4 = array(
        'ext.name' => 'user',
        'ext.min'  => '',
        'ext.max'  => '',
        'ext.all'  => '',
        'php.min'  => '4.0.0',
        'php.max'  => '',
        'php.all'  => '',
    );

    private $aliases;
    private $references;
    private $contextStack;
    private $localVersions;

    /**
     * Initializes the compatibility analyser
     */
    public function __construct()
    {
        $pdo = Environment::initRefDb();

        $this->metrics = array(
            'versions'   => array(),
            'extensions' => array(),
            'namespaces' => array(),
            'objects'    => array(),
            'interfaces' => array(),
            'traits'     => array(),
            'classes'    => array(),
            'methods'    => array(),
            'functions'  => array(),
            'constants'  => array(),
            'conditions' => array(),
        );

        $this->references = new ReferenceCollection(array(), $pdo);
    }

    /**
     * {@inheritDoc}
     */
    public function getMetrics()
    {
        /**
         * All remaining objects in temp queue (referenced) are considered
         * by default as classes.
         * It may be interfaces, but without declaration, impossible to give
         * the right group.
         */
        while (!empty($this->metrics['objects'])) {
            list($name, $versions) = each($this->metrics['objects']);
            array_shift($this->metrics['objects']);
            $group = 'interfaces';
            if (!isset($this->metrics[$group][$name])) {
                $group = 'classes';
            }
            $this->updateElementVersion($group, $name, $versions);
        }
        unset($this->metrics['objects']);

        return parent::getMetrics();
    }

    /**
     * Called once before traversal.
     *
     * @param Node[] $nodes Array of nodes
     *
     * @return null|Node[] Array of nodes
     */
    public function beforeTraverse(array $nodes)
    {
        parent::beforeTraverse($nodes);

        $this->initLocalScope();

        $element  = 'namespaces';
        $name     = self::GLOBAL_NAMESPACE;
        $versions = array(
            'ext.name' => 'Core',
            'ext.min'  => '',
            'ext.max'  => '',
            'ext.all'  => '',
            'php.min'  => '4.0.0',
            'php.max'  => '',
            'php.all'  => '',
        );
        $this->updateElementVersion($element, $name, $versions);
        $this->updateElementVersion('extensions', $versions['ext.name'], $versions);
        $this->contextStack = array(
            array($element, $name)
        );

        // checks if conditional code is present
        $processor  = new ConditionalCodeNodeProcessor();
        $conditions = $processor->traverse($nodes);

        $conditionalFunctions = array(
            'extension_loaded' => 'extensions',
            'function_exists'  => 'functions',
            'method_exists'    => 'methods',
            'class_exists'     => 'classes',
            'interface_exists' => 'interfaces',
            'trait_exists'     => 'traits',
            'defined'          => 'constants',
        );

        while (!empty($conditions)) {
            $condition = array_shift($conditions);

            // conditional code target
            list($element, $values) = each($condition);
            $values[0] = ltrim($values[0], "\\");
            $context = $conditionalFunctions[$element];
            if ('methods' == $context) {
                $target = $values[1];  // method name
                $extra  = $values[0];  //  class name
            } else {
                $target = $values[0];
                $extra  = null;
            }

            if ('extensions' == $context) {
                $versions = array();
            } else {
                $versions = $this->references->find($context, $target, 0, $extra);
            }

            if ('methods' == $context) {
                $target = $values[0] . '::' . $values[1];
            }
            $this->updateElementVersion($context, $target, $versions);
            $this->metrics[$context][$target]['optional'] = true;

            if ('methods' == $context) {
                $target   = $values[0];
                $context  = 'classes';
                $versions = $this->references->find($context, $target);
                // identified also the class
                $this->updateElementVersion($context, $target, $versions);
                $this->metrics[$context][$target]['optional'] = true;

                $condition = sprintf('%s(%s::%s)', $element, $values[0], $values[1]);
            } else {
                $condition = sprintf('%s(%s)', $element, $values[0]);
            }
            $this->updateElementVersion('conditions', $condition, $versions);
            ++$this->metrics['conditions'][$condition]['matches'];
        }
    }

    /**
     * Called once after traversal.
     *
     * @param Node[] $nodes Array of nodes
     *
     * @return null|Node[] Array of nodes
     */
    public function afterTraverse(array $nodes)
    {
        parent::afterTraverse($nodes);

        $this->computeNamespaceVersions();
    }

    /**
     * Called when entering a node.
     *
     * @param Node $node Node
     *
     * @return null|Node Node
     */
    public function enterNode(Node $node)
    {
        parent::enterNode($node);

        if ($node instanceof Node\Stmt\Namespace_) {
            $this->iniUserNamespace($node);

        } elseif ($node instanceof Node\Stmt\Class_) {
            $this->initUserClass($node);

        } elseif ($node instanceof Node\Stmt\Interface_) {
            $this->initUserInterface($node);

        } elseif ($node instanceof Node\Stmt\Trait_) {
            $this->initUserTrait($node);

        } elseif ($node instanceof Node\Stmt\Function_
            || $node instanceof Node\Expr\Closure
            || $node instanceof Node\Stmt\ClassMethod
        ) {
            $this->initUserFunction($node);

        } elseif ($node instanceof Node\Expr\Assign
            && $node->expr instanceof Node\Expr\New_
        ) {
            $this->initClassAliasResolver($node);
        }
    }

    /**
     * Called when leaving a node.
     *
     * @param Node $node Node
     *
     * @return null|Node|false|Node[] Node
     */
    public function leaveNode(Node $node)
    {
        parent::leaveNode($node);

        if ($node instanceof Node\Stmt\Namespace_) {
            $this->computeNamespaceVersions();

        } elseif ($node instanceof Node\Stmt\Class_) {
            $this->computeClassVersions($node);

        } elseif ($node instanceof Node\Stmt\Interface_) {
            $this->computeInterfaceVersions($node);

        } elseif ($node instanceof Node\Stmt\Trait_) {
            $this->computeTraitVersions($node);

        } elseif ($node instanceof Node\Stmt\Function_
            || $node instanceof Node\Expr\Closure
            || $node instanceof Node\Stmt\ClassMethod
        ) {
            $this->computeFunctionVersions($node);

        } elseif ($node instanceof Node\Expr\New_
            && $node->class instanceof Node\Name
        ) {
            $this->computeClassCallVersions($node);

        } elseif ($node instanceof Node\Expr\FuncCall
            && $node->name instanceof Node\Name
        ) {
            $this->computeFunctionCallVersions($node);

        } elseif ($node instanceof Node\Expr\MethodCall
            && is_string($node->name)
        ) {
            $this->computeClassMethodCallVersions($node);

        } elseif ($node instanceof Node\Expr\StaticCall
            && $node->class instanceof Node\Expr\Variable
        ) {
            $this->computePhpFeatureVersions($node);

        } elseif ($node instanceof Node\Expr\StaticCall
            && is_string($node->name)
        ) {
            $this->computeStaticClassMethodCallVersions($node);

        } elseif ($node instanceof Node\Stmt\Use_) {
            $this->computePhpFeatureVersions($node);

        } elseif ($node instanceof Node\Stmt\Property) {
            $this->computePhpFeatureVersions($node);

        } elseif ($node instanceof Node\Expr\Array_) {
            $this->computePhpFeatureVersions($node);

        } elseif ($node instanceof Node\Expr\ArrayDimFetch
            && $node->var instanceof Node\Expr\FuncCall
        ) {
            $this->computePhpFeatureVersions($node);

        } elseif ($node instanceof Node\Stmt\Goto_) {
            $this->computePhpFeatureVersions($node);

        } elseif ($node instanceof Node\Stmt\Const_) {
            foreach ($node->consts as $const) {
                // user constant does not require to search in REF database
                $versions = $const->getAttribute('compatinfo');
                if ($versions === null) {
                    $versions = self::$php4;

                    list($element, $name) = end($this->contextStack);

                    if ('namespaces' == $element) {
                        $versions['php.min'] = '5.3.0';
                    }

                    if (!$const->value instanceof Node\Scalar) {
                        // Constant scalar expressions
                        $versions['php.min'] = '5.6.0';
                    }
                    $const->setAttribute('compatinfo', $versions);
                }
                $this->computeConstantVersions($const, $const->name);
            }

        } elseif ($node instanceof Node\Expr\ConstFetch) {
            $name = (string) $node->name;
            $this->computeConstantVersions($node, $name);

        } elseif ($node instanceof Node\Scalar\MagicConst) {
            $this->computeConstantVersions($node, $node->getName());

        } elseif ($node instanceof Node\Expr\Empty_) {
            $this->computePhpFeatureVersions($node);

        } elseif ($node instanceof Node\Expr\AssignOp\Pow) {
            $this->computePhpFeatureVersions($node);
        }
    }

    /**
     * Update the base version if current ref version is greater
     *
     * @param string $current Current version
     * @param string &$base   Base version
     *
     * @return void
     */
    protected static function updateVersion($current, &$base)
    {
        if (version_compare($current, $base, 'gt')) {
            $base = $current;
        }
    }

    /**
     * Update an element versions of the project
     *
     * @param string $element
     * @param string $name
     * @param array  $versions
     *
     * @return void
     */
    protected function updateElementVersion($element, $name, $versions)
    {
        $versions = array_merge(self::$php4, $versions);

        if (!isset($this->metrics[$element][$name])) {
            $versions['matches'] = isset($versions['matches']) ? $versions['matches'] : 0;
            $this->metrics[$element][$name] = $versions;
        }

        if (isset($this->metrics[$element][$name]['arg.max'])
            && isset($versions['arg.max'])
            && $this->metrics[$element][$name]['arg.max'] < $versions['arg.max']
        ) {
            $this->metrics[$element][$name]['arg.max'] = $versions['arg.max'];
        }

        self::updateVersion(
            $versions['php.min'],
            $this->metrics[$element][$name]['php.all']
        );

        self::updateVersion(
            $versions['php.min'],
            $this->metrics[$element][$name]['php.min']
        );
        self::updateVersion(
            $versions['php.max'],
            $this->metrics[$element][$name]['php.max']
        );
        self::updateVersion(
            $versions['php.all'],
            $this->metrics[$element][$name]['php.all']
        );

        if (isset($versions['declared'])) {
            $this->metrics[$element][$name]['declared'] = true;
        }

        if ('user' == $versions['ext.name']) {
            $this->metrics[$element][$name]['ext.min'] = '';
            $this->metrics[$element][$name]['ext.max'] = '';
            return;
        }

        self::updateVersion(
            $versions['ext.min'],
            $this->metrics[$element][$name]['ext.min']
        );
        self::updateVersion(
            $versions['ext.max'],
            $this->metrics[$element][$name]['ext.max']
        );
    }

    /**
     * Updates parent container context
     *
     * @param array $versions (optional) Version informations
     *
     * @return void
     */
    protected function updateContextVersion(array $versions = null)
    {
        if (count ($this->contextStack) > 1) {
            list($celement, $cname) = array_pop($this->contextStack);
        } else {
            list($celement, $cname) = end($this->contextStack);
        }

        if (!isset($versions)) {
            // retrieve current context informations
            $versions = $this->metrics[$celement][$cname];
        }
        $versions = array_replace(self::$php4, $versions);

        list($pelement, $pname) = end($this->contextStack);

        self::updateVersion(
            $versions['php.all'],
            $this->metrics[$pelement][$pname]['php.all']
        );

        self::updateVersion(
            $versions['php.max'],
            $this->metrics[$pelement][$pname]['php.max']
        );

        self::updateVersion(
            $versions['php.min'],
            $this->metrics[$pelement][$pname]['php.all']
        );

        if (isset($this->metrics[$celement][$cname]['optional'])) {
            // conditional code
            return;
        }

        self::updateVersion(
            $versions['php.min'],
            $this->metrics[$pelement][$pname]['php.min']
        );
    }

    /**
     * Update the global versions of the project
     *
     * @param string $min The PHP min version to check
     * @param string $max The PHP max version to check
     * @param string $all The PHP min version to check for all components
     *
     * @return void
     */
    protected function updateGlobalVersion($min, $max, $all)
    {
        if (empty($this->metrics['versions'])) {
            $this->metrics['versions'] = array(
                'php.min'  => '4.0.0',
                'php.max'  => '',
                'php.all'  => '',
            );
        }

        self::updateVersion(
            $min,
            $this->metrics['versions']['php.min']
        );
        self::updateVersion(
            $max,
            $this->metrics['versions']['php.max']
        );
        self::updateVersion(
            $all,
            $this->metrics['versions']['php.all']
        );
    }

    /**
     * Initialize a new User Namespace
     *
     * @param Node $node
     *
     * @return void
     */
    private function iniUserNamespace(Node $node)
    {
        if (!isset($node->name)) {
            // Namespace without name
            $node->name = new Node\Name(self::GLOBAL_NAMESPACE);
        }

        $element  = 'namespaces';
        $name     = (string)$node->name;
        $versions = array('php.min' => '5.3.0');
        $this->updateElementVersion($element, $name, $versions);
        $this->contextStack[] = array($element, $name);
    }

    /**
     * Initialize a new User Class
     *
     * @param Node $node
     *
     * @return void
     */
    private function initUserClass(Node $node)
    {
        if (isset($node->namespacedName)
            && $node->namespacedName instanceof Node\Name
            && $node->namespacedName->isQualified()
        ) {
            $min = '5.3.0';
        } else {
            if ($node->isAbstract()
                || $node->isFinal()
            ) {
                $min = '5.0.0';
            } else {
                $min = '4.0.0';
            }
        }
        $max = '';

        $element  = 'classes';
        $classname = (string) $node->namespacedName;
        $this->contextStack[] = array($element, $classname);

        // parent class
        if (isset($node->extends)) {
            $name     = (string) $node->extends;
            $group    = $this->findObjectType($name);
            $versions = $this->metrics[$group][$name];

            if ($versions['ext.name'] !== 'user') {
                // update versions of extension's $element
                $this->updateElementVersion('extensions', $versions['ext.name'], $versions);
            }

            if ('user' == $versions['ext.name']) {
                if ($node->extends->isFullyQualified()) {
                    if (count($node->extends->parts) === 1) {
                        // PHP4 syntax (global namespace)
                        $versions = array('php.min' => '4.0.0');
                    } else {
                        $versions = array('php.min' => '5.3.0');
                    }
                } else {
                    $versions = array();
                }
            }
            $this->updateElementVersion('classes', $name, $versions);
            ++$this->metrics['classes'][$name]['matches'];

            if ('objects' == $group) {
                // now object is categorized, remove from temp queue
                unset($this->metrics[$group][$name]);
            }

            $versions['ext.name'] = 'user';
            $this->updateElementVersion('classes', $classname, $versions);
        }

        // interfaces
        foreach ($node->implements as $interface) {
            $name     = (string) $interface;
            $group    = $this->findObjectType($name);
            $versions = $this->metrics[$group][$name];
            $this->updateElementVersion('interfaces', $name, $versions);
            ++$this->metrics['interfaces'][$name]['matches'];

            if ($versions['ext.name'] !== 'user') {
                // update versions of extension's $element
                $this->updateElementVersion('extensions', $versions['ext.name'], $versions);
            }

            if ('objects' == $group) {
                // now object is categorized, remove from temp queue
                unset($this->metrics[$group][$name]);
            }

            $versions['ext.name'] = 'user';
            $this->updateElementVersion('classes', $classname, $versions);
        }

        $name     = (string) $node->namespacedName;
        $group    = $this->findObjectType($name);
        $versions = $this->metrics[$group][$name];

        if ('objects' == $group) {
            // now object is categorized, remove from temp queue
            unset($this->metrics[$group][$name]);
        }

        $versions = array_replace(
            $versions,
            array('ext.name' => 'user', 'declared' => true)
        );
        $this->updateElementVersion('classes', $classname, $versions);
    }

    /**
     * Initialize a new User Interface
     *
     * @param Node $node
     *
     * @return void
     */
    private function initUserInterface(Node $node)
    {
        if (isset($node->namespacedName)
            && $node->namespacedName instanceof Node\Name
            && $node->namespacedName->isQualified()
        ) {
            $min = '5.3.0';
        } else {
            $min = '5.0.0';
        }

        $element  = 'interfaces';
        $name     = (string)$node->namespacedName;
        $versions = array('php.min' => $min, 'declared' => true);
        $this->updateElementVersion($element, $name, $versions);
        $this->contextStack[] = array($element, $name);
    }

    /**
     * Initialize a new User Trait
     *
     * @param Node $node
     *
     * @return void
     */
    private function initUserTrait(Node $node)
    {
        $min      = '5.4.0';
        $element  = 'traits';
        $name     = (string)$node->namespacedName;
        $versions = array('php.min' => $min, 'declared' => true);
        $this->updateElementVersion($element, $name, $versions);
        $this->contextStack[] = array($element, $name);
    }

    /**
     * Initialize a new User Function (anonymous or qualified) or a Method
     *
     * @param Node $node
     *
     * @return void
     */
    private function initUserFunction(Node $node)
    {
        $this->initLocalScope();

        if ($node instanceof Node\Stmt\ClassMethod) {
            list($element, $name) = end($this->contextStack);

            $element  = 'methods';
            $name     = sprintf('%s::%s', $name, $node->name);
            if ($this->isImplicitlyPublicFunction($this->tokens, $node)) {
                $min = '4.0.0';
            } else {
                $min = '5.0.0';
            }

        } else {
            $element  = 'functions';

            if ($node instanceof Node\Expr\Closure) {
                $min  = '5.3.0';
                $name = sprintf(
                    'closure-%d-%d',
                    $node->getAttribute('startLine', 0),
                    $node->getAttribute('endLine', 0)
                );

            } else {
                if (isset($node->namespacedName)
                    && $node->namespacedName instanceof Node\Name
                    && $node->namespacedName->isQualified()
                ) {
                    $min = '5.3.0';
                } else {
                    $min = '4.0.0';
                }
                $name = (string)$node->namespacedName;
            }
        }

        // checks function parameters
        foreach ($node->params as $param) {
            $versions = $this->initFunctionArguments($param);
            self::updateVersion($versions['php.min'], $min);
        }

        $versions = array('php.min' => $min);
        $this->updateElementVersion($element, $name, $versions);
        $this->contextStack[] = array($element, $name);
    }

    /**
     * Checks for function arguments
     * (anonymous or qualified function, class|interface|trait method)
     *
     * @param Node $node
     *
     * @return array
     * @link http://www.php.net/manual/en/functions.arguments.php
     */
    private function initFunctionArguments(Node $node)
    {
        if ($node->variadic) {
            // Variadic functions
            $versions = array('php.min' => '5.6.0');

        } elseif ($node->type instanceof Node\Name\FullyQualified) {
            // type hint

            // introduces parameter object (if not yet defined)
            $name  = (string)$node->type;
            $group = $this->findObjectType($name);
            ++$this->metrics[$group][$name]['matches'];

            // type hint object required at least PHP 5.0
            $versions = $this->metrics[$group][$name];
            self::updateVersion('5.0.0', $versions['php.min']);

        } else {
            $versions = array('php.min' => '4.0.0');
        }
        return $versions;
    }

    /**
     * Try to find the right object (interface | class) of type hint.
     *
     * Stay as group "objects" when undetermined.
     *
     * @param string $name Object's name
     *
     * @return string
     */
    private function findObjectType($name)
    {
        $group = 'objects';
        if (isset($this->metrics[$group][$name])) {
            // object is not yet categorized
            return $group;
        }

        $groups = array('interfaces', 'classes');

        foreach ($groups as $group) {
            if (isset($this->metrics[$group][$name])) {
                // we already know the category of object
                return $group;
            }
        }

        foreach ($groups as $group) {
            // not yet known, try to detect for non user elements
            $versions = $this->references->find($group, $name);
            // arg.max is useless (nonsense) in this context
            unset($versions['arg.max']);

            if ('user' == $versions['ext.name']) {
                // remove the previously cached response before trying new attempt
                $this->references->remove($name);
            } else {
                $this->updateElementVersion($group, $name, $versions);
                return $group;
            }
        }
        // cannot distinguish yet the right group (interfaces or classes)
        $group = 'objects';
        $this->updateElementVersion($group, $name, $versions);
        return $group;
    }

    /**
     * Initialize local scope environment
     *
     * @return void
     */
    private function initLocalScope()
    {
        /*
         * reset class aliases
         * to resolve method calls in local scope (class method or function)
         */
        $this->aliases = array();
    }

    /**
     * Creates an alias that identify the original class.
     *
     * @param Node $node
     *
     * @return void
     */
    private function initClassAliasResolver(Node $node)
    {
        // variable or property that hold an instance of a new class statement
        $class = $node->expr->class;

        if (!$class instanceof Node\Name) {
            /*
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
     * Compute the namespace's version.
     *
     * This is the sum of all versions of class, interface, trait, function,
     * and internal function.
     *
     * @return void
     */
    private function computeNamespaceVersions()
    {
        list($element, $name) = end($this->contextStack);

        $versions = $this->metrics[$element][$name];

        $this->updateGlobalVersion($versions['php.min'], $versions['php.max'], $versions['php.all']);
    }

    /**
     * Compute the class's version.
     *
     * This is the sum of all method's versions
     *
     * @param Node $node
     *
     * @return void
     */
    private function computeClassVersions(Node $node)
    {
        list($element, $name) = end($this->contextStack);

        $versions = $this->metrics[$element][$name];

        if (version_compare($versions['php.all'], '5.0.0', 'eq')) {
            // PHP4 compatibility for properties and methods visibility
            $versions['php.min'] = $versions['php.all'];
            $this->metrics[$element][$name] = $versions;
        }

        // update parent context
        $this->updateContextVersion();
    }

    /**
     * Compute the interface's version.
     *
     * @param Node $node
     *
     * @return void
     */
    private function computeInterfaceVersions(Node $node)
    {
        // update parent context
        $this->updateContextVersion();
    }

    /**
     * Compute the trait's version.
     *
     * This is the sum of all method's versions
     *
     * @param Node $node
     *
     * @return void
     */
    private function computeTraitVersions(Node $node)
    {
        // update parent context
        $this->updateContextVersion();
    }

    /**
     * Compute the function's version.
     *
     * This is the sum of all extension's elements versions
     *
     * @param Node $node
     *
     * @return void
     */
    private function computeFunctionVersions(Node $node)
    {
        // update parent context
        $this->updateContextVersion();
    }

    /**
     * Compute the version of the class called.
     *
     * @param Node $node
     *
     * @return void
     */
    private function computeClassCallVersions(Node $node)
    {
        $element = (string) $node->class;

        $this->computeInternalVersions($node, $element, 'classes');
    }

    /**
     * Compute the version of the function called (user or internal).
     *
     * @param Node $node
     *
     * @return void
     */
    private function computeFunctionCallVersions(Node $node)
    {
        $element = (string) $node->name;

        $this->computeInternalVersions($node, $element, 'functions');

        if (strcasecmp('define', $element) === 0) {
            // user defined constant
            $name = $node->args[0]->value;
            if (!$name instanceof Node\Scalar\String_) {
                // cannot resolved indirect definition
                return;
            }
            $element = 'constants';
            $name    = $name->value;
            $this->updateElementVersion($element, $name, self::$php4);

            $this->contextStack[] = array($element, $name);

            // update parent context
            $this->updateContextVersion($this->metrics[$element][$name]);
        }
    }

    /**
     * Compute the version of the method's class called.
     *
     * @param Node $node
     *
     * @return void
     */
    private function computeClassMethodCallVersions(Node $node)
    {
        // direct call from a local variable or a property
        $caller = $node->var;

        if ($caller instanceof Node\Expr\New_) {
            // class member access on instantiation
            return $this->computePhpFeatureVersions($node);
        }

        if ($caller instanceof Node\Expr\PropertyFetch) {
            if (!is_string($caller->name)) {
                // indirect method call
                return;
            }
            $propertyName = $caller->name;
            if ($caller->var instanceof Node\Expr\Variable
                && is_string($caller->var->name)
                && isset($this->aliases[$caller->var->name . '_' . $propertyName])
            ) {
                $qualifiedClassName = $this->aliases[$caller->var->name . '_' . $propertyName];
            } else {
                // class name resolver failure
                return;
            }

        } elseif ($caller instanceof Node\Expr\Variable) {
            if (!is_string($caller->name)) {
                // indirect method call
                return;
            }
            if (!isset($this->aliases[$caller->name])) {
                // class name resolver failure
                return;
            }
            $qualifiedClassName = $this->aliases[$caller->name];

            $this->computeInternalVersions($node, $node->name, 'methods', $qualifiedClassName);
        } else {
            // indirect method call
            return;
        }
    }

    /**
     * Compute the version of the static method's class called.
     *
     * @param Node $node
     *
     * @return void
     */
    private function computeStaticClassMethodCallVersions(Node $node)
    {
        if (!$node->class instanceof Node\Name) {
            // cannot resolved indirect call
            return;
        }

        // identify class
        $target   = (string) $node->class;
        $context  = 'classes';
        $versions = $this->references->find($context, $target);
        $this->updateElementVersion($context, $target, $versions);
        ++$this->metrics[$context][$target]['matches'];

        $conditionalCode = isset($this->metrics[$context][$target]['optional']);

        // identify method
        $context  = 'methods';
        $versions = $this->references->find($context, $node->name, count($node->args), $target);
        $target  .= '::' . $node->name;
        $this->updateElementVersion($context, $target, $versions);
        ++$this->metrics[$context][$target]['matches'];

        if ($conditionalCode) {
            // tag method as optional if at least class is optional
            $this->metrics[$context][$target]['optional'] = true;
        }

        $this->contextStack[] = array($context, $target);

        // update context that call this static method
        $this->updateContextVersion();
    }

    /**
     * Compute the version of the constant (user or internal).
     *
     * @param Node   $node
     * @param string $name
     *
     * @return void
     */
    private function computeConstantVersions(Node $node, $name)
    {
        $this->computeInternalVersions($node, $name, 'constants');
    }

    /**
     * Compute the version of specific PHP feature.
     *
     * @param Node $node
     *
     * @return void
     */
    private function computePhpFeatureVersions(Node $node)
    {
        list($element, $name) = end($this->contextStack);

        if ($node instanceof Node\Stmt\Use_) {
            if (Node\Stmt\Use_::TYPE_FUNCTION == $node->type
                || Node\Stmt\Use_::TYPE_CONSTANT == $node->type
            ) {
                // use const, use function
                $versions = array('php.min' => '5.6.0');
                // update current and parent context
                $this->updateElementVersion($element, $name, $versions);
                $this->updateContextVersion($versions);
            }

        } elseif ($node instanceof Node\Stmt\Property) {
            // implicitly public visibility is PHP 4 syntax
            if ($this->isImplicitlyPublicProperty($this->tokens, $node)) {
                return;
            }
            $versions = array('php.min' => '5.0.0');
            // update current context only
            $this->updateElementVersion($element, $name, $versions);

        } elseif ($node instanceof Node\Expr\Array_) {
            if ($this->isShortArraySyntax($this->tokens, $node)) {
                // Array Short Syntax
                // http://php.net/manual/en/migration54.new-features.php
                $versions = array('php.min' => '5.4.0');
                // update current and parent context
                $this->updateElementVersion($element, $name, $versions);
                $this->updateContextVersion($versions);
            }

        } elseif ($node instanceof Node\Expr\ArrayDimFetch
            && $node->var instanceof Node\Expr\FuncCall
        ) {
            // Array Dereferencing
            // http://php.net/manual/en/migration54.new-features.php
            $versions = array('php.min' => '5.4.0');
            // update current and parent context
            $this->updateElementVersion($element, $name, $versions);
            $this->updateContextVersion($versions);

        } elseif ($node instanceof Node\Expr\MethodCall
            && is_string($node->name)
        ) {
            $caller = $node->var;

            if ($caller instanceof Node\Expr\New_) {
                // Class Member Access On Instantiation
                // http://php.net/manual/en/migration54.new-features.php
                $versions = array('php.min' => '5.4.0');
                // update current and parent context
                $this->updateElementVersion($element, $name, $versions);
                $this->updateContextVersion($versions);
            }

        } elseif ($node instanceof Node\Stmt\Goto_) {
            $versions = array('php.min' => '5.3.0');
            // update current and parent context
            $this->updateElementVersion($element, $name, $versions);
            $this->updateContextVersion($versions);

        } elseif ($node instanceof Node\Expr\Empty_) {
            // If the parameter of empty() is an arbitrary expression,
            // and not just a variable.
            if ($node->expr instanceof Node\Expr
                && ! $node->expr instanceof Node\Expr\Variable
                && ! $node->expr instanceof Node\Expr\ArrayDimFetch
                && ! $node->expr instanceof Node\Expr\PropertyFetch) {
                // Prior to PHP 5.5, empty() only supports variables
                // http://php.net/manual/en/function.empty.php
                $versions = array('php.min' => '5.5.0');
                // update current and parent context
                $this->updateElementVersion($element, $name, $versions);
                $this->updateContextVersion($versions);
            }

        } elseif ($node instanceof Node\Expr\AssignOp\Pow) {
            // Exponentiation
            $versions = array('php.min' => '5.6.0');
            // update current and parent context
            $this->updateElementVersion($element, $name, $versions);
            $this->updateContextVersion($versions);

        } elseif ($node instanceof Node\Expr\StaticCall
            && $node->class instanceof Node\Expr\Variable
        ) {
            $versions = array('php.min' => '5.3.0');
            // update current and parent context
            $this->updateElementVersion($element, $name, $versions);
            $this->updateContextVersion($versions);
        }
    }

    /**
     * Compute the version of an internal function.
     *
     * @param Node   $node
     * @param string $element
     * @param string $context
     *
     * @return void
     */
    private function computeInternalVersions(Node $node, $element, $context, $extra = null)
    {
        $versions = $node->getAttribute('compatinfo');
        if ($versions === null) {
            // find reference info
            $argc     = isset($node->args) ? count($node->args) : 0;
            $versions = $this->references->find($context, $element, $argc, $extra);
            $versions['ext.all'] = $versions['php.all'] = '';

            if ($argc) {
                foreach ($node->args as $arg) {
                    if ($arg->value instanceof Node\Expr\BinaryOp\Pow) {
                        // Exponentiation
                        $this->updateVersion('5.6.0', $versions['php.min']);
                    }
                }
            }

            // cache to speed-up later uses
            $node->setAttribute('compatinfo', $versions);
        }
        $node->setAttribute('fileName', $this->file);

        if ('methods' == $context) {
            $element = sprintf('%s::%s', $extra, $element);
        }

        // update versions of $element
        $this->updateElementVersion($context, $element, $versions);
        ++$this->metrics[$context][$element]['matches'];

        $this->contextStack[] = array($context, $element);

        // update parent context
        $this->updateContextVersion($versions);

        if ($versions['ext.name'] !== 'user') {
            // update versions of extension's $element
            $this->updateElementVersion('extensions', $versions['ext.name'], $versions);
        }
    }
}
