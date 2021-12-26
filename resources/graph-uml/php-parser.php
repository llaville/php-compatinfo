<?php declare(strict_types=1);

/**
 * @since Release 6.1.0
 * @author Laurent Laville
 */

require_once dirname(__DIR__, 2) . '/vendor/autoload.php';
require_once __DIR__ . '/Graph.php';

use Symfony\Component\Finder\Finder;

$dataSource = dirname(__DIR__, 2) . '/src/Application/PhpParser/NodeVisitor';
$finder = new Finder();
$finder->in($dataSource)->name('*.php');

(new Graph($finder, basename(__FILE__, '.php'), $argv[1] ?? null))();
